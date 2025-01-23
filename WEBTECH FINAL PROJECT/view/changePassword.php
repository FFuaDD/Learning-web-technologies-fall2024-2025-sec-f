<?php
session_start();
include_once '../model/userModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        $error = "All fields are required.";
    } elseif ($newPassword != $confirmPassword) {
        $error = "New password and confirmation password do not match.";
    } elseif (strlen($newPassword) < 8) {
        $error = "Password must be at least 8 characters long.";
    } else {
        $user = getUserByUsername($username);
        if ($user && $user['password'] == $currentPassword) {
            if (updatePasswordByUsername($username, $newPassword)) {
                $success = "Password updated successfully.";
            } else {
                $error = "Failed to update password.";
            }
        } else {
            $error = "Current password is incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
        }
        form {
            background-color: white;
            padding: 80px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="password"] {
            width: 100%;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .success {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="changepassword.php" method="POST" onsubmit="return validatePasswordForm()">
        <div>
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password" id="current_password" required>
        </div>
        <div>
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" required>
        </div>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
        </div>
        <button type="submit">Change Password</button>
    </form>

    <?php if (!empty($error)) { echo "<div class='error'>$error</div>"; } ?>
    <?php if (!empty($success)) { echo "<div class='success'>$success</div>"; } ?>

    <script>
        function validatePasswordForm() {
            var currentPassword = document.getElementById('current_password').value;
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;

            if (currentPassword == "" || newPassword == "" || confirmPassword == "") {
                alert("All fields must be filled out.");
                return false;
            }

            if (newPassword !== confirmPassword) {
                alert("New password and confirmation password do not match.");
                return false;
            }

            if (newPassword.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
