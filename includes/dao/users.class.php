<?php

/**
 * classe PHP pour la manipulation de la table de user
 */
class users extends entity {

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
	

	/**
	 * constructeur de la classe user
	 */	
	function __construct($id, $pseudo, $pwd, $numtel, $country, $email = "", $status = "", $reseau = "", $reg = "") {
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
		$query_params = "";
		$query_params_values = "";
		// si l'email est renseigné, on doit l'inclure dans la requete
		if ($this->email != "" && $this->email != null) {
			$query_params .= ", email";
			$query_params_values .= ", '".$this->email."'"; 
		} else {  }
		// si le status est renseigné, on doit l'inclure dans la requete
		if ($this->status != "" && $this->status != null) {
			$query_params .= ", status";
			$query_params_values .= ", '".$this->status."'"; 
		} else {  }
		// si le reseau telephonique est renseigné, on doit l'inclure dans la requete
		if ($this->reseau_tel != "" && $this->reseau_tel != null) {
			$query_params .= ", reseau_tel";
			$query_params_values .= ", '".$this->reseau_tel."'"; 
		} else {  }
		// si le registered est renseigné, on doit l'inclure dans la requete
		if ($this->registered != "" && $this->registered != null) {
			$query_params .= ", registered";
			$query_params_values .= ", '".$this->registered."'"; 
		} else {  }
		$query = "insert into $table (pseudo, passwd, num_tel, country $query_params) values ('".$this->pseudo."', '".$this->passwd."', '".$this->num_tel."', '".$this->country."' $query_param_values)";
		return parent::__insert($query);
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
	function isRegistered($numero) {
		$query = "SELECT registered FROM entity::table WHERE num_tel = '".$numero."'";
		return parent::__select($query);		
	}
}

?>