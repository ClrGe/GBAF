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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/ff07e057e1.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php require "header.php"; ?>
    <section class="partner-section">
    <?php
         $id = $_GET['id'];
         $req = $bdd->prepare('SELECT id, nom, description, logo FROM partenaires WHERE id = :id');
         $req->execute(array(
         'id' => $id
         ));
         while ($donnees = $req->fetch()){
		echo '<div class="pub"><img src="img/partenaires/' . htmlspecialchars($donnees['logo']) . '" alt="Logo ' . htmlspecialchars($donnees['nom']) . '" class="pub"/></div>';
		echo '<p class="bg-red white description">' . nl2br(htmlspecialchars($donnees['description'])) . '</p>';};
	?>
    </section>
    <section class="comment-section">
    <?php
		$rep = $bdd->prepare('SELECT votes, id_user, id_partenaires FROM votes WHERE id_partenaires = ?');
		$rep->execute(array($id_partenaires));
		$likes = 0;
		$dislikes = 0;
		$liked = "";
		$disliked = "";
		while ($votes = $rep->fetch()) {
			if ($votes['votes'] == 'like') {
			$likes++;
			if ($votes['id_user'] == $_SESSION['id_user']) {
			$liked = "liked";
		    }
			} else if ($votes['votes'] == 'dislike') {
				$dislikes++;
			if ($votes['id_user'] == $_SESSION['id_user']) {
				$disliked = "disliked";
				}
			}
		}
	?>
        <div class="flex-container">
          <div class="button"><i class="fas fa-comments"></i><a href="commenter.php" class="button">COMMENTER</a></div>
          <div class="button"><i class="fas fa-thumbs-up"></i><a href="votes.php?votes=like&idpartner=<?php echo $resultat['id']; ?>" class="<?php echo $liked; ?>"> J'AIME</a></div>
          <div class="button"><i class="fas fa-thumbs-down"></i><a href="votes.php?votes=dislike&idpartner=<?php echo $resultat['id']; ?>" class="<?php echo $disliked; ?>"> JE N'AIME PAS</a>"</div>
        </div>
        <h2 class="comment-title center"> COMMENTAIRES </h2>
        <?php include("database.php"); ?>
        <?php
            $req = $bdd->prepare('SELECT auteur, commentaires, DATE_FORMAT(date_com, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr  FROM commentaires WHERE id_partenaires = 1 ORDER BY date_com');
            $req->execute(array($_GET['commentaires']));
              while ($donnees = $req->fetch()){ ?>
                <p class="comment comment-info"><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
                <p class="comment"><?php echo nl2br(htmlspecialchars($donnees['commentaires'])); ?></p>
        <?php }
          $req->closeCursor();
        ?>
      </section>
</body>
<?php require "footer.php";?>
</html>