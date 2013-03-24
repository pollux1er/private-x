<?php
@session_start();
// si aucune session n'est en cour
if(!isset($_SESSION['num_tel']))	
	header('location:main.php');

//Si c'est deja le cas
if(isset($_SESSION['num_tel']))
	header('location:main.php?step=2'); // on envoi lutilisateur au processus d'envoi de sms
	


?>