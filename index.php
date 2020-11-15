<?php 
include 'lib/includes.php';
include 'lib/image.php';
include 'partials/header.php'; 

// Récuperation des réalisations
$select = $db->query("
	SELECT works.id, works.name, works.slug, images.name as image_name 
	FROM works 
	LEFT JOIN images ON images.id = works.image_id");
$works = $select->fetchAll();
?>
  <div role="main" class="container">

    <h1>Mon portfolio en PHP</h1>

    <div class="row">
    	<?php foreach($works as $work):  ?>
    		<div class="col-md-4">
    			<a href="view.php?slug=<?= $work['slug'] ?>" class="text-dark">
    				<img src="<?= WEBROOT; ?>img/works/<?= resizedName($work['image_name'], 150, 150); ?>" alt="">
    				<h5><?= $work['name']; ?></h5>
    			</a>
    		</div>
    	<?php endforeach;  ?>
    </div>

  </div>

<?php include 'partials/footer.php'; ?>
