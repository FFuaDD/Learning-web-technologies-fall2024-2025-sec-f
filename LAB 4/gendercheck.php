<?php
session_start();
if(isset($_POST['submit']))
{
    if(isset($_POST['gender']))
    {
        $gender = $_POST['gender']; 
        echo " WELCOME"; 
    }else if(!isset($_POST['gender'])){
        echo "Please select at least one of them";
    }
    else
    {
        header('location:gender.html');
    }
}

?>
