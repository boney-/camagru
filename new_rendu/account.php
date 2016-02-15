<?php 
require 'inc/functions.php';
is_logged();

// check if same password
if(!empty($_POST)) {
	if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
		$_SESSION['flash']['error_msg'] = "Les mot de passe ne correspondent pas";
	} else {
		$user_id = $_SESSION['auth']->id;
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		require_once 'inc/config/database.php';
		$req = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?")->execute([$password, $user_id]);
		$_SESSION['flash']['success_msg'] = "Votre mot de passe a bien été mis à jour";
	}
}
require 'inc/header.php'; 
?>

<h1 class="page_title">Bonjour <?= $_SESSION['auth']->username; ?></h1>

<div class="form">
	<form action="" method="POST">
		<div class="form_group">
			<input type="password" name="password" placeholder="Entrez votre nouveau mot de passe">
		</div>
		<div class="form_group">
			<input type="password" name="password_confirm" placeholder="Confirmation du mot de passe">
		</div>
		<button class="submit_btn">Changer mon mot de passe</button>
	</form>
</div>

<?php require 'inc/footer.php' ?>