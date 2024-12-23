<?php
session_start();
include_once '../model/userModel.php';

if (isset($_COOKIE['flag'])) {
    if (isset($_REQUEST['username'])) {
        $username = $_REQUEST['username'];
        $user = getUserByUsername($username);

        if (!$user) {
            header("Location: userlist.php");
            exit();
        }

        if (isset($_POST['submit'])) {
            $new_username = $_POST['username']; // New username from the form
            $password = $_POST['password'];
            $email = $_POST['email'];

            if (updateUserByUsername($username, $new_username, $password, $email)) {
                echo "User updated successfully!";
                header("Location: userlist.php");
                exit();
            } else {
                echo "Error updating user!";
            }
        }
    } else {
        header("Location: userlist.php");
        exit();
    }
?>

<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="post">
        Username: <input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" /> <br>
        Password: <input type="password" name="password" value="<?= htmlspecialchars($user['password']); ?>" /> <br>
        Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" /> <br>
        <input type="submit" name="submit" value="Update" />
    </form>
</body>
</html>

<?php
} else {
    header('Location: login.html');
    exit();
}
?>