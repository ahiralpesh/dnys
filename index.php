<!-- index.php - Landing Page -->
<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to <?php require_once 'config.php'; echo APP_NAME; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .hero-section {
            background: linear-gradient(rgba(0, 123, 255, 0.7), rgba(0, 123, 255, 0.7)), url('./DNYS-Certification-quiz-home.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
            text-align: center;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            margin-bottom: 30px;
        }
        .hero-section h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.5rem;
            max-width: 800px;
            margin: 0 auto 30px;
        }
        .btn-hero {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }
        .btn-hero:hover {
            background-color: #218838;
            border-color: #218838;
            color: white;
        }
        .feature-section {
            padding: 60px 0;
            text-align: center;
        }
        .feature-card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
        .feature-card h3 {
            color: #007bff;
            margin-bottom: 15px;
        }
        .feature-card img {
            max-width: 100px;
            margin-bottom: 20px;
            border-radius: 10px;
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
        .footer p {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <?php require_once 'config.php'; ?>

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
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Unlock Your Potential in Naturopathy & Yogic Science</h1>
            <p class="lead">Embark on a journey of holistic health and well-being. Test your knowledge and earn your certificate in the ancient sciences of natural healing and yoga.</p>
            <a href="register.php" class="btn btn-hero">Get Started Today!</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="feature-section">
        <div class="container">
            <h2 class="text-center mb-5" style="color: #007bff;">Why Choose Our Diploma Quiz?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://placehold.co/100x100/007bff/FFFFFF?text=Quiz" alt="Interactive Quiz">
                        <h3>Interactive Quizzes</h3>
                        <p>Engage with 50 carefully curated questions covering core aspects of Naturopathy and Yogic Science.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://placehold.co/100x100/007bff/FFFFFF?text=Learning" alt="Knowledge Enhancement">
                        <h3>Knowledge Enhancement</h3>
                        <p>Reinforce your understanding of natural healing principles, yoga philosophy, and practical applications.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://placehold.co/100x100/007bff/FFFFFF?text=Certificate" alt="Downloadable Certificate">
                        <h3>Downloadable Certificate</h3>
                        <p>Receive a personalized certificate upon successful completion, validating your expertise.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://placehold.co/100x100/007bff/FFFFFF?text=Progress" alt="Track Progress">
                        <h3>Track Your Progress</h3>
                        <p>Monitor your scores and identify areas for improvement to master the subject.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://placehold.co/100x100/007bff/FFFFFF?text=Admin" alt="Admin Control">
                        <h3>Admin Control</h3>
                        <p>Admins can easily manage questions, answers, and student data through a dedicated panel.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <img src="https://placehold.co/100x100/007bff/FFFFFF?text=Secure" alt="Secure Access">
                        <h3>Secure Access</h3>
                        <p>Robust login and registration ensure your data and quiz attempts are safe and private.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="text-center py-5 bg-light rounded-lg shadow-sm mx-auto" style="max-width: 900px;">
        <div class="container">
            <h2 class="mb-4" style="color: #007bff;">Ready to Test Your Knowledge?</h2>
            <p class="lead mb-4">Join hundreds of students validating their understanding of Naturopathy and Yogic Science. It's quick, easy, and rewarding!</p>
            <a href="login.php" class="btn btn-hero">Login to Start Quiz</a>
        </div>
    </section>

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
