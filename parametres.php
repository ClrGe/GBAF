<!DOCTYPE html>
<html lang="fr">

    <?php include("header.php");?>
        <main>                   
            <form class="formConnexion" action="parametres.php" method="post">
                <h1 class="white">Modifier mon compte</h1>  
                <div class="champs">
                    <label><b>Nom d'utilisateur</b><br /></label>
                    <input type="text" placeholder="Votre identifiant..." name="username" required><br />
                </div>
                <div class="champs">
                    <label><b>Mot de passe</b></label><br />
                    <input type="password" placeholder="Votre mot de passe..." name="password" required><br/>
                    <label for="checkbox"><input type="checkbox" id="checkbox">Afficher le mot de passe</label><br />
                </div>
                <div class="champs">
                    <label><b>Adresse Email</b><br /></label>
                       <input type="text" placeholder="Votre adresse email..." name="email" required><br />
                       <br /><a class="inscription" href="redirection.php"><input type="submit" id='submit' value='Modifier' ></a>
                       <a href="index.php">Revenir à l'accueil</a>
                </div>
            </form>         
        </main>    
    <?php include("footer.php"); ?>    
</html>