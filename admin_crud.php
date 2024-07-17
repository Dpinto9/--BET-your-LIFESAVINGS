<?php
include 'php/db.php';

$sql = "SELECT id, username, email, wallet_balance, role FROM users";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin CRUD</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'php/html/header.php'; ?>    

    <main>
        <div class="container">
            <h1>List of Users</h1>
            <a href="php/Crud/admin_create_user.php" class="btn">New User</a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Wallet Balance</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['wallet_balance']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td>
                            <a href="php/CRUD/admin_update_user.php?id=<?php echo $user['id']; ?>" class="btn edit">Edit</a>
                            <a href="php/CRUD/admin_delete_user.php?id=<?php echo $user['id']; ?>" class="btn delete">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
