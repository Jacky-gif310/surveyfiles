<?php
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";      // Replace with your database password
$dbname = "survey_db"; // Replace with your database name

// Create connection
$conn = mysqli_connect(
  $servername, 
  $username, 
  $password,
  $dbname);
  


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
