<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
// si pas connecté => redirection vers connexion
if (!isset($_SESSION['id_user'])) {
	header('Location: connexion.php');
	die();
}

// Connexion à la BDD
require 'database.php';

if (isset($_GET['id_partenaires']) && isset($_GET['votes'])){

	$id_user = $_SESSION['id_user'];
	$id_partenaires = intval($_GET['id_partenaires']);
	$vote = htmlspecialchars($_GET['votes']);

	// vérification que l'acteur correspondant à l'id existe
	$resp = $bdd->prepare('SELECT acteur FROM partenaires WHERE id_partenaires = ?');
	$resp->execute(array($id_partenaires));
	$acteur = $resp->fetch();
	$resp->closeCursor();

	// vérification du vote
	if (($votes == "like" || $votes == "dislike") && !empty($id_partenaires)) {
		// l'acteur existe et le vote est correct
		// vérifier si l'utilisateur a déjà voté pour cet acteur
		$req = $bdd->prepare('SELECT id_user, id_partenaires, votes FROM votes WHERE id_partenaires = :id_partenaires AND id_user = :id_user');
		$req->execute(array(
			'id_partenaires' => $id_partenaires,
			'id_user' => $id_user
		));
		$resultat = $req->fetch();
		$req->closeCursor();
		if (empty($resultat)) {
			// l'utilisateur n'a pas voté pour cet acteur
			$vote = $bdd->prepare('INSERT INTO votes(id_user, id_partenaires, votes) VALUES (:id_user, :id_partenaires, :votes)');
			$vote->execute(array(
				'id_user' => $id_user,
				'id_partenaires' => $id_partenaires,
				'votes' => $votes
			));
		} else {
			// l'utilisateur a déjà voté pour cet acteur
			// si même vote, annulation du vote
			if ($resultat['votes'] == $votes)
				$votes = 'novote';
			$like = $bdd->prepare('UPDATE votes SET votes = :votes WHERE id_user = :id_user AND id_partenaires = :id_partenaires');
			$like->execute(array(
				'votes' => $votes,
				'id_user' => $id_user,
				'id_partenaires' => $id_partenaires
			));
		}
		header('Location: partenaires.php?id=' . $id_partenaires);
		die();
	} else {
		//echo "Vote incorrect ou l'acteur n'existe pas";
	}
}

// redirection vers page des partenaires
header('Location: index.php');
?>