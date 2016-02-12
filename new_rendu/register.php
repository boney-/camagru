<?php

	require_once 'inc/functions.php';

	if (!empty($_POST)) {

		$errors = [];
		//connexion à la base de données
		require_once 'inc/config/database.php';

		if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
			$errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";
		} else {
			$req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
			$req->execute([$_POST['username']]);
			//recupération d'un enregistrement (le premier)
			$user = $req->fetch();
			//verification username
			if ($user){		
				$errors['username'] = "Ce pseudo est déjà utilisé";
			}
		}

		if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = "Votre email n'est pas valide";
		} else {
			$req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
			$req->execute([$_POST['email']]);
			//recupération d'un enregistrement (le premier)
			$email = $req->fetch();
			//verification email
			if ($email) {
				$errors['email'] = "Ce email est déjà associé à un autre compte";
			}
		}

		if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirmation']) {
			if (empty($_POST['password']))
				$errors['password'] = "Vous devez rentrer un mot de passe valide";
			else
				$errors['password'] = "Les mot de passe entré sont differents";
		}

		if (empty($errors)) {
			//requete ajout utilisateur, utilisation requete préparé cf. doc php
			$req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			//generation string aléatoire comme clé de validation
			$token = str_random(60);
			$req->execute([$_POST['username'], $password, $_POST['email'], $token]);
			$user_id = $pdo->lastInsertId();
			mail($_POST['email'], 'Confirmation de la création de votre compte', "Afin de valider la création de votre compte, merci de cliquer sur ce lien\n\nhttp://localhost/boney_camagru/new_rendu/confirm.php?id=$user_id&token=$token");
			header('Location: Login.php');
			exit();
		}

	}

 ?>

 	<?php require 'inc/header.php' ?>

	<h1 class="page_title">S'inscrire</h1>
	<?php if (!empty($errors)): ?>
	<div class="error_msg">
		<p>Vous n'avez pas rempli le formulaire correctement : </p><br>
		<ul>
			<?php foreach($errors as $error): ?>
				<li>* <?php echo $error; ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
<!--	<?php /*else :*/?>
	<div class="success_msg">
		<p>Votre compte a été créé avec success !</p>
	</div>-->
	<?php endif; ?>

	<form action="" method="POST">
		<div class="form">
			<label for="">Username</label>
			<input type="text" name="username" required />

			<label for="">Email</label>
			<input type="text" name="email" required />
		
			<label for="">Mot de passe</label>
			<input	type="password" name="password" required/>

			<label for="">Confimez votre mot de passe</label>
			<input	type="password" name="password_confirmation" required/>
		</div>

		<button type="submit" class="submit_btn">M'inscrire</button>
	</form>

<?php require 'inc/footer.php' ?>