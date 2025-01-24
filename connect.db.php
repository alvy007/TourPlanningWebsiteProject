<?php
// Database connection details
$host = "localhost"; // Replace with your database host (e.g., "127.0.0.1" or a server URL)
$username = "travel";  // Replace with your database username
$password = "";      // Replace with your database password
$dbname = "pothik"; // Replace with your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>