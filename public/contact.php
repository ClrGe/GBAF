<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  // le visiteur doit être connecté pour accéder au contenu
  if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    die();
  }
  require "..templates/database.php";
  require "../templates/head.php";
  require "..templates/header.php"; 
?>
    <main>
      <!--  Formulaire de contact du GBAF (cf footer) -->
      <h2 class="titre-blanc">NOUS CONTACTER</h2>
      <p class="titre-blanc">Numéro de téléphone : +33.00.00.00.00</p>
      <p class="titre-blanc">Adresse postale : 666, avenue Blip<br>00000 FRANCE</p>
    </main>
  </body>
</html>
