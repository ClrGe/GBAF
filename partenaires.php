<?php
  if (session_status() == PHP_SESSION_NONE) {
  session_start();
  }
  // verifier la connexion du visiteur ; sinon renvoi vers la page de connexion
  if (!isset($_SESSION['id'])) {
  header('Location: connexion.php');
  die();
  }
  // se connecter à la bdd
  require "templates/database.php";
  if (isset($_GET['id_partenaires'])){
      $id_partenaires = $_GET['id_partenaires'];
      $req->execute(array(
      'id_partenaires' => $id_partenaires));
      $result = $req->fetch();
    }
?>
    <?php require "templates/head.php";
      require "templates/header.php"; ?>
    <section class="partner-section bg-red">
    <?php
         $id = $_GET['id'];
         $req = $bdd->prepare('SELECT id, nom, description, logo FROM partenaires WHERE id = :id');
         $req->execute(array(
         'id' => $id
         ));
         while ($donnees = $req->fetch()){
		echo '<div><img src="img/partenaires/' . htmlspecialchars($donnees['logo']) . '" alt="Logo ' . htmlspecialchars($donnees['nom']) . '" class="pub"/></div>';
		echo '<p class="large-txt white bold center">' . htmlspecialchars($donnees['description']) . '</p>';};
	?>
    </section>
    <section class="comment-section">
    <hr>
    <?php
		 $likes = $bdd->prepare("SELECT * FROM votes WHERE votes='1' AND id_partenaires = ?");
     $likes -> execute(array($id));
     $likes = $likes-> rowCount();
     
     $dislikes = $bdd->prepare("SELECT * FROM votes WHERE votes='2' AND id_partenaires = ?");
     $dislikes -> execute(array($id));
     $dislikes = $dislikes -> rowCount();
	?>
        <div class="flex-container">
          <div class="button red"><i class="fas fa-thumbs-up"></i><a href="votes.php" class="button"> J'AIME</a></div>
          <div class="button red"><i class="fas fa-thumbs-down"></i><a href="votes.php" class="button"> JE N'AIME PAS</a></div>
        </div><hr>
        <h2 class="comment-title big center red"><i class="fas fa-comments"></i> COMMENTAIRES </h2>
        <div class="post-comment">
          <form action="partenaires.php" method="post">
            <input type="hidden" name="id_partenaires" value="<?php echo $id_partenaires; ?>"/>
            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user'] ?>"/>
            <label for="commentaires"></label><br />
            <br /><textarea id="commentaires" rows="3" class="commArea" placeholder="Écrivez ici votre commentaire..." name="commentaires" required></textarea>
            <input type="submit" name="publier" value="Publier" class="bg-red white publish">
          </form>
        </div><hr>
        <?php
            $req = $bdd->prepare('SELECT id_user, commentaires, DATE_FORMAT(date_com, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr  FROM commentaires WHERE id_partenaires = ? ORDER BY date_com');
            $req->execute(array($id_partenaires));
              while ($donnees = $req->fetch()){ ?>
                <p class="comment black comment-info"><strong><?php echo htmlspecialchars($donnees['username']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
                <p class="comment black"><?php echo nl2br(htmlspecialchars($donnees['commentaires'])); ?></p><hr>
        <?php }
          $req->closeCursor();
        ?>
      </section>
    <?php require "templates/footer.php";?>
