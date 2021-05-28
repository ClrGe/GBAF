<?php
    require "database.php";
    if (isset($_POST['id_partenaires']) && isset($_POST['id_user']) && isset($_POST['auteur']) && isset($_POST['commentaires'])) {
        $id_partenaires = $_POST['id_partenaires'];
        $id_user = $_POST['id_user'];
        $commentaires = htmlspecialchars($_POST['commentaires']);
        $req = $bdd->prepare("INSERT INTO commentaires(id_user, id_partenaires, auteur, date_com, commentaires) VALUES(:id_user, :id_partenaires, :auteur, :date_com, :commentaires)");
           $req->execute(array(
               'id_user' => $id_user,
               'id_partenaires' => $id_partenaires,
               'date_com' => $NOW(),
               'commentaires' => $commentaires));
               $req->closeCursor();
    }
    header('Location: partenaire01.php');
?>