<?php
session_start();
if(isset($_POST['submit']))
{
    if (!empty($_POST['degrees']) && count($_POST['degrees']) <= 2) {
    echo "WELCOME TO PHP !  " ;
} else if(empty($_POST['degrees']) || count($_POST['degrees']) >= 2 ) {
    echo "Please pick at least two options.";
}

    else
    {
        header('location:degree.html');
    }
}
?>
