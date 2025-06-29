<?php
// Enable error reporting to catch any hidden errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log errors to a file instead of displaying them
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

// Database connection details
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password is empty
$dbname = "dbcrud";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the reactionTime data is received via POST request
if (isset($_POST['reactionTime'])) {
    $reaction_time = floatval($_POST['reactionTime']);
    
    // Debugging output: Check if the reaction time is received correctly
    if ($reaction_time > 0) {
        echo "Received reaction time: " . $reaction_time . " seconds.<br>";
    } else {
        echo "Invalid or no reaction time received.<br>";
        exit;
    }

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO reaction_times (reaction_time) VALUES (?)");

    // Check if the SQL statement preparation was successful
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind the reaction time value to the prepared statement as a double
    $stmt->bind_param("d", $reaction_time);

    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        echo "New record created successfully.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "No reaction time received from the POST request.<br>";
}

// Close the database connection
$conn->close();
?>
