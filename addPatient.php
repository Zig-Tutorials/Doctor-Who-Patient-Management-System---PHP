<?php
// addPatient.php - Page to add a new patient record

// Include the database connection
include 'db.php';

// Initialize variables for error/success messages
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign posted form data
    $first_name = $mysqli->real_escape_string(trim($_POST['first_name']));
    $last_name  = $mysqli->real_escape_string(trim($_POST['last_name']));
    $address    = $mysqli->real_escape_string(trim($_POST['address']));
    $age        = intval($_POST['age']);
    $gender     = $mysqli->real_escape_string(trim($_POST['gender']));
    $marital_status = $mysqli->real_escape_string(trim($_POST['marital_status']));
    $phone      = $mysqli->real_escape_string(trim($_POST['phone']));

    // Build the SQL query to insert the new patient record
    $sql = "INSERT INTO patients (first_name, last_name, address, age, gender, marital_status, phone)
            VALUES ('$first_name', '$last_name', '$address', $age, '$gender', '$marital_status', '$phone')";

    // Execute the query and check if it was successful
    if ($mysqli->query($sql) === TRUE) {
        $message = "New patient record added successfully.";
    } else {
        $message = "Error: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add New Patient</title>
    <style>
        /* Simple styling for the form */
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 500px; }
        label { display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        .message { margin-top: 15px; color: green; }
    </style>
</head>
<body>
    <h1>Add New Patient</h1>
    <?php if ($message): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="post" action="addPatient.php">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required>
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required>
        
        <label for="address">Address:</label>
        <input type="text" name="address" id="address">
        
        <label for="age">Age:</label>
        <input type="number" name="age" id="age">
        
        <label for="gender">Gender:</label>
        <select name="gender" id="gender">
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        
        <label for="marital_status">Marital Status:</label>
        <input type="text" name="marital_status" id="marital_status">
        
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone">
        
        <input type="submit" value="Add Patient" style="margin-top:15px;">
    </form>
</body>
</html>
