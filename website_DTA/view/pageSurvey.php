<?php 

define('__ROOT__', dirname(__DIR__));

require_once __ROOT__.'/model/SurveyManager.php';
require_once __ROOT__.'/model/WebsiteUserManager.php';

$errorMsg="";
//$idSurvey =1;
if(!empty($_GET["idSurvey"])){
    $idSurvey = (int) htmlspecialchars($_GET["idSurvey"]);
} else {
    $errorMsg .= "La page doit connaître le sondage à afficher...<br>\n";
}

$survey = $surveyManager->getSurveyById($idSurvey);

$choices = $surveyManager->getChoicesOfSurvey($idSurvey);
$survey->setChoices($choices);
//partie ajoutée
$surveysView = "";
$choi= $survey->getChoices();
foreach ( $choi as $choice){
    $surveysView .= "<div class='item'>\n";
    $surveysView .= "<div class='image'>\n";
    $surveysView .= "<img src=\"". $choice->getImagePath() ."\">";
    $surveysView .= "\n</div>\n<div class='content' >\n";
    $surveysView .= "<a class='Ttl'>". $choice->getTitle() ."</a>\n";
    $surveysView .= "<div class='description'>\n";
    $surveysView .= "<p>". $choice->getAltDescription() ."</p>\n";
    $surveysView .= "</div>\n";
    $surveysView .= "<div class='Commentaire'>\n";
    $surveysView .= "<p>Commentaire: ". $choice->getAuthorDescription() ."</p>\n";
    $surveysView .= "</div>\n";
    $surveysView .= "</div>\n</div>\n";
}
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
        
        <?php include "header_1.php"; ?>
        <section class="sondages">

            <h1 class="participer"><?php echo $survey->getTitle() ?></h1>

            <div class="ui items ">          
                <?php echo $surveysView;?>
            </div>  

        </section>
        
        
        <?php include "footer.html"; ?>
      
        
        
    </body>
</html>


