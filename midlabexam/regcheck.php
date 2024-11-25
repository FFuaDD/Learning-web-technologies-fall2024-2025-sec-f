<?php
session_start();

if (isset($_POST['submit'])) {
    $pswrd = $_REQUEST['password'];
    $cnfpswrd = $_REQUEST['cpassword'];
    $email = $_REQUEST['email'];
    $name = $_REQUEST['name'];
  
    $userData = [
        'name' => $name,
        'password' => $pswrd,
        'email' => $email,

    ];
    if (!isset($_SESSION['users'])) {
        $_SESSION['users'] = [];
    }

    if (isset($_SESSION['users'][$email])) {
        echo "User with this email is already registered.";
        exit;
    }

    if (empty($name)  || empty($pswrd) || empty($cpswrd) || $cpswrd !== $pswrd  ||empty($email)) {
        echo"<h1>SUCCESSFULLY REGISTERED</h1>";
        echo"<a href='login.html'>Cick Here To Login</a>";
        
        
    }

    $_SESSION['users']= $userData;



    


}
?>
