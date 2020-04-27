<?php

/**
 * Description of WebsiteUserManager
 *
 * @author Tanguy
 */

require_once 'WebsiteUser.php';

class WebsiteUserManager {
    
    private $dtaDb;
    private $errorMsg;
    
    public function __construct($dtaDb) {
        
        $this->dtaDb = $dtaDb;
        $this->errorMsg = "";
    }
    
    public function addUserByArray(array $data){
        
        $query = $this->dtaDb->prepare("insert into websiteUser (Username, FirstName, Name, Age, Password) values"
                . "(:userName, :firstName, :name, :age, :password)");
        
        $query->bindValue(":userName", $data["userName"]);
        $query->bindValue(":firstName", $data["firstName"]);
        $query->bindValue(":name", $data["name"]);
        $query->bindValue(":age", $data["age"], PDO::PARAM_INT);
        $query->bindValue(":password", $data["password"]);
        
        try{
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling addUserByArray() : ".$ex;
        }
        
        
        return $this->dtaDb->query("SELECT IdUser FROM websiteUser ORDER BY IdUser DESC LIMIT 1"); // renvoie l'id de l'utilisateur créé
    }
    
   public function getUserById(int $id) {

        $query = $this->dtaDb->prepare("select * from websiteUser where IdUser = :idUser");
        $query->bindValue(":idUser", $id);

        try {
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling getUserById() : " . $ex->getMessage();
        }

        $obj = new WebsiteUser($query->fetch());

        return $obj;
    } 
   
   public function updateUser(WebsiteUser $user){
       
       $query = $this->dtaDb->prepare("update websiteUser set  Username = :userName , FirstName = :firstName , Name = :name , "
               . "Age = :age , Password = :password where IdUser = :idUser");
       
       $query->bindValue(":userName", $user->userName);
       $query->bindValue(":firstName", $user->firstName);
       $query->bindValue(":name", $user->name);
       $query->bindValue(":age", $user->age, PDO::PARAM_INT);
       $query->bindValue(":password", $user->password);
       $query->bindValue(":idUser", $user->idUser, PDO::PARAM_INT);
       
       try{
           $query->execute();
       } catch (PDOException $ex) {
           $this->errorMsg .= "Exception handled while calling updateUser() : ". $ex->getMessage();
       }
       
   }
   
    
    public function isUserNameUsed(string $userName){
        
        $query = $this->dtaDb->prepare("select * from websiteUser where UserName = :userName");
        
        $query->bindValue(":userName", $userName);
        
        try{
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling isUserNameUsed() : " . $ex->getMessage();
        }
        
        
        $res = $query->fetch();
        
        
        if (empty($res)){
            return false;
        } else {
            return true;
        }
    }
    

    
}

try {
    $dtaDb = new PDO("mysql:host=localhost;dbname=dtadb;charset=utf8", "root", "",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $ex) {
    echo ("Exception handled while  connecting to dtadb : " . $ex->getMessage());
    exit();
}

$userManager = new WebsiteUserManager($dtaDb);

/*
$user = $userManager->getUserById(6);

echo $user->toString();*/

