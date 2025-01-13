<?php
require_once('../model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (login($username, $password)) {
        if ($username === 'fuad' && $password === '12345') {
            header('Location: ../view/dashboard.html');
            exit();
        } else {
            echo "You are a valid employee!";
        }
    } else {
        echo "Invalid credentials!";
    }
}
?>
