<!--affiche liste des partenaires sur la page d'accueil -->

<?php
    $req = $bdd->query('SELECT id, nom, description, logo FROM partenaires');;
        while ($donnees = $req->fetch()) {
?>
            <div class="partenaires">
                <h3><?php echo htmlspecialchars($donnees['nom']); ?></h3>
                <br /><?php echo nl2br(htmlspecialchars($donnees['description']));?><br />
                <br /><p class="voirCommentaires"><em><a href="partenaires.php?billet=<?php echo $donnees['id']; ?>">Cliquez ici pour lire la suite</a></em></p>
            </div>


<?php
} 
$req->closeCursor();
?>