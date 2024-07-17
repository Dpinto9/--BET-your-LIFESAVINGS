<?php
session_start();
include '../db.php'; 

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
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="../../css/style.css"> <!-- Adjust path if necessary -->
</head>
<body>
    <div class="container">
        <h1>Create User</h1>
        <form action="admin_crud_handler.php" method="post"> <!-- Adjust action path to your handler script -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="wallet_balance">Wallet Balance:</label>
            <input type="number" id="wallet_balance" name="wallet_balance" step="0.01" required>
            
            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            
            <button type="submit" name="create_user" class="btn">Create User</button>
        </form>
    </div>
</body>
</html>
