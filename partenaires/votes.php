<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (!isset($_SESSION['id'])) {
	header('Location: connexion.php');
	die();
}
require 'database.php';

	$resp = $bdd->prepare('SELECT nom FROM partenaires WHERE id = ?');
	$resp->execute(array($id));
	$nom = $resp->fetch();
	$resp->closeCursor();

	if (($votes == "likes" || $votes == "dislikes") && !empty($nom)) {
		$req = $bdd->prepare('SELECT id_user, id_partenaires, votes FROM votes WHERE id_partenaires = :id_partenaires AND id_user = :id_user');
		$req->execute(array(
			'id_partenaires' => $id_partenaires,
			'id_user' => $id_user
		));
		$resultat = $req->fetch();
		$req->closeCursor();
		if (empty($resultat)) {
			$new_vote = $bdd->prepare('INSERT INTO votes(id_user, id_partenaires, votes) VALUES (:id_user, :id_partenaires, :votes)');
			$new_vote->execute(array(
				'id_user' => $id_user,
				'id_partenaires' => $id_partenaires,
				'votes' => $votes
			));
		} else {
			if ($resultat['votes'] == $votes)
				$vote = 'novote';
			$up_vote = $bdd->prepare('UPDATE votes SET votes = :votes WHERE id_user = :id_user AND id_partenaires = :id_partenaires');
			$up_vote->execute(array(
				'votes' => $votes,
				'id_user' => $id_user,
				'id_partenaires' => $id_partenaires
			));
		}
		header('Location: index.php?id=' . $id_partenaires);
		die();
}

header('Location: index.php');
?>