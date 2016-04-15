<?php 

// require_once 'inc/functions.php';
// require 'inc/db_connect.php';
// $req = $pdo->prepare('SELECT * FROM photo ORDER BY created_at DESC');

// $photos = $req->execute();
require 'inc/header.php';
require_once 'inc/db_connect.php';

$sql = $pdo->prepare("SELECT * From photo ORDER BY created_at DESC LIMIT 8 OFFSET :offset");
if (!isset($_GET['page']))
	$offset = 0;
else
	$offset = $_GET['page'] * 8;
$sql->bindValue(":offset", $offset, PDO::PARAM_INT);
$sql->execute();

?>

	<h1 class="page_title">Gallerie Photos</h1>

	<div class="small_photo_div">
		<?php While ($res = $sql->fetch(PDO::FETCH_ASSOC)){ ?>
		<a href="photo.php?id=<?php echo $res['id'] ?>">
		 	<span class="helper"></span>
			<img src="<?php echo $res['url'] ?>">
		</a>
		<?php }
		$sql = $pdo->prepare("SELECT COUNT(id) as count From photo");
		$sql->execute();
		$res = $sql->fetch(PDO::FETCH_ASSOC);
		$res = ceil($res['count'] / 8);
		?>
	</div>
<div style="clear:both;"></div>
	<div class="page-nav">
<?php
if (!isset($_GET['page']))
	$page = 0;
else
	$page = $_GET['page'];

$prec = "nobtn";
$suiv = "nobtn";

if ($page > 0)
	echo "<a id='prev' class='btn' href='gallery.php?page=".($page-1)."'>Precedent</a>";
if ($page < $res - 1)
	echo "<a id='next' class='btn' href='gallery.php?page=".($page+1)."'>Suivant</a>";

?>
	</div>

<?php require 'inc/footer.php' ?>


