<?php
session_start();
include('includes/db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$query = "SELECT * FROM Users WHERE user_id = $user_id";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    echo "User not found.";
    exit();
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - MyOnlineShop</title>
 
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="profile">
    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?></h2>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
    <p><strong>Joined on:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>

    <a href="edit_profile.php">Edit Profile</a>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
