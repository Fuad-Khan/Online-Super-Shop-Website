<?php
// Database connection file
$server = "localhost";
$username = "root";
$password = "";
$dbname = "shop_db";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
