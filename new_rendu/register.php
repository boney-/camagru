<?php
	require_once 'inc/functions.php';
	
	if (session_status() == PHP_SESSION_NONE) {
	 	session_start();
	}	

	if (!empty($_POST)) {

		$errors = [];
		//connexion à la base de données
		require_once 'inc/db_connect.php';

		if (empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
			$errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";
		} else {
			$user_name = htmlspecialchars($_POST['username']);

			$req = $pdo->prepare('SELECT id FROM users WHERE username = ?');
			$req->execute(array($user_name));
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
			$user_mail = htmlspecialchars($_POST['email']);
			$req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
			$req->execute(array($user_mail));
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
			$user_pass = htmlspecialchars($_POST['password']);
			//requete ajout utilisateur, utilisation requete préparé cf. doc php
			$req = $pdo->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
			
			$password = password_hash($user_pass, PASSWORD_BCRYPT);
			//generation string aléatoire comme clé de validation
			$token = str_random(60);
			$req->execute($user_name, $password, $user_mail, $token]);
			$user_id = $pdo->lastInsertId();

			mail($user_mail, 'Confirmation de la création de votre compte', "Afin de valider la création de votre compte, merci de cliquer sur ce lien\n\nhttp://localhost:8080/confirm.php?id=$user_id&token=$token");
			$_SESSION['flash']['success_msg'] = "Un email de confirmation vous a été envoyé pour valider votre compte";
			header('Location: login.php');
			exit();
		} 

	}

 ?>

 <?php require 'inc/header.php' ?>

	<?php if (!empty($errors)): ?>
	<div class="msg error_msg">
		<p>Vous n'avez pas rempli le formulaire correctement : </p><br>
		<ul>
			<?php foreach($errors as $error): ?>
				<li>* <?php echo $error; ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>

	<h1 class="page_title">Créer un compte</h1>

	<form action="" method="POST">
		<div class="form_group">
			<ul>
				<li>
					<label for="">Username</label>
					<input type="text" name="username" required />
				</li>
				<li>
					<label for="">Email</label>
					<input type="text" name="email" required />
				</li>
				<li>
					<label for="">Mot de passe</label>
					<input	type="password" name="password" required/>
				</li>
				<li>
					<label for="">Confimez votre mot de passe</label>
					<input	type="password" name="password_confirmation" required/>
				</li>
			</ul>
		</div>

		<button type="submit" class="submit_btn">Créer</button>
	</form>

<?php require 'inc/footer.php' ?>