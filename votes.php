<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  // le visiteur doit être connecté pour accéder au contenu
  if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    die();
  }
  require "templates/database.php";
  //user ne peut voter qu'une seule fois
  $req = $bdd->prepare('SELECT * FROM votes WHERE id_user = :id_user AND id_partenaires = :id_partenaires');
		$req->execute(array(
			'id_user' => $_SESSION['id'],
			'id_partenaires' => $_GET['id']
		));
		$resultat = $req->fetch();
		$req->closeCursor();
		if (empty($resultat)) {
			//si user n\'a pas encore voté, prendre en compte son vote dans la bdd
			$req = $bdd->prepare('INSERT INTO votes(id, id_user, id_partenaires, votes) VALUES(:id, :id_user, :id_partenaires, :votes)');
			$req->execute(array(
				'id' => $_POST[''],
				'id_user' => $_SESSION['id'],
				'id_partenaires' => $_GET['id'],
				'votes' => $_GET['votes'],
				));
		}else {
			// si user a déjà voté, mise à jour de son vote
			if (!empty ($resultat))
				$votes = 'imp';
			$up_vote = $bdd->prepare('UPDATE votes SET votes = :votes WHERE id_user = :id_user AND id_partenaires = :id_partenaires');
			$up_vote->execute(array(
				'votes' => $_GET['votes'],
				'id_user' => $_SESSION['id'],
				'id_partenaires' => $_GET['id'],
			));
		}
  header('Location: partenaires.php?id=3');
	?>
