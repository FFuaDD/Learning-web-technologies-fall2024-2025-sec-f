<?php
session_start();

if (isset($_POST['submit'])) {
    $name = $_REQUEST['name'];
    $password = $_REQUEST['password'];

    if (isset($_SESSION['users'])) {
        $userFound = false;

        foreach ($_SESSION['users'] as $user) {
            if ($user['name'] === $name && $user['password'] === $password) {
                $_SESSION['logged_in_user'] = $name;
                $userFound = true;
                break;
            }
        }

        if ($userFound) {
            header('location:details.php');
        } else {
            echo "Invalid  name or password.";
            header('location:login.html');
        }
    } else {
        echo "No users registered.";
        header('location:login.html');
    }
} else {
    header('location:login.html');
}
?>