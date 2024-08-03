<?php
include '../db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize the input data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate input data
    if (empty($username) || empty($email) || empty($password)) {
        $error_message = "All fields are required.";
        header("Location: ../../login.html?error=" . urlencode($error_message));
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
        header("Location: ../../login.html?error=" . urlencode($error_message));
        exit;
    }

    // Check if username or email already exists
    $sql_check = "SELECT id FROM users WHERE username = ? OR email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $username, $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $error_message = "Error: Username or email already taken.";
        header("Location: ../../login.html?error=" . urlencode($error_message));
        exit;
    }

    $stmt_check->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        header("Location: ../../login.html?success=" . urlencode("Registration successful. Please log in."));
    } else {
        // Error occurred, show error message
        $error_message = "Error: " . $stmt->error;
        header("Location: ../../login.html?error=" . urlencode($error_message));
    }

    $stmt->close();
    $conn->close();
    exit;
} else {
    // If the form was not submitted, redirect to the registration page
    header("Location: ../../login.html");
    exit;
}
?>
