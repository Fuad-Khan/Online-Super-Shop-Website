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
        <h1><a href="index.php">Easy Shop</a></h1>
    </div>

    <nav>
        <a href="cart.php" class="<?= basename($_SERVER['PHP_SELF']) === 'cart.php' ? 'active' : '' ?>"><i class="fas fa-shopping-cart"></i> Cart</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="orders.php"><i class="fas fa-box"></i> Your Orders</a>
            <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
            <a href="#about-us"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="#contact"><i class="fas fa-envelope"></i> Contact</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <?php else: ?>
            <a href="#about-us"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="#contact"><i class="fas fa-envelope"></i> Contact</a>
            <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
            <a href="register.php"><i class="fas fa-user-plus"></i> Register</a>
        <?php endif; ?>

    </nav>
</header>

</body>
</html>