<?php

/**
 * classe PHP pour la manipulation de la table de user
 */
class users extends entity {

	var $table = __CLASS__;
	var $id;
	var $pseudo;
	var $passwd;
	var $num_tel;
	var $email;
	// 0='non verifié',1='verifié',
	var $status;
	var $country;
	var $reseau_tel;
	//0='non', 1='oui'
	var $registered; 
	var $check_code;
	

	/**
	 * constructeur de la classe user
	 */	
	function construct($id, $pseudo, $pwd, $numtel, $country, $email = "", $status = "", $reseau = "", $reg = "") {
		$this->setId($id);
		$this->setPseudo($pseudo);
		$this->setPasswd($pwd);
		$this->setNum_tel($numtel);
		$this->setCountry($country);
		$this->setEmail($email);
		$this->setStatus($status);
		$this->setReseau_tel($reseau);
		$this->setRegistered($reg);
	}
	
	/**
	 * fonctions set de tous les attributs de la classe
	 */
	function setId($id) { $this->id = $id; }
	function setPseudo($pseudo) { $this->pseudo = $pseudo; }
	function setPasswd($passwd) { $this->passwd = $passwd; }
	function setNum_tel($numtel) { $this->num_tel = $numtel; }
	function setEmail($email) { $this->email = $email; }
	function setStatus($status) { $this->status = $status; }
	function setCountry($country) { $this->country = $country; }
	function setResau_tel($rstel) { $this->reseau_tel = $rstel; }
	function setRegistered($reg) { $this->registered = $reg; }
	function setCheck_code($code) { $this->check_code = $code; }
	
	/**
	 * fonctions get de tous les attributs de la classe
	 */
	function getNum_tel() { return $this->num_tel; }
	
	/**
	 * fonction pour nettoyer toutes les données qui vont dans la BDD
	 */
	function cleanPseudo() { $this->pseudo = parent::cleanData($this->pseudo); }
	function cleanPasswd() { $this->passwd = parent::cleanData($this->passwd); }
	function cleanNum_tel() { $this->num_tel = parent::cleanData($this->num_tel); }
	function cleanEmail() { $this->email = parent::cleanData($this->email); }
	function cleanStatus() { $this->status = parent::cleanData($this->status); }
	function cleanCountry() { $this->country = parent::cleanData($this->country); }
	function cleanReseau_tel() { $this->reseau_tel = parent::cleanData($this->reseau_tel); }
	function cleanRegistered() { $this->registered = parent::cleanData($this->registered); }
	
	/**
	 *
	 */
	function cleanAll_data() {
		$this->cleanCountry();
		$this->cleanEmail();
		$this->cleanNum_tel();
		$this->cleanPasswd();
		$this->cleanPseudo();
		$this->cleanRegistered();
		$this->cleanReseau_tel();
		$this->cleanStatus();	
	}
	
	/**
	 * fonction qui permet de valider le pseudo
	 * @return boolean
	 */
	function validatePseudo() {
		
	}
	/**
	 * fonction qui permet de valider l'adresse mail
	 * @return boolean
	 */
	function validateEmail() {
		
	}
	/**
	 * Fonction qui permet de valider de numéro de téléphone
	 * @return boolean
	 */
	function validateNum_tel() {
		$str = explode("+", $this->num_tel);
		return true;
	}
	/**
	 * fonction qui permet de valider le mot de passe
	 * @return boolean
	 */
	function validatePasswd() {
		
	}
	
	/**
	 * insère dans la BDD un nouvel utilisateur
	 * @return
	 */
	function save_new() {
		$query = "insert into $this->table (num_tel, country, check_code) values ('".$this->num_tel."','".$this->country."','".$this->check_code."')";
		//echo "<br>$query<br>";
		return parent::__insert($query);
	}
	
	/**
	 * Envoi le code de verification a linternaute
	 *
	 */
	
	function send_check_code() {
		$sms = new sms('SMS4EVER%2ENE');
		$this->message = 'SMS4EVER.NET confirmation code : ' . $this->check_code . ".\n";
		$this->message .= "________________\n";
		$this->message .= 'Send free SMS to your friends.';
		return $sms->send_sms($this->num_tel, $this->message);
	}
	
	/**
	 *
	 */
	function update($query) {
		
		return parent::__update($query);	
	}
	
	/**
	 * selectionne un user spécifique avec certains paramètres
	 */
	function select() {
		
	}
	
	/**
	 * vérifie de le user enregistré
	 * @return boolean
	 */
	function isRegistered() {	
		if (!$this->validateNum_tel()) {
			//return array;	
		}
		$query = "SELECT registered FROM $this->table WHERE num_tel = '".$this->num_tel."' AND registered = '1';";
		return parent::__select($query);		
	}
	
	/**
	 * génère un code aléatoire pour la validation d'un user
	 */
	function generate_check_code($numchars = 6, $digits = 1, $letters = 1){
	   	$dig = "012345678923456789";
	   	$abc = "ABCDEFGHJKLMNOPQRSTUVWXYZ";
	   	$str = ''; $randomized='';
	   	if($letters == 1){
			$str .= $abc;
	   	}
	   	if($digits == 1){
			$str .= $dig;
	   	}
	
	   	for($i=0; $i < $numchars; $i++){
			$randomized .= $str{rand() % strlen($str)};
	   	}
		$this->setCheck_code($randomized);
	}
}

?>