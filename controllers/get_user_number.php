<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();
	$_SESSION['sender_number'] = $_POST['expediteur'];
	
	// inclusion des utilitaires pour usage 
	include_once "../config.inc.php";
	include_once __includes_path__."/dao/config.inc.php";
	include_once __includes_path__."/dao/db.class.php";
	include_once __includes_path__."/dao/entity.class.php";
	include_once __includes_path__."/dao/country.class.php";
	include_once __includes_path__."/dao/users.class.php";

	db::connexion();
	
	// Verifions si ce numero est deja enregistree 
	//----var_dump(users::isRegistered($_SESSION['sender_number'])); die;
	$user = new users();
	$user->setNum_tel($_SESSION['sender_number']);
	if (var_dump($user->isRegistered())) {
		$_SESSION["error"]["sender_number"] = "<p>Veuillez vous connecter. Votre numéro a déjà été enregistré<p>";
		die;
	} else { }
	// selection de tous les country afin de voir le numéro est autorisé. On ne sait trop jamais
	$country = new country();
	$countries = $country->select();
	$ind_numbers = $country->store_indnum_in_stack($countries);
	
	// Detecter de kel pays est l'internaute et enregistre son numero dans la BD
	
	
	//$_SESSION['checkCode'] = users::generateCheckCode($_SESSION['sender_number']);
	
	
	// Conduire l internaute a letape 2 pour kil verifie son numero 
	header('location:../main.php?step=2');
} else {

}
?>