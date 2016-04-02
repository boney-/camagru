<?php
	require_once 'inc/functions.php';
	require_once 'inc/db_connect.php';
	require 'inc/header.php';

	if (isset($_FILES) && !empty($_FILES['img']['tmp_name'])) {
		$size = getimagesize($_FILES['img']['tmp_name']);
		if ($size[0] < 400 || $size[1] < 300)
			$_SESSION['flash']['error_msg'] = "Les dimensions de l'image doivent être supérieur à 400x300";
		 else {
			$img = $_FILES['img'];
			$ext = strtolower(substr($img['name'], -3));
			$allowed_ext = ['jpg', 'png'];
			if(in_array($ext, $allowed_ext)) {
				$imgpath = "img/tmp/".$_SESSION['auth']->id."-tmp_img.".$ext;
				// Création d'une image temporaire pour application des filtres
				move_uploaded_file($img['tmp_name'], $imgpath);
				
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

	//recuperation filtres
	$dir = opendir('img/filters');
	$folder = [];
	while (false !== ($name = readdir($dir))){
		if ($name != '.' && $name != "..")
			$folder[] = $name;
	}
	closedir($dir);
?>
<head>
	<link rel="stylesheet" href="css/videocam.css" type="text/css" media="all">
	<script src="js/video.js"></script>
</head>
	<h1 class="page_title">Montage Photo ... C'est ici !</h1>

	<div class="capture_div">
		<div class="capture">
			<?php if (isset($ext)) {
					$filter_css = 'horizontal_';

					/* UNUSED FOR NOW */
					/*
					$img = imagecreatefrompng("img/filters/1.png");
					$proportion = (imagesx($img)/$size[0]) * 100;
					//echo imagesx($img);
					*/
			?>
					<div class="preview_div">
						<img id="select_filter" src="img/filters/0.png" alt="selected_filter" style="width: 20%;display: none;" />
						<img id="img_preview" src="<?php echo $imgpath; ?>" />
					</div>
			<?php } else {
					$filter_css = 'vertical_';
			?>
					<div class="cam_div">
						<div class="camera">
							<img id="select_filter" src="img/filters/0.png" alt="selected_filter" style="display:none;width: 20%;"/>
							<video id="video">Video stream not available.</video>
							<button id="startbutton">Take photo</button>
						</div>
						<canvas id="canvas">
						</canvas>
						<div class="output">
							<img id="photo" alt="The screen capture will appear in this box.">
						</div>
					</div>
				<?php } ?>

			<div class="<?php echo $filter_css; ?>filters inline">
				<?php 
					$i = 0;
					foreach ($folder as $file) {
						if (preg_match('#^.+\.(png|jpg|jpeg)$#', $file))
							echo "<div class='".$filter_css."filter_div inline'>
									<img class='filter' id='$i' src='img/filters/$file' alt='filters'/>	
								</div>";
						$i++;
					}
				?>
			</div>
		</div>
		<div class="sidebar">
			<?php
			$sql = $pdo->prepare("SELECT * FROM photo WHERE user_id = ? ORDER BY created_at LIMIT 4");
			$sql->execute(array($_SESSION['auth']->id));
			while ($req = $sql->fetch(PDO::FETCH_ASSOC)){
				echo '<div class="img-wrap"><span class="close" onclick="(delete_img('.$req["id"].'))">&times;</span><a href="photo.php?id='.$req["id"].'"><img src="'.$req["url"].'" /></a></div>';
			}
			?>

		</div>
	</div>
	<div class="show_upload">
		<button id="show_upload">Uploader une photo</button>
			<form class="show_cam" action="" method="post">
				<input type="submit" value="Prendre une photo">
			</form>
			<div class="filter_coord inline">
				<form id="filter_form" class="coord_form" action="makeup.php" method="post">
				<?php if (isset($ext)){ ?>
					<input type="hidden" name="imgPath" value="<?php echo $imgpath; ?>">
					<input type="hidden" name="extension" value="<?php echo $ext; ?>">
				<?php } ?>
					<input type="hidden" name="filterId" value="0" id="filterId">
					<input type="hidden" name="filterSize" value="20" id="filterSize">
					<input type="hidden" name="x_coord" id="filter_x_coord">
					<input type="hidden" name="y_coord"  id="filter_y_coord">
				<?php if (empty($ext)) { ?>
					<input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['auth']->id; ?>">
					<input type="hidden" name="img_val" id="img_val" value="">
				<?php } ?>
					<button type="submit" id="apply_filter">Appliquer</button>
				<form>
			</div>
		<div id="upload"></div>
	</div>

<?php require 'inc/footer.php' ?>