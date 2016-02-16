<?php

try{
	$DB = new PDO('mysql:host=localhost;dbname=camagru','root','');
	$DB->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo 'La base de donnee n\'est pas disponible';
}


/*$sql = 'SELECT email,prenom FROM User';

try{
	$req = $DB->query($sql);
	while($d = $req->fetch(PDO::FETCH_ASSOC)){
		echo '<pre>';
		print_r($d);
		echo '</pre>';
	} 
}
catch(PDOException $e){
	echo 'requete down';
}*/


?>