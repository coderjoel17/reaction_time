<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbcrud";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set headers for CSV export
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=students.csv');

// Fetch data from the students table
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Output the CSV headers
$output = fopen("php://output", "w");
fputcsv($output, array('ID', 'Name', 'Register Number', 'ID Number', 'Age', 'Gender', 'Department', 'Dominant Hand', 'VR1', 'VR2', 'VR3', 'AR1', 'AR2', 'AR3', 'VRM', 'ARM'));

// Output the data rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

// Close the file pointer and database connection
fclose($output);
$conn->close();
exit();
?>
