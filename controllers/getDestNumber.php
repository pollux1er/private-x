<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	session_start();
	$_SESSION['dest_number'] = $_POST['expediteur'];
	header('location:../main.php?step=7');
} else {

}
?>