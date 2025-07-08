<!-- admin/manage_questions.php - Admin: Manage Questions -->
<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Questions - Admin Panel</title>
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
        .btn-primary, .btn-success, .btn-warning, .btn-danger {
            border-radius: 8px;
        }
        .table {
            margin-top: 20px;
        }
        .table thead th {
            background-color: #e9ecef;
        }
        .modal-content {
            border-radius: 10px;
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
        <h2 class="text-center mb-4">Manage Questions for <?php echo APP_NAME; ?></h2>

        <?php
        // admin/manage_questions.php - PHP backend for question management

        if (!isLoggedIn() || !isAdmin()) {
            redirect('../login.php');
        }

        $message = '';
        $message_type = '';

        // Handle Add/Update Question
        if (isset($_POST['submit_question'])) {
            $question_text = sanitizeInput($_POST['question_text']);
            $difficulty = sanitizeInput($_POST['difficulty']);
            $answers = $_POST['answers']; // Array of answer texts
            $correct_answer_index = (int)$_POST['correct_answer']; // Index of the correct answer (0-3)
            $question_id = isset($_POST['question_id']) ? (int)$_POST['question_id'] : 0;

            if (empty($question_text) || empty($answers) || count($answers) !== 4 || !isset($answers[$correct_answer_index])) {
                $message = 'Please fill all question and answer fields correctly.';
                $message_type = 'danger';
            } else {
                try {
                    $pdo->beginTransaction();

                    if ($question_id > 0) {
                        // Update existing question
                        $stmt = $pdo->prepare("UPDATE questions SET question_text = ?, difficulty = ? WHERE id = ?");
                        $stmt->execute([$question_text, $difficulty, $question_id]);

                        // Delete old answers and insert new ones
                        $stmt = $pdo->prepare("DELETE FROM answers WHERE question_id = ?");
                        $stmt->execute([$question_id]);
                        $message = 'Question updated successfully!';
                    } else {
                        // Add new question
                        $stmt = $pdo->prepare("INSERT INTO questions (question_text, difficulty) VALUES (?, ?)");
                        $stmt->execute([$question_text, $difficulty]);
                        $question_id = $pdo->lastInsertId();
                        $message = 'Question added successfully!';
                    }

                    // Insert answers
                    for ($i = 0; $i < 4; $i++) {
                        $is_correct = ($i === $correct_answer_index) ? TRUE : FALSE;
                        $stmt = $pdo->prepare("INSERT INTO answers (question_id, answer_text, is_correct) VALUES (?, ?, ?)");
                        $stmt->execute([$question_id, sanitizeInput($answers[$i]), $is_correct]);
                    }

                    $pdo->commit();
                    $message_type = 'success';

                } catch (PDOException $e) {
                    $pdo->rollBack();
                    $message = 'Error: ' . $e->getMessage();
                    $message_type = 'danger';
                }
            }
        }

        // Handle Delete Question
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $question_id = (int)$_GET['id'];
            try {
                // Deleting question will cascade delete answers due to FOREIGN KEY ON DELETE CASCADE
                $stmt = $pdo->prepare("DELETE FROM questions WHERE id = ?");
                $stmt->execute([$question_id]);
                $message = 'Question deleted successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error deleting question: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
        ?>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?> rounded-lg" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEditQuestionModal" id="addQuestionBtn">
            Add New Question
        </button>

        <!-- Question List -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Existing Questions</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Question</th>
                                <th>Difficulty</th>
                                <th>Answers</th>
                                <th>Correct Answer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $stmt = $pdo->query("SELECT q.id AS question_id, q.question_text, q.difficulty, a.answer_text, a.is_correct
                                                     FROM questions q
                                                     LEFT JOIN answers a ON q.id = a.question_id
                                                     ORDER BY q.id");
                                $all_questions_data = $stmt->fetchAll();

                                $questions_formatted = [];
                                foreach ($all_questions_data as $row) {
                                    $q_id = $row['question_id'];
                                    if (!isset($questions_formatted[$q_id])) {
                                        $questions_formatted[$q_id] = [
                                            'question_text' => $row['question_text'],
                                            'difficulty' => $row['difficulty'],
                                            'answers' => [],
                                            'correct_answer' => ''
                                        ];
                                    }
                                    $questions_formatted[$q_id]['answers'][] = $row['answer_text'];
                                    if ($row['is_correct']) {
                                        $questions_formatted[$q_id]['correct_answer'] = $row['answer_text'];
                                    }
                                }

                                if (empty($questions_formatted)) {
                                    echo '<tr><td colspan="6" class="text-center">No questions added yet.</td></tr>';
                                } else {
                                    foreach ($questions_formatted as $q_id => $q_data) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($q_id) . '</td>';
                                        echo '<td>' . htmlspecialchars($q_data['question_text']) . '</td>';
                                        echo '<td>' . htmlspecialchars($q_data['difficulty']) . '</td>';
                                        echo '<td>';
                                        foreach ($q_data['answers'] as $ans) {
                                            echo '- ' . htmlspecialchars($ans) . '<br>';
                                        }
                                        echo '</td>';
                                        echo '<td>' . htmlspecialchars($q_data['correct_answer']) . '</td>';
                                        echo '<td>';
                                        echo '<button type="button" class="btn btn-warning btn-sm me-2 edit-question-btn rounded-md" data-id="' . $q_id . '" data-bs-toggle="modal" data-bs-target="#addEditQuestionModal">Edit</button>';
                                        echo '<a href="manage_questions.php?action=delete&id=' . $q_id . '" class="btn btn-danger btn-sm rounded-md" onclick="return confirm(\'Are you sure you want to delete this question?\');">Delete</a>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            } catch (PDOException $e) {
                                echo '<tr><td colspan="6" class="text-center text-danger">Error loading questions: ' . $e->getMessage() . '</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add/Edit Question Modal -->
        <div class="modal fade" id="addEditQuestionModal" tabindex="-1" aria-labelledby="addEditQuestionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content rounded-lg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEditQuestionModalLabel">Add/Edit Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="questionForm" action="manage_questions.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="question_id" id="question_id">
                            <div class="mb-3">
                                <label for="question_text" class="form-label">Question Text</label>
                                <textarea class="form-control rounded-md" id="question_text" name="question_text" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="difficulty" class="form-label">Difficulty</label>
                                <select class="form-select rounded-md" id="difficulty" name="difficulty" required>
                                    <option value="easy">Easy</option>
                                    <option value="medium">Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Answers (4 options)</label>
                                <?php for ($i = 0; $i < 4; $i++): ?>
                                    <div class="input-group mb-2">
                                        <div class="input-group-text rounded-l-md">
                                            <input class="form-check-input mt-0" type="radio" name="correct_answer" value="<?php echo $i; ?>" id="correct_answer_<?php echo $i; ?>" required>
                                        </div>
                                        <input type="text" class="form-control rounded-r-md" name="answers[]" placeholder="Answer Option <?php echo $i + 1; ?>" required>
                                    </div>
                                <?php endfor; ?>
                                <small class="form-text text-muted">Select the radio button next to the correct answer.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-md" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit_question" class="btn btn-primary rounded-md">Save Question</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Reset form when modal is hidden
            $('#addEditQuestionModal').on('hidden.bs.modal', function () {
                $('#questionForm')[0].reset();
                $('#question_id').val('');
                $('#addEditQuestionModalLabel').text('Add New Question');
            });

            // Populate form when edit button is clicked
            $('.edit-question-btn').on('click', function() {
                var questionId = $(this).data('id');
                $('#addEditQuestionModalLabel').text('Edit Question');

                // Fetch question data via AJAX
                $.ajax({
                    url: 'fetch_question_data.php', // A new PHP file to fetch single question data
                    type: 'GET',
                    data: { id: questionId },
                    dataType: 'json',
                    success: function(data) {
                        if (data) {
                            $('#question_id').val(data.question_id);
                            $('#question_text').val(data.question_text);
                            $('#difficulty').val(data.difficulty);

                            // Populate answers and select correct one
                            $.each(data.answers, function(index, answer) {
                                $('input[name="answers[]"]').eq(index).val(answer.answer_text);
                                if (answer.is_correct) {
                                    $('input[name="correct_answer"][value="' + index + '"]').prop('checked', true);
                                }
                            });
                        } else {
                            alert('Error: Question data not found.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('AJAX Error: ' + status + ' - ' + error);
                    }
                });
            });
        });
    </script>
</body>
</html>
