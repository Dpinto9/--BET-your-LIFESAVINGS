<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
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

// Logout logic
if (isset($_POST['logout'])) {
    session_unset(); 
    session_destroy(); 
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BET your LIFESAVINGS</title>
    <link rel="shortcut icon" href="logo3.jpg" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <!-- TEXTO -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
    <!-- LOGO -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <div class="logo">
            <img src="./img/logo.jpg" alt="logo">
            <a href="index.php">BET your LIFESAVINGS</a>
        </div>

        <div class="wallet">Wallet: $
            <span id="walletAmount">
                <?php echo number_format($_SESSION['wallet_balance'], 2); ?>
            </span>
        </div>

        <div class="right-section">
            <div class="bank">
                <span class="bank-icon"><i class="fa-solid fa-vault"></i></span>
            </div>

            <div class="notification">
                <span class="icon"><i class="fa-solid fa-envelope"></i></span>
            </div>

            <div class="profile-dropdown">
                <div class="profile">
                    <span class="profile-icon"><i class="fa-solid fa-user"></i></span>
                </div>

                <div class="dropdown-content">
                    <a href="profile.php">Profile: <?php echo $_SESSION['username']; ?> </a>
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <a href="admin_crud.php">Admin CRUD</a>
                    <?php endif; ?>
                    <form method="post">
                        <button type="submit" name="logout">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
</body>
</html>
