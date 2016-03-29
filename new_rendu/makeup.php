<?php 

require_once 'inc/functions.php';

if ($_POST){

$pathToImg = "img/tmp/";
$pathToFilter = "img/filters/";


	$ext = htmlspecialchars($_POST['extension']);
 	$id = htmlspecialchars($_POST['filterId']);
 	$x = htmlspecialchars($_POST['x_coord']);
 	$y = htmlspecialchars($_POST['y_coord']);

	img_merge($ext, $id, $x, $y);
}