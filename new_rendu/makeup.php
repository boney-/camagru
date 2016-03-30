<?php 

require_once 'inc/functions.php';

if ($_POST){

	$imgPath = htmlspecialchars($_POST['imgPath']);
	$ext = htmlspecialchars($_POST['extension']);
 	$id = htmlspecialchars($_POST['filterId']);
 	$percent = htmlspecialchars($_POST['filterSize']);
 	$x = htmlspecialchars($_POST['x_coord']);
 	$y = htmlspecialchars($_POST['y_coord']);

	img_merge($imgPath, $ext, $id, $x, $y);
}