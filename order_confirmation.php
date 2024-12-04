<?php
session_start();
include('includes/db_connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch order details
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;
if ($order_id) {
    $order_query = "SELECT * FROM Orders WHERE order_id = $order_id";
    $order_result = $conn->query($order_query);

    if ($order_result->num_rows > 0) {
        $order = $order_result->fetch_assoc();
    } else {
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - MyOnlineShop</title>
   
    <link rel="stylesheet" href="css/order_confirmation.css">
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="order-confirmation-container">
    <h1>Thank You for Your Order!</h1>
    <p>Your order has been placed successfully. Below are your order details:</p>

    <h3>Order ID: <?php echo $order['order_id']; ?></h3>
    <p>Status: <?php echo $order['status']; ?></p>
    <p>Shipping Address: <?php echo htmlspecialchars($order['shipping_address']); ?></p>
    <p>Total Price: <?php echo number_format($order['total_price'], 2); ?> Taka</p>

    <a href="index.php" class="btn">Continue Shopping</a>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
