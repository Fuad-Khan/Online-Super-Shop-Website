<?php
// Include database connection
include('includes/db_connection.php');
session_start();

$error_message = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $query = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store user data in session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php"); // Redirect to the homepage or dashboard
            exit(); // Ensure no further code is executed after redirection
        } else {
            $error_message = "Invalid Password!";
        }
    } else {
        $error_message = "Invalid Email Address";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="wrapper">
        <div class="login-container">
            <div class="login-header">
                <h2>Login</h2>
            </div>
            <div class="login-body">
                <form method="POST" action="">
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="button-group">
                        <button type="submit">Login</button>
                    </div>
                </form>
            </div>
            <div class="login-footer">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
            <?php if (!empty($error_message)): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        </div>

    </div>

</body>
</html>