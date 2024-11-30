<?php
session_start();
include('includes/db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$cart_id = $_POST['cart_id'];
$quantity = $_POST['quantity'];

// Update the cart item quantity
$query = "UPDATE Cart SET quantity = ? WHERE cart_id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("iii", $quantity, $cart_id, $user_id);
$stmt->execute();

header('Location: cart.php');
exit();
?>
