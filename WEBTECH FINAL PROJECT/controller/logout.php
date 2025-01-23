<?php
session_start();
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session
setcookie('flag', '', time() - 3600, '/'); // Remove the flag cookie
header('location: ../view/login.html'); // Redirect to login page
exit();
?>