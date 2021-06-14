<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  // le visiteur doit être connecté pour accéder au contenu
  if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    die();
  }
  require "templates/database.php";
?>
<?php
    if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['prenom'])  && isset($_POST['nom']) && isset($_POST['question']) && isset($_POST['reponse'])) {
        $id = $_POST['id'];
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $question = htmlspecialchars($_POST['question']);
        $reponse = htmlspecialchars($_POST['reponse']);
        $req = $bdd->prepare('SELECT password FROM user WHERE id = :id');
        $req->execute(array(
            'id' => $id
        ));
        $resultat = $req->fetch();
        if ($password == $resultat['password']) {
            $password_hash = $password;
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
        }
        $req = $bdd->prepare('UPDATE user SET username = :username, password = :password, prenom = :prenom, nom = :nom, question = :question, reponse = :reponse WHERE id = :id');
        $req->execute(array(
            'id' => $id,
            'username' => $username,
            'password' => $password_hash,
            'prenom' => $prenom,
            'nom' => $nom,
            'question' => $question,
            'reponse' => $reponse
        ));
        $req->closeCursor();
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
          $req = $bdd->prepare("INSERT INTO user(username, prenom, nom, password, question, reponse) VALUES(:username, :prenom, :nom, :password, :question, :reponse)");
          $req->execute(array(
              'username' => htmlspecialchars($_POST['username']),
              'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
              'prenom' => htmlspecialchars($_POST['prenom']),
              'nom' => htmlspecialchars($_POST['nom']),
              'question' => htmlspecialchars($_POST['question']),
              'reponse' => htmlspecialchars($_POST['reponse'] )));
          }
  }

        require "templates/head.php";
        require "templates/header.php";

    ?>
        <main>
            <form class="formConnexion parametres" action="parametres.php" method="post">
                <h1 class="white">Mon compte</h1>
                <a href="index.php">Retour</a>
                <div class="champs">
                    <label for="username"><b>Nom d'utilisateur</b><br /></label>
                    <br /><h3><?php echo $_SESSION['username'] . ' '; ?></h3><br />
                </div>
                <div class="champs">
                    <label for="prenom"><b>Prénom</b><br /></label>
                    <br /><h3><?php echo 'prenom' . ' ' ?></h3><br />
                </div>
                <div class="champs">
                    <label for="prenom"><b>Prénom</b><br /></label>
                    <br /><h3><?php echo $resultat['nom'] . ' ' ?></h3><br />
                </div>
                <div class="champs">
                    <label for="password"><b>Mot de passe</b></label><br />
                    <input type="password" placeholder="Nouveau mot de passe..." name="password" id="password" required><br/>
                </div>
                <div class="champs">
                    <label for="confirmPassword"><b>Confirmer le mot de passe</b></label><br />
                    <input type="password" placeholder="Confirmez le mot de passe..." name="confirmPassword" required><br />
                </div>
                <div class="champs">
                    <label for="question"><b>Question secrète</b><br /></label>
                    <?php echo $resultat['question'] ?>
                </div>
                <div class="champs">
                    <label for="reponse"><b>Réponse</b><br /></label>
                    <input type="text" placeholder="Réponse à la question secrète..." name="reponse" required><br />
                    <br /><input type="submit" id='submit' value='Modifier mon compte' ><br />
                </div>
            </form>
        </main>
    <?php require "templates/footer.php"; ?>