<?php
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

// Handle "Empty Table" request
if (isset($_POST['empty_table'])) {
    $truncate_sql = "TRUNCATE TABLE students";
    if ($conn->query($truncate_sql) === TRUE) {
        echo "<script>alert('All records have been deleted successfully.');window.location='index.php';</script>";
    } else {
        echo "Error emptying table: " . $conn->error;
    }
}

// Search functionality
$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search_query'];
}

// Fetch data from the students table
$sql = "SELECT * FROM students WHERE name LIKE '%$search_query%' OR register_number LIKE '%$search_query%' OR id_number LIKE '%$search_query%'";
$result = $conn->query($sql);

// Delete a student record
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql_delete = "DELETE FROM students WHERE id=$id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Record deleted successfully'); window.location='index.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Database Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
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
        button, input[type="submit"], input[type="text"] {
            padding: 10px 15px;
            font-size: 16px;
            margin: 5px;
        }
        button:hover, input[type="submit"]:hover {
            background-color: #45a049;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .empty-btn {
            background-color: #FF5733;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Student Table</h1>

    <!-- Search Form -->
    <form method="GET" action="">
        <input type="text" name="search_query" value="<?php echo $search_query; ?>" placeholder="Search by Name, Register Number or ID Number">
        <input type="submit" name="search" value="Search">
    </form>

    <!-- Empty Table Form -->
    <form method="POST" action="">
        <input type="submit" name="empty_table" value="Empty Table" class="empty-btn" onclick="return confirm('Are you sure you want to delete all records?')">
    </form>

    <!-- Display students table -->
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
                <th>Actions</th>
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
                        <td>
                            <a href='edit_student.php?id={$row['id']}'><button class='edit-btn'>Edit</button></a>
                            <a href='index.php?delete_id={$row['id']}' onclick='return confirm(\"Are you sure?\")'><button class='delete-btn'>Delete</button></a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='16'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Export buttons -->
    <button onclick="exportCSV()">Export as CSV</button>
    <button onclick="exportPDF()">Export as PDF</button>

    <script>
        // Export to CSV function
        function exportCSV() {
            window.location.href = 'export_csv.php';
        }

        // Export to PDF function
        function exportPDF() {
            window.location.href = 'export_pdf.php';
        }
    </script>

</body>
</html>

<?php
$conn->close();
?>
