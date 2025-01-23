<?php

session_start();

if (isset($_SESSION['email'])) {
    echo "Welcome, " . $_SESSION['email'];  // Display session email if user is logged in
} else {
    // Redirect to login page if no session found
    echo "User is not logged in. Redirecting to login page.";
    header('location: ../view/login.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: blue;
        }
        nav a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Your Dashboard, <?php echo htmlspecialchars($username); ?>!</h1>
        <nav>
            <a href="updateProfile.php">Update Profile</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <section>
        <h2>User Information</h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>User Type:</strong> <?php echo htmlspecialchars($user_type); ?></p>
    </section>

    <section>
        <h2>Available Actions</h2>
        <ul>
            <?php if ($user_type === 'admin') { ?>
                <li><a href="manageUsers.php">Manage Users</a></li>
                <li><a href="viewReports.php">View Reports</a></li>
            <?php } elseif ($user_type === 'advertiser') { ?>
                <li><a href="createAd.php">Create Advertisement</a></li>
                <li><a href="viewAdStats.php">View Ad Statistics</a></li>
            <?php } else { ?>
                <li><a href="viewAds.php">View Advertisements</a></li>
                <li><a href="updatePreferences.php">Update Preferences</a></li>
            <?php } ?>
        </ul>
    </section>
</body>
</html>