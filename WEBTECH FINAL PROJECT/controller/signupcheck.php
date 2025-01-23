<?php
    require_once('../model/userModel.php');

    if(isset($_POST['submit'])) {
        $username  = trim($_REQUEST['username']);
        $password  = trim($_REQUEST['password']);
        $re_password = trim($_REQUEST['re_password']);
        $email     = trim($_REQUEST['email']);
        $phone  = trim($_REQUEST['phone']);
        $dob    = trim($_REQUEST['dob']);
        $gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : '';
        $user_type = isset($_REQUEST['user_type']) ? $_REQUEST['user_type'] : '';

      
        if(empty($username) || empty($password) || empty($re_password) || empty($email)) {
            echo "Null data found!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format!";
        } elseif (getUserByEmail($email)) {
            echo "Email already used!";
        } elseif (strlen($password) < 8) {
            echo "Password must be at least 8 characters long!";
        } elseif ($password !== $re_password) {
            echo "Password do not match!";
        } elseif (empty($user_type)) {
            echo "Please select a user type!";
        } else {
          
            $status = addUser($username, $email, $password, $phone, $dob, $gender, $user_type);
            if($status) {
                header('location: ../view/login.html');
            } else {
                echo "Error in registration. Please try again.";
            }
        }
    } else {
        header('location: ../view/signup.html');
    }
?>
