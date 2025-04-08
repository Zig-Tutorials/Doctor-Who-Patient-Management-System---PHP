<?php
// addPatient.php - Page for submitting a new patient record via a questionnaire

// Include the database connection file
include 'db.php';

// Initialize a message variable for success/error feedback
$message = "";

// Process the form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input from each questionnaire field
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
        $message = "Your responses have been submitted and your record has been added successfully!";
    } else {
        $message = "Submission error: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Questionnaire</title>
    <style>
        /* Basic styling for the form questionnaire */
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f9f9f9;
        }
        h1 { color: #333; }
        fieldset { 
            border: 1px solid #ccc; 
            padding: 20px; 
            margin-bottom: 20px; 
            background-color: #fff;
        }
        legend { 
            font-weight: bold; 
            padding: 0 10px;
        }
        label { 
            display: block; 
            margin: 10px 0 5px;
        }
        input[type="text"], 
        input[type="number"], 
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #337ab7;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 15px;
        }
        .message {
            margin: 15px 0;
            padding: 10px;
            background-color: #e7f3fe;
            border: 1px solid #b3d4fc;
            color: #31708f;
        }
    </style>
</head>
<body>
    <h1>Patient Information Questionnaire</h1>

    <!-- Display a success or error message if one exists -->
    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <!-- Begin the questionnaire form -->
    <form method="post" action="addPatient.php">
        <!-- Personal Information Section -->
        <fieldset>
            <legend>Personal Information</legend>
            <label for="first_name">1. What is your First Name?</label>
            <input type="text" id="first_name" name="first_name" required>
            
            <label for="last_name">2. What is your Last Name?</label>
            <input type="text" id="last_name" name="last_name" required>
        </fieldset>

        <!-- Contact Information Section -->
        <fieldset>
            <legend>Contact Information</legend>
            <label for="address">3. What is your Address?</label>
            <input type="text" id="address" name="address" placeholder="Street, City, State">
            
            <label for="phone">4. What is your Phone Number?</label>
            <input type="text" id="phone" name="phone" placeholder="e.g., 555-1234">
        </fieldset>

        <!-- Additional Information Section -->
        <fieldset>
            <legend>Additional Information</legend>
            <label for="age">5. What is your Age?</label>
            <input type="number" id="age" name="age" min="0">
            
            <label for="gender">6. What is your Gender?</label>
            <select name="gender" id="gender">
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            
            <label for="marital_status">7. What is your Marital Status?</label>
            <input type="text" id="marital_status" name="marital_status" placeholder="Single, Married, etc.">
        </fieldset>

        <!-- Submission Button -->
        <input type="submit" value="Submit Questionnaire">
    </form>
</body>
</html>

