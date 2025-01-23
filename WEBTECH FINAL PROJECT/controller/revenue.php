<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode($_POST['mydata'], true);

    // Simulating processing of data
    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];

    // Response back with a success message
    echo json_encode(['pass' => "Received data for $username with email $email."]);
} else {
    echo json_encode(['error' => 'Invalid request method.']);
}
?>
