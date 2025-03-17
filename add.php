<?php
// add.php
$host = 'localhost';
$dbname = 'it6';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment_method'];
    $partial_payment = $_POST['partial_payment'];
    $balance = $_POST['balance']; // Since we removed "Mark as Paid", balance is directly taken from the form

    // Prepare and execute the INSERT query
    $stmt = $conn->prepare("INSERT INTO payments (fullname, birthdate, email, payment_method, partial_payment, balance) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$fullname, $birthdate, $email, $payment_method, $partial_payment, $balance]);

    // Redirect back to the main page after insertion
    header("Location: http://localhost/IT6-Project/index.php");
    exit();
}
?>
