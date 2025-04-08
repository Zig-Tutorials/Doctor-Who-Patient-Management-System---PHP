<?php
// signup.php - Admin Signup Page
session_start();
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and trim input values
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        // Check if the username already exists
        $stmt = $mysqli->prepare("SELECT admin_id FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $message = "Username already exists.";
        } else {
            // Insert new admin with the password hashed
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);
            if ($stmt->execute()) {
                $message = "Signup successful. You can now sign in.";
            } else {
                $message = "Signup failed. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Signup</title>
<style>
    /* Styling for the signup page */
    body { font-family: Arial, sans-serif; margin: 20px; }
    form { max-width: 400px; }
    label { margin-top: 10px; display: block; }
    input[type="text"], input[type="password"] { width: 100%; padding: 8px; margin-top: 5px; }
    input[type="submit"] { padding: 10px 15px; margin-top: 15px; }
    .message { margin-top: 15px; color: red; }
</style>
</head>
<body>
<h1>Admin Signup</h1>
<?php if ($message): ?>
    <div class="message"><?php echo $message; ?></div>
<?php endif; ?>
<form method="post" action="signup.php">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" id="confirm_password" required>
    
    <input type="submit" value="Sign Up">
</form>
<p>Already have an account? <a href="signin.php">Sign In</a></p>
</body>
</html>
