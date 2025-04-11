<?php

/**
 * Database Configuration File
 *
 * This file establishes a connection to the MySQL database.
 * It includes error handling and character set configuration for secure
 * and reliable database interactions.
 */

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "survey_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $errorMessage = "Database connection failed: " . $conn->connect_error;

    // Log the error to a file (ensure appropriate permissions are set)
    error_log($errorMessage, 0);  // Use system's error logging mechanism
    // Or, log to a specific file:
    // error_log($errorMessage, 3, "/path/to/your/error.log");

    // Display a user-friendly error message.  Crucially, do NOT expose sensitive details.
    die("Sorry, there was an issue connecting to the database. Please try again later.");
}

// Set character set to UTF-8 for proper data handling
if (!$conn->set_charset("utf8")) {
    error_log("Error setting character set utf8: " . $conn->error);
}


/**
 * Function to securely sanitize user input
 *
 * This function uses prepared statements to prevent SQL injection attacks.
 *
 * @param mysqli $conn The database connection object.
 * @param string $sql  The SQL query with placeholders.
 * @param string $types A string containing one or more characters which specify the types for the bound variables.
 *               - 'i' for integer
 *               - 'd' for double
 *               - 's' for string
 *               - 'b' for blob
 * @param array $params An array of parameters to bind to the query.
 *
 * @return mysqli_stmt|false  A prepared statement object or false on failure.
 */
function safe_query(mysqli $conn, string $sql, string $types = "", array $params = []): mysqli_stmt|false
{
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        error_log("mysqli::prepare() failed: " . htmlspecialchars($conn->error)); // More detailed error logging
        return false;
    }

    if ($types !== "" && !empty($params)) {
        $stmt->bind_param($types, ...$params);  // Unpack parameters using the spread operator
    }

    return $stmt;
}


/**
 * Executes a prepared statement and returns the result.
 *
 * @param mysqli_stmt $stmt The prepared statement object.
 *
 * @return mysqli_result|bool The result set for SELECT statements or true/false for other statements.
 */
function execute_query(mysqli_stmt $stmt): mysqli_result|bool
{
    if (!$stmt->execute()) {
        error_log("mysqli_stmt::execute() failed: " . htmlspecialchars($stmt->error));
        return false;
    }

    if ($stmt->result_metadata()) { // Check if it's a SELECT query
        $result = $stmt->get_result();
    } else {
        $result = true; // For INSERT, UPDATE, DELETE queries, assume success
    }

    return $result;
}
