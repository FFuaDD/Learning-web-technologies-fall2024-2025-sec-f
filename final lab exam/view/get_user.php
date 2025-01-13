<?php
include('../model/usermodel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $user = getUserByUsername($username);
    if ($user) {
        echo "username:{$user['username']},name:{$user['name']},contact_no:{$user['contact_no']},password:{$user['password']}";
    } else {
        echo "User not found";
    }
}
?>
