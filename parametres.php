
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
                <h1 class="white">Modifier mon compte</h1>
                <a href="index.php">Revenir à l'accueil</a>
                <div class="champs">
                    <label><b>Nom d'utilisateur</b><br /></label>
                    <input type="text" placeholder="Votre identifiant..." name="username" id="username" required><br />
                </div>
                <div class="champs">
                    <label><b>Mot de passe</b></label><br />
                    <input type="password" placeholder="Votre mot de passe..." name="password" id="password" required><br/>
                </div>
                <div class="champs">
                    <label><b>Adresse Email</b><br /></label>
                       <input type="text" placeholder="Votre adresse email..." name="email" id="email" required><br />
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
                    <br /><input type="submit" id='submit' value='Modifier mon compte' ><br />
                </div>
            </form>
        </main>
    <?php include("footer.php"); ?>