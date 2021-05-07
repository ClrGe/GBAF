<!-- page d'accueil de la plateforme -->


<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/style.css">
  </head>

  <body class="accueil">
    <header>
      <img src="img/logo.png" alt="GBAF" class="gbaf">
      <h1>Groupement Banque-Assurance Français</h1>
    </header>
    <main>
      <section>
        <p class="intro">Le GBAF regroupe six des plus importants acteurs du secteur de la banque et de l'assurance en France :</p>
        <ul class=listeActeurs>
          <li>BNP Paribas</li>
          <li>BPCE</li>
          <li>Le Crédit Agricole</li>
          <li>Le Crédit Mutuel / CIC</li>
          <li>La Société Générale</li>
          <li>La Banque Postale</li>
        </ul>
        <p>
          Le GBAF est le représentant de la profession bancaire et des assureurs sur tousles axes de la réglementation financière française. 
          Sa mission est de promouvoirl'activité bancaire à l’échelle nationale. 
          C’est aussi un interlocuteur privilégié des pouvoirs publics pour représenter ce secteur d'activité.
        </p>
      </section>
      
        <?php 
            include("database.php");
            include("listePartenaires.php");
        ?>
      
    </main>
    <footer>
      <ul>
        <li><a href="legal.html">Mentions légales</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul>
    </footer>
  </body>
</html>
