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
  
if ($conn) {
  echo"";
}
else
{
  echo"could not connect!";
}
?>
