<?php
// signin.php - Admin Sign In Page
session_start();
include 'db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Query for the admin by username
    $stmt = $mysqli->prepare("SELECT admin_id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($admin_id, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            // Correct credentials; set session variables and redirect to admin dashboard
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['username'] = $username;
            header("Location: admin.php");
            exit();
        } else {
            $message = "Invalid username or password.";
        }
    } else {
        $message = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Sign In</title>
<style>
    /* Styling for the signin page */
    body { font-family: Arial, sans-serif; margin: 20px; }
    form { max-width: 400px; }
    label { margin-top: 10px; display: block; }
    input[type="text"], input[type="password"] { width: 100%; padding: 8px; margin-top: 5px; }
    input[type="submit"] { padding: 10px 15px; margin-top: 15px; }
    .message { margin-top: 15px; color: red; }
</style>
</head>
<body>
<h1>Admin Sign In</h1>
<?php if ($message): ?>
    <div class="message"><?php echo $message; ?></div>
<?php endif; ?>
<form method="post" action="signin.php">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    
    <input type="submit" value="Sign In">
</form>
<p>Don't have an account? <a href="signup.php">Sign Up</a></p>
</body>
</html>
