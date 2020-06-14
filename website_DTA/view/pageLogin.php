<?php
define('__ROOT__', dirname(__DIR__));


require_once __ROOT__ . '/model/WebsiteUserManager.php';




$data = [
    "userName" => "",
    "password" => ""
];

$errorMsg = "";

if (isset($_POST["submit"])) {

    $data["userName"] = trim(htmlspecialchars($_POST["userName"]));

    if (empty($data["userName"])) {
        $errorMsg .= "Vous devez rentrer votre pseudo<br>\n";
    } else if (strlen($data["userName"]) < 2 || strlen($data["userName"]) > 50) {
        $errorMsg .= "Le champs Pseudo doit contenir entre 2 et 50 caractères, or il en contient " . strlen($data["userName"]) . "<br>\n";
    }

    $data["password"] = trim(htmlspecialchars($_POST["password"]));


    if (empty($data["password"])) {
        $errorMsg .= "Vous devez rentrer votre mot de passe<br>\n";
    } else if (strlen($data["password"]) < 8) {
        $errorMsg .= "Le champs Mot de passe doit contenir au moins 8 caractères<br>\n";
    }


    if (empty($errorMsg)) {
        
        $idUser = $userManager->authenticateUser($data["userName"], $data["password"]);

        if ($idUser > 0) {
            session_start();
            $_SESSION["idUser"] = $idUser;
            $errorMsg .= "session créée !";
            
            
            header("Location: http://localhost/Donne_2/view/index.php");
            exit();
        } else {
            $errorMsg .= "L'authentification a échouée<br>\n";
        }
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
                    <h1 class="ui header">Formulaire d'authentification DTA</h1>
                    <form class="ui form" method="POST" action="pageLogin.php">
                        <h3 class="ui dividing header">Bonjour ! Est ce que tu peux nous rafaichir la mémoire sur ton identité ?</h3>

                        <div class="field">
                            <label>Pseudo</label>
                            <input type ="text" name="userName" placeholder="Pseudo" value="<?php echo $data["userName"]; ?>" required>
                        </div>

                        <div class="field">
                            <label >Mot de passe</label>
                            <input type="password" name="password" placeholder="Mot de passe" value="" minlength="8" required>
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


