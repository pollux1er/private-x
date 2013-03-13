<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();
	// On verifie le code recu
	
	// On check si l'utilisateur a deja un compte
	
	// Si non alors il peut envoyer son SMS d'abord
	header('location:../main.php?step=6');
	
	// Si oui il entre son mot de passe et se connecte une fois
	
	
	//header('location:index.php?step=5');
} else {

}
?>