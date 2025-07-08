<!-- result.php - Displays Quiz Results -->
<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result - <?php echo APP_NAME; ?></title>
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
        .result-container {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .result-container h2 {
            color: #007bff;
            margin-bottom: 25px;
        }
        .result-item {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .score-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 20px;
        }
        .pass-fail {
            font-size: 1.8rem;
            font-weight: bold;
            margin-top: 20px;
        }
        .pass {
            color: #28a745;
        }
        .fail {
            color: #dc3545;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 1.1rem;
            margin-top: 20px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 1.1rem;
            margin-top: 20px;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><?php echo APP_NAME; ?></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>!</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container result-container">
        <?php
        // result.php - Displays quiz results

        if (!isLoggedIn()) {
            redirect('login.php');
        }

        $result = $_SESSION['quiz_result'] ?? null;
        unset($_SESSION['quiz_result']); // Clear result from session after displaying

        if (!$result) {
            // If result not in session, try to fetch the latest from DB
            try {
                $stmt = $pdo->prepare("SELECT score, total_questions, percentage, passed FROM results WHERE user_id = ? ORDER BY test_date DESC LIMIT 1");
                $stmt->execute([$_SESSION['user_id']]);
                $result = $stmt->fetch();
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger rounded-lg" role="alert">Error fetching results: ' . $e->getMessage() . '</div>';
                $result = null;
            }
        }

        if ($result):
        ?>
            <h2 class="mb-4">Your Quiz Results for <?php echo APP_NAME; ?></h2>
            <div class="score-display">
                <?php echo htmlspecialchars($result['score']); ?> / <?php echo htmlspecialchars($result['total_questions']); ?>
            </div>
            <p class="result-item"><strong>Percentage:</strong> <?php echo number_format($result['percentage'], 2); ?>%</p>
            <p class="pass-fail <?php echo $result['passed'] ? 'pass' : 'fail'; ?>">
                <?php echo $result['passed'] ? 'Congratulations! You Passed!' : 'Sorry, you did not pass.'; ?>
            </p>

            <?php if ($result['passed']): ?>
                <a href="generate_certificate.php" class="btn btn-success mt-3">Download Certificate</a>
            <?php endif; ?>

            <a href="quiz.php" class="btn btn-primary mt-3">Retake Quiz</a>
            <a href="logout.php" class="btn btn-secondary mt-3">Logout</a>

        <?php else: ?>
            <div class="alert alert-info rounded-lg" role="alert">
                No quiz results found. Please take the quiz first.
            </div>
            <a href="quiz.php" class="btn btn-primary mt-3">Start Quiz</a>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
