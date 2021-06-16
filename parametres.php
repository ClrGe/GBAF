<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  // le visiteur doit être connecté pour accéder au contenu
  if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    die();
  }
  else {
	$id_user = $_SESSION['id'];
	// Se connecter à la bdd pour récupérer les infos utilisateur
    require "templates/database.php";
	$req = $bdd->prepare('SELECT id, username, nom, prenom, password, question, reponse FROM user WHERE id = :id');
	$req->execute(array(
	    'id' => $id_user));
	$resultat = $req->fetch();
}
if (isset($_POST['id']) && isset($_POST['username'])  && isset($_POST['prenom'])  && isset($_POST['nom']) && isset($_POST['password']) && isset($_POST['question']) && isset($_POST['reponse'])) {
    $id = $_POST['id'];
    $username = htmlspecialchars($_POST['username']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $password = htmlspecialchars($_POST['password']);
    $question = htmlspecialchars($_POST['question']);
    $reponse = htmlspecialchars($_POST['reponse']);
    $req = $bdd->prepare('SELECT password FROM user WHERE id = :id');
    $req->execute(array(
        'id' => $id_user
    ));
    $resultat = $req->fetch();
    if ($password == $resultat['password']) {
        $password_hash = $password;
          } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        }
    }
  if(isset($_POST['username'],  $_POST['prenom'], $_POST['nom'], $_POST['password'], $_POST['question'], $_POST['reponse']))
  {
      if(empty($_POST['password'])){
          echo "Veuillez renseigner votre mot de passe";
      }
      elseif(strlen($_POST['password'])>40){
          echo "Votre mot de passe est trop long";
      }
      elseif(strlen($_POST['password'])<6){
          echo "Votre mot de passe doit comporter au moins 6 caractères";
      }
      elseif(empty($_POST['prenom'])){
          echo "Veuillez renseigner votre prenom";
      }
      elseif(empty($_POST['reponse'])){
          echo "Veuillez répondre à la question secrète";
      }
      else{
        $req = $bdd->prepare('UPDATE user SET username = :username,  prenom = :prenom, nom = :nom, password = :password, question = :question, reponse = :reponse WHERE id = :id');
        $req->execute(array(
            'id' => $id_user,
            'username' => $username,
            'prenom' => $prenom,
            'nom' => $nom,
            'password' => $password_hash,
            'question' => $question,
            'reponse' => $reponse
        ));
        $req->closeCursor();
    }
}
        require "templates/head.php";
        require "templates/header.php";
    ?>
        <div>
            <form class="formConnexion parametres" action="parametres.php" method="post">
                <h1 class="black compte">Mon compte</h1>
                <a href="index.php" class="white">Retour</a><hr>
                <div class="champs">
                    <input type="hidden" name="id_user" value="<?php echo $resultat['id_user']; ?>">
                </div>
                <div class="champs">
                    <label for="username"><b></b><br /></label>
                    <br /><h3 class="black"><?php echo $resultat['username'] . ' '; ?></h3>
                </div>
                <div class="champs">
                    <label for="prenom"><b>Prénom</b><br /></label>
                    <input type="text" value='<?php echo $resultat['prenom'] ?>' name="prenom" required><br />
                </div>
                <div class="champs">
                    <label for="prenom"><b>Nom de famille</b><br /></label>
                    <input type="text" value='<?php echo $resultat['nom'] ?>' name="nom" required><br />
                </div>
                <div class="champs">
                    <label for="question"><b>Question secrète</b><br /></label>
                    <select name="question">
                        <option>Quel est votre plat préféré ?</option>
                        <option>Comment s'appelait votre premier animal de compagnie ?</option>
                        <option>Quelle est votre destination de voyage de rêve ?</option>
                        <option>Dans quelle ville votre père est-il né ?</option>
                    </select>
                </div>
                <div class="champs">
                    <label for="reponse"><b>Réponse</b><br /></label>
                    <input type="password" value='<?php echo $resultat['reponse'] ?>' name="reponse" required><br />
                    <br /><input type="submit" id='submit' value='Modifier mon compte' ><br />
                </div>
            </form>
        </div>
    <?php require "templates/footer.php"; ?>
