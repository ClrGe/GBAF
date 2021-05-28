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
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <header id="header" class="border">
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
        <a href="../index.php"><img src="../img/logo.png" alt="GBAF" class="gbaf"></a>
    </header>
    <main>
      <h4> Donnez votre avis sur cet organisme et les services proposés en postant un commentaire !</h4> <br />
      <form action="commenter-post.php" method="post">
        <input type="hidden" name="id_partenaires" value="<?php echo $id_partenaires; ?>"/>
        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user'] ?>"/>
        <input type="hidden" name="auteur" value="<?php echo $auteur; ?>/>
        <label for="commentaires"></label><br />
        <br /><textarea id="commentaires" rows="3" placeholder="Écrivez ici votre commentaire..." name="commentaires" required></textarea>
        <input type="submit" name="publier" value="Publier">
      </form>
      <a href="../index.php"><em>Retour à l'accueil></em></a>
    </main>
    <footer>
      <div class="flex-footer bg-red">
          <div class="button"><a href="../contact.html">Contact</a></div>
          <div class="button"><a href="../legal.html">Mentions légales</a></div>
        </div>
    </footer>
</html>