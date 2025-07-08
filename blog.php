<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - <?php require_once 'config.php'; echo APP_NAME; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    
    <style>
        body {
            font-family: "Inter", sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #007bff;
            padding: 1rem 0;
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important;
            font-weight: bold;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #e2e6ea !important;
        }
        .blog-container {
            max-width: 900px;
            margin: 80px auto 30px; /* Adjust margin for fixed navbar */
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .blog-post-card {
            margin-bottom: 30px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        .blog-post-card .card-body {
            padding: 25px;
        }
        .blog-post-card h2 {
            color: #007bff;
            margin-bottom: 10px;
        }
        .blog-post-card .post-meta {
            font-size: 0.9em;
            color: #6c757d;
            margin-bottom: 15px;
        }
        .blog-post-card .btn-read-more {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 8px;
            padding: 8px 15px;
            font-size: 0.9rem;
        }
        .blog-post-card .btn-read-more:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .full-post-content {
            margin-top: 20px;
            line-height: 1.8;
            color: #343a40;
        }
        .full-post-content h1, .full-post-content h2, .full-post-content h3 {
            color: #007bff;
            margin-top: 1.5em;
            margin-bottom: 0.8em;
        }
        .full-post-content p {
            margin-bottom: 1em;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
            text-align: center;
            margin-top: 50px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php"><?php echo APP_NAME; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="blog.php">Blog</a>
                    </li>
                    <?php if (isLoggedIn()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="quiz.php">Take Quiz</a>
                        </li>
                        <?php if (isAdmin()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="admin/dashboard.php">Admin Panel</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container blog-container">
        <?php
        $slug = $_GET['slug'] ?? ''; // Get slug for single post view

        if ($slug) {
            // Display single blog post
            try {
                $stmt = $pdo->prepare("SELECT bp.title, bp.content, bp.created_at, u.full_name AS author_name
                                     FROM blog_posts bp
                                     LEFT JOIN users u ON bp.author_id = u.id
                                     WHERE bp.slug = ? AND bp.status = 'published'");
                $stmt->execute([$slug]);
                $post = $stmt->fetch();

                if ($post) {
                    echo '<h1 class="text-center mb-4">' . htmlspecialchars($post['title']) . '</h1>';
                    echo '<p class="text-center post-meta">Published on ' . date('F j, Y', strtotime($post['created_at'])) . ' by ' . htmlspecialchars($post['author_name'] ?? 'Admin') . '</p>';
                    echo '<div class="full-post-content">' . $post['content'] . '</div>'; // Content is HTML, so no htmlspecialchars
                    echo '<div class="text-center mt-5"><a href="blog.php" class="btn btn-primary">Back to Blog Posts</a></div>';
                } else {
                    echo '<div class="alert alert-warning rounded-lg" role="alert">Blog post not found or not published.</div>';
                    echo '<div class="text-center mt-3"><a href="blog.php" class="btn btn-primary">Back to Blog Posts</a></div>';
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger rounded-lg" role="alert">Error fetching blog post: ' . $e->getMessage() . '</div>';
            }
        } else {
            // Display list of blog posts
            echo '<h1 class="text-center mb-4">Our Blog</h1>';
            try {
                $stmt = $pdo->query("SELECT bp.title, bp.slug, bp.content, bp.created_at, u.full_name AS author_name
                                     FROM blog_posts bp
                                     LEFT JOIN users u ON bp.author_id = u.id
                                     WHERE bp.status = 'published'
                                     ORDER BY bp.created_at DESC");
                $posts = $stmt->fetchAll();

                if (empty($posts)) {
                    echo '<div class="alert alert-info rounded-lg" role="alert">No blog posts published yet.</div>';
                } else {
                    foreach ($posts as $post) {
                        // Create a short snippet for the preview
                        $snippet = strip_tags($post['content']); // Remove HTML tags
                        $snippet = substr($snippet, 0, 200); // Take first 200 characters
                        if (strlen(strip_tags($post['content'])) > 200) {
                            $snippet .= '...'; // Add ellipsis if content is longer
                        }

                        echo '<div class="card blog-post-card">';
                        echo '<div class="card-body">';
                        echo '<h2>' . htmlspecialchars($post['title']) . '</h2>';
                        echo '<p class="post-meta">Published on ' . date('F j, Y', strtotime($post['created_at'])) . ' by ' . htmlspecialchars($post['author_name'] ?? 'Admin') . '</p>';
                        echo '<p>' . htmlspecialchars($snippet) . '</p>';
                        echo '<a href="blog.php?slug=' . urlencode($post['slug']) . '" class="btn btn-primary btn-read-more">Read More</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger rounded-lg" role="alert">Error fetching blog posts: ' . $e->getMessage() . '</div>';
            }
        }
        ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> <?php echo APP_NAME; ?>. All rights reserved.</p>
            <p>
                <a href="page.php?slug=privacy-policy" class="text-white text-decoration-none">Privacy Policy</a> |
                <a href="page.php?slug=terms-of-service" class="text-white text-decoration-none">Terms of Service</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>