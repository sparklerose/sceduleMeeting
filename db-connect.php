<?php
$host     = 'localhost';
$username = 'root';
$password = '';
$dbname   = 'meetingschedule';

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>



