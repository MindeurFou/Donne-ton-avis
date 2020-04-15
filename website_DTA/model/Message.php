<?php

/**
 * Description of Message
 *
 * @author Tanguy
 */
class Message {
    
    private $idMessage;
    private $idSurvey;
    private $idAuthor;
    private $textMessage;
    
    private $errorMsg;
    
    public function __construct(array $data) {
        
        
        foreach($data as $key => $value){
            $method = "set".$key;
            
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
        
        $this->errorMsg = "";
    }
    
    public function setIdMessage(int $id){
        
        if($id > 0){
            $this->idMessage = $id;
        } else {
            $this->errorMsg .= "L'idMessage rentré doit être strictement positif"; 
        }
    }
    
    public function setIdSurvey(int $id){
        
        if($id > 0){
            $this->idSurvey = $id;
        } else {
            $this->errorMsg .= "L'idSurvey rentré doit être strictement positif"; 
        }
    }
    
    public function setIdAuthor(int $id){
        
        if($id > 0){
            $this->idAuthor = $id;
        } else {
            $this->errorMsg .= "L'idAuthor rentré doit être strictement positif"; 
        }
    }
    
    public function setTextMessage(string $message){
        
        if(empty($message)){
            $this->errorMsg .= "Le message rentré est vide";
        } else {
            $this->textMessage = $message;
        }
    }
    
    public function toString(){
        
        $stringObject = "";
        
        foreach($this as $key => $value){
            $stringObject .= $key." : ".$value."<br>\n";
        }
        
        return $stringObject;
    }
    
    
}
