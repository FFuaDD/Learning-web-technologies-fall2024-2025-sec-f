<?php
session_start();
require_once('../model/userModel.php');


if (!isset($_SESSION['username'])) {
    header('location: login.html');
    exit();
}

$username = $_SESSION['username'];
$user = getUserByUsername($username);

if (!$user) {
    echo "User data not found!";
    exit();
}



$fullName   = !empty($user['username']) ? $user['username'] : 'N/A';
$phone      = !empty($user['phone']) ? $user['phone'] : 'N/A';
$dob        = !empty($user['dob']) ? $user['dob'] : 'N/A';
$gender     = !empty($user['gender']) ? $user['gender'] : 'N/A';
$userType   = !empty($user['user_type']) ? $user['user_type'] : 'N/A';


$menuPage = '';
if ($userType == "Admin") {
    $menuPage = 'menu_admin.html';
} elseif ($userType == "Advertiser") {
    $menuPage = 'menu_advertiser.html';
} elseif ($userType == "Viewer") {
    $menuPage = 'menu_viewer.html';
} else {
    $menuPage = 'login.html'; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 50%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            text-align: center;
        }
        .info {
            margin-top: 20px;
        }
        .info p {
            font-size: 16px;
            margin: 8px 0;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a.button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Profile Information</h2>
    <h3>User Info</h3>
    <div class="info">
        <p><strong>Full Name:</strong> <?= htmlspecialchars($fullName) ?></p>
        <p><strong>Phone Number:</strong> <?= htmlspecialchars($phone) ?></p>
        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($dob) ?></p>
        <p><strong>Gender:</strong> <?= htmlspecialchars($gender) ?></p>
        <p><strong>User Type:</strong> <?= htmlspecialchars($userType) ?></p>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="<?= htmlspecialchars($menuPage) ?>" class="button">Go Back to Menu</a>
        <a href="../controller/logout.php" class="button" style="background-color: #f44336;">Log Out</a>
    </div>
</div>

</body>
</html>
