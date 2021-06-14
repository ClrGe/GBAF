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
$req->execute(array($_GET['partenaires']));
//préparer l'espace commentaires
// vérification variables $_POST
if (isset($_POST['id_user']) && isset($_POST['id_partenaires']) && isset($_POST['commentaires'])) {
    $id_user = $_POST['id_user'];
    $id_partenaires = $_POST['id_partenaires'];
	$commentaires = htmlspecialchars($_POST['commentaires']);
	// verser dans la bdd
	$req = $bdd->prepare('INSERT INTO commentaires(id_user, id_partenaires, date_com, commentaires) VALUES (?, ?, NOW(), ?)');
	$req->execute(array(
		$id_user => htmlspecialchars($_POST['id_user']),
		$id_partenaires = htmlspecialchars($_POST['id_partenaires']),
        $commentaires = htmlspecialchars($_POST['commentaires'])));
        $req->closeCursor();
        header('Location: partenaires.php?id=' . $id_partenaires);
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
    <div class="flex-container">
      <?php echo '<div class="button red"><i class="fas fa-thumbs-up"></i><a href="votes.php?votes=like&id=' . $id_partenaires . '" class="button"> J\'AIME</a></div>';
      echo '<div class="button red"><i class="fas fa-thumbs-down"></i><a href="partenaires.php?id=' . $id_partenaires . '" class="button"> JE N\'AIME PAS</a></div>';?>
    </div><hr>
    <h2 class="comment-title big center red"><i class="fas fa-comments"></i> COMMENTAIRES </h2>
    <div class="post-comment">
        <?php echo '<form action="partenaires.php?id=' . $id_partenaires ;'" method="post"> ';?>
        <input type="hidden" name="id_partenaires" value="<?php echo $id_partenaires; ?>"/>
        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user'] ?>"/>
        <label for="commentaires"></label><br />
        <br /><textarea id="commentaires" rows="3" class="commArea" placeholder="Écrivez ici votre commentaire..." name="commentaires" required></textarea>
        <input type="submit" id='submit' name="publier" value="Publier" class="bg-red white publish">
      </form>
    </div><hr>
    <?php
      $req_com = $bdd->prepare('SELECT id_user, commentaires, DATE_FORMAT(date_com, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr  FROM commentaires WHERE id_partenaires = ? ORDER BY date_com');
      $req_com->execute(array($id_partenaires));
      while ($donnees = $req_com->fetch()){ ?>
        <p class="comment black comment-info"><strong><?php echo htmlspecialchars($donnees['username']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
        <p class="comment black"><?php echo nl2br(htmlspecialchars($donnees['commentaires'])); ?></p><hr>
        <?php } $req_com->closeCursor();?>
  </div>
  <?php require "templates/footer.php";?>
