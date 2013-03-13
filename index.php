<?php
@session_start();

if(!isset($_SESSION['num_tel']))	
	header('location:main.php');

?>