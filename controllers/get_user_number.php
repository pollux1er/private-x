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
	
	if ($user->isRegistered()) {
		$_SESSION["error"]["sender_number"] = "<p>Veuillez vous connecter. Votre numéro a déjà été enregistré<p>";
		//die;
		header('location:../main.php?step=3');
	} else { }
	// selection de tous les country afin de voir le numéro est autorisé. On ne sait trop jamais
	$country = new country();
	$countries = $country->select();
	$ind_numbers = $country->store_indnum_in_stack($countries);
	
	// Detecter si une verification a deja eu lieu
	if ($user->hasAlreadyReceivedCode()) {
		
		$_SESSION["error"]["sender_number"] = "<p>Veuillez entrer votre code de verification.<p>";
		//die;
		header('location:../main.php?step=2'); die;
	} else { }
	
	
	// Detecter de kel pays est l'internaute et enregistre son numero dans la BD
	$ind_num = (isset($_POST["ind_num"])) ? trim($_POST["ind_num"]) : "";
	$bool = explode ($ind_num, $user->getNum_tel());
	if (count($bool) == 2) {
		for ($i=0; $i<count($ind_numbers); ) {
			if ($ind_num == $ind_numbers[$i]) {
				break;
			} else { $i++; }
		}
		$user->setCountry($countries[$i]["country"]);
		$user->generate_check_code();
		$user->save_new();	
		// --- fonction d'envoie du SMS
		include_once __includes_path__."/sms/sms.class.php";
		$user->send_check_code();
	} else {  }
	
	// Conduire l internaute a letape 2 pour kil verifie son numero 
	header('location:../main.php?step=2');
} else {

}
?>