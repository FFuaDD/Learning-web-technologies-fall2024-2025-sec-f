<?php
require_once('../controller/userManagementController.php');
 
if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
 
    $result = deleteUser($userId);
 
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error deleting user']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No user ID provided']);
}
?>