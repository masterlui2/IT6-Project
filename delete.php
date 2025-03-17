<?php
// Database connection
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

// Check if the id is set in the URL and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Prepare and execute the deletion query
    $stmt = $conn->prepare("DELETE FROM payments WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirecting back to the previous page with a success message
        header("Location: http://localhost/IT6-Project/index.php?msg=Record%20successfully%20deleted?msg=Record successfully deleted");
        exit();
    } else {
        // Redirecting back with an error message
        header("Location: index.php?msg=Error deleting record");
        exit();
    }
} else {
    // Redirect if id is not set or invalid
    header("Location: index.php?msg=Invalid ID");
    exit();
}
?>