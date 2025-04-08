<?php
// viewProfile.php - Display full patient profile (protected admin page)
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: signin.php");
    exit();
}
include 'db.php';

if (isset($_GET['id'])) {
    $patient_id = intval($_GET['id']);
    $stmt = $mysqli->prepare("SELECT * FROM patients WHERE patient_id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $patient = $result->fetch_assoc();
    } else {
        die("Patient not found.");
    }
} else {
    die("No patient ID provided.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Patient Profile</title>
<style>
    /* Styling for the patient profile page */
    body { font-family: Arial, sans-serif; margin: 20px; }
    .nav { margin-bottom: 20px; }
    .nav a { margin-right: 15px; text-decoration: none; color: #337ab7; }
    table { border-collapse: collapse; width: 100%; max-width: 600px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
</style>
</head>
<body>
<div class="nav">
    <a href="admin.php">Dashboard</a>
    <a href="patients.php">View Patients</a>
    <a href="logout.php">Logout</a>
</div>
<h1>Patient Profile</h1>
<table>
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>
    <tr>
        <td>Patient ID</td>
        <td><?php echo htmlspecialchars($patient['patient_id']); ?></td>
    </tr>
    <tr>
        <td>First Name</td>
        <td><?php echo htmlspecialchars($patient['first_name']); ?></td>
    </tr>
    <tr>
        <td>Last Name</td>
        <td><?php echo htmlspecialchars($patient['last_name']); ?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?php echo htmlspecialchars($patient['address']); ?></td>
    </tr>
    <tr>
        <td>Age</td>
        <td><?php echo htmlspecialchars($patient['age']); ?></td>
    </tr>
    <tr>
        <td>Gender</td>
        <td><?php echo htmlspecialchars($patient['gender']); ?></td>
    </tr>
    <tr>
        <td>Marital Status</td>
        <td><?php echo htmlspecialchars($patient['marital_status']); ?></td>
    </tr>
    <tr>
        <td>Phone</td>
        <td><?php echo htmlspecialchars($patient['phone']); ?></td>
    </tr>
</table>
</body>
</html>
