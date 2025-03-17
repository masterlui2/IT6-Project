<?php
include 'db.php';
session_start(); // Ensure session is started

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname'] ?? "");
    $contactno = trim($_POST['contactno'] ?? "");
    $address = trim($_POST['address'] ?? "");
    $licenseno = trim($_POST['licenseno'] ?? "");
    $yrofexp = isset($_POST['yrofexp']) ? intval($_POST['yrofexp']) : 0;
    $comrate = isset($_POST['comrate']) ? floatval($_POST['comrate']) : 0.0;
    $status = "Active"; // Force status to Active

    // Get user ID from session
    $addedby = $_SESSION['user_id'] ?? 1; // Default to 1 if not set

    if (empty($fullname) || empty($address) || empty($licenseno)) {
        echo json_encode(["status" => "error", "message" => "❌ Missing required fields."]);
        exit;
    }

    $stmt = $conn->prepare("
        INSERT INTO driver (fullname, contactno, address, licenseno, yrofexp, comrate, status, addedby) 
        VALUES (?, ?, ?, ?, ?, ?, 'Active', ?) 
        ON DUPLICATE KEY UPDATE 
        fullname=VALUES(fullname), contactno=VALUES(contactno), address=VALUES(address), 
        yrofexp=VALUES(yrofexp), comrate=VALUES(comrate), status=VALUES(status)
    ");

    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "❌ SQL Error: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("ssssidi", $fullname, $contactno, $address, $licenseno, $yrofexp, $comrate, $addedby);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "✅ Driver added successfully!",
            "fullname" => $fullname,
            "contactno" => $contactno,
            "address" => $address,
            "licenseno" => $licenseno,
            "yrofexp" => $yrofexp,
            "comrate" => number_format($comrate, 2)
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Error inserting driver: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>