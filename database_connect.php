<?php
// database_connect.php
// Connects to the MySQL database using mysqli

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'trusthub';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    // If connection fails, stop and show error
    die('Connection failed: ' . $conn->connect_error);
}
?>
