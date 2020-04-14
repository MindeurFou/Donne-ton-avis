<?php

/**
 * Description of WebsiteUserManager
 *
 * @author Tanguy
 */

require_once 'WebsiteUser.php';

class WebsiteUserManager {
    
    private $dtaDb;
    
    public function __construct($dtaDb) {
        
        $this->dtaDb = $dtaDb;
    }
    
    public function checkIfUserExist($idUser){
        $query = $this->dtaDb->query("select * from websiteUser where IdUser = ". $idUser);
        
        if (!empty($query)){
            return true;
        } else {
            return false;
        }
    }
    
}
