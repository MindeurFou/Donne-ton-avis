<?php
session_start();

define('__ROOT__', dirname(__DIR__));

require_once __ROOT__ . '/model/WebsiteUserManager.php';



$data = [
    "userName" => "",
    "firstName" => "",
    "name" => "",
    "age" => 0,
    "password" => ""
];

$passwordCopy = "";

$errorMsg = "";

if (isset($_POST["submit"])) {

    $data["userName"] = trim(htmlspecialchars($_POST["userName"]));

    if (empty($data["userName"])) {
        $errorMsg .= "Le champs Pseudo est obligatoire<br>\n";
    } else if (strlen($data["userName"]) < 2 || strlen($data["userName"]) > 50) {
        $errorMsg .= "Le champs Pseudo doit contenir entre 2 et 50 caractères, or il en contient ".strlen($data["userName"])."<br>\n";
    } else if ($userManager->isUserNameUsed($data["userName"])) {
        $errorMsg .= "Ce pseudo est déjà utilisé. Veuillez en choisir un autre<br>\n";
    }

    $data["firstName"] = trim(htmlspecialchars($_POST["firstName"]));

    if (empty($data["firstName"])) {
        $errorMsg .= "Le champs Prénom doit être rempli<br>\n";
    } else if (strlen($data["firstName"] > 100)) {
        $errorMsg .= "Le champs Prénom ne doit pas dépasser 100 caractères<br>\n";
    }

    $data["name"] = trim(htmlspecialchars($_POST["name"]));

    if (empty($data["name"])) {
        $errorMsg .= "Le champs Nom est obligatoire<br>\n";
    } else if (strlen($data["name"] > 100)) {
        $errorMsg .= "Le champs Nom ne doit pas dépasser 100 caractères<br>\n";
    }

    $data["age"] = (int) trim(htmlspecialchars($_POST["age"]));

    if (empty($data["age"])) {
        $errorMsg .= "Le champs Age est obligatoire<br>\n";
    } else if ($data["age"] <= 0) {
        $errorMsg .= "L'age rentré doit être strictement positif";
    }

    $data["password"] = trim(htmlspecialchars($_POST["password"]));
    $passwordCopy = trim(htmlspecialchars($_POST["passwordCopy"]));

    if (empty($data["password"])) {
        $errorMsg .= "Le champs Mot de passe est obligatoire<br>\n";
    } else if (strlen($data["password"]) < 8) {
        $errorMsg .= "Le champs Mot de passe doit contenir au moins 8 caractères<br>\n";
    }

    if (empty($passwordCopy)) {
        $errorMsg .= "Le champs Confirmez le mot de passe est obligatoire<br>\n";
    }

    if (strcmp($data["password"], $passwordCopy) != 0) {
        $errorMsg .= "Les mots de passe rentrés doivent correspondre<br>\n";
    }

    $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);

    if (empty($errorMsg)) {
        $idUser = $userManager->addUserByArray($data);
        $_SESSION["idUser"] = $idUser;
        header("Location: http://localhost/Donne_2/view/index.php");
    }
}

if (!isset($_POST["submit"]) || !empty($errorMsg)) {
    ?>


    <!DOCTYPE html>
    <html>
        <head>
            <title>Ajout d'un utilisateur DTA</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="semantic.min.css">
            <link href="styles.css" rel="stylesheet">
        </head>
        <body>

            <?php include "header_1.php"; ?>


            <div class="ui main text container">
                <?php
                if (!empty($errorMsg)) {
                    echo '<div class="ui red message">' . $errorMsg . '</div>';
                }
                ?>
                <div class="ui segment">     
                    <h1 class="ui header">Formulaire d'inscription DTA</h1>
                    <form class="ui form" method="POST" action="pageSignIn.php">
                        <h3 class="ui dividing header">Bienvenue chez nous ! Il ne te reste qu'à remplir ces informations et tu feras partie du groupe </h3>
                        <div class="two fields">

                            <div class="field">
                                <label>Prénom</label>
                                <input type="text" name="firstName" placeholder="Prénom" value="<?php echo $data["firstName"]; ?>" required>
                            </div>

                            <div class="field">
                                <label>Nom de famille</label>
                                <input type='text' name="name" placeholder="Nom" value ="<?php echo $data["name"]; ?>" required>
                            </div>
                        </div>

                        <div class="field">
                            <label>Pseudo</label>
                            <input type ="text" name="userName" placeholder="Pseudo" value="<?php echo $data["userName"]; ?>" required>
                        </div>

                            <div class="field">
                                <label>Age</label>
                                <input  type="number" min="1" max="100" name="age" value="<?php echo $data["age"]; ?>" >
                            </div>
                        
                        <div class="two fields">
                            <div class="field">
                                <label >Mot de passe</label>
                                <input type="password" name="password" placeholder="Mot de passe" value="" minlength="8" required>
                            </div>
                            <div class="field">
                                <label >Confirmez le mot de passe</label>
                                <input type="password" name="passwordCopy" placeholder="Mot de passe" value="" minlength="8" required>
                            </div>
                        </div>

                        <button class="ui button" type="submit" name="submit">Enregistrer</button>
                    </form>
                </div>
            </div>

            <?php include ('footer.html'); ?>



        </body>
    </html>

    <?php
}


