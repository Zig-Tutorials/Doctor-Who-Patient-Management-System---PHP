<?php
// admin.php - Admin Dashboard (protected)
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: signin.php");
    exit();
}
include 'db.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign input data from the questionnaire
    $first_name     = $mysqli->real_escape_string(trim($_POST['first_name']));
    $last_name      = $mysqli->real_escape_string(trim($_POST['last_name']));
    $address        = $mysqli->real_escape_string(trim($_POST['address']));
    $age            = intval($_POST['age']);
    $gender         = $mysqli->real_escape_string(trim($_POST['gender']));
    $marital_status = $mysqli->real_escape_string(trim($_POST['marital_status']));
    $phone          = $mysqli->real_escape_string(trim($_POST['phone']));

    // Insert the new patient record into the database
    $sql = "INSERT INTO patients (first_name, last_name, address, age, gender, marital_status, phone)
            VALUES ('$first_name', '$last_name', '$address', $age, '$gender', '$marital_status', '$phone')";
    if ($mysqli->query($sql) === TRUE) {
        $message = "Patient record added successfully.";
    } else {
        $message = "Error: " . $mysqli->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<style>
    /* Styling for the admin dashboard */
    body { font-family: Arial, sans-serif; margin: 20px; }
    fieldset { border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; }
    legend { font-weight: bold; }
    label { display: block; margin-top: 10px; }
    input[type="text"], input[type="number"], select { width: 100%; padding: 8px; margin-top: 5px; }
    input[type="submit"] { padding: 10px 15px; margin-top: 15px; }
    .message { margin: 15px 0; color: green; }
    .nav { margin-bottom: 20px; }
    .nav a { margin-right: 15px; text-decoration: none; color: #337ab7; }
</style>
</head>
<body>
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
<div class="nav">
    <a href="admin.php">Dashboard</a>
    <a href="patients.php">View Patients</a>
    <a href="logout.php">Logout</a>
</div>
<h2>Add New Patient (Questionnaire)</h2>
<?php if ($message): ?>
    <div class="message"><?php echo $message; ?></div>
<?php endif; ?>
<form method="post" action="admin.php">
    <!-- Personal Information Section -->
    <fieldset>
        <legend>Personal Information</legend>
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required>
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required>
    </fieldset>
    
    <!-- Contact Information Section -->
    <fieldset>
        <legend>Contact Information</legend>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address">
        
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone">
    </fieldset>
    
    <!-- Additional Information Section -->
    <fieldset>
        <legend>Additional Information</legend>
        <label for="age">Age:</label>
        <input type="number" name="age" id="age" min="0">
        
        <label for="gender">Gender:</label>
        <select name="gender" id="gender">
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        
        <label for="marital_status">Marital Status:</label>
        <input type="text" name="marital_status" id="marital_status">
    </fieldset>
    
    <input type="submit" value="Submit Patient Information">
</form>
</body>
</html>
