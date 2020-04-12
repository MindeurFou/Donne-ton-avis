<?php

/**
 * Description of Survey
 *
 * @author Tanguy
 */


class Survey {
    
    public const categories = array(1,2);
    
    private $idSurvey;
    private $category;
    private $title;
    private $imagePath;
    private $idAuthor;
    private $description;
    private $dateDebut;
    private $dateFin;
    private $numberParticipants;
    private $numberParticipantsMax;
    private $numberProposalMax;
    private $othersCanPropose;
    private $choices;
    
    public function __construct($idSurvey, $category, $title, $imagePath, $idAuthor, $description, $dateDebut, $dateFin, $numberParticipants, $numberParticipantsMax,$numberProposalMax, $otherCanPropose) {
        $this->idSurvey = $idSurvey;
        $this->category = $category;
        $this->imagePath = $imagePath;
        $this->idAuthor = $idAuthor;
        $this->description = $description;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->numberParticipants = $numberParticipants;
        $this->numberParticipantsMax = $numberParticipantsMax;
        $this->numberProposalMax = $numberProposalMax;
        $this->othersCanPropose = $otherCanPropose;
        $this->choices = array();
              
    }
    
    public function setIdSurvey($id){
        
        $id = (int) $id;
        
        if ($id > 0){
            $this->idSurvey = $id;
        }
    }
    
    public function setCategory($category){
    
        $category = (string) $category;
        
        if($category != ""){
            $this->category = $category;
        }
        
    }
    
    public function setImagePath($imagePath){
        
        $imagePath = (string) $imagePath;
        
        if($imagePath != ""){
            $this->imagePath = $imagePath;
        }
    }

    public function setIdAuthor($id) {
        $id = (int) $id;

        if ($id > 0) {
            $this->idAuthor = $id;
        }
    }
    
    public function setDescription($description){
        
        $description = (string) $description;
        
        if ($description != ""){
            $this->description = $description;
        }
    }

    public function setDateDebut($date){
        
        $date = (string) date;
        
        $this->dateDebut = new DateTime($date);
    }
    
    public function setDateFin($date){
        
        $date = (string) $date;
        
        $this->dateFin = new DateTime($date);
    }
    
    public function setNumberParticipants($participants){
        
        $participants = (int)$participants;
        
        $this->numberParticipants = $participants;
    }
    
    public function setNumberParticipantsMax($participantsMax){
        
        $participantsMax = (int) $participantsMax;
        
        $this->numberParticipantsMax = $participantsMax;
    }
    
    public function setOthersCanPropose($othersCanPropose) {
        
        $othersCanPropose = (boolean) $othersCanPropose;
        
        $this->othersCanPropose = $othersCanPropose;
    }
    
    public function setChoices($choices){
        
        $choices = (array) $choices;
        
        $this->choices = $choices;     
    }
    
    
}

try{
    
    $dtaDb = new PDO("mysql:host=localhost;dbname=dtadb;charset=utf8","root","");
   
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
    
$request = $dtaDb->query("select * from survey");

while($data = $request->fetch(PDO::FETCH_ASSOC)){
    
    foreach ($data as $value){
       echo ($value . "\n<br>"); 
    }
    echo '<br>';
    
}



