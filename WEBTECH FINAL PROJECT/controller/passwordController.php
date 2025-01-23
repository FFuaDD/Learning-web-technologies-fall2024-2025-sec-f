<?php
session_start();
require_once('../model/userModel.php'); 

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email']; 
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];


    error_log("Current Password Entered: $currentPassword");
    error_log("New Password: $newPassword");

    if (!verifyCurrentPassword($email, $currentPassword)) {
        echo "<script>alert('Incorrect current password!'); window.location.href='../view/changePassword.php';</script>";
        exit;
    }

    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!'); window.location.href='../view/changePassword.php';</script>";
        exit;
    }

    if (strlen($newPassword) < 8) {
        echo "<script>alert('Password must be at least 8 characters long!'); window.location.href='../view/changePassword.php';</script>";
        exit;
    }


    if (updatePassword($email, $newPassword)) {
        echo "<script>alert('Password changed successfully!'); window.location.href='../view/viewProfileView.php';</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again.'); window.location.href='../view/changePassword.php';</script>";
    }
}
?>
