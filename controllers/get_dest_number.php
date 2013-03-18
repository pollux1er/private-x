<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();
	$dest_number = $_POST['expediteur'];
	$_SESSION['dest_number'] = $dest_number;
	
	// inclusion des utilitaires pour usage 
	include_once "../config.inc.php";
	include_once __includes_path__."/dao/config.inc.php";
	include_once __includes_path__."/dao/db.class.php";
	include_once __includes_path__."/dao/entity.class.php";
	include_once __includes_path__."/dao/country.class.php";
	include_once __includes_path__."/dao/users.class.php";
	
	db::connexion();
	
	$user = new users();
	$user->setNum_tel($dest_number);
	// selection de tous les country afin de voir le numéro est autorisé. On ne sait trop jamais
	$country = new country();
	$countries = $country->select();
	$ind_numbers = $country->store_indnum_in_stack($countries);
	
	// Detecter de kel pays est l'internaute et enregistre son numero dans la BD
	$ind_num = (isset($_POST["ind_num"])) ? trim($_POST["ind_num"]) : "";
	// on verifie la validité du numéro du destinataire
	if ($user->validateNum_tel()) {
		$bool = explode ($ind_num, $user->getNum_tel());
		if (count($bool) == 2) {
			for ($i=0; $i<count($ind_numbers); ) {
				if ($ind_num == $ind_numbers[$i]) {
					break;
				} else { $i++; }
			}
			// si le numéro commence bien par un des indicatifs 
			if ($i < count($ind_numbers)) {
				$_SESSION['dest_number'] = $dest_number;  // deja repete plus haut ligne 5
				header('location:../main.php?step=7'); die;
			} else {  
				header('location:../main.php?step=6');
			}
		} else {  
			header('location:../main.php?step=6');
		}
	} else {
		header('location:../main.php?step=6');
	}
} else {
	
}
?>