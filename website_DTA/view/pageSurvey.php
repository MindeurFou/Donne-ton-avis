<?php 

require_once 'SurveyManager.php';
require_once 'WebsiteUserManager.php';

//Par exemple disons qu'on veut charger le sondage d'id = 2, on est arrivé sur cette page depuis la page d'index ou on avait chargé plusieurs sondages sous formes d'objets
// on a notre objet $survey, il faut faire :

/*
 * $choices = $surveyManager->getChoicesOfSurvey($survey->idSurvey);
 * $survey->setChoices($choices);
*/

// Il faut maintenant charger ces "choices" dans la page HTML
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Sondage DTA</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link href="semantic.min.css" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="semantic.min.css">
        <script
            src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity ="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
        <script src="semantic.min.js"></script>
        <script>$(document).ready(function() {$(".rating").rating();});</script>
    </head>
    
    <body>
        
        <?php include "header.html"; ?>
        
        <h1 class="ui block header">Quel est le meilleur film de 2019 ?</h1>
        <div class="ui main text container">
        <div class="ui internally celled grid">
            <div class="row">
                <div class="six wide column">
                    <div class="ui centered medium image">
                        <img src="images/once_upon_a_time_affiche.jpg" alt="Poster of Once upon a time">
                    </div>
                </div>
                <div class="ten wide column"> 
                    <h3>Once Upon a Time in Holywood</h3><br>
                    Le nouveau film de Tarantino, il a fait un tabac
                    auprès du public avec pas moins de 100 000 entrées sur les 6 premiers mois après sa sortie...
                    C'est pour moi un bon candidat pour le poste de meilleur film de l'année !
                </div>
            </div>
            
            <div class="row">
                <div class="ten wide column">
                    <h3>Joker</h3><br>
                    Le Joker a été une vrai révélation cette année. Ce film nous a vraiment pris de court, tant il est 
                    différent des films de héros signé Marvel que l'on a l'habitude de voir.                   
                </div>
                <div class="six wide column">
                     <div class="ui centered medium image">
                        <img src="images/joker_affiche.jpg" alt="Poster of Joker">
                    </div>
                </div>
            </div>
        </div>
        </div>    
        
        Popularité : <div class="ui star rating" data-rating="3" ></div>
        
       
        
        
        <?php include "footer.html"; ?>
      
        
        
    </body>
</html>

