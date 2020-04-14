<?php

/**
 * Description of SurveyManager
 *
 * @author Tanguy
 */

require_once 'Survey.php';
require_once 'WebsiteUserManager.php';

class SurveyManager {
    
    private $dtaDb;
    private $errorMsg;
    
    public function __construct($dtaDb){
        
        $this->errorMsg = "";
        
        $this->dtaDb = $dtaDb;

        
    }
    
        
    //loading without the choices related to the surveys
    public function getSurveys($startNumber, $endNumber) {
        
        $request = $this->dtaDb->query("select * from survey limit ". $startNumber. ", " .$endNumber);

        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {

            $obj = new Survey($data, $this->dtaDb);
            
            $list[] = $obj;        
        }
        
        return $list;
    }
    
    public function getChoicesOfAsurvey($idSurvey){
        
        $request = $this->dtaDb->query("select * from choice where IdSurvey = ". $idSurvey);
        
        while ($data = $request->fetch(PDO::FETCH_ASSOC)){
            
            $obj = new Choice($data);
            
            $choices[] = $obj;
        }
        
        return $choices;        
    }
    
    
    //pas d'imagePath
    public function addSurveyByArray(array $data){
        $query = $this->dtaDb->prepare("insert into survey(Category, Title, IdAuthor, Description,"
                . " DateDebut, DateFin, NumberParticipants, NumberParticipantsMax, NumberChoiceMax,"
                . "OthersCanPropose) values(:category, :title, :idAuthor, :description, :dateDebut,"
                . " :dateFin, :numberParticipants,:numberParticipantsMax,:numberChoiceMax, :othersCanPropose)");
        $query->bindValue(":category", $data["category"]);
        $query->bindValue(":title", $data["title"]);
        $query->bindValue("idAuthor", $data["idAuthor"], PDO::PARAM_INT);
        $query->bindValue(":description", $data["description"]);
        $query->bindValue(":dateDebut", $data["dateDebut"]);
        $query->bindValue(":dateFin", $data["dateFin"]);
        $query->bindValue(":numberParticipants", $data["numberParticipants"], PDO::PARAM_INT);
        $query->bindValue(":numberParticipantsMax", $data["numberParticipantsMax"], PDO::PARAM_INT);
        $query->bindValue(":numberChoiceMax", $data["numberChoiceMax"], PDO::PARAM_INT);
        $query->bindValue(":othersCanPropose", $data["othersCanPropose"], PDO::PARAM_INT);
        
        $query->execute();
    }
    
}

try {
    $dtaDb = new PDO("mysql:host=localhost;dbname=dtadb;charset=utf8", "root", "");
} catch (Exception $ex) {
    echo ("Exception handled while  connecting to dtadb : " . $ex->getMessage());
    exit();
}

$surveyManager = new SurveyManager($dtaDb);
$userManager = new WebsiteUser($dtaDb);

