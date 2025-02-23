<?php
session_start();
include('includes/db_connection.php');

// Verify login status
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    // Get cart items with product details in single query
    $query = "SELECT 
                c.cart_id,
                c.quantity,
                p.product_id,
                p.name,
                p.price,
                p.image
              FROM Cart c
              JOIN Products p ON c.product_id = p.product_id
              WHERE c.user_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $total_price = 0;
    $cart_items = [];
    
    while ($row = $result->fetch_assoc()) {
        $item_total = $row['price'] * $row['quantity'];
        $total_price += $item_total;
        
        $cart_items[] = [
            'cart_id' => $row['cart_id'],
            'product_id' => $row['product_id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'image' => $row['image'],
            'quantity' => $row['quantity'],
            'total' => $item_total
        ];
    }
    
} catch (Exception $e) {
    error_log("Cart Error: " . $e->getMessage());
    die("Error loading cart. Please try again later.");
}

// Handle actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['remove_item'])) {
        $cart_id = (int)$_POST['cart_id'];
        $delete_stmt = $conn->prepare("DELETE FROM Cart WHERE cart_id = ? AND user_id = ?");
        $delete_stmt->bind_param("ii", $cart_id, $user_id);
        $delete_stmt->execute();
        header("Location: cart.php");
        exit();
    }
    
    if (isset($_POST['update_quantity'])) {
        $cart_id = (int)$_POST['cart_id'];
        $quantity = (int)$_POST['quantity'];
        
        if ($quantity > 0) {
            $update_stmt = $conn->prepare("UPDATE Cart SET quantity = ? WHERE cart_id = ? AND user_id = ?");
            $update_stmt->bind_param("iii", $quantity, $cart_id, $user_id);
            $update_stmt->execute();
        }
        header("Location: cart.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - MyOnlineShop</title>
   
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="cart-container">
        <?php if (empty($cart_items)): ?>
            <p>Your cart is empty. <a href="index.php">Continue shopping</a></p>
        <?php else: ?>
            <!-- Display cart items with proper IDs -->
            <?php foreach ($cart_items as $item): ?>
                <div class="cart-item">
                    <img src="images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    <div class="item-details">
                        <h4><?= htmlspecialchars($item['name']) ?></h4>
                        <p>Price: <?= number_format($item['price'], 2) ?> Taka</p>
                        <form method="POST">
                            <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1">
                            <button type="submit" name="update_quantity">Update</button>
                        </form>
                        <form method="POST">
                            <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                            <button type="submit" name="remove_item">Remove</button>
                        </form>
                        <p>Total: <?= number_format($item['total'], 2) ?> Taka</p>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <h3>Total Price: <?= number_format($total_price, 2) ?> Taka</h3>
            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
        <?php endif; ?>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
</html>