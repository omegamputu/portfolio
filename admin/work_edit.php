<?php
include '../lib/includes.php';

if (isset($_POST['name']) && isset($_POST['slug'])) {
	# code...
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
		$work_id = $db->quote($_GET['id']);
		$files = $_FILES['images'];
		$images = array();
		require '../lib/image.php';
		foreach ($files['tmp_name'] as $k => $v) {
			# code...
			$images = array(
				'name' => $files['name'][$k],
				'tmp_name' => $files['tmp_name'][$k]
			);
			$extension = pathinfo($images['name'], PATHINFO_EXTENSION);
			if (in_array($extension, array('jpg', 'png'))) {
			    # code...
				$db->query("INSERT INTO images SET work_id=$work_id");
				$image_id = $db->lastInsertId();
				$image_name = $image_id . '.' . $extension;
				move_uploaded_file($images['tmp_name'], IMAGES . '/works/' . $image_name);
				resizeImage(IMAGES . '/works/' . $image_name, 150, 150);
				$image_name = $db->quote($image_name);
				$db->query("UPDATE images SET name=$image_name WHERE id=$image_id");
		    }
		}
		

		header('location:work.php');
		die();
	}else {
		setFlash('Le slug n\'est pas validé', 'danger');
	}
}

// Récuperation d'une réalisation

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

// Suppression d'une image
if (isset($_GET['delete_image'])) {
	# code...
	checkCsrf();
	$id = $db->quote($_GET['delete_image']);
	$select = $db->query("SELECT name, work_id FROM images WHERE id = $id");
	$image = $select->fetch();
	$images = glob(IMAGES . '/works/' . pathinfo($image['name'], PATHINFO_FILENAME) . '_*x*.*');
	if (is_array($images)) {
		# code...
		foreach ($images as $v) {
			# code...
			unlink($v);
		}
	}
	unlink(IMAGES . '/works/' . $image['name']);
	$db->query("DELETE FROM images WHERE id=$id");
	setFlash("L'image a bien été supprimée.");
	header('location:work_edit.php?id=' . $image['work_id']);
	die();
}

if (isset($_GET['highlight_image'])) {
	# code...
	checkCsrf();
	$work_id = $db->quote($_GET['id']);
	$image_id = $db->quote($_GET['highlight_image']);
	$db->query("UPDATE works SET image_id=$image_id WHERE id=$work_id");
	setFlash("L'image a bien été mise en avant.");
	header('location:work_edit.php?id=' . $_GET['id']);
	die();

}
// Récuperation de la liste des catégories

$query = $db->query('SELECT id, name FROM categories ORDER BY name ASC');
$categories = $query->fetchAll();
$categories_list = array();
foreach ($categories as $category) {
	# code...
	$categories_list[$category['id']] = $category['name'];
}

// Récuperation de la liste des images

if (isset($_GET['id'])) {
	# code...
	$id = $db->quote($_GET['id']);
	$query = $db->query("SELECT id, name FROM images WHERE work_id = $id");
	$images = $query->fetchAll();
}else{
	$images = array();
}


include '../partials/admin_header.php';

?>

<div class="container mb-4">
	<h2>Editer une réalisation</h2>

	<p>
		<a href="work.php" class="btn btn-secondary btn-sm">Mes réalisations</a>
	</p>

	<div>
		<form class="row" action="" method="post" enctype="multipart/form-data">
			<div class="col-md-6">
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
				
				<?= csrfInput() ?>
				<button type="submit" class="btn btn-secondary">Enregistrer</button>
			</div>
			<div class="col-md-6">
			    <?php foreach($images as $k => $image): ?>
			    	<p>
					    <img src="<?= WEBROOT; ?>img/works/<?= $image['name']; ?>" width="100">

			    		<a href="?delete_image=<?= $image['id']; ?>&<?= csrf(); ?>" onclick="return confirm('Etes-vous sûr de cette opération?');">
			    			Supprimer
				        </a>
				        <a href="?highlight_image=<?= $image['id']; ?>&id=<?= $_GET['id'] ?>&<?= csrf(); ?>">
			    			Mettre à la une
				        </a>
			    	</p>
		        <?php endforeach; ?>

		        <div class="form-group">
					<input type="file" name="images[]">
					<input type="file" name="images[]" class="d-none" id="duplicate">
				</div>
				<p>
					<a href="#" class="btn btn-success" id="duplicatebtn">Ajouter une image</a>
				</p>
		    </div>
		</form>
	</div>
</div>

<?php include '../partials/footer.php'; ?>
