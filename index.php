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
    </head>
    <body>
    <?php require "header.php"; ?>
    <main>
      <h1 class="bg-red white title">GROUPEMENT BANQUE-ASSURANCE FRANÇAIS</h1>
      <h3 class="black big center">BIENVENUE SUR NOTRE PLATEFORME</h3>
      <section>
        <img src="img/business-04.jpg" alt="pub" class="pub">
        <h3 class="bold black partenaires">
          <br />Le Groupement Banque-Assurance Français est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. 
          Sa mission est de promouvoirl'activité bancaire à l’échelle nationale.
          C’est aussi un interlocuteur privilégié des pouvoirs publics pour représenter ce secteur d'activité.
        </h3>
        <p class="partenaires titre-blanc white">
          Le Groupement Banque-Assurance Français (GBAF) est le fruit
          du regroupement de six des plus importants acteurs du secteur
          de la banque et de l'assurance en France :
        </p>
        <div class="flex-banques">
          <div><i><img src="img/logo_sg.jpg" alt="Société Générale" class="banque"></i></div>
          <div><i><img src="img/bnp-logo.jpg" alt="BNP Paribas" class="banque"></i></div>
          <div><i><img src="img/logo-bpce.png" alt="BPCE" class="banque"></i></div>
          <div><i><img src="img/credit-agricole.jpg" alt="Crédit Agricole" class="banque"></i></div>
          <div><i><img src="img/credit-mutuel.jpg" alt="Crédit Mutuel - CIC" class="banque"></i></div>
          <div><i><img src="img/La-Banque-Postale.png" alt="Banque Postale" class="banque"></i></div>
        </div>
      </section>
        <section>
          <h2 class="nosPart bg-red white">Les partenaires du GBAF</h2>
          <div class="partenaires flex">
          <?php
						$req = $bdd->prepare('SELECT id, nom, description, logo, vignette FROM partenaires ORDER BY id');
            $req->execute(array($_GET['partenaires']));
            while ($donnees = $req->fetch()){
            '<div class="partenaires flex">';
            echo '<div><img src="img/partenaires/' . htmlspecialchars($donnees['vignette']) . '" alt="Logo ' . htmlspecialchars($donnees['nom']) .  '" class="logo"/></div>';
            echo '<div><p class="bg-red white description">' . substr(htmlspecialchars($donnees['description']), 0, strpos(htmlspecialchars($donnees['description']), ".", 1) + 1) . ' [...]</p></div>';
            echo '<div><a class="suite" href="partenaires.php?id=' . $donnees['id'] . '">Afficher la suite ></a></div>';
            echo '';}
            '</div>';
          $reponse->closeCursor();
        ?>
        </div>
      </section>
      <?php require "footer.php";?>
</html>
