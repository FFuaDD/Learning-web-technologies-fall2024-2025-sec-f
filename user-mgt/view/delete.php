<?php
session_start();
include_once '../model/userModel.php';

if (isset($_COOKIE['flag'])) {
    if (isset($_REQUEST['username'])) {
        $username = $_REQUEST['username'];

        if (deleteUserByUsername($username)) {
            echo "User deleted successfully!";
            header("Location: userlist.php");
            exit();
        } else {
            echo "Error deleting user!";
        }
    } else {
        header("Location: userlist.php");
        exit();
    }
} else {
    header('Location: login.html');
    exit();
}
?>