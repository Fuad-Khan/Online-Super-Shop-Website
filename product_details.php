<?php
session_start();
include('includes/db_connection.php');

// Ensure the product ID is passed as a parameter
if (!isset($_GET['product_id'])) {
    echo "Product not found.";
    exit();
}

$product_id = $_GET['product_id'];

// Fetch the product details from the database
$product_query = "SELECT * FROM Products WHERE product_id = $product_id";
$product_result = $conn->query($product_query);

if ($product_result->num_rows === 0) {
    echo "Product not found.";
    exit();
}

$product = $product_result->fetch_assoc();

// Fetch product reviews and ratings
$reviews_query = "SELECT * FROM Reviews WHERE product_id = $product_id";
$reviews_result = $conn->query($reviews_query);

// Handle the form submission for adding a review
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_review'])) {
    $user_id = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    // Insert the review into the database
    $insert_review_query = "INSERT INTO Reviews (user_id, product_id, rating, review_text) VALUES ($user_id, $product_id, $rating, '$review_text')";
    if ($conn->query($insert_review_query)) {
        header("Location: product_details.php?product_id=$product_id"); // Redirect to the same page to see the new review
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Handle the "Add to Cart" functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_id'];

    // Check if the product is already in the cart
    $check_cart_query = "SELECT * FROM Cart WHERE user_id = $user_id AND product_id = $product_id";
    $cart_result = $conn->query($check_cart_query);

    if ($cart_result->num_rows > 0) {
        // Update the quantity if the product already exists in the cart
        $update_cart_query = "UPDATE Cart SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id";
        $conn->query($update_cart_query);
    } else {
        // Add new product to the cart
        $add_to_cart_query = "INSERT INTO Cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)";
        $conn->query($add_to_cart_query);
    }

    $message = "Product added to cart!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - Product Details</title>
    
    <link rel="stylesheet" href="css/product_details.css">
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="product-details">
    <h2><?php echo $product['name']; ?></h2>
    <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <p><strong>Price:</strong> <?php echo number_format($product['price'], 2); ?> Taka</p>
    <p><?php echo $product['description']; ?></p>

    <!-- Add to Cart Form -->
    <form action="product_details.php?product_id=<?php echo $product_id; ?>" method="POST">
        <label for="quantity">Quantity: </label>
        <input type="number" name="quantity" value="1" min="1" required>
        <button type="submit" name="add_to_cart">Add to Cart</button>
    </form>

    <!-- Confirmation Message -->
    <?php if (isset($message)): ?>
        <p style="color: green;"><?php echo $message; ?></p>
        <a href="cart.php"><button>Go to Cart</button></a>

        <!-- Checkout Button -->
        <a href="checkout.php"><button>Proceed to Checkout</button></a>
    <?php endif; ?>

<!-- Reviews Box Section -->
<div class="reviews-box">
    <h3>Reviews</h3>
    <?php if ($reviews_result->num_rows > 0): ?>
        <ul>
            <?php while ($review = $reviews_result->fetch_assoc()): ?>
                <li>
                    <p class="rating">Rating: <?php echo $review['rating']; ?>/5</p>
                    <p><?php echo $review['review_text']; ?></p>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p class="no-reviews">No reviews yet. Be the first to review this product!</p>
    <?php endif; ?>
</div>

    <!-- Review Form -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <h4>Leave a Review</h4>
        <form action="product_details.php?product_id=<?php echo $product_id; ?>" method="POST">
            <label for="rating">Rating: </label>
            <select name="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select><br>
            <label for="review_text">Review: </label>
            <textarea name="review_text" required></textarea><br>
            <button type="submit" name="submit_review">Submit Review</button>
        </form>
    <?php else: ?>
        <p>You must <a href="login.php">login</a> to leave a review.</p>
    <?php endif; ?>

</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
