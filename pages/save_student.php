<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // XAMPP default password is empty
$dbname = "dbcrud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $conn->real_escape_string($_POST['name']);
    $register_number = $conn->real_escape_string($_POST['register_number']);
    $id_number = $conn->real_escape_string($_POST['id_number']);
    $age = $conn->real_escape_string($_POST['age']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $department = $conn->real_escape_string($_POST['department']);
    $dominant_hand = $conn->real_escape_string($_POST['dominant_hand']);

    // SQL query to insert data
    $sql = "INSERT INTO students (name, register_number, id_number, age, gender, department, dominant_hand) 
            VALUES ('$name', '$register_number', '$id_number', '$age', '$gender', '$department', '$dominant_hand')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the test page with the student's ID
        $student_id = $conn->insert_id;
        header("Location: test_page.php?id=" . $student_id);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
