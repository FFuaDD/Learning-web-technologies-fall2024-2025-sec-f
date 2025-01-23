<?php
require_once('../model/userModel.php');

// Handle search input
$title_search = $_GET['title'] ?? null;

// Fetch ads based on the search query
$ads = $title_search ? searchAdsByTitle($title_search) : getPendingAds();

// Handle approve/reject actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad_id = $_POST['ad_id'];
    $action = $_POST['action'];
    $feedback = $_POST['feedback'] ?? null;

    // Fetch ad details using getAdById
    $ad = getAdById($ad_id);
    if (!$ad) {
        die("Ad not found.");
    }

    $advertiser_id = $ad['advertiser_id'];
    $ad_title = $ad['title'];

    if ($action === 'approve') {
        updateAdStatus($ad_id, 'approved');
        $message = "Your ad '$ad_title' has been approved.";
        createNotification($advertiser_id, $ad_id, $message);
    } elseif ($action === 'reject') {
        updateAdStatus($ad_id, 'rejected', $feedback);
        $message = "Your ad '$ad_title' has been rejected. Feedback: $feedback";
        createNotification($advertiser_id, $ad_id, $message);
    }

    header('Location: ../view/adminAdManagement.php');
    exit();
}

?>
