<?php

session_start();

if (!isset($auth)) {
	# code...
	if (!isset($_SESSION['id'])) {
	# code...
	header('location:' . WEBROOT . 'login.php');
   }
}