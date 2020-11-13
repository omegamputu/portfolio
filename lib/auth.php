<?php

session_start();

if (!isset($_SESSION['id'])) {
	# code...
	header('location:' . WEBROOT . 'login.php');
}