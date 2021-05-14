<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page de connexion - GBAF</title>
        <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
    </head>
    <body>
        <header>
            <img class="center" src="img/logo.png" alt="GBAF">
        </header>
        <?php include("database.php");?>
        <?php
            if (isset($_POST['username']) && isset($_POST['password']))
            {
                $query = getPdo()->prepare('SELECT * FROM membres WHERE username = :username LIMIT 1');
                $query->execute(['username' => $_POST['username']]);
                $result = $query->fetch();
            }
            if (! $result) {
                $errors->set('username', 'Identifiant ou mot de passe incorrect');
                $form->set('username', $_POST['username']);
            }
            else if (! password_verify($_POST['password'], $result['password'])) {
                $form->set('username', $_POST['username']);
                $errors->set('username', 'Identifiant ou mot de passe');
            }
            else {
                Member::createSession($result);
                exit;
            }
        ?>
        <?php if ($member->isLogged() === false): ?>

        <div id="connexion">                   
            <form class="formConnexion" action="connexion.php" method="POST">
                <h1 class="white">SE CONNECTER</h1>  
                <div class="champs">
                    <label for="username"><b>Identifiant</b><br /></label>
                    <input type="text" placeholder="Saisissez votre nom d'utilisateur" name="username" id="username" value="<?= $form->get('username'); ?>" required><br />
                    <?php if ($errors->has('username')): ?>
                        <p class="text-error"><?= $errors->get('username') ?></p>
                    <?php endif; ?>
                </div>
                <div class="champs">
                    <label for="password"><b>Mot de passe</b></label><br />
                    <input type="password" id="password" placeholder="Saisissez votre mot de passe" name="password" required><br />
                </div>
                <div class="champs">            
                    <label for="checkbox"><input type="checkbox" id="checkbox">Afficher le mot de passe</label><br />
                </div>
                    <button type="submit" class="btn btn-primary mt-3 champs">Connexion</button>

                    <br />
                    <a class="inscription" href="inscription.php"> Pas encore inscrit ? Cliquez ici pour <strong>créer un compte</strong></a><br />
                    <br/><a href="identification.php"> Mot de passe oublié ?</a>
            </form>
            <?php else: ?>

            <div class="alert-info">Impossible de se connecter.</div>

            <?php endif; ?>

        </div>
    </body>
</html>