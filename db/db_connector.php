<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ultsch_db";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
echo "Connected successfully";
?>