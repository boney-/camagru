<?php 

require_once 'inc/functions.php';
// require 'inc/db_connect.php';
// $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
// $req->execute([$user_id]);
// $user = $req->fetch();

?>

<?php

require 'inc/header.php';
require_once 'inc/db_connect.php';

$sql = $pdo->prepare("SELECT url, title, description, created_at, like_count, username FROM users, photo WHERE photo.id = ? AND photo.user_id = users.id");
if (isset($_GET['id'])) {
	$sql->execute(array($_GET['id']));
	$req = $sql->fetch(PDO::FETCH_ASSOC);

	$sql = $pdo->prepare("SELECT username, comment.id, comment, created_at FROM users, comment WHERE photo_id = ? AND comment.user_id = users.id ORDER BY created_at ASC");
	$sql->execute(array($_GET['id']));
?>
	<script type="text/javascript" src="js/vote.js"> </script>
	<h1 class="page_title"><?php echo $req['title'] ?></h1>

	<div class="wide_photo_div">
		<img src="<?php echo $req['url'] ?>"><br/>
		<span><?php echo $req['description'] ?></span><br/>
		<span>Photo created at: <?php echo $req['created_at'] ?></span>
	</div>

	<div class="comments" id="allcomments">
		<?php while ($req2 = $sql->fetch(PDO::FETCH_ASSOC)){ ?>
		<div class="comment" >
			<span class="comment_auth"><?php echo $req2['username'] ?>: </span>
				<?php echo $req2['comment'];
				echo "<span class='line'></span>"; ?>
		</div>
		<?php } ?>
		<div class="add_comment">
			<textarea name="comment" form="comment" id="comment" placeholder="commentaire ..."></textarea>
			<button onclick="send_comment(<?php  echo $_GET['id']?>)" action="" type="sutbmit" class="send_btn submit_btn">Envoyer</button>
		</div>
	</div>

<?php
}
	require 'inc/footer.php'
?>