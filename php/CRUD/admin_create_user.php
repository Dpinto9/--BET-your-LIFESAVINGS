<?php
session_start();
include '../db.php'; 

if ($_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="../../css/style.css"> 
</head>
<body>
    <div class="container">
        <h1>Create User</h1>
        <form action="admin_crud_handler.php" method="post">
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
        <br>
        <a href="../../admin_crud.php" class="btn">Back</a>
    </div>
</body>
</html>
