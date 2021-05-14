<!-- présentation individuelle des partenaires du GBAF-->

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GBAF - Formation&co</title>
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
        <img src="../img/business-02.jpg" class="pub">
        <p  class="partenaires">
          Formation&co est une association française présente sur tout le territoire. Son ambition est de donner
          à tous l'opportunité de se former sans conditions de revenus ni prérequis. Cette association entend encourager 
          l'entreprenariat et faire fonctionner l'ascenceur social. Pour tendre vers cet objectif, cet organisme propose 
          à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.
          Le service proposé consiste des points suivants :
        </p>  
            <ul>
              <li class="services">Un financement jusqu’à 30 000€ </li>
              <li class="services">Un suivi personnalisé et gratuit</li>
              <li class="services">Une lutte acharnée contre les freins sociétaux et les stéréotypes</li>
            </ul>
        <p  class="partenaires">
          Le financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres… .<br> 
          Nous collaborons avec des personnes talentueuses et motivées.<br>
          Vous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.
        </p>
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
            $req = $bdd->prepare('SELECT auteur, commentaires, DATE_FORMAT(date_com, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr  FROM commentaires WHERE id_partenaires = 1 ORDER BY date_com');
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
          <div class="button"></i><a href="../contact.html">Contact</a></div>
          <div class="button"></i><a href="../legal.html">Mentions légales</a></div>
        </div>
    </footer>
  </body>
</html>
