<?php
include '../lib/includes.php';
include '../partials/admin_header.php';

if (isset($_POST['name']) && isset($_POST['slug'])) {
	# code...
	checkCsrf();
	$slug = $_POST['slug'];
	if (preg_match('/^[a-z\-0-9]+$/', $slug)) {
		# code...
		$name = $db->quote($_POST['name']);
		$slug = $db->quote($_POST['slug']);

		if (isset($_GET['id'])) {
			# code...
			$id = $db->quote($_GET['id']);
			$db->query("UPDATE categories SET name=$name, slug=$slug WHERE id=$id");
		}else{
			$db->query("INSERT INTO categories SET name=$name, slug=$slug");
		}
		setFlash('La catégorie a bien été créer');
		header('location:category.php');
		die();
	}else {
		setFlash('Le slug n\'est pas validé', 'danger');
	}
}

if (isset($_GET['id'])) {
	# code...
	$id = $db->quote($_GET['id']);
	$select = $db->query("SELECT * FROM categories WHERE id=$id");
	if ($select->rowCount() == 0) {
		# code...
		setFlash("Il n'y a pas de catégorie avec cet ID", 'danger');
		header('location:category.php');
		die();
	}
	$_POST = $select->fetch();
}

?>

<div class="container">
	<h2>Editer une catégorie</h2>

	<p>
		<a href="category.php" class="btn btn-secondary btn-sm">Les catégories</a>
	</p>

	<div class="row">
		<div class="col-md-5">
			<form action="" method="post">
				<div class="form-group">
					<label for="name">Nom de la catégorie</label>
					<?= input('name') ?>
				</div>
				<div class="form-group">
					<label for="slug">URL de la catégorie</label>
					<?= input('slug') ?>
				</div>
				<?= csrfInput() ?>
				<button type="submit" class="btn btn-secondary">Enregistrer</button>
			</form>
		</div>
	</div>
</div>

<?php include '../partials/footer.php'; ?>
