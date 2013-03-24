<?php

/**
 * classe correspondant à la table SMS
 */
class Sender{
	var $host;
	var $port;
	/*
	* Username that is to be used for submission
	*/
	var $strUserName;
	/*
	* password that is to be used along with username
	*/
	var $strPassword;
	/*
	* Sender Id to be used for submitting the message
	*/
	var $strSender;
	/*
	* Message content that is to be transmitted
	*/
	var $strMessage;
	/*
	* Mobile No is to be transmitted.
	*/
	var $strMobile;
	/*
	* What type of the message that is to be sent
	* <ul>
	* <li>0:means plain text</li>
	* <li>1:means flash</li>
	* <li>2:means Unicode (Message content should be in Hex)</li>
	* <li>6:means Unicode Flash (Message content should be in Hex)</li>
	* </ul>
	*/
	var $strMessageType;
	/*
	* Require DLR or not
	* <ul>
	* <li>0:means DLR is not Required</li>
	* <li>1:means DLR is Required</li>
	* </ul>
	*/
	var $strDlr;
	
	private function sms__unicode($message){
		$hex1 = '';
		if (function_exists('iconv')) {
			$latin = @iconv('UTF-8', 'ISO-8859-1', $message);
			if (strcmp($latin, $message)) { 
				$arr = unpack('H*hex', @iconv('UTF-8', 'UCS2BE', $message));
				$hex1 = strtoupper($arr['hex']);
			}
			if($hex1 == ''){
				$hex2 = '';
				$hex = '';
				for ($i = 0; $i < strlen($message); $i++){
					$hex = dechex(ord($message[$i]));
					$len = strlen($hex);
					$add = 4 - $len;
					if($len < 4){
						for($j = 0; $j < $add; $j++){
							$hex = "0" . $hex;
						}
					}
					$hex2 .= $hex;
				}
				return $hex2;
			}
			else{
				return $hex1;
			}
		}
		else{
			print 'iconv Function Not Exists !';
		}
	}
	
	//Constructor..
	public function Sender ($host, $port, $username, $password, $sender, $message, $mobile, $msgtype, $dlr){
		$this->host=$host;
		$this->port=$port;
		$this->strUserName = $username;
		$this->strPassword = $password;
		$this->strSender= $sender;
		$this->strMessage=$message; //URL Encode The Message..
		$this->strMobile=$mobile;
		$this->strMessageType=$msgtype;
		$this->strDlr=$dlr;
	}
	
	public function Submit(){
		if($this->strMessageType == "2" || $this->strMessageType == "6") {
			//Call The Function Of String To HEX.
			$this->strMessage = $this->sms__unicode($this->strMessage);
			try {
				//Smpp http Url to send sms.
				$live_url="http://".$this->host.":".$this->port."/bulksms/bulksms?username=".$this->strUserName."&password=".$this->strPassword."&type=".$this->strMessageType."&dlr=".$this->strDlr."&destination=".$this->strMobile."&source=".$this->strSender."&message=".$this->strMessage."";
				$parse_url = file($live_url);
				echo $parse_url[0];
			} catch(Exception $e){
				echo 'Message:' .$e->getMessage();
			}
		}
		else
			$this->strMessage = urlencode($this->strMessage);
		try{
			//Smpp http Url to send sms.
			$live_url="http://".$this->host.":".$this->port."/bulksms/bulksms?username=".$this->strUserName."&password=".$this->strPassword."&type=".$this->strMessageType."&dlr=".$this->strDlr."&destination=".$this->strMobile."&source=".$this->strSender."&message=".$this->strMessage."";
			//var_dump($live_url); die;
			$parse_url=file($live_url);
			return $parse_url[0];
		}
		catch(Exception $e){
			echo 'Message:' .$e->getMessage();
		}
	}
}

class sms extends entity {

