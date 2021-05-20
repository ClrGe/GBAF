<!DOCTYPE html>
<html lang="fr">
    <head>
       <meta charset="utf-8">
       <title>Créer un compte - GBAF</title>
        <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    </head>
    <body>
        <header>
            <img src="img/logo.png" alt="GBAF">
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
            if(isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['question'], $_POST['reponse']))
            {
                if(empty($_POST['username'])){
                    echo "Veuillez renseigner votre nom d'utilisateur";
                }
                elseif(strlen($_POST['pseudo'])>20){
                    echo "Votre nom d'utilisateur ne doit pas dépasser 20 caractères";
                }
                elseif(mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM membres WHERE username='".$_POST['username']."'"))==1){
                    echo "Ce nom d'utilisateur existe déjà";
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
                    $bdd->exec("INSERT INTO user(username, password, email, question, reponse) VALUES('".$_POST["username"]."', '".$_POST["password"]."', '".$_POST["email"]."', '".$_POST["question"]."', '".$_POST["reponse"]."')");
                    }
            }
        ?>

        <div id="connexion" class="space">
            <form class="formConnexion" action="inscription.php" method="post">
                <h1 class="white">CRÉER UN COMPTE</h1>
                <div class="champs">
                    <label><b>Nom d'utilisateur</b><br /></label>
                    <input type="text" placeholder="Votre identifiant..." name="username" required><br />
                </div>
                <div class="champs">
                    <label><b>Mot de passe</b></label><br />
                    <input type="password" placeholder="Votre mot de passe..." name="password" required><br />
                    <label for="checkbox"><input type="checkbox" id="checkbox">Afficher le mot de passe</label><br />
                </div>
                <div class="champs">
                    <label><b>Adresse Email</b><br /></label>
                    <input type="text" placeholder="Votre adresse email..." name="email" required><br />
                </div>
                <div class="champs">
                    <label><b>Question secrète</b><br /></label>
                    <select name="question">
                        <option>Quel est votre plat préféré ?</option>
                        <option>Comment s'appelait votre premier animal de compagnie ?</option>
                        <option>Quelle est votre destination de voyage de rêve ?</option>
                        <option>Dans quelle ville votre père est-il né ?</option>
                    </select>
                </div>
                <div class="champs">
                    <label><b>Réponse</b><br /></label>
                    <input type="text" placeholder="Réponse à la question secrète..." name="reponse" required><br />
                    <br /><a class="inscription" href="redirection.php"><input type="submit" id='submit' value='Créer un compte' ><br /></a>
                </div>
            </form>
        </div>
    </body>
</html>
