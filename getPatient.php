<?php
// getPatient.php - Page to display patient records

// Include the database connection
include 'db.php';

// Retrieve patient records from the database
$sql = "SELECT patient_id, first_name, last_name FROM patients";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Records</title>
    <style>
        /* Styling for the patient records table */
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f9f9f9;
        }
        table { 
            border-collapse: collapse; 
            width: 100%;
            background-color: #fff;
        }
        th, td { 
            border: 1px solid #ccc; 
            padding: 8px 12px; 
            text-align: left;
        }
        th { 
            background-color: #f2f2f2;
        }
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
            // Loop through each record and display as a table row
            while($row = $result->fetch_assoc()){
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

