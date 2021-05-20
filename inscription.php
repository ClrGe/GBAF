<!DOCTYPE html>
<?php session_start();?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GBAF</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header>
            <img src="img/logo.png" alt="GBAF">
        </header>
        <?php
            require "database.php";
            if(isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['question'], $_POST['reponse']))
            {
                if(empty($_POST['username'])){
                    echo "Veuillez renseigner votre nom d'utilisateur";
                }
                elseif(strlen($_POST['pseudo'])>20){
                    echo "Votre nom d'utilisateur ne doit pas dépasser 20 caractères";
                }
                elseif(
                    $req = $bdd->prepare('SELECT * FROM user WHERE username=:username')==1){
                    echo "Ce nom d'utilisateur existe déjà";
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
                elseif(empty($_POST['email'])){
                    echo "Veuillez renseigner votre adresse e-mail";
                }
                elseif(empty($_POST['reponse'])){
                    echo "Veuillez répondre à la question secrète";
                }
                else{
                    $req = $bdd->prepare("INSERT INTO user(username, password, email, question, reponse) VALUES(:username, :password, :email, :question, :reponse)");
                    $req->execute(array(
                        'username' => $_POST['username'],
                        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        'email' => $_POST['email'],
                        'question' => $_POST['question'],
                        'reponse' => $_POST['reponse'] ));
                    }
            }
        ?>
        <div id="connexion" class="space">
            <form class="formConnexion" action="inscription.php" method="post">
                <h1 class="white">CRÉER UN COMPTE</h1>
                <div class="champs">
                    <label><b>Nom d'utilisateur</b><br /></label>
                    <input type="text" placeholder="Votre identifiant..." name="username" required><br />
                </div>
                <div class="champs">
                    <label><b>Mot de passe</b></label><br />
                    <input type="password" placeholder="Votre mot de passe..." name="password" required><br />
                </div>
                <div class="champs">
                    <label><b>Adresse Email</b><br /></label>
                    <input type="text" placeholder="Votre adresse email..." name="email" required><br />
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