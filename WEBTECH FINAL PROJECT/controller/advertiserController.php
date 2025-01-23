<?php
require_once('../model/userModel.php');
session_start();
/*
// Ensure the user is an advertiser
if (!isset($_SESSION['user']) || $_SESSION['user']['user_type'] !== 'Advertiser') {
    header('Location: ../view/login.html');
    exit();
}
*/
$advertiser_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'create_ad') {
    $advertiser_id = $_SESSION['user_id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $start_date = trim($_POST['start_date']);
    $end_date = trim($_POST['end_date']);

    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/images/';
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $image_path = $upload_dir . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }

    $video_path = null;
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/videos/';
        $video_name = time() . '_' . basename($_FILES['video']['name']);
        $video_path = $upload_dir . $video_name;
        move_uploaded_file($_FILES['video']['tmp_name'], $video_path);
    }

    createAdvertisement($advertiser_id, $title, $description, $image_path, $video_path, $start_date, $end_date);
    header('Location: ../view/advertiserAdManagement.php');
    exit();
}


?>
