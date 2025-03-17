<?php
// edit.php
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
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $birthdate = $_POST['birthdate'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment_method'];
    $partial_payment = $_POST['partial_payment'];
    
    // Check if "Mark as Paid" checkbox is checked
    $balance = isset($_POST['mark_as_paid']) ? "Paid" : $_POST['balance'];

    $stmt = $conn->prepare("UPDATE payments SET fullname = ?, birthdate = ?, email = ?, payment_method = ?, partial_payment = ?, balance = ? WHERE id = ?");
    $stmt->execute([$fullname, $birthdate, $email, $payment_method, $partial_payment, $balance, $id]);

    // Redirect back to the main page after updating
    header("Location: http://localhost/IT6-Project/index.php");
    exit();
}
?>
