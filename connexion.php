<!DOCTYPE html>
<html lang="fr">
    <head>
       <meta charset="utf-8">
       <title>Page de connexion - GBAF</title>
        <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    </head>
    <body>
        <header>
            <img src="img/logo.png" alt="GBAF">
        </header>
        <div id="connexion">                   
            <form class="formConnexion" action="connexion.php" method="post">
                <h1 class="white">SE CONNECTER</h1>  
                <div class="champs">
                    <label><b>Identifiant</b><br /></label>
                    <input type="text" placeholder="Saisissez votre nom d'utilisateur" name="username" required><br />
                </div>
                <div class="champs">
                    <label><b>Mot de passe</b></label><br />
                    <input type="password" placeholder="Saisissez votre mot de passe" name="password" required><br />
                    <label for="checkbox"><input type="checkbox" id="checkbox">Afficher le mot de passe</label><br />
                    <br /><a href=index.php><input type="submit" id='submit' value='Connexion' ></a><br />
                </div>
                    <br />
                    <a class="inscription" href="inscription.php"> Pas encore inscrit ? Cliquez ici pour <strong>créer un compte</strong></a>
            </form>
        </div>
    </body>
</html>