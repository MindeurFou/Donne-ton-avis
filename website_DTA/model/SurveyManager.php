<?php

/**
 * Description of SurveyManager
 *
 * @author Tanguy
 */



require_once 'Survey.php';

class SurveyManager {

    private $dtaDb;
    private $errorMsg;

    public function __construct($dtaDb) {

        $this->errorMsg = "";

        $this->dtaDb = $dtaDb;
    }
    
    //loading without the choices related to the surveys
    public function getSurveys($startNumber, $endNumber) {

        try {
            $request = $this->dtaDb->query("select * from survey limit " . $startNumber . ", " . $endNumber);
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling getSurveys() : " . $ex->getMessage();
        }

        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {

            $obj = new Survey($data);

            $list[] = $obj;
        }

        return $list;
    }

    public function getSurveyById(int $id) {

        $query = $this->dtaDb->prepare("select * from survey where IdSurvey = :idSurvey");
        $query->bindValue(":idSurvey", $id);

        try {
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling getSurveyById() : " . $ex->getMessage();
        }

        $obj = new Survey($query->fetch());

        return $obj;
    }
    
    public function updateSurvey(Survey $survey) {
        
        $query = $this->dtaDb->prepare("update survey set Category = :category, Title = :title, ImagePath = :imagePath, IdAuthor = :idAuthor, "
                . "Description = :description, dateDebut = :dateDebut,  DateFin = :dateFin, NumberParticipants = :numberParticipants, "
                . "NumberParticipantsMax= :numberParticipantsMax, NumberChoiceMax =:numberChoiceMax, OthersCanPropose = :othersCanPropose where IdSurvey= :idSurvey");
        
        $query->bindValue(":idSurvey", $survey->idSurvey, PDO::PARAM_INT);
        $query->bindValue(":category", $survey->category);
        $query->bindValue(":title", $survey->title);
        $query->bindValue(":imagePath", $survey->imagePath);
        $query->bindValue(":idAuthor", $survey->idAuthor);
        $query->bindValue(":description", $survey->description);
        $query->bindValue(":dateDebut", $survey->dateDebut->format('Y-m-d'));
        $query->bindValue(":dateFin", $survey->dateFin->format('Y-m-d'));
        $query->bindValue(":numberParticipants", $survey->numberParticipants, PDO::PARAM_INT);
        $query->bindValue(":numberParticipantsMax", $survey->numberParticipantsMax, PDO::PARAM_INT);
        $query->bindValue(":numberChoiceMax", $survey->numberChoiceMax, PDO::PARAM_INT);
        $query->bindValue(":othersCanPropose", $survey->othersCanPropose, PDO::PARAM_INT);
        
        try{
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling updeSurvey() : ". $ex->getMessage();
        }
        
    }

    public function updateChoicesOfSurvey(Survey $survey) {

        $query = $this->dtaDb->prepare("update choice set Title = :title , AuthorDescription = :authorDescription , AltDescription = :altDescription"
                . " , numberOfVotes= :numberOfVotes , ClassementPosition = :classementPosition where IdSurvey = :idSurvey");

        $query->bindValue(":idSurvey", $survey->idSurvey);

        foreach ($survey->choices as $choice) {

            $query->bindValue(":title", $choice->title);
            $query->bindValue(":authorDescription", $choice->authorDescription);
            $query->bindValue(":altDescription", $choice->altDescription);
            $query->bindValue(":numberOfVotes", $choice->numberOfVotes, PDO::PARAM_INT);
            $query->bindValue(":classementPosition", $choice->classementPosition, PDO::PARAM_INT);

            try {
                $query->execute();
            } catch (PDOException $ex) {
                $this->errorMsg .= "Exception handled while calling updateChoicesOfSurvey() : " . $ex->getMessage();
            }
        }
    }

    public function updateOneChoice(Choice $choice) {

        $query = $this->dtaDb->prepare("update choice set Title = :title , AuthorDescription = :authorDescription , AltDescription = :altDescription"
                . " , numberOfVotes= :numberOfVotes , ClassementPosition = :classementPosition where IdChoice = :idChoice");


        $query->bindValue(":title", $choice->title);
        $query->bindValue(":authorDescription", $choice->authorDescription);
        $query->bindValue(":altDescription", $choice->altDescription);
        $query->bindValue(":numberOfVotes", $choice->numberOfVotes, PDO::PARAM_INT);
        $query->bindValue(":classementPosition", $choice->classementPosition, PDO::PARAM_INT);
        $query->bindValue(":idChoice", $choice->idChoice);

        try {
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling updateOneChoice() : " . $ex->getMessage();
        }
    }
    
    
    /**
     *  
     * @param int $idSurvey the id of the survey of which you want to get the choices associated
     * @return \Choice an array of choices
     */
    public function getChoicesOfSurvey(int $idSurvey) {

        try {
            $request = $this->dtaDb->query("select * from choice where IdSurvey = " . $idSurvey);
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling getChoiceOfSurvey() : " . $ex->getMessage();
        }


        while ($data = $request->fetch(PDO::FETCH_ASSOC)) {

            $obj = new Choice($data);

            $choices[] = $obj;
        }

        return $choices;
    }

