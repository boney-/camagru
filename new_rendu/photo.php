<?php 

require_once 'inc/functions.php';
// require 'inc/db_connect.php';
// $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
// $req->execute([$user_id]);
// $user = $req->fetch();

?>

<?php require 'inc/header.php' ?>

	<h1 class="page_title"><?php echo $_GET['name'] ?></h1>

	<div class="wide_photo_div">
		<img src="img/img1.jpg">
	</div>

	<div class="comments">
		<div class="comment">
			<span class="comment_auth"><?php echo $_GET['name'] ?></span>
				dnbkldfknbndfklbndlkfnblk nlkbndlkndklbn dknb
			<?php 
				if ($i < $count) 
					echo "<span class='line'></span>" ;
			?>
		</div>
		<div class="add_comment">
			<textarea placeholder="commentaire ..."></textarea>
			<button action="" type="sutbmit" class="send_btn submit_btn">Envoyer</button>
		</div>
	</div>

<?php require 'inc/footer.php' ?>