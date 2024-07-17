<?php
session_start();
include '../db.php'; // Adjust path if necessary
if ($_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

// Fetch User Data
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT id, username, email, wallet_balance, role FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        $_SESSION['update_message'] = "User not found!";
        header("Location: ../../admin_crud.php");
        exit();
    }

    $stmt->close();
} else {
    $_SESSION['update_message'] = "Invalid user ID!";
    header("Location: ../../admin_crud.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="../../css/style.css"> <!-- Adjust path if necessary -->
</head>
<body>
    <div class="container">
        <h1>Update User</h1>
        <form action="admin_crud_handler.php" method="post"> <!-- Adjust action path to your handler script -->
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
            
            <label for="wallet_balance">Wallet Balance:</label>
            <input type="number" id="wallet_balance" name="wallet_balance" step="0.01" value="<?php echo $user['wallet_balance']; ?>" required>
            
            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
            
            <button type="submit" name="update_user" class="btn">Update User</button>
        </form>
    </div>
</body>
</html>
