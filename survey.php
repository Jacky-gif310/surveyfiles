<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Feedback Survey</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

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

  <!-- Survey Introduction -->
  <section class="survey-intro">
    <img src="images/survey_banner.jpg" alt="Customer Survey">
    <h2>Customer Satisfaction Survey</h2>
    <p>Your feedback helps businesses improve! Please take a few minutes to share your shopping experience.</p>
  </section>

  <!-- Survey Form -->
  <section class="survey-section">
    <form action="submit_survey.php" method="POST">
      <!-- Shopping Platform -->
      <label>Where did you shop?</label>
      <div class="platform-selection">
        <label>
          <input type="radio" name="shopping_platform" value="Jumia" required>
          <img src="Jumia.PNG" alt="Jumia Logo">
        </label>

        <label>
          <input type="radio" name="shopping_platform" value="Amazon">
          <img src="Amazon.png" alt="Amazon Logo">
        </label>

        <label>
          <input type="radio" name="shopping_platform" value="Kilimall">
          <img src="kilimal .png" alt="Kilimall Logo">
        </label>

        <label>
          <input type="radio" name="shopping_platform" value="Carrefour">
          <img src="carrefour.png" alt="Carrefour Logo">
        </label>
      </div>

      <!-- Experience Rating -->
      <label>Rate your shopping experience (1 to 5)</label>
      <input type="number" name="experience_rating" min="1" max="5" required>

      <!-- Product Satisfaction -->
      <label>Were you satisfied with the product quality?</label>
      <select name="product_satisfaction" required>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>

      <!-- Delivery Experience -->
      <label>How would you rate the delivery experience?</label>
      <input type="number" name="delivery_rating" min="1" max="5" required>

      <!-- Recommendation -->
      <label>Would you recommend this platform to others?</label>
      <select name="recommendation" required>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>

      <!-- Shopping Frequency -->
      <label>How often do you shop on this platform?</label>
      <select name="shopping_frequency" required>
        <option value="Daily">Daily</option>
        <option value="Weekly">Weekly</option>
        <option value="Monthly">Monthly</option>
        <option value="Rarely">Rarely</option>
        <option value="First Time">First Time</option>
      </select>

      <!-- Pricing Evaluation -->
      <label>Do you think the pricing on this platform is fair?</label>
      <select name="pricing_fairness" required>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>

      <!-- Customer Service Quality -->
      <label>How satisfied were you with the customer support you received?</label>
      <input type="number" name="support_rating" min="1" max="5" required>

      <!-- Delivery Speed -->
      <label>How long did it take for your order to arrive?</label>
      <select name="delivery_speed" required>
        <option value="Same day">Same day</option>
        <option value="1-2 days">1-2 days</option>
        <option value="3-5 days">3-5 days</option>
        <option value="More than a week">More than a week</option>
      </select>

      <!-- Improvement Suggestions -->
      <label>What improvements would you like to see?</label>
      <textarea name="improvement_suggestions" rows="4" required></textarea>

      <button type="submit">Submit Survey</button>
    </form>
  </section>

  <footer>
    <p>&copy; 2025 Survey Analysis Tool | Designed for SMEs</p>
  </footer>

</body>
</html>
