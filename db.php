<?php
$host = "localhost";  // Change if using a different host
$user = "root";       // Your database username (default is 'root' for XAMPP)
$pass = "";           // Your database password (default is empty for XAMPP)
$dbname = "fishing_boat_db";  // Database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
