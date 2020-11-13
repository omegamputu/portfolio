<?php

session_start();

if (!isset($auth)) {
	# code...
	if (!isset($_SESSION['Auth']['id'])) {
	# code...
	header('location:' . WEBROOT . 'login.php');
	die();
   }
}

if (!isset($_SESSION['csrf'])) {
	# code...
	$_SESSION['csrf'] = md5(time() + rand());
}

function csrf()
{
	return 'csrf=' . $_SESSION['csrf'];
}

function checkCsrf()
{
	if (!isset($_GET['csrf']) || $_GET['csrf'] != $_SESSION['csrf']) {
		# code...
		header('location:' . WEBROOT . '/csrf.php');
		die();
	}
}