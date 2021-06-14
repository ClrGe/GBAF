  <?php
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    // le visiteur doit être connecté pour accéder au contenu
    if (!isset($_SESSION['id'])) {
      header('Location: connexion.php');
      die();
    }
    require "templates/database.php"; //connexion à la bdd
    require "templates/head.php";
    require "templates/header.php";
  ?>
    <div class="container">
      <h1 class="bg-red white title">GROUPEMENT BANQUE-ASSURANCE FRANÇAIS</h1>
      <h3 class="black big center">BIENVENUE SUR NOTRE PLATEFORME</h3>
      <div class="page">
        <img src="img/business-04.jpg" alt="pub" class="pub pub-partenaire">
        <div><h3 class="bold txt large-txt">
          <br />Le Groupement Banque-Assurance Français est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française.
          Sa mission est de promouvoir l'activité bancaire à l’échelle nationale.
          C’est aussi un interlocuteur privilégié des pouvoirs publics pour représenter ce secteur d'activité.
        </h3>
        <p class="txt bold big red center">
          Le GBAF regroupe six des plus importants acteurs du secteur
          de la banque et de l'assurance en France
        </p>
        <div class="flex-banques">
          <div><i><img src="img/logo_sg.jpg" alt="Société Générale" class="banque"></i></div>
          <div><i><img src="img/bnp-logo.jpg" alt="BNP Paribas" class="banque"></i></div>
          <div><i><img src="img/logo-bpce.png" alt="BPCE" class="banque"></i></div>
          <div><i><img src="img/credit-agricole.jpg" alt="Crédit Agricole" class="banque"></i></div>
          <div><i><img src="img/credit-mutuel.jpg" alt="Crédit Mutuel - CIC" class="banque"></i></div>
          <div><i><img src="img/La-Banque-Postale.png" alt="Banque Postale" class="banque"></i></div>
        </div>
        </div>
        <div>
          <h2 class="nosPart large white bg-red center">LES PARTENAIRES DU GBAF</h2>
          <div class="partenaires flex bg-red">
          <?php
	    $req = $bdd->prepare('SELECT id, nom, description, logo, vignette FROM partenaires ORDER BY id');
            $req->execute(array($_GET['partenaires']));
            while ($donnees = $req->fetch()){
            '<div class="partenaires flex">';
            echo '<div class="flex-block"><img src="img/partenaires/' . htmlspecialchars($donnees['vignette']) . '" alt="Logo ' . htmlspecialchars($donnees['nom']) .  '" class="logo"/></div>';
            echo '<div class="flex-block"><p class="white description">' . substr(htmlspecialchars($donnees['description']), 0, strpos(htmlspecialchars($donnees['description']), ".", 1) + 1) . ' [...]</p></div>';
            echo '<div class="flex-block"><a class="suite" href="partenaires.php?id=' . $donnees['id'] . '">Afficher la suite ></a></div>';
            echo '<hr>';}
            '</div>';
        ?>
        </div>
      </div>
    </div>
    <?php require "templates/footer.php";
      $donnees->closeCursor();
    ?>
