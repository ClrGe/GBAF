
<?php
	require 'templates/database.php';
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$req = $bdd->prepare('SELECT id, username, password FROM user WHERE username = :username');
		$req->execute(array('username' => $username));
		$resultat = $req->fetch();
		$isPasswordCorrect = password_verify($password, $resultat['password']);
		if (!$resultat) {
			header('Location: connexion.php?connexion=0');
			die();
		} else {
			if ($isPasswordCorrect) {
				session_start();
				$_SESSION['id'] = $resultat['id'];
				$_SESSION['username'] = $username;
				header('Location: index.php');
				die();
			}
		}
	}
?>
<?php require "templates/head.php";?>
        <header>
            <img class="center" src="img/logo.png" alt="GBAF">
        </header>
        <div id="connexion">
            <form class="formConnexion" action="connexion.php" method="post">
                <h1 class="white">SE CONNECTER</h1>
                <div class="champs black bold">
                    <label for="username">Identifiant<br /></label>
                    <input type="text" placeholder="Saisissez votre nom d'utilisateur" name="username" id="username" required><br />
                </div>
                <div class="champs black bold">
                    <label for="password">Mot de passe</label><br />
                    <input type="password" placeholder="Saisissez votre mot de passe" id="password" name="password" required><br />
                    <br /><input type="submit" name="connexion" id='submit' value='Connexion' ><br />
                </div>
                <br />
                <a class="inscription" href="inscription.php"> Pas encore inscrit ? Cliquez ici pour <strong>créer un compte</strong></a><br />
                <br/><a class="black" href="oubli.php"> Mot de passe oublié ?</a>
            </form>
        </div>
    </body>
</html>