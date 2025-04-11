<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Survey Analysis Tool</title>
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
        </ul>
    </nav>
</header>

<!-- Contact Section -->
<section class="contact-section">
    <h2>Get in Touch</h2>
    <p>Have questions or need support? Reach out to us using the form below or via email.</p>

    <div class="contact-details">
        <p><strong>Email:</strong> support@surveytool.com</p>
        
        
    </div>

    <!-- Contact Form -->
    <form action="contact_form_handler.php" method="POST">
        <label>Your Name</label>
        <input type="text" name="name" required>

        <label>Your Email</label>
        <input type="email" name="email" required>

        <label>Message</label>
        <textarea name="message" rows="5" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2025 Survey Analysis Tool | Designed for SMEs</p>
</footer>

</body>
</html>
