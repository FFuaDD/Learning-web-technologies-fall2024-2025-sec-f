<?php
 require_once('../model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact_no = $_POST['contact_no'];
    $username = $_POST['username'];
    $password = $_POST['password'];

   
   
    if (checkIfUsernameExists($username)) {
        echo "Username already exists!";
    } else {
        if (addUser($name, $contact_no, $password, $username)) {
            echo "Registration successful! <br>
             <a href='../view/login.html'>Login Page</a>";
        } else {
            echo "Error in registration.";
        }
    }
}
?>
