<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.html");
    exit();
}

include 'php/db.php';

// Fetch the updated wallet balance from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT wallet_balance FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['wallet_balance'] = $row['wallet_balance'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header with Wallet Balance</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <script>
        function updateWallet() {
            fetch('update_wallet.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('walletAmount').innerText = data.wallet_balance;
                })
                .catch(error => console.error('Error updating wallet:', error));
        }

        window.onload = updateWallet;
    </script>
</head>
<body>
    <header>
        <div class="logo"><a href="index.php">CassinadaFurira</a></div>
        <div class="wallet">Wallet: $<span id="walletAmount"><?php echo number_format($_SESSION['wallet_balance'], 2); ?></span></div>
        <div class="right-section">
            <div class="notification">
                <span class="icon">🔔</span>
            </div>
            <div class="profile-dropdown">
                <span class="profile">Connected: <?php echo $_SESSION['username']; ?> ▼</span>
                <div class="dropdown-content">
                    <a href="profile.php">Profile</a>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                    <a href="admin_crud.php">Admin CRUD</a>
                    <?php endif; ?>
                    <a href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </header>
</body>
</html>
