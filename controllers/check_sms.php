<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();
	$_SESSION['message'] = $_POST['message'];
	
	// inclusion des utilitaires pour usage 
	include_once "../config.inc.php";
	include_once __includes_path__."/dao/config.inc.php";
	include_once __includes_path__."/dao/db.class.php";
	include_once __includes_path__."/dao/entity.class.php";
	include_once __includes_path__."/sms/sms.class.php";
	
	db::connexion();
	// 
	$sms = new sms();
	$sms->setMessage($_SESSION["message"]);
	// vérification de la validité de message
	if ($sms->validateMessage()) {
		// 
		header('location:../main.php?step=8');
	} else {
		header('location:../main.php?step=7');	
	}
} else {

}
?>