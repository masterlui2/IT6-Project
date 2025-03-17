<?php
$servername = "localhost";
$username = "root"; // Change to your DB username
$password = ""; // Change to your DB password
$dbname = "it6";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>