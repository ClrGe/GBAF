<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
require "templates/database.php";
if (isset($_POST['username'])) {
	$username = htmlspecialchars($_POST['username']);
	$req = $bdd->prepare('SELECT username, question FROM user WHERE username = :username');
	//vérifier que l'utilisateur existe
    $req->execute(array(
		'username' => $username
	));
	$resultat = $req->fetch();
	if ($resultat)
		$real_user = true;
	else
		$real_user = false;
	$req->closeCursor();
}
if (isset($_POST['username']) && isset($_POST['question']) && isset($_POST['reponse'])) {
	$username = htmlspecialchars($_POST['username']);
	$question = htmlspecialchars($_POST['question']);
	$reponse = htmlspecialchars($_POST['reponse']);
	$req = $bdd->prepare('SELECT reponse, question FROM user WHERE username = :username');
	$req->execute(array(
		'username' => $username
	));
	$resultat = $req->fetch();
	if ($reponse == $resultat['reponse'])
		$OKreponse = true;
	else
		$OKreponse = false;
	$req->closeCursor();
}

if (isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_POST['username'])) {
	$username = htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);
	$confirmPassword = htmlspecialchars($_POST['confirmPassword']);

	$answer_correct = true;
	if ($password != $confirmPassword) {
		$password_correct = false;
	} else {
		$password_correct = true;
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$req = $bdd->prepare('UPDATE user SET password = :password WHERE username = :username');
		$req->execute(array(
			'password' => $hash,
			'username' => $username
		));
		header('Location: redirection.php');	}
}
?>
<?php require "templates/head.php"; ?>
        <header>
            <img src="img/logo.png" alt="GBAF">
        </header>
        <section class="content-page">
		<div>
			<section>
				<h2 class="red center large">Réinitialiser le mot de passe</h2>
				<div id="connexion">
					<form class="formConnexion" method="post" action="oubli.php">
						<?php
							if ((!isset($_POST['username']) && !isset($_POST['reponse'])) || (isset($real_user) && !$real_user)) {
						?>
						<div class="champs white bold">
							<label for="username">Nom d'utilisateur</label><br />
							<input type="text" name="username" id="username" maxlength="255" required />
						</div>
						<input type="submit" name="question" class="button" value="Valider" />
						<?php
							}
							if ((isset($_POST['username']) && !isset($_POST['reponse']) && !isset($_POST['password']) && $real_user) || (isset($OKreponse) && !$OKreponse)) {
						?>
						<div class="champs black">
							<label for="username">Nom d'utilisateur</label>
							<input type="text" name="username" id="username" value="<?php echo $username; ?>" readonly />
						</div>
						<div class="champs black">
							<label for="question">Question secrète</label>
							<input type="text" name="question" id="question" maxlength="255" value="<?php echo $resultat['question']; ?>" readonly />
						</div>
						<div class="champs black">
							<label for="reponse">Reponse à la question secrète</label>
							<input type="text" name="reponse" id="reponse" maxlength="255" required />
						</div>
						<input type="submit" name="confirm" class="button" value="Envoyer ma réponse >" />
						<?php
							}
							if ((isset($_POST['reponse']) && $OKreponse) || (isset($OKpassword) && !$OKpassword)) {
						?>
						<div class="champs white bold">
							<label for="username">Nom d'utilisateur</label>
							<input type="text" name="username" id="username" value="<?php echo $username; ?>" readonly />
						</div>
						<div class="champs white bold">
							<label for="password">Nouveau mot de passe</label>
							<input type="password" name="password" id="password" maxlength="255" required />
						</div>
						<div class="champs white bold">
							<label for="confirmPassword">Confirmer le nouveau mot de passe</label>
							<input type="password" name="confirmPassword" id="confirmPasword" maxlength="255" required />
						</div>
						<input type="submit" name="send" class="button" value="Envoyer >" />
						<?php
							}
						?>
					</form>
				</div>
			</section>
		</div>
	</section>
	<?php
	include 'footer.php';
	?>
</body>
</html>