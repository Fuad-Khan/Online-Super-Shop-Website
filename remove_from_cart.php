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

// Delete the item from the cart
$query = "DELETE FROM Cart WHERE cart_id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $cart_id, $user_id);
$stmt->execute();

header('Location: cart.php');
exit();
?>
