<?php
// db.php - Database connection file

$host = 'localhost';
$db   = 'doctorWho';
$user = 'helper';
$pass = 'feelBetter';

// Create a new MySQLi connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check for a connection error and display a message if it fails
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
