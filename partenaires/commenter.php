<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>GBAF - Nouveau Commentaire</title>
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <header>
      <a href="index.php"><img src="../img/logo.png" alt="GBAF"></a>
      <h1>Poster un commentaire</h1>
    </header>
      
    <main>
      <form action="" method="post">
        <label for="nom">Nom</label> : <input type="text" name="nom" id="nom" /><br />
        <label for="commentaire"></label>
        <textarea id="commentaire" rows="3" placeholder="Écrivez ici votre commentaire..." name="commentaire" required></textarea>
        <input type="submit" name="publier" value="Publier">
      </form>
    
      <p><strong><?php echo htmlspecialchars($_POST['nom']) ?></strong> le <?php echo date("d/m/Y") ?> à <?php echo date("H:i:s"); ?></p>
      <p><?php echo nl2br(htmlspecialchars($_POST['commentaire'])); ?></p>
    
     <?php 
          include("database.php");
          $req = $bdd->prepare('INSERT INTO commentaires(id, id_user, id_partenaires, date_com, commentaires) VALUES(:id, :nom, :id_partenaires, :date_com, :commentaire)');
          $req->execute(array(
          'id' => $_POST[''],
          'id_billet' => $_POST[''],
          'nom' => $_POST['nom'],
          'commentaire' => $_POST['commentaires'],
          'date_com' => $NOW()
               ));
      ?>
    </main>
    <footer>
      <a>Mentions légales</a>
      <a>Contact</a>
    </footer>
    <ul>
        <li><a href="../legal.html">Mentions légales</a></li>
        <li><a href="../contact.html">Contact</a></li>
  </footer>
</body>
</html>
