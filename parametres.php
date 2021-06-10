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
  $req = $bdd->prepare('SELECT id, username, password, email, question, reponse FROM user WHERE id = ?');
  if(isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['question'], $_POST['reponse']))
  {
      if(empty($_POST['username'])){
          echo "Veuillez renseigner votre nom d'utilisateur";
      }
      elseif(strlen($_POST['pseudo'])>20){
          echo "Votre nom d'utilisateur ne doit pas dépasser 20 caractères";
      }
      elseif(empty($_POST['password'])){
          echo "Veuillez renseigner votre mot de passe";
      }
      elseif(strlen($_POST['password'])>40){
          echo "Votre mot de passe est trop long";
      }
      elseif(strlen($_POST['password'])<6){
          echo "Votre mot de passe doit comporter au moins 6 caractères";
      }
      elseif(empty($_POST['email'])){
          echo "Veuillez renseigner votre adresse e-mail";
      }
      elseif(empty($_POST['reponse'])){
          echo "Veuillez répondre à la question secrète";
      }
      else{
          $req = $bdd->prepare("INSERT INTO user(username, password, email, question, reponse) VALUES(:username, :password, :email, :question, :reponse)");
          $req->execute(array(
              'username' => htmlspecialchars($_POST['username']),
              'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
              'email' => htmlspecialchars($_POST['email']),
              'question' => htmlspecialchars($_POST['question']),
              'reponse' => htmlspecialchars($_POST['reponse'] )));
          }
      $req->closeCursor();
  }
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
            <form class="formConnexion parametres" action="parametresEdit.php" method="post">
                <h1 class="white">Mon compte</h1>
                <a href="index.php">Revenir à l'accueil</a>
                <div class="champs">
                    <label><b>Nom d'utilisateur</b><br /></label>
                    <br /><h3><?php echo $_SESSION['username'] . ' '; ?></h3><br />
                </div>
                <div class="champs">
                    <label><b>Mot de passe</b></label><br />
                    <input type="password" placeholder="Nouveau mot de passe..." name="password" id="password" required><br/>
                </div>
                <div class="champs">
                    <label><b>Confirmer le mot de passe</b></label><br />
                    <input type="password" placeholder="Confirmez le mot de passe..." name="confirmPassword" required><br />
                </div>
                <div class="champs">
                    <label><b>Adresse Email</b><br /></label>
                       <input type="text" placeholder="Votre adresse email..." name="email" id="email" required><br />
                </div>
                <div class="champs">
                    <label><b>Question secrète</b><br /></label>
                    <?php echo $_SESSION['question'] . ' '; ?>
                </div>
                <div class="champs">
                    <label><b>Réponse</b><br /></label>
                    <input type="text" placeholder="Réponse à la question secrète..." name="reponse" required><br />
                    <br /><input type="submit" id='submit' value='Modifier mon compte' ><br />
                </div>
            </form>
        </main>
    <?php include("footer.php"); ?>