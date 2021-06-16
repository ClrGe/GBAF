<?php
  if (session_status() == PHP_SESSION_NONE) { // paramètres de session
    session_start();
  }
  if (!isset($_SESSION['id'])) {
    header('Location: connexion.php'); // verifier la connexion ; sinon renvoi vers la page d'identification
    die();
  }
  //récupérer les infos du partenaires dans la bdd
  require "templates/database.php";
  if (isset($_GET['id'])){
    $id_partenaires = $_GET['id'];
    $req = $bdd->prepare('SELECT id, nom, description, logo FROM partenaires WHERE id = :id_partenaires'); // récupérer le partenaire
    $req->execute(array(
      'id_partenaires' => $id_partenaires));
  }

  //afficher les templates
  require "templates/head.php";
  require "templates/header.php";
  ?>
  <div class="partner-section bg-red">
  <?php while ($result = $req->fetch()){
    // afficher les données du partenaire
    echo '<div><img src="img/partenaires/' . htmlspecialchars($result['logo']) . '" alt="Logo ' . htmlspecialchars($result['nom']) . '" class="pub"/></div>';
    echo '<p class="large-txt white bold center">' . htmlspecialchars($result['description']) . '</p>';
  }?>
  </div>
  <div class="comment-section"><hr>
  <?php
						// récupération des votes de l'acteur
						$rep = $bdd->prepare('SELECT id_user, id_partenaires, votes FROM votes WHERE id_partenaires = ?');
						$rep->execute(array($id_partenaires));
						$likes = 0;
						$dislikes = 0;
						while ($votes = $rep->fetch()) {
							// comptage du nbr de likes et dislikes
							if ($votes['votes'] == '1') {
								$likes++;
							} else if ($votes['votes'] == '-1') {
								$dislikes++;
							}
						}
						$rep->closeCursor();

					?>
    <div class="flex-container">
      <div class="button red"><a href='votes.php?votes=1&id=<?php echo $id_partenaires ?>' class="button"><i class="fas fa-thumbs-up"></i><?php echo $likes;?> </a></div>
      <div class="button red"><a href="votes.php?votes=-1&id=<?php echo $id_partenaires ?>" class="button"><i class="fas fa-thumbs-down"></i><?php echo $dislikes;?> </a></div>'
    </div><hr>
    <h2 class="comment-title big center red"><i class="fas fa-comments"></i> COMMENTAIRES </h2>
    <div class="post-comment">
    <form method="post" action="partenaires.php?id=<?php echo $id_partenaires ;?>">
				<input type="hidden" name="id_user" value="<?php echo $_SESSION['id'] ?>"/>
        <input type="hidden" name="id_partenaires" value="<?php echo $id_partenaires; ?>"/>
        <input type="hidden" name="auteur" value="<?php echo $_SESSION['username']; ?>"/>
        <label for="commentaire"></label><br />
        <br /><textarea id="commentaire" rows="3" class="commArea" placeholder="Écrivez ici votre commentaire..." name="commentaire" required></textarea>
        <input type="submit" id='submit' name="publier" value="Publier" class="bg-red white publish">
      </form>
    </div><hr>
  </div>
  <?php
     require "templates/database.php";

      $req_com = $bdd->prepare('SELECT id, auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr  FROM commentaire WHERE id_partenaires = ? ORDER BY date_commentaire');
      $req_com->execute(array($id_partenaires));
      while ($donnees = $req_com->fetch()){ ?>
        <p class="comment black comment-info"><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
        <p class="comment black"><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p><hr>
        <?php } $req_com->closeCursor();?>
    <?php require "templates/footer.php";?>
    <?php 
      require "templates/database.php";
      $req = $bdd->prepare('INSERT INTO commentaire(id, id_partenaires, auteur, commentaire) VALUES(:id, :id_partenaires, :auteur, :commentaire)');
      $req->execute(array(
        'id' => $_POST[''],
        'id_partenaires' => $_GET['id'],
        'auteur' => $_POST['auteur'],
        'commentaire' => $_POST['commentaire'],
        ));
    ?>
