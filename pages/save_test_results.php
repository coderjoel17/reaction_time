<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP password
$dbname = "dbcrud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if data is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);  // Get student ID

    // Retrieve the VR values (ensure they exist in POST)
    $vr1 = isset($_POST['vr1']) ? floatval($_POST['vr1']) : NULL;
    $vr2 = isset($_POST['vr2']) ? floatval($_POST['vr2']) : NULL;
    $vr3 = isset($_POST['vr3']) ? floatval($_POST['vr3']) : NULL;

    // Retrieve the AR values (ensure they exist in POST)
    $ar1 = isset($_POST['ar1']) ? floatval($_POST['ar1']) : NULL;
    $ar2 = isset($_POST['ar2']) ? floatval($_POST['ar2']) : NULL;
    $ar3 = isset($_POST['ar3']) ? floatval($_POST['ar3']) : NULL;

    // Update query: only update columns that have values
    $sql = "UPDATE students SET vr1 = IFNULL(?, vr1), vr2 = IFNULL(?, vr2), vr3 = IFNULL(?, vr3), ar1 = IFNULL(?, ar1), ar2 = IFNULL(?, ar2), ar3 = IFNULL(?, ar3) WHERE id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the statement
    $stmt->bind_param("ddddddi", $vr1, $vr2, $vr3, $ar1, $ar2, $ar3, $id);

    // Execute the query
    if ($stmt->execute()) {
        echo "Test results updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
