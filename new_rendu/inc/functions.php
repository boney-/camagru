<?php
function debug($variable){
	
	echo '<pre>' . print_r($variable, true) . '</pre>';
}

function str_random($length){
	$alpha = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
	//lettre répétée 60 foix
	return substr(str_shuffle(str_repeat($alpha, $length)), 0, $length);
}

function is_logged(){
	if (session_status() == PHP_SESSION_NONE) {
	 	session_start();
	}

	if(!isset($_SESSION['auth'])){
		$_SESSION['flash']['error_msg'] = "Vous n'avez pas le droit d'accéder à cette page";
		header('Location: login.php');
		exit();
	}
}