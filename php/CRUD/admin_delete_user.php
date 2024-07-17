<?php
session_start();
include '../db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Make sure the id is an integer

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['delete_message'] = "User deleted successfully!";
    } else {
        $_SESSION['delete_message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $_SESSION['delete_message'] = "Invalid user ID.";
}

header("Location: ../../admin_crud.php");
exit();
?>
