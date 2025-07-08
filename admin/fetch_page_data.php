<?php
// admin/fetch_page_data.php - Fetches single static page data for editing
require_once '../config.php';

// Temporarily enable error reporting for debugging. Remove in production.
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type header to ensure JSON is parsed correctly
header('Content-Type: application/json');

if (!isLoggedIn() || !isAdmin()) {
    echo json_encode(['error' => 'Unauthorized']);
    exit(); // Ensure no further output
}

if (isset($_GET['id'])) {
    $page_id = (int)$_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT id, title, content FROM static_pages WHERE id = ?");
        $stmt->execute([$page_id]);
        $page = $stmt->fetch();

        if ($page) {
            echo json_encode($page);
            exit(); // Ensure no further output after JSON
        } else {
            echo json_encode(null); // Page not found
            exit(); // Ensure no further output
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
        exit(); // Ensure no further output on error
    }
} else {
    echo json_encode(['error' => 'No page ID provided.']);
    exit(); // Ensure no further output
}
// IMPORTANT: No closing PHP tag `?>` here to prevent accidental whitespace output.
