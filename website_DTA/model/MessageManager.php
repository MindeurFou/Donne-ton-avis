<?php

/**
 * Description of MessageManager
 *
 * @author Tanguy
 */
class MessageManager {
    
    private $dtaDb;
    private $errorMsg;
    
    public function __construct($dtaDb) {
        
        $this->dtaDb = $dtaDb;
        $this->errorMsg = "";
    }
    
    public function addMessage(array $message) {

        $query = $this->dtaDb->prepare("insert into message (IdSurvey, IdAuthor, MessageText) values (:idSurvey, :idAuthor, :messageText");

        $query->bindValue(":idSurvey", $message["idSurvey"], PDO::PARAM_INT);
        $query->bindValue(":idAuthor", $message["idAuthor"], PDO::PARAM_INT);
        $query->bindValue(":messageText", $message["textMessage"]);

        try {
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling addMessage() : " . $ex->getMessage();
        }

        return $this->dtaDb->query("select IdMessage from message order by IdMessage DESC LIMIT 1");
    }

    public function getMessagesOfSurvey(int $idSurvey) {

        $query = $this->dtaDb->prepare("select * from message where IdSurvey = :idSurvey");
        $query->bindValue(":idSurvey", $idSurvey, PDO::PARAM_INT);

        try {
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling getMessageOfSurvey() : " . $ex->getMessage();
        }

        $messages = array();

        while ($data = $query->fetch()) {

            $message = new Message($data);

            $messages[] = $message;
        }

        return $messages;
    }

}

try {
    $dtaDb = new PDO("mysql:host=localhost;dbname=dtadb;charset=utf8", "root", "",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $ex) {
    echo ("Exception handled while  connecting to dtadb : " . $ex->getMessage());
    exit();
}

$messageManager = new MessageManager($dtaDb);