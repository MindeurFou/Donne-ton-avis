<?php 
require_once 'WebsiteUserManager.php';

session_start();

if(isset($_SESSION["idUser"])){
    $user = $userManager->getUserById($_SESSION["idUser"]);
} else {
    header("Location: http://localhost/website_DTA/view/pageLogin.php");
    exit();
}

