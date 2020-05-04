<?php

/**
 * Description of Survey
 *
 * @author Tanguy
 */

require_once 'Choice.php';

class Survey {
    
    public static $categories = array("Films","Books");
    
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
    private $numberChoiceMax;
    private $othersCanPropose;
    
    private $choices;
    private $errorMsg;
    
    private static $timeZone = "Europe/London"; 
    
    /*public function __construct($idSurvey, $category, $title, $imagePath, $idAuthor, $description, $dateDebut, $dateFin, $numberParticipants, $numberParticipantsMax,$numberProposalMax, $otherCanPropose) {
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
              
    }*/
    
    
    public function __construct(array $data){
        
        foreach ($data as $key => $value){
            
            $method = "set" . $key;
            
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
        
        $this->choices = array();
        $this->errorMsg = "";
        
    }
    
    
    public function updateClassement(){ 
        
       function comparator($choice1, $choice2){  //fonction utilisée pour comparer les nombres de vote des choix
           if ($choice1->getNumberOfVotes() == $choice2->getNumberOfVotes()){
               return 0;
           } else {
               return $choice1->getNumberOfVotes() > $choice2->getNumberOfVotes() ? -1 : 1;
           }         
       }
       
       usort($this->choices, "comparator"); 
       
       for ($i = 0; $i < count($this->choices) ; $i++){  // attribution des classements en fonction du nombre de vote
           
           if ($i == 0){ // si c'est le premier on lui donne la première place
               $this->choices[0]->setClassementPosition(1);
           }
           else if($this->choices[$i]->getNumberOfVotes() == $this->choices[$i - 1]->getNumberOfVotes() ){ // si ex-aequo, on donne le même classement que le choix précédent
               $this->choices[$i]->setClassementPosition($this->choices[$i-1]->getClassementPosition());
           } else {
               $this->choices[$i]->setClassementPosition($this->choices[$i-1]->getClassementPosition() +1); // sinon, on donne la position juste derrière celui qui le précède
           }
           
       }
    }
    
    public function setIdSurvey($val){
        
        $id = (int) $val;
        
        if ($id > 0){
            $this->idSurvey = $id;
        } else {
            $this->errorMsg .= "Error while setting idSurvey <br>\n";
        }
    }
    
    public function setCategory($category){
            
        if ($this->checkString("category", $category)){
            $this->category = $category;
        }    
    }
    
    public function setTitle($title){
        
        if($this->checkString("title", $title)){
            $this->title = $title;
        } 
    }
    
    public function setImagePath($imagePath){
        
    //rajouter une fonction de test de l'existance de l'image dans les fichiers
        if($this->checkString("imagePath", $imagePath )){
            $this->imagePath = $imagePath;
        }
    }

    public function setIdAuthor($val) {
        $id = (int) $val;

        if ($id > 0) {
            $this->idAuthor = $id;
        } else {
            $this->errorMsg .= "Error while setting idAuthor <br>\n";
        }
    }
    
    public function setDescription($description) {

        if ($this->checkString("description", $description)) {
            $this->description = $description;
        }
    }

    public function setDateDebut($date) {

        if ($this->checkString("dateDebut", $date)) {
            try {

                $this->dateDebut = new DateTime($date, new DateTimeZone(self::$timeZone));
                
            } catch (Exception $ex) {
                $this->errorMsg .= "Exception handled while setting dateDebut : ". $ex->getMessage();
            }
        }
    }
    
    public function setDateFin($date) {

        if ($this->checkString("dateFin", $date)) {
            try {

                $this->dateFin = new DateTime($date, new DateTimeZone(self::$timeZone));
                
            } catch (Exception $ex) {
                $this->errorMsg .= "Exception handled while setting dateFin : " . $ex->getMessage();
            }
        }
    }

    public function setNumberParticipants($val){
        
        $participants = (int)$val;
        
        if ($participants >= 0){
           $this->numberParticipants = $participants; 
        } else {
            $this->errorMsg .= "Error while setting numberParticipants of " . $this . ". <br>\n";
        }
        
    }
    
    public function setNumberParticipantsMax($val){
        
        $participantsMax = (int) $val;
        
        if ($participantsMax > 0 ){
            $this->numberParticipantsMax = $participantsMax;
        } else {
            $this->errorMsg .= "Error while setting numberParticipantsMax of " . $this . ". <br>\n";
        }
        
    }

    public function setNumberChoiceMax($val) {

        $numberChoiceMax = (int) $val;
        
        if ($numberChoiceMax > 0){
            $this->numberChoiceMax = $numberChoiceMax;
        } else {
            $this->errorMsg .= "Error while setting numberChoiceMax of " . $this . ". <br>\n"; 
        }
    }

    public function setOthersCanPropose($othersCanPropose) {
        
        if ($othersCanPropose == 0){
            $this->othersCanPropose = false;
        } else {
            $this->othersCanPropose = true;
        }
    }
    

    
    public function setChoices(array $choices){
        
        $this->choices = $choices;     
    }
    
    public function getIdSurvey(){
        return $this->idSurvey;
    }
    
    public function toString() {

        $stringObject = "";
        
        $stringObject .= "idSurvey = ". $this->idSurvey . "<br>\n";
        $stringObject .= "category = ". $this->category . "<br>\n";
        $stringObject .= "title = ". $this->title . "<br>\n";
        $stringObject .= "imagePath = ". $this->imagePath ."<br>\n";
        $stringObject .= "idAuthor = ".$this->idAuthor ."<br>\n";
        $stringObject .= "description = " . $this->description ."<br>\n";
        $stringObject .= "dateDebut = ". date_format($this->dateDebut, 'Y-m-d') . "<br>\n";
        $stringObject .= "dateFin = ". date_format($this->dateFin, 'Y-m-d') . "<br>\n";
        $stringObject .= "numberParticipants = ". $this->numberParticipants."<br>\n";
        $stringObject .= "numberParticpantsMax = ". $this->numberParticipantsMax. "<br>\n";
        $stringObject .= "numberChoiceMax = ". $this->numberChoiceMax. "<br>\n";
        $stringObject .= "othersCanPropose = " . ($this->othersCanPropose == true ? "true" : "false") ."<br>\n";
        $stringObject .= "choices = ";
        
        foreach($this->choices as $value){
            $stringObject .= $value->toString() . "<br>\n";
        }

        return $stringObject;
    }

    public function checkString($key, $value) {

        if(is_string($value)){
            if(!empty($value)){
                return true;
            } else {
                $this->errorMsg .= "Error while setting ".$key.", var is empty <br>\n";
                return false;
            }
            
        } else {
            $this->errorMsg .= "Error while setting ".$key.", var needs to be a string<br>\n";
            return false;
        }
        
    }
    
}


/*try {
    $dtaDb = new PDO("mysql:host=localhost;dbname=dtadb;charset=utf8", "root", "");
} catch (Exception $ex) {
}

$request = $dtaDb->query("select * from survey ");

while ($data = $request->fetch(PDO::FETCH_ASSOC)) {

    $obj = new Survey($data);

    $list[] = $obj;
    
    echo $obj;
}
*/










