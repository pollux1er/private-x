<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();
	$_SESSION['sender_number'] = $_POST['expediteur'];
	
	// inclusion des utilitaires pour usage 
	include_once "../config.inc.php";
	include_once __includes_path__."/dao/config.inc.php";
	include_once __includes_path__."/dao/db.class.php";
	include_once __includes_path__."/dao/entity.class.php";
	include_once __content_path__."/users.action.php";
	db::connexion();
	
	// Verifions si ce numero est deja enregistree 
	//var_dump(users::isRegistered($_SESSION['sender_number'])); die;
	
	// Detecter de kel pays est l'internaute et enregistre son numero dans la BD
	
	
	//$_SESSION['checkCode'] = users::generateCheckCode($_SESSION['sender_number']);
	
	
	// Conduire l internaute a letape 2 pour kil verifie son numero 
	header('location:../main.php?step=2');
} else {

}
?>