<?php
// config.php - Database connection and global configurations

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Replace with your database username
define('DB_PASS', '');     // Replace with your database password
define('DB_NAME', 'dnys'); // The database name defined in the schema

// Define the new application name
define('APP_NAME', 'Diploma in Naturopathy and Yogic Science');

// Establish database connection using PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Define minimum passing percentage for certificates
define('PASSING_PERCENTAGE', 60);

// Start session (important for user authentication)
session_start();

// Function to redirect
function redirect($url) {
    header("Location: " . $url);
    exit();
}

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to check if user is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Function to sanitize input (basic example, more robust validation needed for production)
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
