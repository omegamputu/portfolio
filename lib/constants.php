<?php
$directory = basename(dirname(dirname(__FILE__)));
$url = explode($directory, $_SERVER['REQUEST_URI']);
if (count($url) == 1) {
	# code...
	define('WEBROOT', '/');
}else{
	define('WEBROOT', $url[0] . 'portfolio/');
}


