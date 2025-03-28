<?php
session_start();
include('includes/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, name, password, role FROM Users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit();
        }
    }
    
    $_SESSION['error'] = "Invalid email or password!";
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <section>
        <form method="POST" action="">
            <h1>Login</h1>
            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" name="email" required placeholder=" ">
                <label>Email</label>
            </div>

            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" name="password" required placeholder=" ">
                <label>Password</label>
            </div>

            <div class="forget">
                <label><input type="checkbox"> Remember Me</label>
                <a href="#">Forgot Password?</a>
            </div>

            <button type="submit">Log in</button>

            <div class="register">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="error-message">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
        </form>
        <button class="btn-home" onclick="window.location.href='index.php';">Back to Home</button>
    </section>
</body>
</html>
