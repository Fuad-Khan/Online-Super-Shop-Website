<?php
session_start();
include('includes/db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user cart items
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM Cart WHERE user_id = $user_id";
$cart_result = $conn->query($query);

// Initialize total price variable
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

// Handle remove action
if (isset($_POST['remove_item'])) {
    $product_id = intval($_POST['product_id']);
    $delete_query = "DELETE FROM Cart WHERE user_id = $user_id AND product_id = $product_id";
    $conn->query($delete_query);
    header('Location: cart.php');
    exit();
}

// Handle quantity update
if (isset($_POST['update_quantity'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    if ($quantity > 0) {
        $update_query = "UPDATE Cart SET quantity = $quantity WHERE user_id = $user_id AND product_id = $product_id";
        $conn->query($update_query);
    }
    header('Location: cart.php');
    exit();
}


// Handle placing the order (checkout)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
    header('Location: checkout.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - MyOnlineShop</title>
   
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="cart-container">
    <h2>Your Shopping Cart</h2>

    <?php if (empty($cart_items)): ?>
        <p>Your cart is empty. <a href="index.php">Go back to shopping.</a></p>
    <?php else: ?>
        <div class="cart-items">
    <?php foreach ($cart_items as $item): ?>
        <div class="cart-item">
            <img src="images/<?php echo $item['product']['image']; ?>" alt="<?php echo $item['product']['name']; ?>">
            <div class="item-details">
                <h4><?php echo $item['product']['name']; ?></h4>
                <p>Price: <?php echo number_format($item['product']['price'], 2); ?> Taka</p>
                <form action="cart.php" method="POST" class="update-form">
                    <input type="hidden" name="product_id" value="<?php echo $item['product']['product_id']; ?>">
                    <label for="quantity-<?php echo $item['product']['product_id']; ?>">Quantity:</label>
                    <input type="number" id="quantity-<?php echo $item['product']['product_id']; ?>" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                    <button type="submit" name="update_quantity">Update</button>
                </form>
                <p>Total: <?php echo number_format($item['total'], 2); ?> Taka</p>
                <form action="cart.php" method="POST" class="remove-form">
                    <input type="hidden" name="product_id" value="<?php echo $item['product']['product_id']; ?>">
                    <button type="submit" name="remove_item" class="remove-btn">Remove</button>
                </form>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
</div>


        <h3>Total Price: <?php echo number_format($total_price, 2); ?> Taka</h3>

        <form action="cart.php" method="POST">
            <button type="submit" name="checkout" class="checkout-btn">Proceed to Checkout</button>
        </form>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
