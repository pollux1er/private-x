<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();
	
	// inclusion des utilitaires pour usage 
	include_once "../config.inc.php";
	include_once __includes_path__."/dao/config.inc.php";
	include_once __includes_path__."/dao/db.class.php";
	include_once __includes_path__."/dao/entity.class.php";
	include_once __includes_path__."/sms/sms.class.php";
	
	$sms = new sms($_SESSION['sender_number']);
	//$sms->construct($_SESSION['sender_number'], $_SESSION['dest_number'], $_SESSION['message'], 'error'); // ?? pas besoin de call le construteur je crois
	// verification de la sauvegarde du sms dans la BDD
	if ($sms->send_sms($_SESSION['dest_number'], $_SESSION['message'])) {
		// Envoi du sms une fois avec sa sauvegarde automatique dans le bd
		// redirection sur l'étape 9
		header('location:../main.php?step=9');	
	} else {
		
	}
	
} else {
	
}
?>