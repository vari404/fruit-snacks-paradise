<?php

session_start();

$servername = "localhost";
$username = "your_database_username";
$password = "your_database_password";
$dbname = "fruit_snacks_db";
$port = 3306; 

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
