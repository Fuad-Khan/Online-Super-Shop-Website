<?php
session_start();
include('includes/db_connection.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the user's profile information, including the shipping address
$query = "SELECT address FROM Users WHERE user_id = $user_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $address = $user['address']; // Assuming the address field is 'address'
} else {
    $address = ''; // If no address found, leave it empty
}

// Fetch cart data
$query = "SELECT * FROM Cart WHERE user_id = $user_id";
$cart_result = $conn->query($query);

// Calculate total price
$total_price = 0;
$cart_items = [];
while ($row = $cart_result->fetch_assoc()) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];

    // Get product details
    $product_query = "SELECT * FROM Products WHERE product_id = $product_id";
    $product_result = $conn->query($product_query);
    $product = $product_result->fetch_assoc();

    // Calculate price for the current product
    $product_total = $product['price'] * $quantity;
    $total_price += $product_total;

    $cart_items[] = [
        'product' => $product,
        'quantity' => $quantity,
        'total' => $product_total
    ];
}

// Handle the form submission for placing an order
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $shipping_address = $_POST['address']; // Get address from form
    $_SESSION['address'] = $shipping_address; // Save address in session

    // Insert into Orders table
    $status = 'pending'; // Default status
    $order_query = "INSERT INTO Orders (user_id, total_price, status, shipping_address, created_at) 
                    VALUES ($user_id, $total_price, '$status', '$shipping_address', NOW())";
    if ($conn->query($order_query)) {
        $order_id = $conn->insert_id;

        // Insert items into OrderItems table
        foreach ($cart_items as $item) {
            $order_item_query = "INSERT INTO OrderItems (order_id, product_id, quantity, price) 
                                 VALUES ($order_id, {$item['product']['product_id']}, {$item['quantity']}, {$item['product']['price']})";
            $conn->query($order_item_query);
        }

        // Empty the cart after placing the order
        $conn->query("DELETE FROM Cart WHERE user_id = $user_id");

        // Redirect to order confirmation
        header('Location: order_confirmation.php?order_id=' . $order_id);
        exit();
    } else {
        $error_message = "Failed to place the order. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - MyOnlineShop</title>
    
    <link rel="stylesheet" href="css/checkout.css">
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="checkout-container">
    <h2>Checkout</h2>

    <?php if (isset($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <h3>Cart Items</h3>
    <div class="cart-items">
        <?php foreach ($cart_items as $item): ?>
            <div class="cart-item">
                <img src="images/<?php echo $item['product']['image']; ?>" alt="<?php echo $item['product']['name']; ?>">
                <div class="item-details">
                    <h4><?php echo $item['product']['name']; ?></h4>
                    <p>Price: <?php echo number_format($item['product']['price'], 2); ?> Taka</p>
                    <p>Quantity: <?php echo $item['quantity']; ?></p>
                    <p>Total: <?php echo number_format($item['total'], 2); ?> Taka</p>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>

    <h3>Total Price: <?php echo number_format($total_price, 2); ?> Taka</h3>

    <!-- Address and Checkout Form -->
    <form action="checkout.php" method="POST" class="checkout-form">
        <label for="address">Shipping Address:</label>
        <textarea id="address" name="address" rows="4" required><?php echo htmlspecialchars($address); ?></textarea>

        <button type="submit" class="place-order-btn">Place Order</button>
    </form>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
