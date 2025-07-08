<?php
// generate_certificate.php - Generates a downloadable certificate
require_once 'config.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$full_name = '';
$score = 0;
$total_questions = 0;
$percentage = 0;
$test_date = '';

try {
    // Fetch user's full name
    $stmt = $pdo->prepare("SELECT full_name FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user_data = $stmt->fetch();
    if ($user_data) {
        $full_name = $user_data['full_name'];
    }

    // Fetch the latest passing result for the user
    $stmt = $pdo->prepare("SELECT score, total_questions, percentage, test_date FROM results WHERE user_id = ? AND passed = TRUE ORDER BY test_date DESC LIMIT 1");
    $stmt->execute([$user_id]);
    $result = $stmt->fetch();

    if ($result) {
        $score = $result['score'];
        $total_questions = $result['total_questions'];
        $percentage = $result['percentage'];
        $test_date = date('F j, Y', strtotime($result['test_date']));
    } else {
        // If no passing result, redirect or show an error
        $_SESSION['error_message'] = 'No passing result found to generate a certificate.';
        redirect('result.php');
    }

} catch (PDOException $e) {
    $_SESSION['error_message'] = 'Error fetching certificate data: ' . $e->getMessage();
    redirect('result.php');
}

// Set headers for download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="Certificate_of_Achievement_' . str_replace(' ', '_', $full_name) . '.html"'); // Suggest saving as HTML

// HTML content for the certificate
// This is a basic HTML certificate. For a more robust solution, a PDF library would be used.
// Users can print this HTML page to PDF from their browser.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Achievement - <?php echo APP_NAME; ?></title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .certificate {
            width: 800px;
            height: 600px;
            padding: 50px;
            border: 10px solid #007bff;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            box-sizing: border-box;
            background-image: url('[https://placehold.co/800x600/F0F8FF/007bff?text=Certificate+Background](https://placehold.co/800x600/F0F8FF/007bff?text=Certificate+Background)'); /* Placeholder background */
            background-size: cover;
            background-position: center;
        }
        .certificate::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 2px dashed #007bff;
        }
        h1 {
            font-size: 3em;
            color: #007bff;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        h2 {
            font-size: 2.2em;
            color: #333;
            margin-bottom: 10px;
        }
        p {
            font-size: 1.2em;
            color: #555;
            line-height: 1.6;
        }
        .name {
            font-size: 2.8em;
            font-weight: bold;
            color: #28a745;
            margin: 30px 0;
            text-transform: capitalize;
        }
        .details {
            margin-top: 40px;
            font-size: 1.1em;
        }
        .date {
            margin-top: 50px;
            font-size: 1.1em;
            color: #777;
        }
        .signature {
            margin-top: 60px;
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            font-size: 1.1em;
        }
        .signature div {
            border-top: 1px solid #ccc;
            padding-top: 10px;
            width: 40%;
        }
        .logo {
            position: absolute;
            top: 40px;
            left: 40px;
            width: 80px;
            height: 80px;
            background-color: #007bff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 1.5em;
        }
        @media print {
            body {
                min-height: auto;
                display: block;
                background-color: #fff;
            }
            .certificate {
                width: 100%;
                height: auto;
                box-shadow: none;
                border: none;
                background-image: none;
            }
            .certificate::before {
                border: 2px dashed #007bff;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
            }
            .logo {
                display: none; /* Hide placeholder logo in print */
            }
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="logo">DNYS</div>
        <h1>Certificate of Achievement</h1>
        <p>This certifies that</p>
        <div class="name"><?php echo htmlspecialchars($full_name); ?></div>
        <p>has successfully completed the examination for the **Diploma in Naturopathy and Yogic Science** with a remarkable performance.</p>
        <div class="details">
            <p>Achieved a score of <strong><?php echo htmlspecialchars($score); ?></strong> out of <strong><?php echo htmlspecialchars($total_questions); ?></strong> questions.</p>
            <p>Resulting in a total percentage of <strong><?php echo number_format($percentage, 2); ?>%</strong>.</p>
        </div>
        <div class="date">
            Awarded on: <?php echo htmlspecialchars($test_date); ?>
        </div>
        <div class="signature">
            <div>
                Administrator
            </div>
            <div>
                <?php echo APP_NAME; ?> Team
            </div>
        </div>
    </div>
</body>
</html>
