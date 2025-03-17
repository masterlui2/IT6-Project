<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "it6";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$lastServiced = $_POST['lastServiced'];
$nextMaintenance = $_POST['nextMaintenance'];
$status = $_POST['status'];
$mileage = $_POST['mileage'];

$sql = "UPDATE maintenance SET last_serviced='$lastServiced', next_maintenance='$nextMaintenance', status='$status', mileage=$mileage WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>