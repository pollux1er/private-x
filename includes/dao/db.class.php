<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Classe de traitements et layoutions sur la base de données
 * @author 		
 * @package 	
 * @since 		Version 1.0
 * @version		1.0
 * @copyright 	Copyright (c) 2011, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */

class db {

	/**
	 * Instance de notre objet BD
	 * @var string
	 */
	private static $instance = null;
	
	/**
	 * L'instance de la connexion layoutive
	 * @var string
	 */
	private static $con = null;
	private static $dsn = null;
	private static $debug = true;
	
	/**
	 *
	 */
	private static function setDsn() {
		self::$dsn = "".__dbtype__.":host=".__host__.";port=".__port__.";dbname=".__dbname__."";	
	}
	
	/**
	 *
	 */
	public static function getCon() {
		return self::$con;	
	}
	
	/**
	 * Méthode pour se connecter à la bd
	 *
	 * @param	
	 * @since	1.0
	 */
	public static function connexion() {
		self::setDsn();
		try { 
			(!self::$debug) ? error_reporting(0) : error_reporting(-1);
			self::$con = new PDO(self::$dsn, __dbuname__, __dbupwd__/* , array( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true, ) */);
			self::getInstance()->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch(PDOException $e) {
			printf("Erreur de connexion : %s", $e->getMessage());
			if(!is_null(self::$con))  echo "<pre>". var_dump(self::$con->errorInfo()) . "</pre>";
			die;
		}
	}
	
	/**
	 * Méthode pour eviter de se connecter 2 fois
	 * @param	
	 * @since	1.0
	 */
	
	public static function getInstance() {
		if(!self::$con) {
			self::connexion();
		}
		return self::$con;
	}
	
	/**
	 * Méthode utilisé pour faire un débuggage lors de l'echec de connexion à la bd
	 * Elle retrace fichier après fichier la ligne ou le script a été interrompu
	 * 
	 * return string
	 */
	public static function debugConnexion() {
		self::setDsn();
		try {
			self::$con = new PDO(self::$dsn, __dbuname__, __dbpwd__);
			echo "<pre>"; var_dump(get_class_methods(PDOException)); die;
		}
		catch(PDOException $e) {
			echo "<pre>";var_dump(get_class_methods(PDO)); die;
			print $e->getTraceAsString();
			die;
		}
	}
	
	/**
	 * Pour empecher la clonage de notre instance
	 */
	public function __clone() {
		trigger_error('Clonage non autorise.' , E_USER_ERROR);
	}
	
	/**
	 * Méthode pour executer une requete
	 * @return ressource
	 */
	public static function sql($requete) {
		try {
			return self::getInstance()->exec($requete);
		} catch(PDOException $e) {
			print "Erreur ! : " . $e->getMessage() . "<br />";
			//$this->noteErreur($this->protegeDonnee($e->getMessage()));
		}
	}
	
	/**
	 * Méthode pour executer une requete
	 * @return ressource
	 */
	public static function sqls($requete) {
		try {
			return self::getInstance()->query($requete);
		} catch(PDOException $e) {
			print "Erreur ! : " . $e->getMessage() . "<br />";
			//$this->noteErreur($this->protegeDonnee($e->getMessage()));
		}
	}
	
	/**
	 * Méthode destructeur de la classe bd
	 */
	public function deconnexion() {
		self::$con = null;
	}
	
}

?>