<?php
// getPatient.php - Page to display patient records

// Include the database connection
include 'db.php';

// Query the database for patient records
$sql = "SELECT patient_id, first_name, last_name FROM patients";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Patient Records</title>
    <style>
        /* Styling for the display table */
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 8px 12px; text-align: left; }
        th { background-color: rgb(244, 244, 244); }
    </style>
</head>
<body>
    <h1>Patient Records</h1>
    <table>
        <tr>
            <th>Patient ID</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Loop through each record and output as a table row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['patient_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No records found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
