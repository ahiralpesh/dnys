<?php
// admin/fetch_question_data.php - Fetches single question data for editing
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
    $question_id = (int)$_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT id, question_text, difficulty FROM questions WHERE id = ?");
        $stmt->execute([$question_id]);
        $question = $stmt->fetch();

        if ($question) {
            $stmt = $pdo->prepare("SELECT id, answer_text, is_correct FROM answers WHERE question_id = ? ORDER BY id"); // Order by ID to maintain consistent answer order
            $stmt->execute([$question_id]);
            $answers = $stmt->fetchAll();

            // Ensure 4 answers are always returned, even if less are in DB (for form consistency)
            $formatted_answers = [];
            for ($i = 0; $i < 4; $i++) {
                if (isset($answers[$i])) {
                    $formatted_answers[] = [
                        'answer_id' => $answers[$i]['id'],
                        'answer_text' => $answers[$i]['answer_text'],
                        'is_correct' => (bool)$answers[$i]['is_correct']
                    ];
                } else {
                    $formatted_answers[] = [
                        'answer_id' => null,
                        'answer_text' => '',
                        'is_correct' => false
                    ];
                }
            }

            echo json_encode([
                'question_id' => $question['id'],
                'question_text' => $question['question_text'],
                'difficulty' => $question['difficulty'],
                'answers' => $formatted_answers
            ]);
            exit(); // Ensure no further output after JSON
        } else {
            echo json_encode(null); // Question not found
            exit(); // Ensure no further output 
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
        exit(); // Ensure no further output on error
    }
} else {
    echo json_encode(['error' => 'No question ID provided.']);
    exit(); // Ensure no further output
}
