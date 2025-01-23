<?php
require_once('../model/userModel.php');
$response = ['success' => false, 'message' => ''];
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';  
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';
    $contact_method = $_POST['contact_method'] ?? '';
 
    $errors = [];
 
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (!empty($phone) && !is_numeric($phone)) {
        $errors[] = "Phone number must contain only numbers.";
    }
    if (strlen($message) < 10 || strlen($message) > 500) {
        $errors[] = "Message must be between 10 and 500 characters.";
    }
    $valid_methods = ['email', 'phone'];
    if (!in_array($contact_method, $valid_methods)) {
        $errors[] = "Invalid contact method. Choose either 'email' or 'phone'.";
    }
    if (!empty($errors)) {
        $response['message'] = implode(" ", $errors);
    } else {
        if (addContactInformation($name, $email, $phone, $message, $contact_method)) {
            $response['success'] = true;
            $response['message'] = 'Contact information submitted successfully.';
        } else {
            $response['message'] = 'There was an error submitting your contact information. Please try again later.';
        }
    }
}
echo json_encode($response);
?>