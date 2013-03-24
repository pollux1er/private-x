<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();
	
	include_once "../config.inc.php";
	include_once __includes_path__."/dao/config.inc.php";
	include_once __includes_path__."/dao/db.class.php";
	include_once __includes_path__."/dao/entity.class.php";
	include_once __includes_path__."/dao/country.class.php";
	include_once __includes_path__."/dao/users.class.php";
	

	db::connexion();
	// On verifie le code recu
	
	// On check si l'utilisateur a deja un compte
	$user = new users();
	if (!$user->checkUserCode($_POST['code'])) {
		
		$_SESSION["error"]["sender_number"] = "<p>Veuillez entrer le code verification recu par SMS.<p>";
		//die;
		header('location:../main.php?step=2'); die;
	} else {
		// On coche lutilisateur comme enregistre sur le site en sauvegardant son code comme mot de passe
		
	}
	
	// Si non alors il peut envoyer son SMS d'abord
	header('location:../main.php?step=6');
	
	// Si oui il entre son mot de passe et se connecte une fois
	
	
	//header('location:index.php?step=5');
} else {

}
?>