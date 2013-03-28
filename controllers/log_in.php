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
	
	$user = new users();
	
	// Si non alors il peut envoyer son SMS d'abord
	header('location:../main.php?step=6');
	
	// Si oui il entre son mot de passe et se connecte une fois
	
	
	//header('location:index.php?step=5');
} else {

}
?>