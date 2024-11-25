<?php
session_start();


if (!isset($_SESSION['logged_in_user'])) {
    header('location: login.html');
    exit;
}


$name = $_SESSION['logged_in_user'];
$userFound = false;


if (isset($_SESSION['users']) && is_array($_SESSION['users'])) {
    foreach ($_SESSION['users'] as $user) {
        if (
            is_array($user) &&
            isset($user['name'], $user['email']) &&
            $user['name'] === $name
        ) {
            $email = $user['email'];
            $userFound = true;
            break;
        }
    }
}


if ($userFound) {
    echo "<h2>Welcome to the Home Page!</h2>";
    echo "Name: $name<br>";
    echo "Email: $email<br>";
} else {
    echo "<h2>User not found!</h2>";
}
?>
<br><a href="logout.php">Click Here To Logout</a>
