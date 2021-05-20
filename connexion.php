<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de connexion - GBAF</title>
        <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    </head>
    <body>
        <header>
            <img class="center" src="img/logo.png" alt="GBAF">
        </header>
        <div id="connexion">
            <form class="formConnexion" action="connect.php" method="post">
                <h1 class="white">SE CONNECTER</h1>
                <div class="champs">
                    <label for="username">Identifiant<br /></label>
                    <input type="text" placeholder="Saisissez votre nom d'utilisateur" name="username" id="username" required><br />
                </div>
                <div class="champs">
                    <label for="password">Mot de passe</label><br />
                    <input type="password" placeholder="Saisissez votre mot de passe" id="password" name="password" required><br />
                    <br /><input type="submit" name="connexion" id='submit' value='Connexion' ><br />
                </div>
                <br />
                <a class="inscription" href="inscription.php"> Pas encore inscrit ? Cliquez ici pour <strong>créer un compte</strong></a><br />
                <br/><a href="identification.php"> Mot de passe oublié ?</a>
            </form>
        </div>
    </body>
</html>