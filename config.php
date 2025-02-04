<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "users_db";

try {
    // Create a new MySQLi connection
    $conn = new mysqli($host, $user, $password, $database);

    // Check for connection errors
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {

    // Log the error instead of displaying it
    error_log("[" . date("Y-m-d H:i:s") . "] Database Connection Error: " . $e->getMessage() . "\n", 3, "errors.log");

    // Display a generic error message to users
    die("Database connection failed. Please try again later.");
    
}
?>
