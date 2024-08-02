<?php
include '../db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password, role, wallet_balance FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['wallet_balance'] = $user['wallet_balance'];
            $stmt->close();
            $conn->close();
            header("Location: ../../index.php");
            exit;
        } else {
            $error_message = urlencode("Invalid username or password.");
        }
    } else {
        $error_message = urlencode("Invalid username or password.");
    }

    $stmt->close();
    $conn->close();
    header("Location: ../../login.html?error=" . $error_message);
    exit;
}
?>
