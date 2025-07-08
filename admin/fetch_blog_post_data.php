<?php
// admin/fetch_blog_post_data.php - Fetches single blog post data for editing
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
    $post_id = (int)$_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT id, title, content, status FROM blog_posts WHERE id = ?");
        $stmt->execute([$post_id]);
        $post = $stmt->fetch();

        if ($post) {
            echo json_encode($post);
            exit(); // Ensure no further output after JSON
        } else {
            echo json_encode(null); // Post not found
            exit(); // Ensure no further output
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
        exit(); // Ensure no further output on error
    }
} else {
    echo json_encode(['error' => 'No post ID provided.']);
    exit(); // Ensure no further output
}