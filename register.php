<?php
session_start();
include('includes/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $address = htmlspecialchars($_POST['address']);

    // Check if email exists
    $stmt = $conn->prepare("SELECT email FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    if ($stmt->get_result()->num_rows > 0) {
        $_SESSION['error'] = "Email already exists!";
        header("Location: register.php");
        exit();
    }

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO Users (name, email, password, address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $address);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! Please login.";
        header("Location: login.php");
    } else {
        $_SESSION['error'] = "Registration failed: " . $conn->error;
        header("Location: register.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <?php if (!empty($error_message)): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="register.php">
    <input type="text" name="name" required placeholder="Full Name">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <textarea name="address" required placeholder="Shipping Address"></textarea>
    <button type="submit">Register</button>
</form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>