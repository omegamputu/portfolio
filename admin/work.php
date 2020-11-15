<?php
include '../lib/includes.php';
include '../partials/admin_header.php';

//
if (isset($_GET['delete'])) {
	# code...
	checkCsrf();

	$id = $db->quote($_GET['delete']);
	$db->query("DELETE FROM works WHERE id=$id");
	setFlash("La réalisation a bien été supprimée."); 
	header('location:work.php');
	die();
}

// AFFICHAGE DES works
$select = $db->query('SELECT id, name, slug FROM works');
$works = $select->fetchAll(); 

?>

<div class="container">
	<h2>Les réalisations</h2>

	<p>
		<a href="work_edit.php" class="btn btn-secondary btn-sm">Ajouter une réalisation</a>
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
			<?php foreach($works as $work): ?>
				<tr>
					<td><?= $work['id']; ?></td>
					<td><?= $work['name']; ?></td>
					<td>
						<a href="work_edit.php?id=<?= $work['id']; ?>" class="btn btn-primary btn-sm">Editer</a>
						<a href="?delete=<?= $work['id']; ?>&<?= csrf() ?>" class="btn btn-danger btn-sm" onclick="return confirm('Etes-vous sûr de cette opération ?')">Supprimer</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?php include '../partials/footer.php'; ?>
