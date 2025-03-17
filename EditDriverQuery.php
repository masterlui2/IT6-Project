<?php
include 'db.php';
session_start(); // Ensure session is started

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $driverid = isset($_POST['driverid']) ? intval($_POST['driverid']) : 0;
    $fullname = htmlspecialchars(trim($_POST['fullname'] ?? ""), ENT_QUOTES, 'UTF-8');
    $contactno = htmlspecialchars(trim($_POST['contactno'] ?? ""), ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars(trim($_POST['address'] ?? ""), ENT_QUOTES, 'UTF-8');
    $licenseno = htmlspecialchars(trim($_POST['licenseno'] ?? ""), ENT_QUOTES, 'UTF-8');
    $yrofexp = isset($_POST['yrofexp']) ? intval($_POST['yrofexp']) : 0;
    $comrate = isset($_POST['comrate']) ? floatval($_POST['comrate']) : 0.0;
    $status = htmlspecialchars(trim($_POST['status'] ?? "Active"), ENT_QUOTES, 'UTF-8');

    // Ensure required fields are present
    if ($driverid <= 0 || empty($fullname) || empty($address) || empty($licenseno)) {
        echo json_encode(["status" => "error", "message" => "❌ Missing required fields."]);
        exit;
    }

    // Prepare SQL call to stored procedure
    $stmt = $conn->prepare("CALL UpdateDriver(?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "❌ SQL Error: " . $conn->error]);
        exit;
    }

    // Bind parameters and execute the stored procedure
    $stmt->bind_param("issssids", $driverid, $fullname, $contactno, $address, $licenseno, $yrofexp, $comrate, $status);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "✅ Driver updated successfully!",
            "driver" => [
                "driverid" => $driverid,
                "fullname" => $fullname,
                "contactno" => $contactno,
                "address" => $address,
                "licenseno" => $licenseno,
                "yrofexp" => $yrofexp,
                "comrate" => number_format($comrate, 2),
                "status" => $status
            ]
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Error updating driver: " . $stmt->error]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>