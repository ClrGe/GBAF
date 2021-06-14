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
    <title>GBAF</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <?php require "header.php";?>
    <main>
      <!--  Formulaire de contact du GBAF (cf footer) -->
      <h2 class="titre-blanc">NOUS CONTACTER</h2>
      <p class="titre-blanc">Numéro de téléphone : +33.00.00.00.00</p>
      <p class="titre-blanc">Adresse postale : 666, avenue Blip<br>00000 FRANCE</p>
    </main>
  </body>
</html>
