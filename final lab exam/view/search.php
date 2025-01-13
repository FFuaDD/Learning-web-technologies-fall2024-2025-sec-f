<?php
require_once('../model/usermodel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['search'];
    $users = searchUsers($search);

    if (!empty($users)) {
        foreach ($users as $user) {
            echo "
                    <p><strong>Name:</strong> {$user['name']}</p>
                    <p><strong>Username:</strong> {$user['username']}</p>
                    <p><strong>Contact No:</strong> {$user['contact_no']}</p>
                    <p><strong>Password:</strong> {$user['password']}</p>
                    <button onclick='updateUser(\"{$user['username']}\")'>Update</button>
                    <button onclick='deleteUser(\"{$user['username']}\")'>Delete</button>
                    
                
                  <hr>";
        }
    } else {
        echo "No results found!";
    }
}
?>
