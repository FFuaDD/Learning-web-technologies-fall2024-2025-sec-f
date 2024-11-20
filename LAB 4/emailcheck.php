<?php
session_start();
if (isset($_POST['submit'])) {
    $name = $_REQUEST['name'];
    if (empty($name) || strpos($name, "@") == false || strpos($name, ".") == false) 
    {
        header('location: email.html');
    } else {
     
        echo"Hello! Your email is ", $name;
    }
}
?>
