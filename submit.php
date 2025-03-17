<?php
header('Content-Type: application/json');

// Database connection
$host = 'localhost';
$dbname = 'it6';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $e->getMessage()]);
    exit;
}

// Check if required fields are present
if (!isset($_POST['fullname'], $_POST['birthdate'], $_POST['email'], $_POST['payment_method'], $_POST['partial_payment'], $_POST['total_amount'])) {
    echo json_encode(["success" => false, "message" => "Missing required fields"]);
    exit;
}

// Sanitize user inputs
$fullname = htmlspecialchars($_POST['fullname']);
$birthdate = htmlspecialchars($_POST['birthdate']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$payment_method = htmlspecialchars($_POST['payment_method']);
$partial_payment = floatval($_POST['partial_payment']);
$total_amount = floatval($_POST['total_amount']);

// Calculate balance
$balance = $total_amount - $partial_payment;

try {
    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO payments (fullname, birthdate, email, payment_method, partial_payment, total_amount, balance) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$fullname, $birthdate, $email, $payment_method, $partial_payment, $total_amount, $balance]);

    echo json_encode(["success" => true, "message" => "Transaction saved successfully!"]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
?>
