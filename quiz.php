<!-- quiz.php - Question Paper Page -->
<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - <?php echo APP_NAME; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
        .quiz-container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .question-card {
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            background-color: #fefefe;
        }
        .question-card h5 {
            margin-bottom: 15px;
            color: #343a40;
        }
        .form-check {
            margin-bottom: 10px;
        }
        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-submit {
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 8px;
            padding: 10px 30px;
            font-size: 1.2rem;
        }
        .btn-submit:hover {
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

    <div class="container quiz-container">
        <h2 class="text-center mb-4">Question Paper for <?php echo APP_NAME; ?></h2>
        <?php
        // quiz.php - PHP backend to fetch questions

        if (!isLoggedIn()) {
            redirect('login.php'); // Redirect if not logged in
        }

        $questions = [];
        try {
            // Fetch 50 questions (or fewer if less are available)
            $stmt = $pdo->query("SELECT q.id AS question_id, q.question_text, a.id AS answer_id, a.answer_text
                                 FROM questions q
                                 JOIN answers a ON q.id = a.question_id
                                 ORDER BY q.id, RAND()
                                 LIMIT 200"); // Limit to 200 rows (50 questions * 4 answers) to get enough questions
            $raw_questions_data = $stmt->fetchAll();

            // Organize questions and answers
            foreach ($raw_questions_data as $row) {
                $question_id = $row['question_id'];
                if (!isset($questions[$question_id])) {
                    $questions[$question_id] = [
                        'question_text' => $row['question_text'],
                        'answers' => []
                    ];
                }
                $questions[$question_id]['answers'][] = [
                    'answer_id' => $row['answer_id'],
                    'answer_text' => $row['answer_text']
                ];
            }

            // Ensure we only have up to 50 unique questions
            $questions = array_slice($questions, 0, 50, true);

            if (empty($questions)) {
                echo '<div class="alert alert-warning rounded-lg" role="alert">No questions available. Please contact the administrator.</div>';
            }

        } catch (PDOException $e) {
            echo '<div class="alert alert-danger rounded-lg" role="alert">Error fetching questions: ' . $e->getMessage() . '</div>';
            $questions = []; // Clear questions if there's an error
        }
        ?>

        <form id="quizForm" action="submit_quiz.php" method="POST">
            <?php $q_num = 1; ?>
            <?php foreach ($questions as $question_id => $question): ?>
                <div class="question-card rounded-lg">
                    <h5><?php echo $q_num++; ?>. <?php echo htmlspecialchars($question['question_text']); ?></h5>
                    <?php shuffle($question['answers']); // Shuffle answers for each question ?>
                    <?php foreach ($question['answers'] as $answer): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_<?php echo $question_id; ?>" id="answer_<?php echo $answer['answer_id']; ?>" value="<?php echo $answer['answer_id']; ?>" required>
                            <label class="form-check-label" for="answer_<?php echo $answer['answer_id']; ?>">
                                <?php echo htmlspecialchars($answer['answer_text']); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <?php if (!empty($questions)): ?>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-submit">Submit Quiz</button>
                </div>
            <?php endif; ?>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Optional: Add client-side validation or timer if needed
            // For now, relying on 'required' attribute for radio buttons
            // and server-side validation.
        });
    </script>
</body>
</html>
```php

