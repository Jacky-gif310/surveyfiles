<?php
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "survey_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check for POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture predefined selection
    $shopping_platform = $_POST['shopping_platform'];

    // Check if user entered a custom platform
    if ($shopping_platform === "Other" && !empty($_POST['custom_platform'])) {
        $shopping_platform = $_POST['custom_platform']; // Replace predefined choice with custom entry
    }

    // Capture other form fields
    $experience_rating = $_POST['experience_rating'];
    $product_satisfaction = $_POST['product_satisfaction'];
    $delivery_rating = $_POST['delivery_rating'];
    $recommendation = $_POST['recommendation'];
    $shopping_frequency = $_POST['shopping_frequency'];
    $pricing_fairness = $_POST['pricing_fairness'];
    $support_rating = $_POST['support_rating'];
    $delivery_speed = $_POST['delivery_speed'];
    $improvement_suggestions = $_POST['improvement_suggestions'];

    // Prepare SQL query to insert all data
    $sql = "INSERT INTO customer_feedback (shopping_platform, experience_rating, product_satisfaction, delivery_rating, recommendation, shopping_frequency, pricing_fairness, support_rating, delivery_speed, improvement_suggestions) 
            VALUES ('$shopping_platform', '$experience_rating', '$product_satisfaction', '$delivery_rating', '$recommendation', '$shopping_frequency', '$pricing_fairness', '$support_rating', '$delivery_speed', '$improvement_suggestions')";

    // Execute query and check success
    if ($conn->query($sql) === TRUE) {
        echo "Survey submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
