<?php 
include_once 'db.php';

$_SESSION['auth']['id'] = 2;

 ?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
		<script src="../new_rendu/js/vote.js"></script>
	</head>
	<body>
		<?php
			include_once 'menu.php';
			if (isset($_POST['menu']) && $_POST['menu'] == "gallerie") {
				include_once 'gallerie.php';
		}
			else{
			include_once 'standart.php';
		}
		?>
	</body>
</html>
