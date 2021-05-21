<?php session_start(); ?>

<!DOCTYPE html>
<?php session_start();?>
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
    <?php
        try
        {
          $bdd = new PDO('mysql:host=localhost;dbname=extranetGBAF;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());
        }
        if (isset($_POST['id_partenaires']) && isset($_POST['id_user']) && isset($_POST['auteur']) && isset($_POST['commentaires'])) {
          $id_partenaires = $_POST['id_partenaires'];
          $id_user = $_POST['id_user'];
          $commentaire = htmlspecialchars($_POST['commentaires']);
        $req = $bdd->prepare("INSERT INTO commentaires(id_user, id_partenaires, auteur, date_com, commentaires) VALUES(:id_user, :id_partenaires, :auteur, :date_com, :commentaires)");
           $req->execute(array(
               'id_user' => $id_user,
               'id_partenaires' => $id_partenaires,
               'auteur' => $auteur,
               'date_com' => $NOW(),
               'commentaires' => $commentaires));
               $req->closeCursor();
        }
      ?>
    <main>
      <h4> Donnez votre avis sur cet organisme et les services proposés en postant un commentaire !</h4> <br />
      <form action="commenter.php" method="post">
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
      <div class="flex-footer">
          <div class="button"><a href="../contact.html">Contact</a></div>
          <div class="button"><a href="../legal.html">Mentions légales</a></div>
        </div>
    </footer>
</html>
