<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $age = $_POST['age']; // New field
    $position = $_POST['position']; // New field
    $address = $_POST['address']; // New field
    $gender = $_POST['gender']; // New field

    // Connect to the SQLite database
    $db = new SQLite3('database.db');

    // Prepare the SQL statement to insert data into the employees table
    $stmt = $db->prepare('INSERT INTO employees (name, email, phone, salary, age, position, address, gender) 
                          VALUES (:name, :email, :phone, :salary, :age, :position, :address, :gender)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':salary', $salary);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':gender', $gender);

    // Execute the statement
    if ($stmt->execute()) {
        // Data inserted successfully
        echo '<script>alert("Employee added successfully."); window.location.href = "add.php";</script>';
    } else {
        // Error occurred while inserting data
        echo '<script>alert("Error: Unable to add employee."); window.location.href = "add.php";</script>';
    }

    // Close the database connection
    $db->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Add the Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
    <a href="index.php" class="btn btn-primary" >
        Back
    </a>
    <br>
    <br>
    <h2>Add Employee</h2>
    <form method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="salary">Salary:</label>
            <input type="number" class="form-control" id="salary" name="salary" required>
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" class="form-control" id="age" name="age" required>
        </div>
        <div class="form-group">
            <label for="position">Position:</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <input type="text" class="form-control" id="gender" name="gender" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Employee</button>
    </form>
</div>

<!-- Add the Bootstrap JS and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
