<?php 
include_once 'db.php';
include_once 'photo.php';
 ?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	</head>
	<body>
<?php 

$sql = 'SELECT * FROM photo';

try{
	$req = $DB->query($sql);
	while($d = $req->fetch(PDO::FETCH_ASSOC)){
		display_photo($d['url'], $d['description'], $d['like_count'], "photo-container");
	} 
}
catch(PDOException $e){
	echo 'requete down';
}

 ?>

	</body>
</html>