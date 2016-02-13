<?php 
	if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
		require_once 'inc/config/database.php';
		require_once 'inc/functions.php';
		session_start();
		$req = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :username AND confirmed_at IS NOT NULL');
		$req->execute(['username' => $_POST['username']]);
		$user = $req->fetch();
		if($user && password_verify($_POST['password'], $user->password)){
			$_SESSION['auth'] = $user;
			$_SESSION['flash']['success_msg'] = "Vous êtes maintenant connecté";
			header('Location: account.php');
			exit();
		} else {
			$_SESSION['flash']['error_msg'] = "Identifiant ou mot de passe incorrecte";
		}
	}
?>

<?php require 'inc/header.php'; ?>
<h1>Vous connecter à votre compte</h1>

<form action="" method="POST">
	<div class="form">
		<label for="">Pseudo ou Mail</label>
		<input type="text" name="username" required />
	
		<label for="">Mot de passe</label>
		<input	type="password" name="password" required/>
	</div>
	<button type="submit" class="submit_btn">Se connecter</button>
</form>

	<a href="register.php">Créer un compte</a>

<?php require 'inc/footer.php' ?>
