<?php 
define('__ROOT__', dirname(__DIR__));

require_once __ROOT__.'/model/SurveyManager.php';


//Disons qu'on veuille afficher sur notre page d'index les dix premiers sondages donnés par la db : 

$surveys = $surveyManager->getSurveys(1,10); // C'est un tableau de sondages

//Il faut maintenant les afficher sur la page HTML

?>




<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Bienvenue sur DTA</title>

        <link href="semantic.min.css" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">
    </head>
    <body>
        
        <?php include ('header.html'); ?>


        <section class="sondages">

            <h1 class="ui block header">Envie de participer à un sondage ?</h1>

            <div class="ui items ">
                
                <div class="item">
                    <div class="image">
                        <img src="<?php echo __ROOT__ ?>/images/top-films.jpg">
                       
                    </div>
                    <div class="content">
                        <a class="header" href="pageSurvey.html">Quel est le meilleur film de 2019 ?</a>
                        <div class="meta">
                            <span>Créé par Tanguy</span>
                        </div>
                        <div class="description">
                            <p>L'année 2019 a été riche en chefs d'oeuvres du cinéma... Cependant
                                il est l'heure d'élire ceux qui vous ont le plus plût ! Donnez vôtre avis ici !</p>
                        </div>
                        <div class="extra">
                            Ferme dans 10 jours
                        </div>
                    </div>
                </div>

            </div>    

        </section>

        <section class="creation sondage">
            <h1 class="ui block header">Envie de proposer un autre sondage ?</h1>
            <div class="ui segment">
                <p>Vous avez parcouru tout les sondages du site mais toujours pas de traces de celui qui trottait dans votre tête ?
                    Vous pouvez toujours créer le vôtre dans cette section. C'est simple et rapide : en quelques clics vous pouvez parametrer la manière
                    dont les gens interagiront avec vôtre sondage.</p>
                <a href="addNewSurvey.php"><button class="ui button floated right" type="button" >Créer un sondage</button></a>
            </div>
        </section>


        <?php include ('footer.html'); ?>
    </body>
</html>
