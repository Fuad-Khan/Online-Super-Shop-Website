<?php
// Include database connection
include('includes/db_connection.php');

$error_message = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $query = "SELECT * FROM Users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $error_message = "Email already exists!";
    } else {
        // Insert user into the database
        $insert_query = "INSERT INTO Users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', 'customer')";
        if ($conn->query($insert_query)) {
            $error_message = "Registration successful! You can <a href='login.php'>login</a> now.";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
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
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Full Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>