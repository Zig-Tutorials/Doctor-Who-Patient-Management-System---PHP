<?php
// patients.php - Display a list of patients with clickable names (protected admin page)
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: signin.php");
    exit();
}
include 'db.php';

$sql = "SELECT patient_id, first_name, last_name FROM patients";
$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Patient List</title>
<style>
    /* Styling for the patients list page */
    body { font-family: Arial, sans-serif; margin: 20px; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
    th { background-color: #f2f2f2; }
    a { text-decoration: none; color: #337ab7; }
    .nav { margin-bottom: 20px; }
    .nav a { margin-right: 15px; }
</style>
</head>
<body>
<div class="nav">
    <a href="admin.php">Dashboard</a>
    <a href="patients.php">View Patients</a>
    <a href="logout.php">Logout</a>
</div>
<h1>Patient List</h1>
<table>
    <tr>
        <th>Patient ID</th>
        <th>Patient Name</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['patient_id']) . "</td>";
            // The name is a clickable link leading to viewProfile.php with the patient_id as a parameter
            echo "<td><a href='viewProfile.php?id=" . urlencode($row['patient_id']) . "'>" 
                . htmlspecialchars($row['first_name'] . " " . $row['last_name']) . "</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No records found.</td></tr>";
    }
    ?>
</table>
</body>
</html>
