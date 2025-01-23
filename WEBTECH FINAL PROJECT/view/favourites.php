<?php
session_start();
require_once('../model/userModel.php'); // Include query logic

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../view/login.html');
    exit();
}

$user_id = $_SESSION['user_id']; // User's ID from session
$message = "";

// Handle adding to favourites
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ad_id'])) {
    $ad_id = intval($_POST['ad_id']);
    $message = addToFavourites($user_id, $ad_id);
}

// Handle removing from favourites
if (isset($_GET['remove_id'])) {
    $ad_id = intval($_GET['remove_id']);
    $message = removeFromFavourites($user_id, $ad_id);
}

// Fetch user's favourite ads
$favourites = getFavourites($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ad Favourites</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .message {
            color: green;
            margin-bottom: 15px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background: #e9ecef;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .remove-btn {
            color: red;
            text-decoration: none;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ad Favourites</h1>
        
        <?php if (!empty($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- Add to Favourites Form -->
        <form method="POST">
            <label for="ad_id">Enter Ad ID:</label>
            <input type="number" id="ad_id" name="ad_id" required>
            <button type="submit">Add to Favourites</button>
        </form>

        <!-- Favourite Ads -->
        <h2>Your Favourite Ads</h2>
        <ul>
            <?php if (!empty($favourites)): ?>
                <?php foreach ($favourites as $favourite): ?>
                    <li>
                        <div>
                            <strong><?php echo htmlspecialchars($favourite['title']); ?></strong>
                            <p><?php echo htmlspecialchars($favourite['description']); ?></p>
                        </div>
                        <a href="?remove_id=<?php echo $favourite['id']; ?>" class="remove-btn">Remove</a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>You have no favourite ads yet.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
