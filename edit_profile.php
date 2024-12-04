<?php
session_start();
include('includes/db_connection.php');

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// Fetch user data
$query = "SELECT * FROM Users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Update user details
    $update_query = "UPDATE Users SET name = ?, email = ?, address = ? WHERE user_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param('sssi', $name, $email, $address, $user_id);

    if ($update_stmt->execute()) {
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
   
    <link rel="stylesheet" href="css/edit_profile.css">
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <h2>Edit Profile</h2>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
        <form action="edit_profile.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required><?php echo htmlspecialchars($user['address']); ?></textarea>

            <button type="submit">Update Profile</button>
        </form>
    </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>
