<?php
// submit_quiz.php - Processes submitted quiz answers
require_once 'config.php';

if (!isLoggedIn()) {
    redirect('login.php'); // Redirect if not logged in
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $score = 0;
    $total_questions_answered = 0;

    try {
        // Start a transaction for atomicity
        $pdo->beginTransaction();

        // Delete previous responses and results for this user to allow re-attempts
        $stmt = $pdo->prepare("DELETE FROM student_responses WHERE user_id = ?");
        $stmt->execute([$user_id]);

        $stmt = $pdo->prepare("DELETE FROM results WHERE user_id = ?");
        $stmt->execute([$user_id]);


        // Fetch all correct answers to compare against submitted answers
        $correct_answers = [];
        $stmt = $pdo->query("SELECT question_id, id AS correct_answer_id FROM answers WHERE is_correct = TRUE");
        foreach ($stmt->fetchAll() as $row) {
            $correct_answers[$row['question_id']] = $row['correct_answer_id'];
        }

        // Process each submitted question
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'question_') === 0) {
                $question_id = (int) str_replace('question_', '', $key);
                $selected_answer_id = (int) $value;

                $total_questions_answered++;

                // Check if the selected answer is correct
                $is_correct_response = false;
                if (isset($correct_answers[$question_id]) && $correct_answers[$question_id] == $selected_answer_id) {
                    $score++;
                    $is_correct_response = true;
                }

                // Store student's response
                $stmt = $pdo->prepare("INSERT INTO student_responses (user_id, question_id, selected_answer_id, is_correct_response) VALUES (?, ?, ?, ?)");
                $stmt->execute([$user_id, $question_id, $selected_answer_id, $is_correct_response]);
            }
        }

        // Calculate percentage
        $percentage = ($total_questions_answered > 0) ? ($score / $total_questions_answered) * 100 : 0;
        $passed = ($percentage >= PASSING_PERCENTAGE);

        // Store overall result
        $stmt = $pdo->prepare("INSERT INTO results (user_id, score, total_questions, percentage, passed) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $score, $total_questions_answered, $percentage, $passed]);

        $pdo->commit();

        // Redirect to a results page or display results directly
        $_SESSION['quiz_result'] = [
            'score' => $score,
            'total_questions' => $total_questions_answered,
            'percentage' => $percentage,
            'passed' => $passed
        ];
        redirect('result.php');

    } catch (PDOException $e) {
        $pdo->rollBack(); // Rollback transaction on error
        $_SESSION['error_message'] = 'Quiz submission failed: ' . $e->getMessage();
        redirect('quiz.php'); // Redirect back to quiz with error
    }
} else {
    redirect('quiz.php'); // If not a POST request, redirect to quiz page
}
?>
```html