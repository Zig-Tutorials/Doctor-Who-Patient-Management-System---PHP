<?php
// logout.php - End the admin session
session_start();
session_destroy();
header("Location: signin.php");
exit();
?>
