<?php

/**
 * classe correspondant à la table SMS
 */
class sms {

	var $table = __CLASS__;
	var $id;
	var $id_em;
	var $num_tel_em;
	var $num_tel_recep;
	var $message;
	var $error_status;
	var $adr_ip_em;
	
	
	/**
	 * constructeur de la classe user
	 */	
	function __construct($id, $em, $num_tel_em, $num_tel_recep, $mess, $adr, $error) {
		$this->setId($id);
		$this->setId_em($em);
		$this->setNum_tel_em($num_tel_em);
		$this->setNum_tel_recep($num_tel_recep);
		$this->setMessage($mess);
		$this->setError($error);
		$this->setAdr_ip_em($adr);
	}
	
	/**
	 * fonctions set de tous les attributs de la classe
	 */
	function setId($id) { $this->id = $id; }
	function setId_em($id_em) { $this->id_em = $id_em; }
	function setNum_tel_em($num) { $this->num_tel_em = $num; }
	function setNum_tel_recep($num) { $this->num_tel_recep = $num; }
	function setMessage($mess) { $this->message = $mess; }
	function setError($err) { $this->error = $err; }
	function setAdr_ip_em($adr) { $this->adr_ip_em = $adr; }
	
	/**
	 * fonction pour nettoyer toutes les données qui vont dans la BDD
	 */
	function cleanNum_tel_em() { $this->num_tel_em = parent::cleanData($this->num_tel_em); }
	function cleanNum_tel_recep() { $this->num_tel_recep = parent::cleanData($this->num_tel_recep); }
	function cleanMessage() { $this->message = parent::cleanData($this->message); }
	function cleanError() { $this->error = parent::cleanData($this->error); }
	
	/**
	 *
	 */
	function cleanAll_data() {
		$this->cleanNum_tel_em();
		$this->cleanNum_tel_recep();
		$this->cleanMessage();
		$this->cleanError();
		$this->cleanAdr_ip_em();
	}
	
	/**
	 * fonction qui permet de valider le numéro de téléphone de l'emetteur
	 * @return boolean
	 */
	function validateNum_tel_em() {
		
	}
	
	
	/**
	 * insère dans la BDD un nouvel utilisateur
	 * @return
	 */
	function save_new() {
		
		return parent::__insert($query);
	}
	
	/**
	 * selectionne un user spécifique avec certains paramètres
	 */
	function select() {
		
	}
}

?>