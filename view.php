<?php 
include 'lib/includes.php';
include 'lib/image.php';


if (!isset($_GET['slug'])) {
    # code...
    header('HTTP/1.1 301 Moved Permanently');
    header('location:index.php');
    die();
}

$slug = $db->quote($_GET['slug']);
$select = $db->query("SELECT * FROM works WHERE slug = $slug");
if ($select->rowCount() == 0) {
    # code...
    header('HTTP/1.1 301 Moved Permanently');
    header('location:index.php');
    die();
}

$work = $select->fetch();
$work_id = $work['id'];

$select = $db->query("SELECT * FROM images WHERE work_id = $work_id");
$images = $select->fetchAll();

include 'partials/header.php'; 

?>


  <div role="main" class="container">
    <h3><?= $work['name']; ?></h3>

    <p><?= $work['content']; ?></p>

    <?php foreach($images as $image): ?>
        <p>
            <img src="<?= WEBROOT; ?>img/works/<?= $image['name']; ?>" width="100">
        </p>
    <?php endforeach; ?>
  </div>

<?php include 'partials/footer.php'; ?>
