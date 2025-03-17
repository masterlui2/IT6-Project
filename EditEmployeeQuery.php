<?php
include 'db.php';
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");

// Validate request method
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "❌ Invalid request method."]);
    exit;
}

// Fetch and validate inputs
$id = isset($_POST['employeeid']) ? intval($_POST['employeeid']) : null;
$fullname = trim($_POST['fullname'] ?? "");
$contactno = trim($_POST['contactno'] ?? "");
$email = trim($_POST['email'] ?? "");
$address = trim($_POST['address'] ?? "");
$role = trim($_POST['role'] ?? "");
$password = trim($_POST['password'] ?? "");
$salary = isset($_POST['salary']) ? filter_var($_POST['salary'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : 0.0;
$hiredate = trim($_POST['hiredate'] ?? "");
$updatedby = $_SESSION['userid'] ?? null;
$status = isset($_POST['status']) && $_POST['status'] === 'Active' ? 'Active' : 'Deactivated';

// Ensure required fields are present
if (!$id || empty($fullname) || empty($role)) {
    echo json_encode(["status" => "error", "message" => "❌ Missing required fields."]);
    exit;
}

// Validate `updatedby`
if (!is_null($updatedby)) {
    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM employee WHERE employeeid = ?");
    $stmt_check->bind_param("i", $updatedby);
    $stmt_check->execute();
    $stmt_check->bind_result($exists);
    $stmt_check->fetch();
    $stmt_check->close();
    if ($exists == 0) {
        $updatedby = null;
    }
}

// Convert hiredate correctly
if (!empty($hiredate) && strtotime($hiredate) !== false) {
    $formatted_hiredate = date('Y-m-d', strtotime($hiredate));
} else {
    $formatted_hiredate = null;  // Ensure it's actually NULL
}

// Hash password only if provided
if (!empty($password)) {
    $password = password_hash($password, PASSWORD_DEFAULT);
} else {
    $password = null;
}

// Prepare stored procedure call
$stmt = $conn->prepare("CALL UpdateEmployee(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "❌ SQL Error: " . $conn->error]);
    exit;
}

// Bind parameters properly
if ($formatted_hiredate === null) {
    $stmt->bind_param(
        "issssssdsis",
        $id, $fullname, $contactno, $email, $address, $role,
        $salary, $hiredate, $status, $updatedby, $password
    );
} else {
    $stmt->bind_param(
        "issssssdsis",
        $id, $fullname, $contactno, $email, $address, $role,
        $salary, $hiredate, $status, $updatedby, $password
    );
}

// Execute query
if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "✅ Employee updated successfully!", "id" => $id]);
} else {
    echo json_encode(["status" => "error", "message" => "❌ Error updating employee: " . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>