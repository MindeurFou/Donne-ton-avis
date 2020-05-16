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

        foreach ($data as $key => $value) {

            $method = "set" . $key;

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    
    public function getIdUser(){
        return $this->idUser;
    }
    
    
    public function getUserName(){
        return $this->userName;
    }

    public function setIdUser($val) {

        $id = (int) $val;

        if ($id <= 0) {
            $this->errorMsg = "Un id doit être strictement positif";
        } else {
            $this->idUser = $id;
        }
    }

    public function setUserName(string $name) {

        if ($this->checkString("userName", $name)) {
            $this->userName = $name;
        }
    }

    public function setFirstName(string $firstName) {

        if ($this->checkString("firstName", $firstName)) {
            $this->firstName = $firstName;
        }
    }

    public function setName(string $name) {

        if ($this->checkString("name", $name)) {
            $this->name = $name;
        }
    }

    public function setAge($val) {

        $age = (int) $val;

        if ($age > 0) {
            $this->age = $age;
        }
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function checkString($key, $value) {

        if (is_string($value)) {
            if (!empty($value)) {
                return true;
            } else {
                $this->errorMsg .= "Erreur en essayant de mettre à jour  " . $key . ", la variable est vide<br>\n";
                return false;
            }
        } else {
            $this->errorMsg .= "Erreur en essayant de mettre à jour   " . $key . ", la variable doit être un string<br>\n";
            return false;
        }
    }

    public function toString() {

        $stringObject = "";

        foreach ($this as $key => $value) {
            $stringObject .= $key . " : " . $value . "<br>\n";
        }

        return $stringObject;
    }

}
