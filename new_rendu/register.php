<?php require 'inc/header.php' ?>

<?php

	if (!empty($_POST)) {

		$errors = [];

		//changer la regex pour l'email
		if (empty($_POST['username']) || !pregmatch('/^[a-zA-Z0-9_.-]+$/')) {
			$errors['username'] = "Veuillez remplir le champ email";
		}

		debug($errors);


	}

 ?>

	<h1 class="page_title">S'inscrire</h1>

	<form action="" method="POST">
		<div class="form">
			<label for="">Email</label>
			<input type="text" name="username" required />
		
			<label for="">Mot de passe</label>
			<input	type="password" name="password" required/>

			<label for="">Confimez votre mot de passe</label>
			<input	type="password" name="password_confirmation" required/>
		</div>

		<button type="submit" class="submit_btn">M'inscrire</button>
	</form>

<?php require 'inc/footer.php' ?>