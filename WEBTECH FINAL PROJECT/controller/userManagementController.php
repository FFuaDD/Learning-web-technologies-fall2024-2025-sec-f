<?php
require_once('../model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_id = intval($_POST['user_id']);
    if (deleteUser($user_id)) {
        $message = "User deleted successfully!";
    } else {
        $message = "Failed to delete user. Please try again.";
    }
}

// Fetch all users for the view
$users = getAllUser();
?>
