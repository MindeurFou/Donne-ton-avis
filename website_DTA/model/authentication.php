<?php 
require_once 'WebsiteUserManager.php';

session_start();

if(isset($_SESSION["idUser"])){
    $user = $userManager->getUserById($_SESSION["idUser"]);
} else {
    header("Location: http://localhost/Donne/view/pageLogin.php");
    exit();
}

