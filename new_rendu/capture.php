<?php
	require_once 'inc/functions.php';
	require_once 'inc/db_connect.php';
	require 'inc/header.php';

	if (!isset($_SESSION['auth'])){
		is_logged();
	}

	if (isset($_FILES) && !empty($_FILES['img']['tmp_name'])) {
		$size = getimagesize($_FILES['img']['tmp_name']);
		if ($size[0] < 400 || $size[1] < 300)
			$_SESSION['flash']['error_msg'] = "Les dimensions de l'image doivent être supérieur à 400x300";
		 else {
			$img = $_FILES['img'];
			$ext = get_img_type($img['tmp_name']);

			if(isset($ext)) {
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
				header('Location: capture.php');
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

	$select = isset($ext) ? '' : 'selected_capture';
?>
<head>
	<link rel="stylesheet" href="css/videocam.css" type="text/css" media="all">
	<script src="js/video.js"></script>
</head>
	<h1 class="page_title">Montage Photo ... C'est ici !</h1>

	<div id="trigger_div">
		<div class="trigger inline <?= $select ?>" id="cam_trigger"><span>Webcam</span></div>
		<div class="trigger inline" id="up_trigger"><span>Upload</span></div>
	</div>
	<div class="capture_div">
		<div class="capture">
			<div class="preview_div" id="preview">
				<?php if (isset($ext)) { ?>
					<img id="select_filter" src="" alt="selected_filter" style="width: 20%;display: none;" />
					<img id="img_preview" src="<?php echo $imgpath; ?>" />
				<?php } else { ?>
						<img id="select_filter" src="" alt="selected_filter" style="display:none;width: 20%;"/>
						<video id="video">Video stream not available.</video>
						<button id="startbutton">Take photo</button>
						<canvas id="canvas">
						</canvas>
				<?php } ?>
			</div>	

			<div class="filters inline">
				<?php 
					$i = 0;
					foreach ($folder as $file) {
						if (preg_match('#^.+\.(png|jpg|jpeg)$#', $file))
							echo "<div class='filter_div inline'>
									<img class='filter' id='$i' src='img/filters/$file' alt='filters'/>	
								</div>";
						$i++;
					}
				?>
			</div>
		</div>
		<div class="sidebar" id="sidebar">
			<?php
			$sql = $pdo->prepare("SELECT * FROM photo WHERE user_id = ? ORDER BY created_at DESC");
			$sql->execute(array($_SESSION['auth']->id));
			while ($req = $sql->fetch(PDO::FETCH_ASSOC)){
				echo '<div class="img-wrap"><span class="close" onclick="(delete_img('.$req["id"].'))">&times;</span><a href="photo.php?id='.$req["id"].'"><img src="'.$req["url"].'" /></a></div>';
			}
			?>

		</div>
	</div>
	<div class="show_upload">
		<div class="filter_coord inline">
			<form id="filter_form" class="coord_form" action="makeup.php" method="post">
			<?php if (isset($ext)){ ?>
				<input type="hidden" name="imgPath" value="<?php echo $imgpath; ?>">
			<?php } ?>
				<input type="hidden" name="filterId" value="0" id="filterId">
				<input type="hidden" name="filterSize" value="20" id="filterSize">
				<input type="hidden" name="x_coord" id="filter_x_coord">
				<input type="hidden" name="y_coord"  id="filter_y_coord">
			<?php if (empty($ext)) { ?>
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['auth']->id; ?>">
				<input type="hidden" name="img_val" id="img_val" value="">
			<?php } ?>
			<?php if (isset($ext)){ ?>
				<input type="hidden" name="extension" id="extension" value="<?php echo $ext; ?>">
				<button type="submit" id="apply_filter">Appliquer</button>
			<?php } ?>
			<form>
		</div>
	</div>

<?php require 'inc/footer.php' ?>