<!-- admin/dashboard.php - Admin Dashboard -->
<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - <?php echo APP_NAME; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Inter", sans-serif;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important;
        }
        .admin-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .btn-primary, .btn-info, .btn-warning, .btn-danger {
            border-radius: 8px;
        }
        .list-group-item {
            border-radius: 8px;
            margin-bottom: 5px;
        }
        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Admin Panel for <?php echo APP_NAME; ?></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Welcome, Admin <?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>!</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container admin-container">
        <?php
        // admin/dashboard.php
        require_once '../config.php';

        if (!isLoggedIn() || !isAdmin()) {
            redirect('../login.php'); // Redirect if not logged in or not admin
        }

        $total_students = 0;
        $total_questions = 0;
        $total_blog_posts = 0;
        $total_static_pages = 0;

        try {
            $stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'student'");
            $total_students = $stmt->fetchColumn();

            $stmt = $pdo->query("SELECT COUNT(*) FROM questions");
            $total_questions = $stmt->fetchColumn();

            $stmt = $pdo->query("SELECT COUNT(*) FROM blog_posts");
            $total_blog_posts = $stmt->fetchColumn();

            $stmt = $pdo->query("SELECT COUNT(*) FROM static_pages");
            $total_static_pages = $stmt->fetchColumn();

        } catch (PDOException $e) {
            echo '<div class="alert alert-danger rounded-lg" role="alert">Error fetching dashboard data: ' . $e->getMessage() . '</div>';
        }
        ?>

        <h2 class="text-center mb-4">Admin Dashboard</h2>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Quiz Management</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total Questions: <strong><?php echo $total_questions; ?></strong></p>
                        <a href="manage_questions.php" class="btn btn-primary">Manage Questions</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">User Management</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total Students: <strong><?php echo $total_students; ?></strong></p>
                        <a href="manage_students.php" class="btn btn-info">Manage Students</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Blog Management</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total Blog Posts: <strong><?php echo $total_blog_posts; ?></strong></p>
                        <a href="manage_blog_posts.php" class="btn btn-success">Manage Blog Posts</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Page Management</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Total Static Pages: <strong><?php echo $total_static_pages; ?></strong></p>
                        <a href="manage_pages.php" class="btn btn-warning">Manage Static Pages</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Latest Quiz Results</h5>
            </div>
            <div class="card-body">
                <?php
                try {
                    $stmt = $pdo->query("SELECT u.full_name, r.score, r.total_questions, r.percentage, r.passed, r.test_date
                                         FROM results r
                                         JOIN users u ON r.user_id = u.id
                                         ORDER BY r.test_date DESC
                                         LIMIT 10");
                    $latest_results = $stmt->fetchAll();

                    if (empty($latest_results)) {
                        echo '<div class="alert alert-info rounded-lg" role="alert">No quiz results yet.</div>';
                    } else {
                        echo '<ul class="list-group">';
                        foreach ($latest_results as $result) {
                            echo '<li class="list-group-item d-flex justify-content-between align-items-center rounded-lg">';
                            echo '<div>';
                            echo '<strong>' . htmlspecialchars($result['full_name']) . '</strong> - ';
                            echo 'Score: ' . htmlspecialchars($result['score']) . '/' . htmlspecialchars($result['total_questions']) . ' ';
                            echo '(' . number_format($result['percentage'], 2) . '%)';
                            echo '<br><small class="text-muted">Date: ' . htmlspecialchars($result['test_date']) . '</small>';
                            echo '</div>';
                            echo '<span class="badge ' . ($result['passed'] ? 'bg-success' : 'bg-danger') . ' rounded-pill">';
                            echo ($result['passed'] ? 'Passed' : 'Failed');
                            echo '</span>';
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                } catch (PDOException $e) {
                    echo '<div class="alert alert-danger rounded-lg" role="alert">Error fetching latest results: ' . $e->getMessage() . '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
