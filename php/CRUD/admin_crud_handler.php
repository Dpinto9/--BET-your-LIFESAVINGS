<?php
session_start();
include '../db.php'; 

if ($_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

// Handle Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $wallet_balance = $_POST['wallet_balance'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, email, password, wallet_balance, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $email, $password, $wallet_balance, $role);

    if ($stmt->execute()) {
        $_SESSION['create_message'] = "User created successfully!";
        header("Location: ../../admin_crud.php");
        exit();
    } else {
        $_SESSION['create_message'] = "Error: " . $stmt->error;
        header("Location: admin_create_user.php");
        exit();
    }

    $stmt->close();
}

// Handle Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $wallet_balance = $_POST['wallet_balance'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET username = ?, email = ?, wallet_balance = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $username, $email, $wallet_balance, $role, $id);

    if ($stmt->execute()) {
        $_SESSION['update_message'] = "User updated successfully!";
        header("Location: ../../admin_crud.php");
        exit();
    } else {
        $_SESSION['update_message'] = "Error: " . $stmt->error;
        header("Location: admin_update_user.php?id=" . $id);
        exit();
    }

    $stmt->close();
}

// Handle Delete
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['delete_message'] = "User deleted successfully!";
    } else {
        $_SESSION['delete_message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: ../../admin_crud.php");
    exit();
}

$conn->close();
?>
