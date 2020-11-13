<?php 

$auth = 0; 
include 'lib/includes.php';

/** TRAITEMENT DU FORMULAIRE **/

if (isset($_POST['username']) && isset($_POST['password'])) {
 	# code...
 	$username = $db->quote($_POST['username']);
 	$password = sha1($_POST['password']);

 	$select = $db->query("SELECT * FROM users WHERE username=$username AND password='$password'");

 	if ($select->rowCount() > 0) {
 		# code...
 		$_SESSION['Auth'] = $select->fetch();
 		setFlash('Vous êtes maintenant connecté.');
 		header('location:' . WEBROOT . 'admin/index.php');
 		die();
 	}

 } 


/** INCLUSION DU HEADER **/

include 'partials/header.php'; 

?>



<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-5">
			<form action="" method="POST">
				<div class="form-group">
					<label for="username">Nom d'utilisateur</label>
					<?= input('username'); ?>
				</div>
				<div class="form-group">
					<label for="password">Mot de passe</label>
					<input type="password" id="password" name="password" class="form-control">
				</div>
				<button type="submit" class="btn btn-secondary">Se connecter</button>
			</form>
		</div>
	</div>
</div>