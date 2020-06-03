 <?php 

define('__ROOT__', dirname(__DIR__));

require_once __ROOT__.'/model/SurveyManager.php';
require_once __ROOT__.'/model/WebsiteUserManager.php';

$errorMsg="";
$idSurvey =2;
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
    $surveysView .= "<div class=\"item\">\n";
    $surveysView .= "<div class=\"image\">\n";
    $surveysView .= "<img src=\"". $choice->getImagePath() ."\">";
    $surveysView .= "\n</div>\n<div class='content' >\n";
    $surveysView .= "<h1 class='header'>". $choice->getTitle() ."</h1>\n";
    $surveysView .= "<div class='description'>\n";
    $surveysView .= "<p>". $choice->getAuthorDescription() ."</p>\n";
    $surveysView .= "</div>\n";
    $surveysView .= "<div class='description'>\n";
    $surveysView .= "<p>". $choice->getAltDescription() ."</p>\n";
    $surveysView .= "</div>\n";
    $surveysView .= "<div> <button class='ui button'>Voter</button>";
    $surveysView .= "</div>\n";
    $surveysView .= "<div class='ui progress'>\n";
    $surveysView .= "<div class='bar'>\n<div class='progress'></div>\n";
    $surveysView .= "</div>\n</div>\n";
    $surveysView .= "</div>\n</div>\n";
}

// Il faut maintenant charger ces "choices" dans la page HTML
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
        
        <section class="sondages">

            <h1 class="ui block header"><?php echo $survey->getTitle() ?></h1>

            <div class="ui items ">          
                <?php echo $surveysView;?>
            </div>  

        </section>

        <?php include ('footer.html'); ?>
    </body>
</html>