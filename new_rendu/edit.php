<?php

require_once 'inc/functions.php';
require 'inc/header.php';
is_logged();

$outPath = "img/tmp/".$_SESSION['auth']->id."-user_img.jpeg";

// si l'utilisateur saccede a edit via l'url, affiche le dernier montage encore présent, sinon rediriger vers capture
// if(!file_exists($outPath)){
// 	header('Location: capture.php');
// }

?>

<h1 class="page_title">Editer votre photo</h1>

<div class="output_preview">
	<img id="out_preview" src="<?php echo $outPath; ?>"><br/>
	<div id="keep">Cette photo vous convient-elle ?</div>
	<div class="choice_div">
		<button class="choice" id="yes_keep">Oui</button>
		<button class="choice" id="no_keep">Non</button>
	</div>
	<div id="edit_div"></div>
</div>

<?php require 'inc/footer.php' ?>