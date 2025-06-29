<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP password
$dbname = "dbcrud";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Fetch student data
$sql = "SELECT * FROM students WHERE id=$id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();

// Update the student information
if (isset($_POST['update_student'])) {
    $name = $_POST['name'];
    $register_number = $_POST['register_number'];
    $id_number = $_POST['id_number'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $dominant_hand = $_POST['dominant_hand'];

    $sql = "UPDATE students SET name='$name', register_number='$register_number', id_number='$id_number', 
            age='$age', gender='$gender', department='$department', dominant_hand='$dominant_hand' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Student updated successfully');window.location.href='index.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
        }
        input, select {
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Edit Student</h1>
    <form action="" method="POST">
        <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
        <input type="text" name="register_number" value="<?php echo $student['register_number']; ?>" required>
        <input type="text" name="id_number" value="<?php echo $student['id_number']; ?>" required>
        <input type="date" name="age" value="<?php echo $student['age']; ?>" required>
        <select name="gender" required>
            <option value="Male" <?php if ($student['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($student['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if ($student['gender'] == 'Other') echo 'selected'; ?>>Other</option>
        </select>
        <input type="text" name="department" value="<?php echo $student['department']; ?>" required>
        <select name="dominant_hand" required>
            <option value="Left" <?php if ($student['dominant_hand'] == 'Left') echo 'selected'; ?>>Left</option>
            <option value="Right" <?php if ($student['dominant_hand'] == 'Right') echo 'selected'; ?>>Right</option>
        </select>
        <input type="submit" name="update_student" value="Update Student">
    </form>

</body>
</html>

<?php
$conn->close();
?>
