<?php 
require_once 'inc/functions.php';
reconnect_from_cookie();
//redirection automatique si connecté et cherche a acceder a login.php
if(isset($_SESSION['auth'])){
	header('Location: account.php');
	exit();
}

if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
	require_once 'inc/db_connect.php';
	$req = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :username AND confirmed_at IS NOT NULL');
	$req->execute(['username' => $_POST['username']]);
	$user = $req->fetch();
	if($user && password_verify($_POST['password'], $user->password)){
		$_SESSION['auth'] = $user;
		$_SESSION['flash']['success_msg'] = "Vous êtes maintenant connecté";
		//verifie si checkbox coché
		if($_POST['remember']){
			$remember_token = str_random(250);
			$pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);
			//creation cookie avec info user qui dure 7j
			setcookie('remember', $user->id . '//' . $remember_token . sha1($user->id . 'citronbride'), time() + 60 * 60 * 24 * 7);
		}
		header('Location: account.php');
		exit();
	} else {
		$_SESSION['flash']['error_msg'] = "Identifiant ou mot de passe incorrecte";
	}
}
?>

<?php require 'inc/header.php'; ?>
<h1 class="page_title">Vous connecter à votre compte</h1>

<div class="form">
	<form action="" method="POST">
		<div class="form_group">
			<ul>
				<li>
					<label for="">Pseudo ou Mail</label>
					<input type="text" name="username" required />
				</li>
				<li>
					<label for="">Mot de passe</label>
					<input	type="password" name="password" required/>
				</li>
			</ul>
		</div>

		<div class="form_group">
			<label>
				<input type="checkbox" name="remember" value="1"/>Se souvenir de moi
			</label>
		</div>

		<button type="submit" class="submit_btn">Se connecter</button>
	</form>

	<div class="form_link">
		<a href="register.php">Créer un compte</a>
		<a href="forgot.php">Mot de passe oublié</a>
	</div>
<div>

<?php require 'inc/footer.php' ?>
