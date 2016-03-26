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

	//recuperation filtres
	$dir = opendir('img/filters');
	$folder = [];
	while (false !== ($name = readdir($dir))){
		if ($name != '.' && $name != "..")
			$folder[] = $name;
	}
	closedir($dir);

	//position du filtre

?>
<head>
	<link rel="stylesheet" href="css/videocam.css" type="text/css" media="all">
	<script src="js/video.js"></script>
</head>
	<h1 class="page_title">Montage Photo ... C'est ici !</h1>

	<div class="capture_div">
		<div class="capture">
			<?php 
				if (isset($ext)) {	
					$filter_css = 'horizontal_';
					$img = imagecreatefrompng("img/filters/1.png");
					$proportion = (imagesx($img)/$size[0]) * 100;
					echo 'proportion du filtre par rapport à l\'image :'.$proportion.'%';
					//echo imagesx($img);

					echo '<div class="preview_div">
							<img id="select_filter" src="img/filters/1.png" alt="selected_filter" style="width:'.$proportion.'%;"" />
							<img id="img_preview" src="img/tmp/tmp_img.'.$ext.'" />
						</div>';
				} else {
					$filter_css = 'vertical_';
					echo 
						'<div class="cam_div">
							<div class="camera">
								<img id="select_filter" src="img/filters/1.png" alt="selected_filter" />
								<video id="video">Video stream not available.</video>
								<button id="startbutton">Take photo</button>
							</div>
							<canvas id="canvas">
							</canvas>
							<div class="output">
								<img id="photo" alt="The screen capture will appear in this box.">
							</div>
						</div>';
					}
			?>
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
		<div class="sidebar"></div>
	</div>
	<div class="show_upload">
		<button id="show_upload">Uploader une photo</button>
		<?php if (isset($ext)) {
			echo 
				'<form class="show_cam" action="" method="post">
					<input type="submit" value="Prendre une photo">
				</form>';
			echo 
				'<div class="filter_coord inline">
					<label for="filter_x_coord">x </label>
					<input class="coord inline" id="filter_x_coord" type="number" value="0">
					<label for="filter_y_coord">y </label>
					<input class="coord inline" id="filter_y_coord" type="number" value="0"/>
					<button onclick="img_merge($ext, 1, 0, 0)" id="apply_filter">Appliquer</button>
				</div>';
		} ?>
		<div id="upload"></div>
	</div>

<?php require 'inc/footer.php' ?>