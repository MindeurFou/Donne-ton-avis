<?php

    $affichage = "";
    $errormsg = "";
    
    $surveyTitle = "";
    $surveyCategory = "";
    $surveyDescription = "";
    $startingDate = "";
    $endingDate = "";
    $numberParticipantsMax = 65535;
    $nulberProposalMax = 15;
    $otherCanPropose = false;
    
    
    
    
    $surveyCategories = ["Films","Books"];


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
        <header>

            <div class="ui menu">
                <div class="header item">DONNE TON AVIS</div>
                <a class="item">Catégories</a>
                <a class="item">Histoire du site</a>
                <a class="item">Contact</a>
            </div>
        </header>
        <div class="ui main text container">
            <div class="ui segment">     
                <h1 class="ui header">Ajout d'un nouveau sondage</h1>
                <form class="ui form" method="POST" action="addNewSurvey.php">
                    <h3 class="ui dividing header">Le sondage</h3>
                    <div class="two fields">
                        
                        <div class="field">
                            <label>Titre</label>
                            <input type="text" name="surveyTitle" placeholder="Titre" value="<?php echo $surveyTitle; ?>" required>
                        </div>

                        <div class="field">
                            <label>Catégorie</label>
                            <select class="ui fluid dropdown">
                                <option value="">Catégorie</option>
                                <?php for($i = 0; $i < count($surveyCategories); $i++){
                                    echo "<option value= '" . $surveyCategories[$i] . "'>" . $surveyCategories[$i] . "</option>";
                                }?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="field">
                        <label>Description</label>
                        <textarea name="surveyDescription" placeholder="Décrivez le but général de votre sondage, cela donnera envie aux gens d'y participer !" rows="2"></textarea>
                    </div>

                    <div class="two fields">
                        <div class ="field">
                            <label>Date de cloture (facultatif)</label>
                            <div class="ui calendar">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input type="date">
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>Image associée</label>
                            <input type="file"  name="Image">
                        </div>
                    </div>

                    <div class="field">
                        <label>Nombre de participants maximal</label>
                        <input  type="number" min="10" max="65535" name="numberParticipantsMax"  value="1000"></input>
                    </div>       
                    
                    <div class="field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="otherCanPropose" >
                            <label for="edit-abo_newsletter">Laisser la possibilité aux utilisateurs de créer d'autres propositions pour le sondage</label>
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
        
        <footer>
            <div class="ui inverted vertical footer segment">
                <div class="ui container">
                    <div class="ui stackable inverted divided equal height grid">
                        <div class="three wide column">
                            <h4 class="ui inverted header">A propos</h4>
                            <div class="ui inverted link list">
                                <a class="item" href="#">Plan du site</a>
                                <a class="item" href="#">Contact</a>
                                <a class="item" href="https://github.com/MindeurFou/Donne-ton-avis">Code source</a>
                            </div>
                        </div>
                        
                        <div class="three wide column">
                        <h4 class="ui inverted header">De plus</h4>
                            <div class="ui inverted link list">
                                <a class="item" href="#">Plan du site</a>
                                <a class="item" href="#">Contact</a>
                                <a class="item" href="#">Autre chose</a>
                            </div>
                        </div>
                        
                        <div class="seven wide column">
                            <h4 class="ui inverted header">Développement du site</h4>
                            <p>Le site a été développé par Tanguy Pouriel et José Maria grâce au cours et aux conseils de M. Goupil
                            que l'on remercie !</p>
                        </div>
                           
                    </div>
                </div>
            </div>
        </footer>

        
       
    </body>
</html>

