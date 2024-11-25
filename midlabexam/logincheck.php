<?php
session_start();

if (isset($_POST['submit'])) {

    $name = trim($_REQUEST['name'] );
    $password = trim($_REQUEST['password'] );


    if (isset($_SESSION['users']) && is_array($_SESSION['users'])) {
        $userFound = false;

    
        foreach ($_SESSION['users'] as $user) {
            if (
                is_array($user) && 
                isset($user['name'], $user['password']) && 
                $user['name'] === $name && $user['password'] === $password 
            ) {
                $_SESSION['logged_in_user'] = $name;
                $userFound = true;
                break;
            }
        }

        if ($userFound) {
            header('location:details.php'); 
            exit;
        } else {
            echo "Invalid name or password.";
            exit;
        }
    } else {
        echo "No users registered.";
        exit;
    }
} else {
    header('location:login.html'); 
    exit;
}
?>
