<?php

/**
 * Description of WebsiteUser
 *
 * @author Tanguy
 */
class WebsiteUser {
    
    private $idUser;
    private $userName;
    private $firstName;
    private $name;
    private $age;
    private $password;
    
    private $errorMsg;
    
    public function __construct(array $data) {
        
        foreach ($data as $key => $value){
            
            $method = "set".$key;
            
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
    
    public function setIdUser($val){
        
        $id = (int) $val;
        
        if ($userManager->checkIfUserExist($id)){
            $this->errorMsg .= "Un utilisateur a déjà cet id";
        } else if ($id <= 0){
            $this->errorMsg = "Un id doit être strictement positif";
        } else {
            $this->idUser = $id;
        }
    }

    public function setUserName(string $name){
        
        if(empty($name)){
            $this->errorMsg .= "Le pseudo rentré est vide";
        } else {
            $this->userName = $name;
        }
    }
    
    public function setFirstName(string $firstName){
        
        if (empty($firstName)){
            $this->errorMsg .= "Le prénom rentré est vide";
        } else {
            $this->firstName = $firstName;
        }
    }
    
    public function setName(string $name){
        
        if(empty($name)){
            $this->errorMsg .= "Le nom rentré est vide";
        } else {
            $this->name = $name;
        }
    }
}
