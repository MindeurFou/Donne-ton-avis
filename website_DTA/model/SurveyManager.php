<?php

/**
 * Description of SurveyManager
 *
 * @author Tanguy
 */

require_once 'Survey.php';


class SurveyManager {
    
    private $dtaDb;
    private $errorMsg;
    
    public function __construct($dtaDb){
        
        $this->errorMsg = "";
        
        $this->dtaDb = $dtaDb;

        
    }
    
        
    //loading without the choices related to the surveys
    public function getSurveys($startNumber, $endNumber) {
        
        try{
             $request = $this->dtaDb->query("select * from survey limit ". $startNumber. ", " .$endNumber);
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling getSurveys() : ". $ex->getMessage();
        }
       

        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {

            $obj = new Survey($data);
            
            $list[] = $obj;        
        }
        
        return $list;
    }
    
    public function getSurveyById(int $id){
        
    }
    
    public function updateChoicesOfSurvey(Survey $survey){
        
        $query = $this->dtaDb->prepare("update choice set Title = :title , AuthorDescription = :authorDescription , AltDescription = :altDescription"
                . " , numberOfVotes= :numberOfVotes , ClassementPosition = :classementPosition where IdSurvey = :idSurvey");
        
         $query->bindValue(":idSurvey", $survey->idSurvey);
         
        foreach ($survey->choices as $choice){
            
            $query->bindValue(":title", $choice->title);
            $query->bindValue(":authorDescription", $choice->authorDescription);
            $query->bindValue(":altDescription", $choice->altDescription);
            $query->bindValue(":numberOfVotes", $choice->numberOfVotes, PDO::PARAM_INT);
            $query->bindValue(":classementPosition", $choice->classementPosition, PDO::PARAM_INT);
            
            try{
                $query->execute();
            } catch (PDOException $ex) {
                $this->errorMsg .= "Exception handled while calling updateChoicesOfSurvey() : " . $ex->getMessage();
            }
            
        }  
    }
    
    public function updateOneChoice(Choice $choice) {

        $query = $this->dtaDb->prepare("update choice set Title = :title , AuthorDescription = :authorDescription , AltDescription = :altDescription"
                . " , numberOfVotes= :numberOfVotes , ClassementPosition = :classementPosition where IdChoice = :idChoice");


        $query->bindValue(":title", $choice->title);
        $query->bindValue(":authorDescription", $choice->authorDescription);
        $query->bindValue(":altDescription", $choice->altDescription);
        $query->bindValue(":numberOfVotes", $choice->numberOfVotes, PDO::PARAM_INT);
        $query->bindValue(":classementPosition", $choice->classementPosition, PDO::PARAM_INT);
        $query->bindValue(":idChoice", $choice->idChoice);
        
        try{
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling updateOneChoice() : " . $ex->getMessage();
        }
        
    }

    public function getChoicesOfSurvey($idSurvey){
        
        try{
            $request = $this->dtaDb->query("select * from choice where IdSurvey = ". $idSurvey);
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling getChoiceOfSurvey() : ". $ex->getMessage();
        }
        
        
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
        
        try{
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling addSurveyByArray() : " .$ex->getMessage();
        }
        
        
        return $this->dtaDb->query("SELECT IdSurvey FROM survey ORDER BY IdSurvey DESC LIMIT 1"); // récupère l'id de la ligne créée dans la db
        
    }
    
    public function addChoiceByArray(array $data){
        
        $query = $this->dtaDb->prepare("insert into choice (IdSurvey, Title, IdAuthor, AuthorDescription,"
                . " AltDescription) values (:idSurvey, :title, :idAuthor, :authorDescription, :altDescription)");
        
        $query->bindValue(":idSurvey", $data["idSurvey"], PDO::PARAM_INT);
        $query->bindValue(":title", $data["title"]);
        $query->bindValue(":idAuthor", $data["idAuthor"], PDO::PARAM_INT);
        $query->bindValue(":authorDescription", $data["authorDescription"]);
        $query->bindValue(":altDescription", $data["altDescription"]);
        
        try{
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling addChoiceByArray() : " .$ex->getMessage();
        }
        
        
        return $this->dtaDb->query("select IdChoice from choice order by IdChoice DESC LIMIT 1");
    }
    
}

//============== Peut-être à enlever et à écrire en début de chaque fichier le nécessitant
try {
    $dtaDb = new PDO("mysql:host=localhost;dbname=dtadb;charset=utf8", "root", "",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $ex) {
    echo ("Exception handled while  connecting to dtadb : " . $ex->getMessage());
    exit();
}

$surveyManager = new SurveyManager($dtaDb);


