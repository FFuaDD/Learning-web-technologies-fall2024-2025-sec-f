<?php
require_once('../model/userModel.php');
session_start();

// Ensure the user is an advertiser
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Advertiser') {
    header('Location: ../view/login.html');
    exit();
}

$advertiser_id = $_SESSION['user_id'];

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    // Handle filter request
    if (isset($input['search']) || isset($input['date'])) {
        $search = $input['search'] ?? null;
        $date = $input['date'] ?? null;
        $notifications = getNotificationsByAdvertiser($advertiser_id, $search, $date);
        echo json_encode($notifications);
        exit();
    }

    // Handle mark as read request
    if (isset($input['action']) && $input['action'] === 'markAsRead') {
        $notificationId = $input['notificationId'];
        $success = markNotificationAsRead($notificationId);
        echo json_encode(['success' => $success]);
        exit();
    }
}



// Default fetch for initial page load
$notifications = getNotificationsByAdvertiser($advertiser_id);

?>
