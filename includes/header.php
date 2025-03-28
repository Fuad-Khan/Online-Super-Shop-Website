<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOnlineShop</title>
    <link rel="stylesheet" href="css/header.css">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<!-- Header Section -->
<header>
    <div class="logo">
        <h1><a href="index.php">Easy Shop</a></h1>
    </div>

    <!-- Mobile Hamburger Button -->
    <button class="menu-toggle" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>

    <nav class="nav-menu">
        <a href="cart.php" class="<?= strpos($_SERVER['REQUEST_URI'], 'cart.php') !== false ? 'active' : '' ?>">
            <i class="fas fa-shopping-cart"></i> <span class="nav-text">Cart</span>
        </a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="orders.php"><i class="fas fa-box"></i> <span class="nav-text">Your Orders</span></a>
            <a href="profile.php"><i class="fas fa-user"></i> <span class="nav-text">Profile</span></a>
            <a href="#about-us"><i class="fas fa-info-circle"></i> <span class="nav-text">About Us</span></a>
            <a href="#contact"><i class="fas fa-envelope"></i> <span class="nav-text">Contact</span></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span class="nav-text">Logout</span></a>
        <?php else: ?>
            <a href="#about-us"><i class="fas fa-info-circle"></i> <span class="nav-text">About Us</span></a>
            <a href="#contact"><i class="fas fa-envelope"></i> <span class="nav-text">Contact</span></a>
            <a href="login.php"><i class="fas fa-sign-in-alt"></i> <span class="nav-text">Login</span></a>
            <a href="register.php"><i class="fas fa-user-plus"></i> <span class="nav-text">Register</span></a>
        <?php endif; ?>
    </nav>
</header>

<script>
    // Mobile menu toggle
    document.querySelector('.menu-toggle').addEventListener('click', function() {
        document.querySelector('.nav-menu').classList.toggle('active');
        this.classList.toggle('active');
    });
</script>

</body>
</html>