<?php
session_start();
include('includes/db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get product ID and quantity from the form
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$user_id = $_SESSION['user_id'];

// Check if the product is already in the cart
$query = "SELECT * FROM Cart WHERE user_id = $user_id AND product_id = $product_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Update the quantity if the product already exists in the cart
    $update_query = "UPDATE Cart SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id";
    $conn->query($update_query);
} else {
    // Add new product to the cart
    $insert_query = "INSERT INTO Cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)";
    $conn->query($insert_query);
}

// Redirect back to the product listing page
header('Location: index.php');
exit();
?>
