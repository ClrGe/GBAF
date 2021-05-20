<?php
	session_start();
	if (isset($_SESSION['id']) && isset($_SESSION['username']))
	{
		$_SESSION = array();
		session_destroy();
	}
	header('Location: connexion.php');
?>