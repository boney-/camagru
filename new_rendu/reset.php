<?php
	if(isset($_GET['id']) && isset($_GET['token'])){
		require('inc/db_connect.php');
		require('inc/functions.php');
		//on fixe la durée de validité du lien à 30 minutes
		$req = $pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
		$req->execute([$_GET['id'], $_GET['token']]);
		$user = $req->fetch();
		if($user){
			//verification des deux mot de passe
			if(!empty($_POST['password']) && $_POST['passeword'] == $_POST['password_confirm']) {
				//encryptage mot de passe
				$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
				//modification mot de passe en base
				$pdo->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL WHERE id = ?')->execute([$_POST['password'], $user->id]);
				//connexion de l'utilisateur en metant user dans $_SESSION['auth']
				session_start();
				$_SESSION['flash']['success_msg'] = "Votre mot de passe a bien été modifié";
				$_SESSION['auth'] = $user;
				header('Location: account.php');
				exit();
			} else {
				session_start();
				$_SESSION['flash']['error_msg'] = "Les mot de passe ne correspondent pas";
			}
		} else {
			session_start();
			$_SESSION['flash']['error_msg'] = "Ce token de validation n'est pas valide";
			header('Location: login.php');
		}
	} else {
		header('Location: login.php');
		exit();
	}
?>

<?php require 'inc/header.php'; ?>
<h1 class="page_title">Reinitialiser votre mot de passe</h1>

<div class="form">
	<form action="" method="POST">
		<div class="form_group">
			<ul>
				<li>
					<label for="">Nouveau mot de passe</label>
					<input	type="password" name="password" required/>
				</li>
				<li>
					<label for="">Confimez le nouveau mot de passe</label>
					<input	type="password" name="password_confirma" required/>
				</li>
			</ul>
		</div>

		<button type="submit" class="submit_btn">Réinitialiser mon mot de passe</button>
	</form>
<div>

<?php require 'inc/footer.php' ?>
