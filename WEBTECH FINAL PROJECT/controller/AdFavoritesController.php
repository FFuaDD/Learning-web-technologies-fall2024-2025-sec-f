<?php
require_once('../model/userModel.php');

// Assume user_id = 1 for demonstration purposes
$user_id = 1;

// Handle adding a favorite
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ad_id'])) {
    $ad_id = intval($_POST['ad_id']);
    addFavoriteAd($user_id, $ad_id);

    // Redirect to avoid form resubmission
    header('Location: AdFavoritescontroller.php');
    exit();
}

// Fetch favorite ads for the user
$favorites = getFavoriteAdsByUser($user_id);

// Load the view
require_once('../view/AdFavoritesView.php');
?>
