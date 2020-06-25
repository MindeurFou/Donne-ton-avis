<?php

header("Content-Type:application/json");

require_once 'SurveyManager.php';

if(!empty($_GET["idSurvey"])){
    $idSurvey = htmlspecialchars($_GET["idSurvey"]);
    
    $survey = $surveyManager->getSurveyById($idSurvey);
    
    if(!empty($survey)){
        $survey->setChoices($surveyManager->getChoicesOfSurvey($idSurvey));
        
        reponse(200, "found survey", $survey);
    } else {
        reponse(200, "survey not found", NULL);
    }
    
} else {
    reponse(400, "Invalid Request", NULL);
}

function reponse($status, $status_message, $data){
    
    header("HTTP/1.1 " . $status);
       
    $reponse["status"] = $status;
    $reponse["status_message"] = $status_message;
    $reponse["data"] = $data;
    
    $json_response = json_encode($reponse);
    
    echo $json_response;
}