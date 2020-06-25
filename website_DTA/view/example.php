<?php
define('__ROOT__', dirname(__DIR__));

require_once __ROOT__ . '/model/SurveyManager.php';
require_once __ROOT__ . '/model/WebsiteUserManager.php';

$errorMsg = "";
$idSurvey = 1;
if (!empty($_GET["idSurvey"])) {
    $idSurvey = (int) htmlspecialchars($_GET["idSurvey"]);
} else {
    $errorMsg .= "La page doit connaître le sondage à afficher...<br>\n";
}

$survey = $surveyManager->getSurveyById($idSurvey);

$choices = $surveyManager->getChoicesOfSurvey($idSurvey);
$survey->setChoices($choices);
//partie ajoutée
$surveysView = "";
$choi = $survey->getChoices();
//créaton de tables
$ttitle = [];
$votes = [];
$datap = "";
$botton="";
$i = 0;

foreach ($choi as $choice) {
    $surveysView .= "<div class='item'>\n";
    $surveysView .= "<div class='image'>\n";
    $surveysView .= "<img src=\"" . $choice->getImagePath() . "\">";
    $surveysView .= "\n</div>\n<div class='content' >\n";
    $surveysView .= "<a class='Ttl'>" . $choice->getTitle() . "</a>\n";
    $surveysView .= "<div class='description'>\n";
    $surveysView .= "<p>" . $choice->getAltDescription() . "</p>\n";
    $surveysView .= "</div>\n";
    $surveysView .= "<div class='Commentaire'>\n";
    $surveysView .= "<p>Commentaire: " . $choice->getAuthorDescription() . "</p>\n";
    $surveysView .= "</div>\n";
    $surveysView .= "</div>\n</div>\n";
    $ttitle[$i] = $choice->getTitle();
    $votes[$i] = $choice->getNumberOfVotes();
    $datap.= "{y: ".$votes[$i].", label: "."'".$ttitle[$i]."'"."},"."\n";
    $botton.=
    $i = $i + 1;
    
}
// Il faut maintenant charger ces "choices" dans la page HTML
   
?>

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
        <script>$(document).ready(function () {
                $(".rating").rating();
            });</script>

        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        
    </head>

<body>
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,

                title: {
                    text: "Classement du sondage"
                },
                axisX: {
                    interval: 1
                },
                axisY2: {
                    interlacedColor: "rgba(1,77,101,.2)",
                    gridColor: "rgba(1,77,101,.1)"

                },
                data: [{
                        type: "bar",
                        name: "companies",
                        axisYType: "secondary",
                        color: "#014D65",
                        dataPoints: [
                            <?php echo $datap?>
                        ]
                    }]
            });
            chart.render();

            };</script>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div> 
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    
</body>
</html>