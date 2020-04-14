<?php

/**
 * Description of Surveys
 *
 * @author Tanguy
 */

require_once 'Survey.php';

class Surveys {
    
    private $list;
    private $dtaDb;
    private $errorMsg;
    
    public function __construct() {
        $this->list = array();
        $this->errorMsg = "";
        
        try{
            $this->dtaDb = new PDO("mysql:host=localhost;dbname=dtadb;charset=utf8","root","");
        } catch (Exception $ex) {
            $this->errorMsg .=  "Exception handled while  connecting to dtadb : " . $ex->getMessage();
        }
        
    }
    
    
    public function addToList(Survey $survey){
        $this->list[] = $survey;
    }
    
    

    public function getDtaDb() {
        return $this->dtaDb;
    }
    
    public function getList(){
        return $this->list;
    }

}

$surveys = new Surveys();

$surveys->loadSurveys(0, 2);

foreach($surveys->getList() as $survey){
    $survey->loadChoices();
    echo $survey->toString() ."<br><br>";
}
