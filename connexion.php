<!-- page de connexion pour accéder à l'extranet -->

<!DOCTYPE html>
<html lang="fr">
<html>
    <head>
       <meta charset="utf-8">
       <title>Page de connexion - GBAF</title>
        <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="connexion">
            <header>
                <img src="img/logo.png" alt="GBAF">
            </header>
            
            <form class="formConnexion">
                <h1>SE CONNECTER</h1>
                
                <div class="champs">
                    <label><b>Identifiant</b><br /></label>
                    <input type="text" placeholder="Saisissez votre nom d'utilisateur" name="identifiant" required><br />
                </div>
                <label><b>Mot de passe</b></label><br />
                <input type="password" placeholder="Saisissez votre mot de passe" name="password" required><br />

                <br /><input type="submit" id='submit' value='Connexion' >
            
            </form>
        </div>
    </body>
</html>
