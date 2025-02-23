<?php
// Database connection file
$server = "localhost";
$username = "root";
$password = "";
$dbname = "online_super_shop";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error); // Log error
    die("Database connection error. Please try again later."); // User-friendly message
}
?>
