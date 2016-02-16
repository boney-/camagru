<?php

function display_photo($id, $url, $description, $like, $size, $DB){
	$sql = "SELECT * FROM vote WHERE photo_id = $id AND user_id =". $_SESSION['auth']['id'];
	$req = $DB->query($sql);
	?>
	<div class="<?php echo $size;?>">
		<div class="photo"><img src="<?php echo $url ?>"/></div>
		<div class="description"><?php echo $description;?></div>
		<div id="<?php echo $id?>" class="<?php if ($req->fetch())
			echo 'like-vote" title="You have already voted">'; else
			echo 'like-btn" onclick="vote('.$id.')">';?><i class="fa fa-thumbs-up"></i><?php echo $like; ?></div>
	</div>
	<?php
}
?>