<?php
require_once('../model/userModel.php');
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['user_type'] !== 'Admin') {
    header('Location: ../view/adminDashboard.html');
    exit();
}

// Handle filtering
$title_filter = $_GET['title'] ?? null;
$advertiser_filter = $_GET['advertiser'] ?? null;

// Fetch advertisers for the filter dropdown
$advertisers = getAdvertisers();

// Fetch pending ads with filters
$pending_ads = getPendingAdvertisements($title_filter, $advertiser_filter);

// Handle approve/reject actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad_id = $_POST['ad_id'];
    $action = $_POST['action'];
    $feedback = $_POST['feedback'] ?? null;

    if ($action === 'approve') {
        approveAd($ad_id);
    } elseif ($action === 'reject') {
        if (!empty($feedback)) {
            rejectAd($ad_id, $feedback);
        } else {
            echo "Feedback is required to reject an ad.";
            exit();
        }
    }

    header('Location: ../view/adminAdManagement.php');
    exit();
}
?>
