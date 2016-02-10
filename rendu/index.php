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
					include($path.'/partials/footer.php');
				}
			?>
		</div>
		<script src="Ressources/public/js/javascript.js"></script>
	</body>
</html>