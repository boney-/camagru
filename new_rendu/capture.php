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
				$sql = $pdo->prepare("SELECT id FROM photo ORDER BY id DESC");
				$sql->execute();
				$req = $sql->fetch();
				$img_name = "img".($req->id+1);
				move_uploaded_file($img['tmp_name'], "img/".$img_name.'.'.$ext);
				$sql = $pdo->prepare("SELECT COUNT(user_id) AS like_count FROM vote WHERE photo_id = ?");
				Img::createMin("img/".$img_name.'.'.$ext, "img/min/", $img_name.'.'.$ext, 400, 300);
			} else {
				$_SESSION['flash']['error_msg'] = "Le format du fichier uploadé n'est pas pris en charge";
			}
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