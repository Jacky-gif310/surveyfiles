<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Survey Analysis Tool</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Navigation Bar -->
<header>
    <nav>
        <h1>Survey Analysis Tool</h1>
        <ul>
            <li><a href="Form.php">Home🏠</a></li>
            <li><a href="survey.php">Survey</a></li>
            <li><a href="results.php">Results📊</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact📞</a></li>

            <?php if (isset($_SESSION["user_id"])): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<!-- Hero Section with Background Image -->
<section class="hero-about">
    <div class="overlay"></div>
    <div class="hero-content">
        <h2>Empowering SMEs Through Customer Insights</h2>
        <p>Our mission is to provide e-commerce businesses with smart, data-driven feedback solutions to enhance customer satisfaction.</p>
    </div>
</section>

<!-- About Content Section -->
<section class="about-content">
    <div class="about-container">
        <h2>About Survey Analysis Tool</h2>
        <p>The <strong>Survey Analysis Tool</strong> is designed to help businesses collect, analyze, and visualize customer satisfaction data efficiently. In today’s competitive e-commerce landscape, understanding consumer feedback is crucial for improving service quality and building lasting relationships with customers.</p>
        
        <h3>Our Mission</h3>
        <p>We aim to empower **small and medium-sized enterprises (SMEs)** with an easy-to-use, cost-effective feedback analysis platform. Through **custom surveys, real-time analytics, and dynamic visualizations**, our tool helps businesses make informed decisions to improve customer satisfaction.</p>

        <h3>Why Choose Our Tool?</h3>
        <div class="features-grid">
            <div class="feature">
                <img src="pexels-rdne-9034221.jpg" alt="Custom Surveys">
                <h4>Custom Surveys</h4>
                <p>Personalized surveys tailored to your business needs.</p>
            </div>
            <div class="feature">
                <img src="pexels-shkrabaanthony-5816283.jpg" alt="Advanced Analytics">
                <h4>Advanced Analytics</h4>
                <p>Gain deep insights into customer sentiment and feedback trends.</p>
            </div>
            <div class="feature">
                <img src="pexels-serpstat-177219-572056.jpg" alt="Dynamic Visualization">
                <h4>Dynamic Visualization</h4>
                <p>Track customer satisfaction over time with interactive graphs and reports.</p>
            </div>
        </div>

        <!-- "Learn More" Button -->
        <div class="learn-more-container">
            <a href="why_choose.php" class="learn-more-btn">Learn More ➜</a>
        </div>

        <h3>Who Can Benefit?</h3>
        <p>This tool is perfect for:</p>
        <ul>
            <li>✔ E-commerce stores seeking better feedback management.</li>
            <li>✔ SMEs looking for cost-effective analytics solutions.</li>
            <li>✔ Businesses aiming to improve customer satisfaction.</li>
        </ul>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Survey Analysis Tool | Designed for SMEs</p>
</footer>

</body>
</html>
