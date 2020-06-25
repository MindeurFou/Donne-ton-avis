<?php

require_once __ROOT__ . '/model/WebsiteUser.php';
require_once __ROOT__ . '/model/WebsiteUserManager.php';

if(isset($_SESSION["idUser"])){
    $user = $userManager->getUserById($_SESSION["idUser"]);
    $name=$user->getUserName();
} 


$montre= "<div class='header'>"
          ." <div class='ui fixed inverted main menu'>"
          ."<div class='"
        . " item'>DONNE TON AVIS</div>"
          ."<a class='item'>Categories</a>"
          ."<a class='item'>Histoire du site</a>"
          ."<a class='item'>Contact</a>";
            if(empty($name)){
             $montre.="<nav>
                <a href='pageLogin.php'>Se connecter</a>
                <a href='pageSignIn.php'>S'incrire</a>
            </nav>" ; 
            }
            else {
            $montre.="<a class=' right item'>Bienvenue ". $name  ."</a>";
            }
            $montre.="</div>"
            
."</div>";
echo $montre;
