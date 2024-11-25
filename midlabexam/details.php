<?php
session_start();

if (!isset($_SESSION['logged_in_user'])) {
    header('location: login.html');
    exit;
}


$email = $_SESSION['logged_in_user'];


if (isset($_SESSION['users'][$email])) {
    $user = $_SESSION['users'][$email];
    $name = $user['name'];
    $email = $user['email'];

    $pswrd = $user['password'];

    echo "<h2>Welcome to the Home Page!</h2>";
    echo " Name: $name<br>";
    echo "Email: $email<br>";
    echo "Password: $password<br>";
} else {
    echo "User not found!";
}
?>
<a href="logout.php">Logout</a>
