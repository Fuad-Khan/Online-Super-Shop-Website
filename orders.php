<?php
session_start();
include('includes/db_connection.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Query to get orders for the logged-in user
$orders_query = "SELECT * FROM Orders WHERE user_id = $user_id ORDER BY created_at DESC";
$orders_result = $conn->query($orders_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>

    <link rel="stylesheet" href="css/orders.css">
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="orders-container">
    <h2>Your Orders</h2>

    <?php if ($orders_result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Shipping Address</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = $orders_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo number_format($order['total_price'], 2); ?> Taka</td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td><?php echo htmlspecialchars($order['shipping_address']); ?></td>
                        <td><?php echo $order['created_at']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have not placed any orders yet.</p>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
