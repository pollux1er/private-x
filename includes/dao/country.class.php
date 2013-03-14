<?php

class country extends entity {

	var $table = __CLASS__;
	var $id;
	var $country;
	var $ind_num;
	var $status;
	
	/**
	 * constructeur de la classe
	 * @param id
	 * @param $country
	 * @param $ind_num
	 * @param $status
	 *
	 * @return
	 */
	function construct($id, $country, $ind_num, $status) {
		$this->setId($id);
		$this->setCountry($country);
		$this->setInd_num($ind_num);
		$this->setStatus($status);	
	}
	
	/**
	 * fonctions set de toutes les variables
	 */
	function setId($id) { $this->id = $id; }
	function setCountry($country) { $this->country = $country; }
	function setInd_num($num) { $this->ind_num = $num; }
	function setStatus($status) { $this->status = $status; }
	
	/**
	 * fonction qui selectionne tous les country activés dans la BDD
	 *	
	 * @return tableau de country
	 */
	function select() { 
		$query = "select * from $this->table where status='1'";
		return parent::__select($query);
	}
	
	/**
	 * sauvegarde tous les ind_num dans un pile
	 * @param $countries Liste de tous les country
	 *
	 * @return array de ind_num
	 */
	function store_indnum_in_stack($countries) {
		$ind_nums = array();
		for ($i=0; $i<count($countries); $i++) {
			array_push($ind_nums, $countries[$i]["ind_num"]);	
		}
		return $ind_nums;
	}
}

?>