	var $table = __CLASS__;
	var $id;
	var $id_em;
	var $num_tel_em;
	var $num_tel_recep;
	var $message;
	var $error_status;
	var $adr_ip_em;
	
	
	/**
	 * constructeur de la classe sms
	 */	
	function __construct($num_tel_em/*, $num_tel_recep, $mess , $error */) {
		// Je veux éviter de le surcharger de données qu'on ne peut pas fournir à tous les coup!
		// Pour moi le constructeur veut dire qu'on instancie d'abord l'objet, les manipulations surviennent après
		// Idéalement on sait presque toujours qui veut envoyer le SMS donc c la donnée initiale.
		//$this->setId($id);
		//$this->setId_em($em);
		$this->setNum_tel_em($num_tel_em);
		// $this->setNum_tel_recep($num_tel_recep);
		// $this->setMessage($mess);
		//	$this->setError_status($error);
		$this->setAdr_ip_em($_SERVER['REMOTE_ADDR']);
		//var_dump($this->num_tel_em);
	}
	
	/**
	 * fonctions set de tous les attributs de la classe
	 */
	function setId($id) { $this->id = $id; }
	function setId_em($id_em) { $this->id_em = $id_em; }
	function setNum_tel_em($num) { $this->num_tel_em = $num; }
	function setNum_tel_recep($num) { $this->num_tel_recep = $num; }
	function setMessage($mess) { $this->message = $mess; }
	function setError_status($err) { $this->error_status = $err; }
	function setAdr_ip_em($adr) { $this->adr_ip_em = $adr; }
	
	/**
	 * fonction pour nettoyer toutes les données qui vont dans la BDD
	 */
	function cleanNum_tel_em() { $this->num_tel_em = parent::cleanData($this->num_tel_em); }
	function cleanNum_tel_recep() { $this->num_tel_recep = parent::cleanData($this->num_tel_recep); }
	function cleanMessage() { $this->message = parent::cleanData($this->message); }
	function cleanError_status() { $this->error_status = parent::cleanData($this->error_status); }
	function cleanAdr_ip_em() { $this->adr_ip_em = parent::cleanData($this->adr_ip_em); }
	
	/**
	 *
	 */
	function cleanAll_data() {
		$this->cleanNum_tel_em();
		$this->cleanNum_tel_recep();
		$this->cleanMessage();
		$this->cleanError_status();
		$this->cleanAdr_ip_em();
	}
	
	/**
	 * fonction qui permet de valider le numéro de téléphone de l'emetteur
	 * @return boolean
	 */
	function validateNum_tel_em() {
		
	}
	
	function validateMessage() {
		
		return true;	
	}
	
	/*
	 * Fonction qui permet d'envoyer les sms
	 */
	function send_sms($destination, $msg) {
		$host = "121.241.242.114";
		$port = "8080";
		$user = "dms-sms4ever";
		$pass = "27fevrie";
		$source = $this->num_tel_em;
		$type = "0";
		$dlr = "1";
		// on enleve le + devant le numero de lemetteur pour eviter lerreur 1707
		$source = str_replace("+", "", $source);
		//var_dump($this->num_tel_em);
		if(empty($msg))
			return false;
		$this->message = $msg;
		$this->num_tel_recep = $destination = str_replace("+", "", $destination);
		$sms = new Sender($host, $port, $user, $pass, $source, $msg, $destination, $type, $dlr);
		$this->error_status = $sms->Submit();
		$this->cleanAll_data();
		// on enregistre le sms kon vient dessayer denvoyer dans la table des sms
		$query = "insert into $this->table (num_tel_em, num_tel_recep, message, error_status, adr_ip_em) values 
					(".$this->num_tel_em.", ".$this->num_tel_recep.", ".$this->message.", ".$this->error_status.", 
					 ".$this->adr_ip_em.")";
		parent::__insert($query);
		return $this->error_status;
	}
	
	
	/**
	 * insère dans la BDD un nouvel utilisateur
	 * @return
	 */
	function save_new($num_tel_recep, $mess) {
		$this->setNum_tel_recep($num_tel_recep);
		$this->setMessage($mess);
		
		$this->setError_status($this->send_sms($this->num_tel_recep, $this->message)); // on envoi le sms en prenant directement le code json retour
		
		$this->cleanAll_data();
		$query = "insert into $this->table (num_tel_em, num_tel_recep, message, error_status, adr_ip_em) values 
					(".$this->num_tel_em.", ".$this->num_tel_recep.", ".$this->message.", ".$this->error_status.", 
					 ".$this->adr_ip_em.")";
		return parent::__insert($query);
	}
	
	/**
	 * selectionne un user spécifique avec certains paramètres
	 */
	function select() {
		
	}
}

?>