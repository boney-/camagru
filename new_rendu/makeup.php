<?php 

require_once 'inc/functions.php';

if ($_POST){

	$imgPath = htmlspecialchars($_POST['imgPath']);
	$filterPath = "img/filters/".htmlspecialchars($_POST['filterId']).".png";
	$ext = htmlspecialchars($_POST['extension']);
 	$percent = htmlspecialchars($_POST['filterSize']);
 	$x = htmlspecialchars($_POST['x_coord']);
 	$y = htmlspecialchars($_POST['y_coord']);

 	filterResize($filterPath, $imgPath, $percent, $ext);
	//img_merge($imgPath, $ext, $filterPath, $x, $y);
}