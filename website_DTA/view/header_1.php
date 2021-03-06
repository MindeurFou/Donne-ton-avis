<?php

require_once __ROOT__ . '/model/WebsiteUser.php';
require_once __ROOT__ . '/model/WebsiteUserManager.php';

if(isset($_SESSION["idUser"])){
    $user = $userManager->getUserById($_SESSION["idUser"]);
    $name=$user->getUserName();
} 


$montre= "<header>"
          ." <div class='ui fixed inverted main menu'>"
          ."<div class='header item'>DONNE TON AVIS</div>"
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
            $montre.="<a class='right item'>Bienvenue ". $name  ."</a>";
            }
            $montre.="</div>"
            ."<section class='texts-header'>"
             ."<h1>Créez ou participez à un sondage</h1>"
             . "<h2>Laissez vous tenter !</h2>"
            ."</section>"
            ."<div class='wave' style='height: 150px; overflow: hidden;'>"
                    ."<svg viewBox='0 0 500 150' preserveAspectRatio='none' style='height: 100%; width: 100%;'>"
                    ."<path d='M0.00,49.99 C169.29,150.29 349.20,-49.99 500.00,49.99 L500.00,150.00 L0.00,150.00 Z' style='stroke: none; fill: #fff;'>"
                    ."</path>"
                    ."</svg></div>"
."</header>";
            
echo $montre;
