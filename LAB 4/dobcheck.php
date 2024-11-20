<?php
session_start();
if (isset($_POST['submit'])) {
    $dd = $_REQUEST['date'];
    $mm = $_REQUEST['month'];
    $yyyy=$_REQUEST['year'];
     
    if($dd == null ||$mm==null||$yyyy== null){
        echo "can't be empty";
    }else if(($dd>=1 && $dd<=31) && ($mm>=1 && $mm<=12) && ($yyyy>=1953 && $yyyy<=1998) )
    {
        echo"Hello!<br/> Your Date of Birth is  ".$dd."/".$mm."/".$yyyy;
    }else if(!($dd>=1 && $dd<=31)){

        echo " please put valid numbers.<br/>date must be 1-31";
    } else if(!($mm>=1 && $mm<=12)){

        echo " please put valid numbers.<br/>month must be 1-12";
    } else if(!($yyyy>=1953 && $yyyy<=1998)){

        echo " please put valid numbers.<br/>year must be 1953-1998";
    } 
    else
    {
        header('location: dob.html');
    }
}


?>