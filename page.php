<!-- page.php - Displays Static Pages (Privacy Policy, Terms of Service) -->
<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php require_once 'config.php'; echo isset($_GET['slug']) ? ucwords(str_replace('-', ' ', $_GET['slug'])) : 'Page'; ?> - <?php echo APP_NAME; ?></title>
    <!-- Bootstrap CSS -->
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
        .page-container {
            max-width: 900px;
            margin: 80px auto 30px; /* Adjust margin for fixed navbar */
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .page-content h1, .page-content h2, .page-content h3 {
            color: #007bff;
            margin-top: 1.5em;
            margin-bottom: 0.8em;
        }
        .page-content p {
            line-height: 1.8;
            margin-bottom: 1em;
            color: #343a40;
        }
        .page-content ul, .page-content ol {
            margin-bottom: 1em;
            padding-left: 20px;
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
                        <a class="nav-link" href="blog.php">Blog</a>
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

    <div class="container page-container">
        <?php
        $slug = $_GET['slug'] ?? ''; // Get slug for the page

        if ($slug) {
            try {
                $stmt = $pdo->prepare("SELECT title, content FROM static_pages WHERE slug = ?");
                $stmt->execute([$slug]);
                $page = $stmt->fetch();

                if ($page) {
                    echo '<h1 class="text-center mb-4">' . htmlspecialchars($page['title']) . '</h1>';
                    echo '<div class="page-content">' . $page['content'] . '</div>'; // Content is HTML, so no htmlspecialchars
                } else {
                    echo '<div class="alert alert-warning rounded-lg" role="alert">Page not found.</div>';
                }
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger rounded-lg" role="alert">Error fetching page content: ' . $e->getMessage() . '</div>';
            }
        } else {
            echo '<div class="alert alert-info rounded-lg" role="alert">No page specified.</div>';
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