<?php
	include_once ('Common.php');
	$path = "Ressources/views";
?>

<!DOCTYPE html>
<html>
	<?php include($path.'/partials/head.php'); ?>
	<body>
		<div class="container">
			<?php
				if (empty($_SESSION['LOGIN']))
					include($path.'/login.php');
				else
				{
					include($path.'/partials/header.php');
					include($path.'/partials/main.php');
					include($path.'/partials/side.php');
				}
			?>
		</div>
		<script src="js/javascript.js"></script>
	</body>
	<?php include($path.'/partials/footer.php') ?>
</html>