<?php
function debug($variable){
	
	echo '<pre>' . print_r($variable, true) . '</pre>';
}

function str_random($length){
	$alpha = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
	//lettre répétée 60 foix
	return substr(str_shuffle(str_repeat($alpha, $length)), 0, $length);
}