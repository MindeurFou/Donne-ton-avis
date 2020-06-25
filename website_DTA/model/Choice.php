<?php

/**
 * Description of Choice
 *
 * @author Tanguy
 */

class Choice {
    
    private $idChoice;
    private $idSurvey;
    private $title;
    private $imagePath;
    private $idAuthor;
    private $authorDescription;
    private $altDescription;
    private $numberOfVotes;
    private $classementPosition;
    
    private $errorMsg;
    
    
    public function __construct(array $data) {
        
        foreach($data as $key => $value){
            
            $method = "set".$key;
            
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
    
    public function addAVote(){
        $this->numberOfVotes++;
    }
    
    public function setIdChoice($val){
        
        $id = (int) $val;
        
        if ($id > 0){
            $this->idChoice = $id;
        } else {
            $this->errorMsg .= "Error while setting idChoice. <br>\n";
        }
    }
    
    public function setIdSurvey($val) {
        
        $id = (int) $val;
        
        if ($id > 0){
            $this->idSurvey = $id;
        } else {
            $this->errorMsg = "Error while setting idSurvey. <br>\n";
        }
    }
    
    public function setTitle($title){
        
        if($this->checkString("title", $title)){
            $this->title = $title;
        }
    }

    public function setImagePath($imagePath) {

        if ($this->checkString("imagePath", $imagePath)) {
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
    
    public function setAuthorDescription($authorDescription) {
        
        if($this->checkString("authorDescription", $authorDescription )){
            $this->authorDescription = $authorDescription;
        }
    }
    
    public function setAltDescription ($altDescription){
        
        if($this->checkString("altDescription", $altDescription)){
            $this->altDescription = $altDescription;
        }
    }
    
    public function setNumberOfVotes($val){
        
        $numberOfVotes = (int) $val;
        
        if ($numberOfVotes >= 0){
            $this->numberOfVotes = $numberOfVotes;
        }
    }
    
    
    public function setClassementPosition($val){
        
       $classementPosition = (int) $val;
       
       if($classementPosition >= 0){
           $this->classementPosition = $classementPosition;
       }
    }
    
    
    public function getNumberOfVotes(){
        return $this->numberOfVotes;
    }
    
    
    public function getClassementPosition(){
        return $this->classementPosition;
    }
    
    
    public function getIdSurvey(){
        return $this->idSurvey;
    }
    
    
    public function getImagePath(){
        return $this->imagePath;
    }
    
    
    public function getTitle(){
        return $this->title;
    }
    
    
    public function getAuthorDescription(){
        return $this->authorDescription;
    }
    
    public function getAltDescription(){
        return $this->altDescription;
    }
    
   
    public function toString(){
        
        $stringObj = "";
        
        foreach ($this as $key => $value){
            $stringObj .= $key ." : " . $value . "<br>\n";
        }
        
        return $stringObj;
    }
    

    private function checkString($key, $value) {

        if(is_string($value)){
            if($value != ""){
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
