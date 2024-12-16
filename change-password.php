<?php
session_start();
include './db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $userId = $_SESSION['id'];

    $result = $conn->query("SELECT `password` FROM `users` WHERE `id` = $userId");
    $user = $result->fetch_assoc();

    if (password_verify($currentPassword, $user['password'])) {
        if ($newPassword === $confirmPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $conn->query("UPDATE `users` SET `password` = '$hashedPassword' WHERE `id` = $userId");
            $msg = "Password changed";
            header('Location: user_profile.php?msg=' . $msg);    
        } else {
            $msg = 'New password and confirm password do not match.';
            header('Location: user_profile.php?msg=' . $msg);
        }
    } else {
        $msg = 'Current password is incorrect.';
        header('Location: user_profile.php?msg=' . $msg);
    }
}
exit;
?>
