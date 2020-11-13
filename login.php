<?php $auth = 0; ?>
<?php include 'lib/includes.php'; ?>
<?php include 'partials/header.php'; ?>

<?php 
var_dump($_POST)
?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-5">
			<form action="" method="POST">
				<div class="form-group">
					<label for="username">Nom d'utilisateur</label>
					<input type="text" id="username" name="username" value="<?php if(isset($_POST['username'])) {echo $_POST['username']; } ?>" class="form-control">
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