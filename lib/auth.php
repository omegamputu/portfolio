<?php

session_start();

if (!isset(SESSION['id'])) {
	# code...
	//header('location:login.php');
}