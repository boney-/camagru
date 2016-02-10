<div id="login">
	<form id="log_form" method="POST" action="Controllers/usercheckcontroller.php">
		<div id="log_div">
			Login : <input type="text" name="email" placeholder="e-mail">
		</div>
		<div id="pass_div">
			Password : <input type="password" name="password" placeholder="password">
		</div>
		<input type="submit" name="submit" value="Connexion" id="send_btn">
		<div id="sign_div">
			<a href="sign.php"> Sign up </a><br />
			<?php echo $_SESSION['errlog']; ?>
		</div>
	</form>
</div>