<!-- admin/manage_students.php - Admin: Manage Students -->
<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students - Admin Panel</title>
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
        .btn-danger, .btn-info {
            border-radius: 8px;
        }
        .table {
            margin-top: 20px;
        }
        .table thead th {
            background-color: #e9ecef;
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
        <h2 class="text-center mb-4">Manage Students for <?php echo APP_NAME; ?></h2>

        <?php
        // admin/manage_students.php - PHP backend for student management

        if (!isLoggedIn() || !isAdmin()) {
            redirect('../login.php');
        }

        $message = '';
        $message_type = '';

        // Handle Delete Student
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $user_id = (int)$_GET['id'];
            if ($user_id === $_SESSION['user_id']) {
                $message = 'You cannot delete your own admin account.';
                $message_type = 'danger';
            } else {
                try {
                    // Deleting user will cascade delete their responses and results
                    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ? AND role = 'student'"); // Only allow deleting students
                    $stmt->execute([$user_id]);
                    if ($stmt->rowCount() > 0) {
                        $message = 'Student deleted successfully!';
                        $message_type = 'success';
                    } else {
                        $message = 'Student not found or could not be deleted.';
                        $message_type = 'warning';
                    }
                } catch (PDOException $e) {
                    $message = 'Error deleting student: ' . $e->getMessage();
                    $message_type = 'danger';
                }
            }
        }
        ?>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?> rounded-lg" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Student List -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Registered Students</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Registered On</th>
                                <th>Latest Score</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $stmt = $pdo->query("SELECT u.id, u.full_name, u.username, u.email, u.created_at,
                                                            r.score, r.total_questions, r.percentage, r.passed
                                                     FROM users u
                                                     LEFT JOIN (
                                                        SELECT user_id, score, total_questions, percentage, passed
                                                        FROM results
                                                        WHERE (user_id, test_date) IN (
                                                            SELECT user_id, MAX(test_date)
                                                            FROM results
                                                            GROUP BY user_id
                                                        )
                                                     ) r ON u.id = r.user_id
                                                     WHERE u.role = 'student'
                                                     ORDER BY u.created_at DESC");
                                $students = $stmt->fetchAll();

                                if (empty($students)) {
                                    echo '<tr><td colspan="7" class="text-center">No students registered yet.</td></tr>';
                                } else {
                                    foreach ($students as $student) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($student['id']) . '</td>';
                                        echo '<td>' . htmlspecialchars($student['full_name']) . '</td>';
                                        echo '<td>' . htmlspecialchars($student['username']) . '</td>';
                                        echo '<td>' . htmlspecialchars($student['email']) . '</td>';
                                        echo '<td>' . htmlspecialchars($student['created_at']) . '</td>';
                                        echo '<td>';
                                        if ($student['score'] !== null) {
                                            echo htmlspecialchars($student['score']) . '/' . htmlspecialchars($student['total_questions']) . ' ';
                                            echo '(' . number_format($student['percentage'], 2) . '%) ';
                                            echo '<span class="badge ' . ($student['passed'] ? 'bg-success' : 'bg-danger') . ' rounded-pill">' . ($student['passed'] ? 'Passed' : 'Failed') . '</span>';
                                        } else {
                                            echo 'N/A';
                                        }
                                        echo '</td>';
                                        echo '<td>';
                                        echo '<a href="manage_students.php?action=delete&id=' . $student['id'] . '" class="btn btn-danger btn-sm rounded-md" onclick="return confirm(\'Are you sure you want to delete this student and all their data?\');">Delete</a>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            } catch (PDOException $e) {
                                echo '<tr><td colspan="7" class="text-center text-danger">Error loading students: ' . $e->getMessage() . '</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
