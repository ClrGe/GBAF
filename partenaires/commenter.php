<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
  </head>

  <body>
    <header id="header" class="border">
      <ul class="settings">
          <li class="black"><i></i> <strong> Utilisateur </strong> </li>
          <li class="black"><a class="black" href="../parametres.php"><i></i>Paramètres du compte</a></li>
          <li class="black"><a class="black" href="../connexion.php"><i></i>Deconnexion</a></li>
      </ul>
        <a href="../index.php"><img src="../img/logo.png" alt="GBAF" class="gbaf"></a>
    </header>
    <main>
      <h4> Donnez votre avis sur cet organisme et les services proposés en postant un commentaire !</h4> <br />
      <form action="" method="post">
        <label for="commentaire"></label>
        <textarea id="commentaire" rows="3" placeholder="Écrivez ici votre commentaire..." name="commentaire" required></textarea>
        <input type="submit" name="publier" value="Publier">
      </form>
    </main>
    <footer>
      <div class="flex-footer">
          <div class="button"><a href="../contact.html">Contact</a></div>
          <div class="button"><a href="../legal.html">Mentions légales</a></div>
        </div>
    </footer>
</html>
