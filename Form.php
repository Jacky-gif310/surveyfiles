<?php
session_start();
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process form submission
}

// Ensure no unintended output before HTML rendering
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Survey Analysis Tool</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body>
    <video autoplay muted loop id="background-video">
      <source src="267133_tiny.mp4" type="video/mp4" />
      Your browser does not support HTML5 video.
    </video>

    <!-- Header Section -->
    <header>
      <h1>Welcome to the Survey Analysis Tool</h1>
      
      <div class="auth-buttons">
        <?php if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])): ?>
          <p class="welcome-msg">Hi, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
          <a href="logout.php" class="btn logout">Logout</a>
        <?php else: ?>
          <a href="login.php" class="btn login">Login</a>
          <a href="register.php" class="btn register">Register</a>
        <?php endif; ?>
      </div>
      
      <p>Your feedback helps us improve customer satisfaction. Click below to participate!</p>
    </header>

    <!-- Survey Section -->
    <section id="survey">
      <h2>Take the Survey</h2>
      <p>Click the button below or scan the QR code to participate in our survey.</p>
      
      <!-- Survey Button -->
      <a href="https://docs.google.com/forms/d/e/1FAIpQLSeF0IUXHUq5ha9NSSkxLmFUcslgVJsdTg4F1t-pijqrXiQUQg/viewform?usp=sf_link" class="btn">📋 Take the Survey</a>

      <br /><br />

      <!-- QR Code -->
      <div class="qr-container">
        <img src="survey_qr.png" alt="Scan to Take the Survey" class="qr-code" />
        <p><strong>Scan the QR code above to access the survey on mobile.</strong></p>
      </div>

      <!-- Thank You Message -->
      <p class="thank-you">🎉 Thank you for sharing your valuable feedback!</p>
    </section>

    <!-- Explore Website Section -->
    <section id="explore">
      <h2>Explore More Insights</h2>
      <p>Discover how customer feedback is analyzed to improve decision-making.</p>
      <a href="index.php" class="btn">🌍 Visit Our Website</a>
    </section>

    <!-- Footer -->
    <footer>
      <p>&copy; 2025 Survey Analysis Tool</p>
      <p>Designed for better business insights and decision-making.</p>
    </footer>
  </body>
</html>
