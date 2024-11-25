<?php
session_start();

if (isset($_POST['submit'])) {
 
    $pswrd = $_REQUEST['password'] ;
    $cnfpswrd = $_REQUEST['cpassword']  ;
    $email = $_REQUEST['email']  ;
    $name = $_REQUEST['name'] ;


    if (!isset($_SESSION['users']) || !is_array($_SESSION['users'])) {
        $_SESSION['users'] = []; 
    }


    foreach ($_SESSION['users'] as $user) {
        if (
            is_array($user) && 
            (isset($user['name']) && $user['name'] === $name || 
             isset($user['email']) && $user['email'] === $email)
        ) 
         {
            echo "User with this name or email is already registered.";
            exit;
        }
    }


    if (empty($name) || empty($pswrd) || empty($cnfpswrd) || empty($email)) {
        echo "All fields are required.";
        exit;
    }


    if ($cnfpswrd !== $pswrd) {
        echo "Passwords do not match.";
        exit;
    }


    $userData = [
        'name' => $name,
        'password' => $pswrd,
        'email' => $email,
    ];

    $_SESSION['users'][] = $userData; 

    echo "<h1>Registration successful!</h1><br/>";
    echo"<h3><a href='login.html'>Cick Here To Login</a></h3>";
    exit;
}
?>
