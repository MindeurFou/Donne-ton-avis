<?php
define('__ROOT__', dirname(__DIR__));

include __ROOT__ . '/model/authentication.php';

require_once __ROOT__ . '/model/SurveyManager.php';

$data = [
    "category" => "",
    "title" => "",
    "imagePath" => "",
    "idAuthor" => 0,
    "description" => "",
    "dateDebut" => "",
    "dateFin" => "",
    "numberParticipants" => 0,
    "numberParticipantsMax" => 10000,
    "numberChoiceMax" => 15,
    "othersCanPropose" => 0
];

$choices = array(
    array(
        "idSurvey" => 0,
        "title" => "",
        "imagePath" => "",
        "idAuthor" => 0,
        "authorDescription" => "",
        "altDescription" => "",
        "numberOfVotes" => 0,
        "classementPosition" => 0
    ),
    array(
        "idSurvey" => 0,
        "title" => "",
        "imagePath" => "",
        "idAuthor" => 0,
        "authorDescription" => "",
        "altDescription" => "",
        "numberOfVotes" => 0,
        "classementPosition" => 0
    ),
    array(
        "idSurvey" => 0,
        "title" => "",
        "imagePath" => "",
        "idAuthor" => 0,
        "authorDescription" => "",
        "altDescription" => "",
        "numberOfVotes" => 0,
        "classementPosition" => 0
    ),
    array(
        "idSurvey" => 0,
        "title" => "",
        "imagePath" => "",
        "idAuthor" => 0,
        "authorDescription" => "",
        "altDescription" => "",
        "numberOfVotes" => 0,
        "classementPosition" => 0
    ),
     array(
        "idSurvey" => 0,
        "title" => "",
        "imagePath" => "",
        "idAuthor" => 0,
        "authorDescription" => "",
        "altDescription" => "",
        "numberOfVotes" => 0,
        "classementPosition" => 0
    )
);

$errorMsg = "";


if (isset($_POST["submit"])) {


    $data["category"] = trim(htmlspecialchars($_POST["category"]));

    if (empty($data["category"])) {
        $errorMsg .= "Le champs Catégorie est obligatoire<br>\n";
    }


    $data["title"] = trim(htmlspecialchars($_POST["surveyTitle"]));

    if (empty($data["title"])) {
        $errorMsg .= "Le champs titre est obligatoire<br>\n";
    } else if (strlen($data["title"]) < 2 || strlen($data["title"]) > 100) {
        $errorMsg .= "Le champs titre doit contenir entre 2 et 100 caractères<br>\n";
    }

    if ($surveyManager->isTitleUsed($data["title"])) {
        $errorMsg .= "Le titre existe déjà :( Veuillez en choisir un autre svp<br>\n";
    }

    $data["imagePath"] = SurveyManager::uploadImage($data["title"], "image");

    $data["idAuthor"] = $user->getIdUser();


    $data["description"] = trim(htmlspecialchars($_POST["surveyAuthorDescription"]));

    if (empty($data["description"])) {
        $errorMsg .= "Le champs Description est obligatoire<br>\n";
    } else if (strlen($data["description"]) < 10) {
        $errorMsg .= "Le champs Description rentré est trop court<br>\n";
    }


    $data["dateDebut"] = date_format(new DateTime("now", new DateTimeZone("Europe/London")), "Y-m-d");

    $data["dateFin"] = trim(htmlspecialchars($_POST["dateFin"]));


    $data["numberParticipantsMax"] = (int) trim(htmlspecialchars($_POST["numberParticipantsMax"]));

    if ($data["numberParticipantsMax"] > 32767 || $data["numberParticipantsMax"] < 10) {
        $errorMsg .= "Le nombre de participants max du sondage doit être entre 10 et 32767";
    }

    $data["numberChoiceMax"] = (int) trim(htmlspecialchars($_POST["numberChoiceMax"]));

    if (isset($_POST["othersCanPropose"])) {
        $data["othersCanPropose"] = 1;
    } else {
        $data["othersCanPropose"] = 0;
    }

    //management of the choices :


    for ($i = 0; $i < 4; $i++) {

        $choice["title"] = trim(htmlspecialchars($_POST["choiceTitle" . $i]));

        if (empty($data["title"])) {
            $errorMsg .= "Le champs titre est obligatoire<br>\n";
        } else if (strlen($data["title"]) < 2 || strlen($data["title"]) > 100) {
            $errorMsg .= "Le champs titre doit contenir entre 2 et 100 caractères<br>\n";
        }

        $choice["imagePath"] = SurveyManager::uploadImage($choice["title"], "image" . $i);

        $choice["idAuthor"] = $user->getIdUser();

        $choice["authorDescription"] = trim(htmlspecialchars($_POST["choiceAuthorDescription" . $i]));

        if (empty($choice["authorDescription"])) {
            $errorMsg .= "Le champs Description est obligatoire<br>\n";
        } else if (strlen($choice["authorDescription"]) < 10) {
            $errorMsg .= "Le champs Description rentré est trop court<br>\n";
        }

        $choices[] = $choice;
    }


    //si tout s'est bien passé, on ajoute le sondage dans la base de données et on retourne sur la page d'index
    if (empty($errorMsg)) {
        $idSurvey = $surveyManager->addSurveyByArray($data);

        foreach ($choices as $choice) {
            $choice["idSurvey"] = $idSurvey;
            $surveyManager->addChoiceByArray($choice);
        }

        header("Location: http://localhost/website_DTA/view/index.php");
    }
}

