
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GBAF</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <?php require "header.php"; ?>
    <main>
      <h1 class="titre-blanc">GROUPEMENT BANQUE-ASSURANCE FRANÇAIS</h1>
      <h3>Bienvenue sur notre plateforme</h3>
      <section>
        <img src="img/business-04.jpg" alt="pub" class="pub">
        <h5 class="partenaires">
          <br />Le Groupement Banque-Assurance Français est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. 
          Sa mission est de promouvoirl'activité bancaire à l’échelle nationale.
          C’est aussi un interlocuteur privilégié des pouvoirs publics pour représenter ce secteur d'activité.
        </h5>
        <p class="partenaires titre-blanc">
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
      <?php require "database.php"; ?>
        <section>
          <h2 class="nosPart titre-blanc">Les partenaires du GBAF</h2>
          <div class="partenaires flex-container">
            <div>
              <a href="partenaires/partenaire01.php"><img src="img/formation_co.png" alt="partenaire01" class="logo"></a>
            </div>
            <div>
              <p class="titre-blanc">
                Formation & Co est une association française présente sur tout le territoire.
                Son but est de permettre à des personnes issues de tout milieu de devenir entrepreneur
                grâce à un crédit et un accompagnement professionnel et personnalisé. <br />
              </p>
              <div><a href="partenaires/partenaire01.php" class="suite">Lire la suite...</a></div>
            </div>
          </div>
          <div class="partenaires flex-container">
            <div>
              <a href="partenaires/partenaire02.php"><img src="img/protectpeople.png" alt="partenaire02" class="logo"></a>
            </div>
            <div>
              <p class="titre-blanc">
                En appliquant le principe édifié par la Sécurité Sociale française en 1945,
                Protect People finance la solidarité nationale
                pour permettre à chacun de bénéficier d’une protection sociale.<br>
                <a href="partenaires/partenaire02.php" class="suite">Lire la suite...</a>
              </p>
            </div>
          </div>
          <div class="partenaires flex-container">
            <div>
              <a href="partenaires/partenaire03.php"><img src="img/Dsa_france.png" alt="partenaire03" class="logo"></a>
            </div>
            <div>
              <p class="titre-blanc">
                DSA-France accélère la croissance du territoire
                et s’engage avec les collectivités territoriales pour
                accompagner les entreprises dans les étapes clés de leur évolution.<br />
                <a href="partenaires/partenaire03.php" class="suite">Lire la suite...</a>
              </p>
            </div>
          </div>
          <div class="partenaires flex-container">
            <div>
              <a href="partenaires/partenaire04.php"><img src="img/CDE.png" alt="partenaire04" class="logo"></a>
            </div>
            <div>
              <p class="titre-blanc">
                La Chambre Des Entrepreneurs (CDE) accompagne les entreprises
                dans leurs démarches de formations<br />
                <a href="partenaires/partenaire04.php" class="suite">Lire la suite...</a>
              </p>
            </div>
          </div>
        </section>
      </main>
    <?php require "footer.php";?>
</html>