<?php

class entity {

	var $_result;

	/**
	 *
	 */
	function cleanData($data) {
		return db::getInstance()->quote($data);	
	}

	/*
	 * Method to make a single insertion in the database
	 * @param string		the query in a string
	 * @return integer 	the number of row affected or 0 if no save was done
	 */
	public function __insert($requete, $motif = null) {
		//var_dump($requete); die;
		try {
			db::getInstance()->exec("set names utf8");
			$this->_result = db::getInstance()->exec($requete);
			if(db::traceSQL) db::traceSQL($requete, $motif);
		} catch(PDOException $exception) {
			echo "Erreur de la requete : " . $exception->getMessage() . "<br>";
			echo "<pre>". var_dump(db::getCon()->errorInfo()) . "</pre>";
		}
		return ( $this->_result ) ? $this->_result : 0;
	}
	
	/*
	 * Method to make multiple insertion at a time
	 * Return 
	 */
	public function __multiInsert($table, $champsbd, $valeurs) {
		$champs = $this->ConstruitChamps($champsbd);
		$requete = "INSERT INTO " . $table . " SET " . $champs; 
		$etat = db::getInstance()->prepare($requete);
		foreach($valeurs as $val) {
			for($i = 1, $j = 0; $i <= count($champsbd); $i++, $j++) {
				$etat->bindParam($i, $val[$j]);
			}
			$etat->execute();
		}
	}
	
	/*
	 * Méthode qui tranforme en chaine de caractère le tableau des champs pour l'insertion dans la base de données
	 */
	private function __construitChamps($champsbd) {
		$champs = null;
		foreach($champsbd as $champ) {
			$champs .= $champ . " = ?, ";
		}
		return substr($champs, 0, strlen(rtrim($champs))-1);
	}
	
	/*
	 *Méthode de sélection
	 */
	public function __select($requete, $motif = null) {
		try {
			// if($this->traceSQL == true) {
				// include_once 'fichier.class.php';
				// $log = new fichier();
				// $log->logAction($log->sqlLogsFile, $requete);
			// }
			//if(!is_null($motif)) $this->traceSQL($requete, $motif);
			//is_null($motif) ? : $this->traceSQL($requete, $motif);
			db::getCon()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if(preg_match("/date/", $requete)) {
				$this->sql("SET lc_time_names = 'fr_FR';");
			}
			$st = db::getInstance()->query($requete);
		} catch (PDOException $e) {
			echo "Erreur de la requete : " . $e->getMessage() . "<br>";
			echo "<pre>". var_dump(db::getCon()->errorInfo()) . "</pre>";
		}
		
		return $st->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function __count($table) {
		$statement = db::getInstance()->prepare("SELECT * FROM $table");
		$statement->execute();
		return $count = $statement->rowCount();
	}
	
	public function __countResult($request) {
		$statement = db::getInstance()->prepare($request);
		// Reflection::export(new ReflectionObject($statement));
		//var_dump(Reflection::export(new ReflectionObject($statement))); die;
		$statement->execute();
		return $count = $statement->rowCount();
	}
	
	/*
	 * Method to get the id of the last insertion
	 * @return integer	the value of the last inserted id
	 */
	public function __lastId() {
		return db::getInstance()->lastInsertId();
	}
	
	/** Methode permettant de construire une requete d'insertion */
	protected function __buildInsertQuery($data, $table) {
		$fields = '';
		$values = '';
		foreach($data as $k => $v) {
			$fields .= "$k, ";
			($v == '') ? $values .= "NULL, " : $values .= "'$v', ";
		}
		$fields = removeLastChar($fields);
		$values = removeLastChar($values);
		$query = "SET FOREIGN_KEY_CHECKS=0; INSERT INTO $table($fields) VALUES($values);";
		return $query;
	}
	
	/** Methode permettant de construire une requete d'edition */
	protected function __buildUpdateQuery($data, $table, $idRecordToUpdate, $primarykeyName = NULL) {
		$updates = '';
		$query = "UPDATE $table SET ";
		foreach($data as $k => $v) {
			if($k != "$primarykeyName")
				$updates .= ($v == '') ? "$k = NULL, " : "$k = '$v', ";
		}
		$updates = removeLastChar($updates);
		$query .= " $updates WHERE $primarykeyName = '$idRecordToUpdate';";
		return $query;
	}
	
	public function __getPrimaryKey($table) {
		$sql = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";
		$res = $this->select($sql);
		return $res[0]->Column_name;
	}
	
	
	/** Methode permettant de construire une requete d'edition */
	protected function __buildUpdateQueryWhere($data, $table, $idRecordToUpdate = NULL) {
		$updates = '';
		$query = "UPDATE $table SET ";
		foreach($data as $k => $v) {
			if($k != 'identificador')
				$updates .= ($v == '') ? "$k = NULL, " : "$k = '$v', ";
		}
		$updates = removeLastChar($updates);
		$query .= " $updates WHERE identificador = '$idRecordToUpdate';";
		return $query;
	}
	
	public function __cleanQuery($donnee) {
		//echo "cote gpc"; var_dump(get_magic_quotes_gpc());
		return get_magic_quotes_gpc() ? $this->getInstance()->quote($donnee) : $donnee;
		
	}
	/*
	 Methode pour nettoyer les valeurs entrees dans un formulaire
	*/
	public function cleanData($donnee) {
				
	}
	
	/*
	 * Method to make a single insertion in the database
	 * @param string		the query in a string
	 * @return integer 	the number of row affected or 0 if no save was done
	 */
	public function update($requete) {
		return $this->insert($requete);
	}
}
?>