<?php
session_start();
require_once('../model/userModel.php');

// Check if form was submitted
if (isset($_POST['submit'])) {
    // Sanitize and check if the required data exists
    $email = isset($_REQUEST['email']) ? trim($_REQUEST['email']) : '';
    $password = isset($_REQUEST['password']) ? trim($_REQUEST['password']) : '';

    // Ensure both fields are not empty
    if (empty($email) || empty($password)) {
        echo "Null data found!";
    } else {
        // Fetch user from database
        $user = getUserByEmail($email);

        if ($user && $user['password'] === $password) {
            // Set session variables only after successful login
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['user_id'] = $user['id'];

            // Redirect based on user type
            switch ($user['user_type']) {
                case 'Admin':
                    header('location: ../view/menu_admin.html');
                    exit;
                case 'Advertiser':
                    header('location: ../view/menu_advertiser.html');
                    exit;
                case 'Viewer':
                    header('location: ../view/menu_viewer.html');
                    exit;
                default:
                    echo "Invalid user type!";
            }
        } else {
            // Invalid email or password
            echo "Email or password does not match!";
        }
    }
} else {
    // Redirect to login page if form is not submitted
    header('location: ../view/login.html');
    exit;
}
?>
