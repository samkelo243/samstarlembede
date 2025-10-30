<?php
$host = "localhost";     // database host
$user = "root";          // database username
$pass = "";              // database password
$dbname = "portfolio_db";  // your database name

// First connect to MySQL server (without specifying DB)
$conn = new mysqli($host, $user, $pass);

// Check server connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Try selecting the database
if (!$conn->select_db($dbname)) {
    die("Database '$dbname' not found. Please create it first.");
}
?>
