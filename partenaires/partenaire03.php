<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  // le visiteur doit être connecté pour accéder au contenu
  if (!isset($_SESSION['id'])) {
    header('Location: ../connexion.php');
    die();
  }
  require "../database.php";
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GBAF - DSA France</title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/ff07e057e1.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header id="header" class="border">
      <div>
      <ul class="settings">
          <?php
          if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
          ?>
          <p>
            <li class="black settings"><strong><?php echo $_SESSION['username'] . ' '; ?></strong> </li>
            <li class="black settings"><a class="black" href="../parametres.php"><i></i>Paramètres du compte</a></li>
            <li class="black settings"><a class="black" href="../deconnexion.php"><i></i>Deconnexion</a></li>
          </p>
          <?php
          } else {
          ?>
          <p> Veuillez vous connecter </p>
          <?php
          }
          ?>
        </ul>
      </div>
      <a href="../index.php"><img src="../img/logo.png" alt="GBAF" class="gbaf alt-gbaf"></a>
    </header>
    <main>
      <section>
        <img src="../img/Dsa_france.png" alt="DSAFrance">
        <p class="bg-red white description">
          Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.
        </p>
        <p class="partenaires">
          Nous accompagnons les entreprises dans les étapes clés de leur évolution.
          Notre philosophie : s’adapter à chaque entreprise.
          Nous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises
        </p>
        <img src="../img/business-03.jpg" alt="pub" class="pub">
      </section>
      <section class="comment-section">
        <div class="flex-container">
          <div class="button"><i class="fas fa-comments"></i><a href="commenter.php" class="button">COMMENTER</a></div>
          <div class="button"><i class="fas fa-thumbs-up"></i></div>
          <div class="button"><i class="fas fa-thumbs-down"></i></div>
        </div> 
        <h2 class="comment-title"> COMMENTAIRES </h2>
        <?php include("database.php"); ?>
        <?php
            $req = $bdd->prepare('SELECT auteur, commentaires, DATE_FORMAT(date_com, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr  FROM commentaires WHERE id_partenaires = 3 ORDER BY date_com');
            $req->execute(array($_GET['commentaires']));
              while ($donnees = $req->fetch()){ ?>
                <p class="comment comment-info"><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
                <p class="comment"><?php echo nl2br(htmlspecialchars($donnees['commentaires'])); ?></p>
        <?php } 
          $req->closeCursor();
        ?>  
      </section>
    </main>
    <footer>
      <div class="flex-footer bg-red">
        <div class="button"><a href="../contact.html">Contact</a></div>
        <div class="button"><a href="../legal.html">Mentions légales</a></div>
      </div>
    </footer>
  </body>
</html>
