<?php

session_start();
//include_once('bd.php');
function __autoload($class_name) {
    include_once 'Models/'.$class_name . '.php';
}

?>