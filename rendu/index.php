<?php 
include_once 'db.php';

$_SESSION['auth']['id'] = 2;

 ?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
		<script>
			function vote(id) {
				if (id.length == 0) {
					return;
				} else {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById(id).className = "like-vote";
						}
					};
					xmlhttp.open("GET", "vote.php?id=".id, true);
					xmlhttp.send();
				}
			}
		</script>
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