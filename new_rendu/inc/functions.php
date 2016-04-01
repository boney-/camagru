<?php
function debug($variable){
	
	echo '<pre>' . print_r($variable, true) . '</pre>';
}

function str_random($length){
	$alpha = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
	//lettre répétée 60 foix
	return substr(str_shuffle(str_repeat($alpha, $length)), 0, $length);
}

function check_vote($id_photo, $id_user, $db)
{

	$sql = $db->prepare("SELECT * FROM vote WHERE photo_id = ? AND user_id = ?");
	$sql->execute(array($id_photo, $id_user));
	if ($sql->fetch())
		return (true);
	else
		return (false);
}

function is_logged(){
	if (session_status() == PHP_SESSION_NONE) {
	 	session_start();
	}

	if(!isset($_SESSION['auth'])){
		$_SESSION['flash']['error_msg'] = "Vous n'avez pas le droit d'accéder à cette page";
		header('Location: login.php');
		exit();
	}
}

function reconnect_from_cookie(){
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}

	if(isset($_COOKIE['remember']) && !isset($_SESSION['auth'])){
		require_once 'config/db_connect.php';
		//si require deja fais ailleurs on aura pas acces à $pdo
		//global permet de recuperer $pdo si elle est deja définie ailleurs
		if(!isset($pdo)){
			global $pdo;
		}
		$remember_token = $_COOKIE['remember'];
		$parts = explode('//', $remember_token);
		$user_id = $parts[0];
		$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
		$req->execute([$user_id]);
		$user = $req->fetch();
		if($user){
			$expected = $user_id . '//' . $user->remember_token . sha1($user_id . 'citronbride');
			if($expected == $remember_token){
				session_start();
				$_SESSION['auth'] = $user;
				setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
			}
		} else {
			//si utilisateur ne correspond pas au remember_token je detruis cookie
			setcookie('remember', NULL, -1);
		}
	}

	if ($_SESSION && $_SESSION['flash']){
		$_SESSION['flash'] = NULL;
	}
}

class Img{

	static function createMin($img,$path,$name,$width=100,$height=100){
		// On supprime l'extension du name
		$name = substr($name,0,-4);
		// On récupère les dimensions de l'image
		$dimension=getimagesize($img);
		// On cré une image à partir du fichier récup
		if(substr(strtolower($img),-4)==".jpg"){$image = imagecreatefromjpeg($img); }
		else if(substr(strtolower($img),-4)==".png"){$image = imagecreatefrompng($img); }
		else if(substr(strtolower($img),-4)==".gif"){$image = imagecreatefromgif($img); }
		// L'image ne peut etre redimensionne
		else{return false; }
		
		// Création des miniatures
		// On cré une image vide de la largeur et hauteur voulue
		$miniature =imagecreatetruecolor ($width,$height); 
		// On va gérer la position et le redimensionnement de la grande image
		if($dimension[0]>($width/$height)*$dimension[1] ){ 
			$dimY=$height; 
			$dimX=$height*$dimension[0]/$dimension[1]; 
			$decalX=-($dimX-$width)/2; 
			$decalY=0;
		}
		if($dimension[0]<($width/$height)*$dimension[1]){ 
			$dimX=$width; 
			$dimY=$width*$dimension[1]/$dimension[0]; 
			$decalY=-($dimY-$height)/2; 
			$decalX=0;
		}
		if($dimension[0]==($width/$height)*$dimension[1]){ 
			$dimX=$width; 
			$dimY=$height; 
			$decalX=0; 
			$decalY=0;
		}
		// on modifie l'image crée en y plaçant la grande image redimensionné et décalée
		imagecopyresampled($miniature,$image,$decalX,$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);
		// On sauvegarde le tout
		imagejpeg($miniature,$path."/".$name.".jpg",90);
		return true;
	}
}


//coord_x et coord_y à la position du filtre
function img_merge($imgPath, $ext, $filterPath, $coord_x, $coord_y) {

	$dest = ($ext == "png") ? imagecreatefrompng($imgPath) : imagecreatefromjpeg($imgPath);
	$src = imagecreatefrompng($filterPath);
	imagecolortransparent($src, imagecolorat($src, 0, 0));

	$src_x = imagesx($src);
	$src_y = imagesy($src);

	$dest_x = imagesx($dest);
	$dest_y = imagesy($dest);
	$scaleX = $dest_x / 100;
	$scaleY = $dest_y / 100;

	imagecopymerge($dest, $src, $coord_x * $scaleX, $coord_y * $scaleY, 0, 0, $src_x, $src_y, 100);

	// Output and free from memory
	header('Content-Type: image/png');
	//imagejpeg($dest, 'img/test.jpg');
	imagejpeg($dest);

	imagedestroy($dest);
	imagedestroy($src);
}

function filterResize($filterPath, $imgPath, $percent, $ext) {

	// Content type
	header('Content-Type: image/png');

	$filter = imagecreatefrompng($filterPath);
	$photo = ($ext == "png") ? imagecreatefrompng($imgPath) : imagecreatefromjpeg($imgPath);
	$imgWidth = imagesx($photo);
	$filterWidth = imagesx($filter);
	$filterHeight = imagesy($filter);

	// Calcul des nouvelles dimensions
	$newWidth = ($imgWidth / 100) * $percent;
	$newHeight = ($newWidth / $filterWidth) * $filterHeight;

	// Chargement
	$thumb = imagecreatetruecolor($newWidth, $newHeight);
	$source = imagecreatefrompng($filterPath);

	// Redimensionnement
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $filterWidth, $filterHeight);
	
	// Application transparance
	imagecolortransparent($thumb, imagecolorat($thumb, 0, 0));
	// Affichage
	// imagepng($thumb);
	// Enregistrement
	imagepng($thumb, 'img/tmp/tmp_filter.png');
}













