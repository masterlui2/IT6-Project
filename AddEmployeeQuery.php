<?php
include 'db.php';
session_start(); // Start the session

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname'] ?? "");
    $contactno = trim($_POST['phone'] ?? "");
    $email = trim($_POST['email'] ?? "");
    $address = trim($_POST['address'] ?? "");
    $role = trim($_POST['role'] ?? "");
    $password = trim($_POST['password'] ?? "");
    $salary = isset($_POST['salary']) ? floatval($_POST['salary']) : 0.0;
    $hiredate = $_POST['hiredate'] ?? "";
    $status = "Active"; // Force status to Active

    // Get user ID from session (ensure it exists)
    $addedby = $_SESSION['user_id'] ?? 1; // Default to 1 if not set

    // Validate required fields
    if (empty($fullname) || empty($contactno) || empty($email) || empty($address) || empty($role) || empty($password) || empty($hiredate)) {
        echo json_encode(["status" => "error", "message" => "❌ Missing required fields."]);
        exit;
    }

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "❌ Invalid email format."]);
        exit;
    }

    // Encrypt the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query (Avoid SQL injection)
    $stmt = $conn->prepare("
        INSERT INTO employee (fullname, contactno, email, address, role, password, salary, hiredate, status, addedby, dateadded) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ON DUPLICATE KEY UPDATE 
        contactno = VALUES(contactno), email = VALUES(email), address = VALUES(address), 
        role = VALUES(role), salary = VALUES(salary), hiredate = VALUES(hiredate), password = VALUES(password)
    ");

    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "❌ SQL Error: " . $conn->error]);
        exit;
    }

    // Bind parameters and execute
    $stmt->bind_param("ssssssdsis", $fullname, $contactno, $email, $address, $role, $hashed_password, $salary, $hiredate, $status, $addedby);

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "✅ Employee added successfully!",
            "fullname" => $fullname,
            "email" => $email
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Error inserting employee: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>