<?php
require_once('../model/userModel.php');
session_start();



// Fetch approved advertisements
$ads = getApprovedAdvertisements();


?>
