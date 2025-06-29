<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP password
$dbname = "dbcrud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the students table
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4b41a;
        }
    </style>
</head>
<body>

    <h1>Student Data Table</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Register Number</th>
                <th>ID Number</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Department</th>
                <th>Dominant Hand</th>
                <th>VR1</th>
                <th>VR2</th>
                <th>VR3</th>
                <th>AR1</th>
                <th>AR2</th>
                <th>AR3</th>
                <th>VRM</th>
                <th>ARM</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if records were found
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['register_number']}</td>
                        <td>{$row['id_number']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['department']}</td>
                        <td>{$row['dominant_hand']}</td>
                        <td>{$row['vr1']}</td>
                        <td>{$row['vr2']}</td>
                        <td>{$row['vr3']}</td>
                        <td>{$row['ar1']}</td>
                        <td>{$row['ar2']}</td>
                        <td>{$row['ar3']}</td>
                        <td>{$row['vrm']}</td>
                        <td>{$row['arm']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='16'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        window.print(); // Automatically open the print dialog for the user to print or save as PDF
    </script>

</body>
</html>

<?php
$conn->close();
?>
