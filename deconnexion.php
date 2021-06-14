<?php
	//détruire la session
	session_start();
	if (isset($_SESSION['id']) && isset($_SESSION['username']))
	{
		$_SESSION = array();
		session_destroy();
	}
	//retour à la page de connexion
	header('Location: connexion.php');
?>
