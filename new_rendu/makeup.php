<?php 

/*
http://www.kubilayerdogan.net/html2canvas-take-screenshot-of-web-page-and-save-it-to-server-javascript-and-php/
*/

require_once 'inc/functions.php';

if ($_POST){

	if (isset($_POST['extension'])) {
		$imgPath = htmlspecialchars($_POST['imgPath']);
		$ext = htmlspecialchars($_POST['extension']);
	} else {
		$imgVal = htmlspecialchars($_POST['img_val']);
 		$userId = htmlspecialchars($_POST['user_id']);
 		$imgPath = "img/tmp/".$userId."-tmp_img.png";
		$ext = "png";
	}

	$filterId = htmlspecialchars($_POST['filterId']);
	$filterPath = "img/filters/".$filterId.".png";
	$tempFilter = "img/tmp/tmp_filter.png";
 	$percent = htmlspecialchars($_POST['filterSize']);
 	$x = htmlspecialchars($_POST['x_coord']);
 	$y = htmlspecialchars($_POST['y_coord']);

	//if photo taken with cam posted
 	if (isset($imgVal)) {
 		//Get the base-64 string from data
		$filteredData=substr($imgVal, strpos($imgVal, ",")+1);
		//Decode the string
		$unencodedData=base64_decode($filteredData);
		//Save the image
		file_put_contents($imgPath, $unencodedData);
 	}

 	filterResize($filterPath, $imgPath, $percent, $ext);
	img_merge($imgPath, $ext, $tempFilter, $x, $y);
}