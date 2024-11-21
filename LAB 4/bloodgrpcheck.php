<?php
session_start();

if (isset($_POST['submit'])) {
  
    if (!empty($_POST['bloodgroup'])) {
        echo "WELCOME TO PHP! <br/> You Selected Blood group : " . $_POST['bloodgroup'] ;
    } else if(empty($_POST['bloodgroup'])) {
        echo "Please select a Blood Group please.";
    }else
    {
        header('location:degree.html');
    }
}
?>