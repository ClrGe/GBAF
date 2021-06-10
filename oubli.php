<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
require "database.php";
if (isset($_POST['username'])) {
	// récupération de la question secrète de l'utilisateur
	$username = htmlspecialchars($_POST['username']);
	$req = $bdd->prepare('SELECT username, question FROM membres WHERE username = :username');
	$req->execute(array(
		'username' => $username
	));
	$resultat = $req->fetch();
	if ($resultat)
		$user_exists = true;
	else
		$user_exists = false;
	$req->closeCursor();
}
if (isset($_POST['reponse']) && isset($_POST['username']) && isset($_POST['question'])) {
	$username = htmlspecialchars($_POST['username']);
	$reponse = htmlspecialchars($_POST['reponse']);
	$question = htmlspecialchars($_POST['question']);
	$req = $bdd->prepare('SELECT reponse, question FROM user WHERE username = :username');
	$req->execute(array(
		'username' => $username
	));
	$resultat = $req->fetch();
	if ($reponse == $resultat['reponse'])
		$answer_correct = true;
	else
		$answer_correct = false;
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
		// hachage du mot de passe
		$pass_hache = password_hash($password, PASSWORD_DEFAULT);
		$req = $bdd->prepare('UPDATE user SET password = :password WHERE username = :username');
		$req->execute(array(
			'password' => $pass_hache,
			'username' => $username
		));
	}
}
?>
<!DOCTYPE html>
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
        <section class="content-page">
		<div class="container">
			<section class="bloc-content">
				<!-- Mot de passe oublié -->
				<h2>Mot de passe oublié</h2>
				<div class="confirmation">
					<?php
					if (isset($password_correct) && $password_correct) {
						echo '<p>Mot de passe mis à jour.</p><button class="button"><a href="index.php">Se connecter ></a></button>';
					}
					?>
				</div>
				<form method="post" action="oubli.php">
					<?php
						if ((!isset($_POST['username']) && !isset($_POST['reponse'])) || (isset($user_exists) && !$user_exists)) {
					?>
					<p>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" maxlength="255" required />
					</p>
					<input type="submit" name="question" class="button" value="Afficher ma question secrète >" />
					<?php
						}
						if ((isset($_POST['username']) && !isset($_POST['reponse']) && !isset($_POST['password']) && $user_exists) || (isset($answer_correct) && !$answer_correct)) {
					?>
					<p>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" value="<?php echo $username; ?>" readonly />
					</p>
					<p>
						<label for="question">Question secrète</label>
						<input type="text" name="question" id="question" maxlength="255" value="<?php echo $resultat['question']; ?>" readonly />
					</p>
					<p>
						<label for="reponse">Reponse secrète</label>
						<input type="text" name="reponse" id="reponse" maxlength="255" required />
					</p>
					<input type="submit" name="confirm" class="button" value="Envoyer ma réponse >" />
					<?php
						}
						if ((isset($_POST['reponse']) && $answer_correct) || (isset($password_correct) && !$password_correct)) {
					?>
					<p>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" value="<?php echo $username; ?>" readonly />
					</p>
					<p>
						<label for="password">Nouveau mot de passe</label>
						<input type="password" name="password" id="password" maxlength="255" required />
					</p>
					<p>
						<label for="confirmPassword">Confirmer nouveau mot de passe</label>
						<input type="password" name="confirmPassword" id="confirmPasword" maxlength="255" required />
					</p>
					<input type="submit" name="send" class="button" value="Envoyer >" />
					<?php
						}
					?>
				</form>			
			</section>
		</div>
	</section>
	<?php
	include 'footer.php';
	?>
</body>
</html>