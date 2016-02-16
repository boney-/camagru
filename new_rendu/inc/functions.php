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

function reconnect_from_cookie(){
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}

	if(isset($_COOKIE['remember']) && !isset($_SESSION['auth'])){
		require_once 'config/db_connect.php';
		//si require deja fais ailleurs on aura pas acces à $pdo
		//global permet de recuperer $pdo si elle est deja définie ailleurs
		if(!isset($pdo)){
			global $pdo;
		}
		$remember_token = $_COOKIE['remember'];
		$parts = explode('//', $remember_token);
		$user_id = $parts[0];
		$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
		$req->execute([$user_id]);
		$user = $req->fetch();
		if($user){
			$expected = $user_id . '//' . $user->remember_token . sha1($user_id . 'citronbride');
			if($expected == $remember_token){
				session_start();
				$_SESSION['auth'] = $user;
				setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
			}
		} else {
			//si utilisateur ne correspond pas au remember_token je detruis cookie
			setcookie('remember', NULL, -1);
		}
	}

	if ($_SESSION['flash']){
		$_SESSION['flash'] = NULL;
	}
}