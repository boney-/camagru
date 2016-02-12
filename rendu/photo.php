<?php
function display_photo($url, $description, $like, $size){
?>
		<div class="<?php echo $size;?>">
			<div class="photo"><img src="<?php echo $url ?>"/></div>
			<div class="description"><?php echo $description;?></div>
			<div class="like-btn"><i class="fa fa-thumbs-up"></i><?php echo $like; ?></div>
		</div>
<?php 
} 
?>