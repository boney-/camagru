<?php
	require_once 'inc/functions.php';
	require 'inc/header.php';
	if(!empty($_FILES)){
		$img = $_FILES['img'];
		$ext = strtolower(substr($img['name'], -3));
		$allowed_ext = ['jpg', 'png'];
		if(in_array($ext, $allowed_ext)) {
			move_uploaded_file($img['tmp_name'], "img/".$img['name']);
			Img::createMin("img/".$img['name'], "img/min/", $img['name'], 600, 400);
		} else {
			$_SESSION['flash']['error_msg'] = "Le format du fichier uploadé n'est pas pris en charge";
		}
	}
?>

	<h1 class="page_title">Montage Photo ... C'est ici !</h1>

	<div class="capture_div">
		<div class="capture">
			CAPTURE ZONE
		</div>
		<div class="sidebar">
			ICI LA SIDE BAR
		</div>
	</div>
	<div class="upload">
		<h2> uploader une photo : </h2>
		<form method="POST" action="" enctype="multipart/form-data">
			<input type="file" name="img"/>
			<input type="submit" name="send" value="Envoyer"/>
		</form>
	</div>

<?php require 'inc/footer.php' ?>