<?php

    $data = [
        "idSurvey" => 0,
        "category" => "",
        "title" => "",
        "imagePath" => "",
        "idAuthor" => 0,
        "description" => "",
        "dateDebut" => "",
        "dateFin" => "",
        "numberParticipants" => 0,
        "numberParticipantsMax" => 65535,
        "numberChoiceMax" => 15,
        "othersCanPropose" => false,
        "choices" => array(
            
            "idChoice" => 0,
            "idSurvey" => 0,
            "title" => "",
            "imagePath" => "",
            "idAuthor" => 0,
            "authorDescription" => "",
            "altDescription" => "",
            "numberOfVotes" => 0,
            "classementPosition" => 0
        )
    ];
       
    $surveyCategories = ["Films","Books"];

if (isset($_POST["submit"])){
    
    $data["category"] = trim(htmlspecialchars($_POST["category"]));
    $data["title"] = trim(htmlspecialchars($_POST["surveyTitle"]));
    //$data["imagePath"];
    //$data["idAuthor"] = ?;
    $data["description"] = trim(htmlspecialchars($_POST["surveyAuthorDescription"]));
    $data["dateDebut"] = date_format(new DateTime("now", new DateTimeZone("Europe/London")), "Y-m-d");
    $data["dateFin"] = htmlspecialchars($_POST["dateFin"]);
    $data["numberParticipantsMax"] = trim(htmlspecialchars($_POST["numberParticipantsMax"]));
    $data["numberChoiceMax"] = trim(htmlspecialchars($_POST["numberChoiceMax"]));
    
    if(isset($_POST["otherCanPropose"])){
        $data["otherCanPropose"] = true;
    } else {
        $data["otherCanPropose"] = false;
    }
    
    echo "vos données ont bien été enregistrées";
    
} else {
?>




<!DOCTYPE html>
<html>
    <head>
        <title>Nouveau sondage DTA</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="semantic.min.css">
        <style>
            .main.container {
                margin-top: 4em;
            }
        </style>
    </head>
    <body>

        <?php include "header.html"; ?>
        
        <div class="ui main text container">
            <div class="ui segment">     
                <h1 class="ui header">Ajout d'un nouveau sondage</h1>
                <form class="ui form" method="POST" action="addNewSurvey.php">
                    <h3 class="ui dividing header">Le sondage</h3>
                    <div class="two fields">
                        
                        <div class="field">
                            <label>Titre</label>
                            <input type="text" name="surveyTitle" placeholder="Titre" value="<?php echo $data["title"]; ?>" required>
                        </div>

                        <div class="field">
                            <label>Catégorie</label>
                            <select class="ui fluid dropdown" name="category">
                                <option value="">Catégorie</option>
                                <?php for($i = 0; $i < count($surveyCategories); $i++){
                                    echo "<option value= '" . $surveyCategories[$i] . "'>" . $surveyCategories[$i] . "</option>";
                                }?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label>Description</label>
                        <textarea name="surveyAuthorDescription" placeholder="Décrivez le but général de votre sondage, cela donnera envie aux gens d'y participer !" rows="2"><?php 
                            echo $data["description"]; ?></textarea>
                    </div>

                    <div class="two fields">
                        <div class ="field">
                            <label>Date de cloture (facultatif)</label>
                            <div class="ui calendar">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="date" name="dateFin" required>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Image associée</label>
                            <input type="file"  name="Image">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Nombre de participants maximal</label>
                            <input  type="number" min="10" max="65535" name="numberParticipantsMax"  value="1000"></input>
                        </div>
                        <div class="field">
                            <label>Nombre de choix maximal</label>
                            <input type="number" min="2" max ="20" name="numberChoiceMax" value="15"></input>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="otherCanPropose" >
                            <label>Laisser la possibilité aux utilisateurs de créer d'autres propositions pour le sondage</label>
                        </div>
                    </div>



                    <h3 class="ui dividing header">Les propositions</h3>


                    
                    <div class="ui segment">
                        <div class="field">
                            <label>Description</label>
                            <textarea name="Proposal1Description" placeholder="Décrivez la proposition" rows="1"></textarea>
                        </div>
                    </div>
                    
                     <div class="ui segment">
                        <div class="field">
                            <label>Description</label>
                            <textarea name="Proposal2Description" placeholder="Décrivez la proposition" rows="1"></textarea>
                        </div>
                    </div>


                    <button class="ui button" type="submit" name="submit">Enregistrer</button>
                </form>
            </div>
        </div>
        
        <?php include "footer.html"; ?>

        
       
    </body>
</html>

<?php }