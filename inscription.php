<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
require "templates/head.php";
?>
        <header>
            <img src="img/logo.png" alt="GBAF">
        </header>
        <?php
            require "templates/database.php";
            if(isset($_POST['username'], $_POST['password'], $_POST['prenom'],  $_POST['nom'], $_POST['question'], $_POST['reponse']))
            {
                if(empty($_POST['username'])){
                    echo "Veuillez renseigner votre nom d'utilisateur";
                }
                elseif(strlen($_POST['pseudo'])>20){
                    echo "Votre nom d'utilisateur ne doit pas dépasser 20 caractères";
                }
                elseif(empty($_POST['password'])){
                    echo "Veuillez renseigner votre mot de passe";
                }
                elseif(strlen($_POST['password'])>40){
                    echo "Votre mot de passe est trop long";
                }
                elseif(strlen($_POST['password'])<6){
                    echo "Votre mot de passe doit comporter au moins 6 caractères";
                }
                elseif(empty($_POST['prenom'])){
                    echo "Veuillez renseigner votre adresse prénom";
                }
                elseif(empty($_POST['nom'])){
                    echo "Veuillez renseigner votre adresse nom";
                }
                elseif(empty($_POST['reponse'])){
                    echo "Veuillez répondre à la question secrète";
                }
                else{
                    $req = $bdd->prepare("INSERT INTO user(username, password, prenom, nom, question, reponse) VALUES(:username, :password, :prenom, :nom, :question, :reponse)");
                    $req->execute(array(
                        'username' => htmlspecialchars($_POST['username']),
                        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        'prenom' => htmlspecialchars($_POST['prenom']),
                        'nom' => htmlspecialchars($_POST['nom']),
                        'question' => htmlspecialchars($_POST['question']),
                        'reponse' => htmlspecialchars($_POST['reponse'] )));
                    header('Location: redirection.php');
                    die();
                    }
                $req->closeCursor();
            }
        ?>
        <div id="connexion">
            <form class="formConnexion" action="inscription.php" method="post">
                <h1 class="white">CRÉER UN COMPTE</h1>
                <div class="champs">
                    <label><b>Nom d'utilisateur</b><br /></label>
                    <input type="text" placeholder="Votre identifiant..." name="username" required><br />
                </div>
                <div class="champs">
                    <label><b>Prénom</b><br /></label>
                    <input type="text" placeholder="Votre prénom..." name="prenom" required><br />
                </div>
                <div class="champs">
                    <label><b>Nom de famille</b><br /></label>
                    <input type="text" placeholder="Votre nom..." name="nom" required><br />
                </div>
                <div class="champs">
                    <label><b>Mot de passe</b></label><br />
                    <input type="password" placeholder="Votre mot de passe..." name="password" required><br />
                </div>
                <div class="champs">
                    <label><b>Confirmer le mot de passe</b></label><br />
                    <input type="password" placeholder="Confirmez votre mot de passe..." name="confirmPassword" required><br />
                </div>
                <div class="champs">
                    <label><b>Question secrète</b><br /></label>
                    <select name="question">
                        <option>Quel est votre plat préféré ?</option>
                        <option>Comment s'appelait votre premier animal de compagnie ?</option>
                        <option>Quelle est votre destination de voyage de rêve ?</option>
                        <option>Dans quelle ville votre père est-il né ?</option>
                    </select>
                </div>
                <div class="champs">
                    <label><b>Réponse</b><br /></label>
                    <input type="text" placeholder="Réponse à la question secrète..." name="reponse" required><br />
                    <br /><input type="submit" id='submit' value='Créer un compte' ><br />
                </div>
            </form>
        </div>
    </body>
</html>
