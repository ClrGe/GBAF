<?php
	require 'database.php';
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
header('Location: connexion.php?connexion=0');
?>
