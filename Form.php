<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Analysis Tool</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Navigation Bar -->
<header>
    <nav>
        <h1>Survey Analysis Tool</h1>
        <ul>
            <li><a href="Form.php">Home</a></li>
            <li><a href="survey.php">Survey</a></li>
            <li><a href="results.php">Results</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>

            <?php if (isset($_SESSION["user_id"])): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<!-- Hero Section with Background Video -->
<section class="hero">
    <video autoplay muted loop id="background-video">
        <source src="267133_tiny.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>
    <div class="hero-content">
        <h2>Welcome to the Survey Analysis Tool!</h2>
        <p>Analyze customer feedback, improve service quality, and make data-driven decisions.</p>
        <a href="survey.php" class="cta-button">Start Your Survey</a>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Survey Analysis Tool | Designed for SMEs</p>
</footer>

</body>
</html>
