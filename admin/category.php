<?php
include '../lib/includes.php';
include '../partials/admin_header.php';

//
if (isset($_GET['delete'])) {
	# code...
	checkCsrf();

	$id = $db->quote($_GET['delete']);
	$db->query("DELETE FROM categories WHERE id=$id");
	setFlash("La catégorie a bien été supprimée."); 
	header('location:category.php');
	die();
}

// AFFICHAGE DES CATEGORIES
$select = $db->query('SELECT id, name, slug FROM categories');
$categories = $select->fetchAll(); 

?>

<div class="container">
	<h2>Les catégories</h2>

	<p>
		<a href="category_edit.php" class="btn btn-secondary btn-sm">Ajouter une catégorie</a>
	</p>

	
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nom</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($categories as $category): ?>
				<tr>
					<td><?= $category['id']; ?></td>
					<td><?= $category['name']; ?></td>
					<td>
						<a href="category_edit.php?id=<?= $category['id']; ?>" class="btn btn-primary btn-sm">Editer</a>
						<a href="?delete=<?= $category['id']; ?>&<?= csrf() ?>" class="btn btn-danger btn-sm" onclick="return confirm('Etes-vous sûr de cette opération ?')">Supprimer</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?php include '../partials/footer.php'; ?>
