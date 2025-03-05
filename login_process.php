<?php
session_start();

// Load credentials (update to use hashed passwords)
$credentials = include 'includes/credentials.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = strtolower(trim($_POST['username'] ?? ''));
    $password = $_POST['password'] ?? '';

    // Validate credentials
    if (isset($credentials[$username]) && password_verify($password, $credentials[$username])) {
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Redirect to dashboard after successful login
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password!";
        header("Location: login.php");
        exit();
    }
}
?>