    /**
     *  Save in the database a survey
     * @param array $data the associative array matching columns of the survey table
     * @return int the id of the survey you have created
     */
    public function addSurveyByArray(array $data) {
        $query = $this->dtaDb->prepare("insert into survey(Category, Title, ImagePath, IdAuthor, Description,"
                . " DateDebut, DateFin, NumberParticipants, NumberParticipantsMax, NumberChoiceMax,"
                . "OthersCanPropose) values(:category, :title, :imagePath, :idAuthor, :description, :dateDebut,"
                . " :dateFin, :numberParticipants,:numberParticipantsMax,:numberChoiceMax, :othersCanPropose)");
        $query->bindValue(":category", $data["category"]);
        $query->bindValue(":title", $data["title"]);
        $query->bindValue(":imagePath", $data["imagePath"]);
        $query->bindValue("idAuthor", $data["idAuthor"], PDO::PARAM_INT);
        $query->bindValue(":description", $data["description"]);
        $query->bindValue(":dateDebut", $data["dateDebut"]);
        $query->bindValue(":dateFin", $data["dateFin"]);
        $query->bindValue(":numberParticipants", $data["numberParticipants"], PDO::PARAM_INT);
        $query->bindValue(":numberParticipantsMax", $data["numberParticipantsMax"], PDO::PARAM_INT);
        $query->bindValue(":numberChoiceMax", $data["numberChoiceMax"], PDO::PARAM_INT);
        $query->bindValue(":othersCanPropose", $data["othersCanPropose"], PDO::PARAM_INT);
        try {
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling addSurveyByArray() : " . $ex->getMessage();
        }
        return $this->dtaDb->query("SELECT IdSurvey FROM survey ORDER BY IdSurvey DESC LIMIT 1"); // récupère l'id de la ligne créée dans la db
    }
    
    /**
     *  Save in the database a choice
     * @param array $data he associative array matching columns of the choice table
     * @return int the id of the choice you have created
     */
    public function addChoiceByArray(array $data) {

        $query = $this->dtaDb->prepare("insert into choice (IdSurvey, Title, IdAuthor, AuthorDescription,"
                . " AltDescription) values (:idSurvey, :title, :idAuthor, :authorDescription, :altDescription)");

        $query->bindValue(":idSurvey", $data["idSurvey"], PDO::PARAM_INT);
        $query->bindValue(":title", $data["title"]);
        $query->bindValue(":idAuthor", $data["idAuthor"], PDO::PARAM_INT);
        $query->bindValue(":authorDescription", $data["authorDescription"]);
        $query->bindValue(":altDescription", $data["altDescription"]);

        try {
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling addChoiceByArray() : " . $ex->getMessage();
        }


        return $this->dtaDb->query("select IdChoice from choice order by IdChoice DESC LIMIT 1");
    }
    
    
    /**
     *  Check wether the input title is already used in the database
     * @param string $title the title to search
     * @return boolean true if the title already exists, false if not
     */
    public function isTitleUsed(string $title) {

        $query = $this->dtaDb->prepare("select * from survey where Title = :title");

        $query->bindValue(":title", $title);

        try {
            $query->execute();
        } catch (PDOException $ex) {
            $this->errorMsg .= "Exception handled while calling isTitleUsed() : " . $ex->getMessage();
        }

        $res = $query->fetch();


        if (empty($res)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     *  Search for surveys in database without any specified image
     * 
     * @return \Survey an array of surveys
     */
    public function findUnfilledSurveys() {

        $query = $this->dtaDb->query("select * from survey where ImagePath = null");

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {

            $obj = new Survey($data);

            $surveys[] = $obj;
        }

        return $surveys;
    }

    
    /**
     *  Search in the database for surveys containing Choices uncompleted : no image specified or no altDescription
     * 
     * @return \Survey an array of surveys
     */
    public function findSurveysWithUnfilledChoices() {

        //récupère les surveys associés à des choices pas entièrement remplis
        $query = $this->dtaDb->query("SELECT s.* FROM survey s INNER JOIN choice c ON c.IdSurvey = s.IdSurvey WHERE c.ImagePath is null OR c.AltDescription is nulll");

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $surveys[] = new Survey($data);
        }


        //chargement des choix qui sont incomplets et affectation aux surveys associés
        foreach ($surveys as $survey) {

            $query = $this->dtaDb->query("select * from choice where IdSurvey = " . $survey . getIdSurvey() . " and ImagePath is null OR AltDescription is null");

            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $choices[] = new Choice($data);
            }

            $survey->setChoices($choices);
        }

        return $surveys;
    }
    
    /**
     * 
     * @param string $title the title you choose to name your file. Keep the same pattern as all existing images in project
     * @param string $name value of the attribute "name" in the HTML form
     * 
     * @return string|null a string corresponding to the realtive path of the image, or null if there wasn't any image
     */
    public static function uploadImage(string $title, string $name) {

        if (is_uploaded_file($_FILES[$name]["tmp_name"])) {

            $fileExtension = pathinfo($_FILES[$name]["name"])["extension"];
            $extensionsAllowed = array("jpeg", "jpg", "png");

            if (in_array($fileExtension, $extensionsAllowed)) {
                
                $imagePath = __ROOT__ . "/images/" . $title . "." . $fileExtension;

                if (move_uploaded_file($_FILES[$name]["tmp_name"], $imagePath)){

                    $pos = strpos($imagePath, "\website_DTA"); // enlève la partie absolue du chemin
                    $imagePath = substr($imagePath, $pos);

                    return $imagePath;
                }
            }
            
        } else {
            return null;
        }
        
    }

}

//============== Peut-être à enlever et à écrire en début de chaque fichier le nécessitant
try {
    $dtaDb = new PDO("mysql:host=localhost;dbname=dtadb;charset=utf8", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $ex) {
    echo ("Exception handled while  connecting to dtadb : " . $ex->getMessage());
    exit();
}

$surveyManager = new SurveyManager($dtaDb);


