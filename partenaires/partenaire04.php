<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GBAF - Chambres des Entrepreneurs</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/ff07e057e1.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header id="header" class="border">
      <div>
        <ul class="settings desktop-only">
          <li class="black"><strong> Utilisateur </strong> </li>
          <li class="black"><a class="black" href="parametres.php"><i></i>Paramètres du compte</a></li>
          <li class="black"><a class="black" href="connexion.php"><i></i>Deconnexion</a></li>
        </ul>
      </div>
      <a href="../index.php"><img src="../img/logo.png" alt="GBAF" class="gbaf alt-gbaf"></a>
    </header>
    <main>
      <section>
        <img src="../img/business-05.jpg" alt="pub" class="pub">
        <h5 class="partenaires">
          La <strong>CDE</strong> (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. 
          Son président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.
        </h5>
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
            $req = $bdd->prepare('SELECT auteur, commentaires, DATE_FORMAT(date_com, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr  FROM commentaires WHERE id_partenaires = 4 ORDER BY date_com');
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
      <div class="flex-footer">
        <div class="button"><a href="../contact.html">Contact</a></div>
        <div class="button"><a href="../legal.html">Mentions légales</a></div>
      </div>
    </footer>
    </body>
</html>
