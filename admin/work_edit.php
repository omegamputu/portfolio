<?php
include '../lib/includes.php';
include '../partials/admin_header.php';

if (isset($_POST['name']) && isset($_POST['slug'])) {
	# code...
	var_dump($_POST);
	var_dump($_FILES);
	die();
	checkCsrf();
	$slug = $_POST['slug'];
	if (preg_match('/^[a-z\-0-9]+$/', $slug)) {
		# code...
		$name = $db->quote($_POST['name']);
		$slug = $db->quote($_POST['slug']);
		$content = $db->quote($_POST['content']);
		$category_id = $db->quote($_POST['category_id']);

		// SAUVEGARDE DE LA REALISATION

		if (isset($_GET['id'])) {
			# code...
			$id = $db->quote($_GET['id']);
			$db->query("UPDATE works SET name=$name, slug=$slug, content=$content, category_id=$category_id WHERE id=$id");
		}else{
			$db->query("INSERT INTO works SET name=$name, slug=$slug, content=$content, category_id=$category_id");
			$_GET['id'] = $db->lastInsertId();
		}
		setFlash('La réalisation a bien été créer');

		// ENVOIE DES IMAGES

		//header('location:work.php');
		die();
	}else {
		setFlash('Le slug n\'est pas validé', 'danger');
	}
}

if (isset($_GET['id'])) {
	# code...
	$id = $db->quote($_GET['id']);
	$select = $db->query("SELECT * FROM works WHERE id=$id");
	if ($select->rowCount() == 0) {
		# code...
		setFlash("Il n'y a pas de réalisation avec cet ID", 'danger');
		header('location:category.php');
		die();
	}
	$_POST = $select->fetch();
}

$query = $db->query('SELECT id, name FROM categories ORDER BY name ASC');
$categories = $query->fetchAll();
$categories_list = array();
foreach ($categories as $category) {
	# code...
	$categories_list[$category['id']] = $category['name'];
}

?>

<div class="container mb-4">
	<h2>Editer une réalisation</h2>

	<p>
		<a href="work.php" class="btn btn-secondary btn-sm">Mes réalisations</a>
	</p>

	<div class="row">
		<div class="col-md-5">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="name">Nom de la réalisation</label>
					<?= input('name') ?>
				</div>
				<div class="form-group">
					<label for="slug">URL de la réalisation</label>
					<?= input('slug') ?>
				</div>
				<div class="form-group">
					<label for="content">Contenu</label>
					<?= textarea('content') ?>
				</div>
				<div class="form-group">
					<label for="category_id">Catégorie</label>
					<?= select('category_id', $categories_list) ?>
				</div>
				<div class="form-group">
					<input type="file" name="image">
				</div>
				<?= csrfInput() ?>
				<button type="submit" class="btn btn-secondary">Enregistrer</button>
			</form>
		</div>
	</div>
</div>

<?php include '../partials/footer.php'; ?>
