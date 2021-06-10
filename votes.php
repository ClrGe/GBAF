<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  // le visiteur doit être connecté pour accéder au contenu
  if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    die();
  }
  require "database.php";

if (isset($_GET['id']) && isset($_GET['votes'])){
	$id_user = $_SESSION['id_user'];
	$votes = htmlspecialchars($_GET['votes']);
    $id_partenaires = $_GET['idpartner'];

	$req = $bdd->prepare('SELECT nom FROM partenaires WHERE id = ?');
	$req->execute(array($id_partenaires));
	$acteur = $req->fetch();
	$req->closeCursor();

	if (($votes == "like" || $votes == "dislike") && !empty($nom)) {
		$req = $bdd->prepare('SELECT id_user, id_partenaires, votes FROM votes WHERE id_partenaires = :id_partenaires AND id_user = :id_user');
		$req->execute(array(
			'id_partenaires' => $id_partenaires,
			'id_user' => $id_user
		));
		$resultat = $req->fetch();
		$req->closeCursor();
		if (empty($resultat)) {
			// l'utilisateur n'a pas voté pour cet acteur
			$vote = $bdd->prepare('INSERT INTO votes(votes, id_user, id_partenaires) VALUES (:votes, :id_user, :id_partenaires)');
			$vote->execute(array(
				'id_user' => $id_user,
				'id' => $id,
				'votes' => $votes
			));
		} else {
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
?>
