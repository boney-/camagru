<?php
	require_once 'inc/functions.php';
	require_once 'inc/db_connect.php';
	require 'inc/header.php';

	if (!empty($_FILES)) {
		$size = getimagesize($_FILES['img']['tmp_name']);
		if ($size[0] < 400 || $size[1] < 300)
			$_SESSION['flash']['error_msg'] = "Les dimensions de l'image doivent être supérieur à 400x300";
		 else {
			$img = $_FILES['img'];
			$ext = strtolower(substr($img['name'], -3));
			$allowed_ext = ['jpg', 'png'];
			if(in_array($ext, $allowed_ext)) {
				// Création d'une image temporaire pour application des filtres
				move_uploaded_file($img['tmp_name'], "img/tmp/tmp_img.".$ext);
				



				/*$sql = $pdo->prepare("SELECT id FROM photo ORDER BY id DESC");
				$sql->execute();
				$req = $sql->fetch();
				$img_name = "img".($req->id+1);*/
				//move_uploaded_file($img['tmp_name'], "img/tmp/".$img_name.'.'.$ext);
	
				/*
				Img::createMin("img/".$img_name.'.'.$ext, "img/min/", $img_name.'.'.$ext, 400, 300);*/
			} else {
				$_SESSION['flash']['error_msg'] = "Le format du fichier uploadé n'est pas pris en charge";
			}
		}
	}
?>
<head>
	<link rel="stylesheet" href="css/videocam.css" type="text/css" media="all">
	<script src="js/video.js">
	</script>

</head>
	<h1 class="page_title">Montage Photo ... C'est ici !</h1>

	<div class="capture_div">
		<div class="capture">
			<?php 
				if (isset($ext))
					echo '<img id="img_preview" src="img/tmp/tmp_img.'.$ext.'" />';
				else
					echo 
						'<div class="camera">
							<video id="video">Video stream not available.</video>
							<button id="startbutton">Take photo</button>
						</div>
						<canvas id="canvas">
						</canvas>
						<div class="output">
							<img id="photo" alt="The screen capture will appear in this box.">
						</div>';
			?>
		</div>
		<div class="sidebar">
			ICI LA SIDE BAR
		</div>
	</div>
	<button id="show_upload">Uploader une photo</button>
	<div id="upload"></div>

<?php require 'inc/footer.php' ?>