if (!isset($_POST["submit"]) || !empty($errorMsg)) {
    ?>


    <!DOCTYPE html>
    <html>
        <head>
            <title>Nouveau sondage DTA</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="semantic.min.css">
            <link href="styles.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <!-- Il faut ajouter les libraries de jquery-->
            <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
            <script src="semantic.min.js" type="text/javascript"></script>
            
        </head>
        <body>

            <?php include "header_2.php"; ?>



            <div class="ui main text container">
                <?php
                if (!empty($errorMsg)) {
                    echo '<div class="ui red message">' . $errorMsg . '</div>';
                }
                ?>
                <div class="ui segment">     
                    <h1 class="ui header">Ajout d'un nouveau sondage</h1>
                    <form class="ui form" enctype="multipart/form-data" method="POST" action="addNewSurvey.php">
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
                                    <?php
                                    foreach (Survey::$categories as $value) {
                                        echo "<option value= '" . $value . "'>" . $value . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="field">
                            <label>Description</label>
                            <textarea name="surveyAuthorDescription" placeholder="Décrivez le but général de votre sondage, cela donnera envie aux gens d'y participer !" rows="2" required><?php echo $data["description"]; ?></textarea>
                        </div>

                        <div class="two fields">
                            <div class ="field">
                                <label>Date de cloture (facultatif)</label>
                                <div class="ui calendar">
                                    <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="date" name="dateFin">
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label>Image associée</label>
                                <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                                <input type="file"  name="image">
                            </div>
                        </div>
                        <div class="two fields">
                            <div class="field">
                                <label>Nombre de participants maximal</label>
                                <input  type="number" min="10" max="32767" name="numberParticipantsMax"  value="10000">
                            </div>
                            <div class="field">
                                <label>Nombre de choix maximal</label>
                                <input type="number" min="2" max ="20" name="numberChoiceMax" value="15">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="othersCanPropose" value="" >
                                <label>Laisser la possibilité aux utilisateurs de créer d'autres propositions pour le sondage</label>
                            </div>
                        </div>



                        <h3 class="ui dividing header">Les propositions</h3>

                        <div class="ui top attached tabular menu">
                            <a class="active item" data-tab="first">1</a>
                            <a class="item" data-tab="second">2</a>
                            <a class="item" data-tab="three">3</a>
                            <a class="item" data-tab="four">4</a>
                            <a class="item" data-tab="five">5</a>
                        </div>

                        <div class="ui bottom attached active tab segment" data-tab="first">

                            <div class="two fields">
                                <div class ="field">
                                    <label>Titre</label>
                                    <input type="text" name="choiceTitle0" placeholder="Titre" value="<?php echo $choices[0]["title"]; ?>" required>
                                </div>

                                <div class="field">
                                    <label>Image associée</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                                    <input type="file"  name="image0">
                                </div>
                            </div>

                            <div class="field">
                                <label>Description</label>
                                <textarea name="choiceAuthorDescription0" placeholder="Décrivez votre proposition aux autres utilisateurs !" rows="2" required><?php echo $choices[0]["authorDescription"]; ?></textarea>
                            </div>

                        </div>

                        <div class="ui bottom attached tab segment" data-tab="second">
                            <div class="two fields">
                                <div class ="field">
                                    <label>Titre</label>
                                    <input type="text" name="choiceTitle1" placeholder="Titre" value="<?php echo $choices[1]["title"]; ?>" required>
                                </div>

                                <div class="field">
                                    <label>Image associée</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                                    <input type="file"  name="image1">
                                </div>
                            </div>

                            <div class="field">
                                <label>Description</label>
                                <textarea name="choiceAuthorDescription1" placeholder="Décrivez votre proposition aux autres utilisateurs !" rows="2" required><?php echo $choices[1]["authorDescription"]; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="ui bottom attached active tab segment" data-tab="three">

                            <div class="two fields">
                                <div class ="field">
                                    <label>Titre</label>
                                    <input type="text" name="choiceTitle0" placeholder="Titre" value="<?php echo $choices[2]["title"]; ?>">
                                </div>

                                <div class="field">
                                    <label>Image associée</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                                    <input type="file"  name="image0">
                                </div>
                            </div>

                            <div class="field">
                                <label>Description</label>
                                <textarea name="choiceAuthorDescription0" placeholder="Décrivez votre proposition aux autres utilisateurs !" rows="2"><?php echo $choices[2]["authorDescription"]; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="ui bottom attached active tab segment" data-tab="four">

                            <div class="two fields">
                                <div class ="field">
                                    <label>Titre</label>
                                    <input type="text" name="choiceTitle0" placeholder="Titre" value="<?php echo $choices[3]["title"]; ?>">
                                </div>

                                <div class="field">
                                    <label>Image associée</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                                    <input type="file"  name="image0">
                                </div>
                            </div>

                            <div class="field">
                                <label>Description</label>
                                <textarea name="choiceAuthorDescription0" placeholder="Décrivez votre proposition aux autres utilisateurs !" rows="2"><?php echo $choices[3]["authorDescription"]; ?></textarea>
                            </div>


                        </div>
                        
                        <div class="ui bottom attached active tab segment" data-tab="five">

                            <div class="two fields">
                                <div class ="field">
                                    <label>Titre</label>
                                    <input type="text" name="choiceTitle0" placeholder="Titre" value="<?php echo $choices[4]["title"]; ?>">
                                </div>

                                <div class="field">
                                    <label>Image associée</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                                    <input type="file"  name="image0">
                                </div>
                            </div>

                            <div class="field">
                                <label>Description</label>
                                <textarea name="choiceAuthorDescription0" placeholder="Décrivez votre proposition aux autres utilisateurs !" rows="2"><?php echo $choices[4]["authorDescription"]; ?></textarea>
                            </div>
                        </div>
                        
                        <button class="ui button" type="submit" name="submit">Enregistrer</button>
                    </form>
                </div>
            </div>

            <?php include "footer.html"; ?>
            
            <script>$('.tabular.menu .item').tab({history: false});</script>

        </body>
        
        
    </html>

    <?php
}
