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

  if(isset($_GET['votes']) && isset($_GET['id'])){
		  $id_partenaires = $_GET['id'];
		  $votes = htmlspecialchars($_GET['votes']);
		  $id_user = $_SESSION['id'];
		  $verif = $bdd -> prepare("SELECT * FROM partenaires WHERE id =?"); // vérifier que l'id partenaire est valable
		  $verif -> execute(array($id_partenaires));
		  $partenaires = $verif->fetch();
			$verif->closeCursor();
		  if($verif -> rowCount() == 1) // L'id partenaire est OK ==1
		  {
			if (($votes == "up" || $votes == "down") && !empty($partenaires)) {			  {
				$votes = $bdd->prepare("SELECT * FROM votes WHERE id_partenaires = :id_partenaires AND id_user = :id_user");
				$votes -> execute(array(
					'id_partenaires' => $id_partenaires, //vérifier si l'user a déjà voté pour ce partenaire
					'id_user' => $id_user ));
				$result = $req->fetch();
				$req->closeCursor();
				if (empty($result)) { //result OK, il n'a pas voté pour cet acteur
					$new_vote = $bdd->prepare('INSERT INTO votes(id_user, id_partenaires, votes) VALUES (:id_user, :id_partenaires, :votes)');
					$new_vote->execute(array(
						'id_user' => $id_user,
						'id_partenaires' => $id_partenaires,
						'votes' => $votes
					));
				} else {
					if ($resultat['votes'] == $votes) //a déjà voté pour ce partenaire -- update ou redirection
						$votes = 'imp';
					$like = $bdd->prepare('UPDATE votes SET votes = :votes WHERE id_user = :id_user AND id_partenaires = :id_partenaires');
					$like->execute(array(
						'votes' => $votes,
						'id_user' => $id_user,
						'id_partenaires' => $id_partenaires
					));
				}
				header('Location: partenaires.php?id=' . $id_partenaires);
				die();}
			}
		}
	}

header('Location: partenaires.php?id=' . $id_partenaires);
?>
