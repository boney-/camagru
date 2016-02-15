<?php 
	if (!empty($_POST) && !empty($_POST['email'])){
		require_once 'inc/config/database.php';
		require_once 'inc/functions.php';
		session_start();
		$req = $pdo->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');
		$req->execute([$_POST['email']]);
		$user = $req->fetch();
		if($user){
			$reset_token = str_random(60);
			$pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
			$_SESSION['flash']['info_msg'] = "Les instruction pour reinitialiser votre mot de passe vous ont été envoyé par mail";
			mail($_POST['email'], 'Réinitialisation de votre mot de passe', "Afin de réinitialiser votre mot de passe, merci de cliquer sur ce lien\n\nhttp://localhost/boney_camagru/new_rendu/reset.php?id={$user->id}&token=$reset_token");
			header('Location: login.php');
			exit();
		} else {
			$_SESSION['flash']['error_msg'] = "Aucun compte ne correspond à cette adresse email";
		}
	}
?>

<?php require 'inc/header.php'; ?>
<h1 class="page_title">Mot de passe oublié</h1>

<form action="" method="POST">
	<div class="form">
		<ul>
			<li>
				<label for="">Adresse email associé à votre compte</label>
				<input type="email" name="email" required />
			</li>
		</ul>
	</div>

	<button type="submit" class="submit_btn">Envoyer</button>
</form>

<?php require 'inc/footer.php' ?>
