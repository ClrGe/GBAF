<!DOCTYPE html>
<html lang="fr">
    <head>
       <meta charset="utf-8">
       <title>Créer un compte - GBAF</title>
        <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    </head>
    <body>
        <header>
            <img src="img/logo.png" alt="GBAF">
        </header>
        <div id="connexion">                   
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
                    <br /><input type="submit" id='submit' value='Créer un compte' ><br />
                </div>
            </form>
        </div>
    </body>
</html>