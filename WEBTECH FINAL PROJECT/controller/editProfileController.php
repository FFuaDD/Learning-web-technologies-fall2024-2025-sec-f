<?php
session_start(); 
require_once('../model/userModel.php'); 


if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'viewProfile') {
    $email = $_SESSION['email'];
    $user = getUserProfileByEmail($email);
    include('../views/viewProfileView.php'); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['action']) && $_GET['action'] == 'editProfile') {
    $userId = $_SESSION['user']['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    
    if (updateUser($userId, $username, $email, $phone, $dob, $gender)) {
        $_SESSION['user'] = getUserData($email); 
        header("Location: viewProfileView.php"); 
    } else {
        echo "Failed to update profile.";
    }
}
?>
