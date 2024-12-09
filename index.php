<?php
session_start(); // Start the session
// Database connection
include('includes/db_connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories from the database
$category_query = "SELECT * FROM Categories";
$category_result = $conn->query($category_query);

// Fetch products based on category if selected or search query
$category_id = isset($_GET['category_id']) && $_GET['category_id'] != 'all' ? $_GET['category_id'] : '';
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

// Build the query to fetch products
$product_query = "SELECT * FROM Products WHERE 1";

if ($category_id) {
    $product_query .= " AND category_id = '$category_id'";
}

if ($search_query) {
    $product_query .= " AND (name LIKE '%$search_query%' OR description LIKE '%$search_query%')";
}

// Add randomness to the query
$product_query .= " ORDER BY RAND()";

$product_result = $conn->query($product_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Shop</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <!-- Header Section with Navbar -->
    <?php include('includes/header.php'); ?>


    <!-- Search Bar Section -->
    <div class="search-bar-container">
        <div class="search-category">
            <select id="category-dropdown" class="category-dropdown" onchange="filterByCategory()">
                <option value="all">All Categories</option>
                <?php while ($category = $category_result->fetch_assoc()): ?>
                    <option value="<?php echo $category['category_id']; ?>" <?php echo ($category_id == $category['category_id']) ? 'selected' : ''; ?>>
                        <?php echo $category['name']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <input type="text" id="search-input" class="search-input" placeholder="Search Products..." value="<?php echo $search_query; ?>">

            <button type="button" id="search-button" onclick="searchProducts()">Search</button>
        </div>
    </div>



    <div id="products">
        <h2>Products</h2>
        <div class="product-list">
            <?php while ($product = $product_result->fetch_assoc()): ?>
                <div class="product-card">
                    <!-- Product Image and Title -->
                    <a href="product_details.php?product_id=<?php echo $product['product_id']; ?>">
                        <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-img">
                        <h3><?php echo $product['name']; ?></h3>
                    </a>

                    <!-- Product Body -->
                    <div class="product-body">
                        <p><?php echo $product['description']; ?></p>
                        <p><strong><?php echo number_format($product['price'], 2); ?> Taka</strong></p>

                        <!-- Add-to-Cart Form -->
                        <form class="addtocart" action="add_to_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <input type="number" name="quantity" value="1" min="1">
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>



    <!-- Footer Section -->
    <?php include('includes/footer.php'); ?>

    <script>
        // JavaScript to handle category filter and search bar functionality
        function filterByCategory() {
            const category_id = document.getElementById("category-dropdown").value;
            const search_query = document.getElementById("search-input").value;
            window.location.href = `index.php?category_id=${category_id}&search_query=${search_query}`;
        }

        function searchProducts() {
            const search_query = document.getElementById("search-input").value;
            const category_id = document.getElementById("category-dropdown").value;
            window.location.href = `index.php?category_id=${category_id}&search_query=${search_query}`;
        }

        document.addEventListener("DOMContentLoaded", () => {
            const menuToggle = document.querySelector(".menu-toggle");
            const navLinks = document.querySelector(".nav-links");

            menuToggle.addEventListener("click", () => {
                navLinks.classList.toggle("active");
            });
        });
    </script>

</body>

</html>