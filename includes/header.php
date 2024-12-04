<?php
// Database connection file
$server = "localhost";
$username = "root";
$password = "";
$dbname = "shop_db";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOnlineShop</title>
    <link rel="stylesheet" href="css/header.css">
</head>
<body>

<!-- Header Section -->
<header>
    <div class="logo">
        <h1><a href="index.php">TakeItEasy Shop</a></h1>
    </div>
    <nav>
        <a href="cart.php">Cart</a>
        <?php if (isset($_SESSION['user_id'])): ?>
                <a href="orders.php">Your Orders</a></li> <!-- Link to the Orders page -->
            <?php endif; ?>
        <a href="#about-us">About Us</a>
        <a href="#contact">Contact</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Show Profile and Logout if logged in -->
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <!-- Show Login and Register if not logged in -->
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>

</body>
</html>