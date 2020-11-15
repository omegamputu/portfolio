
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Mon administration</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= WEBROOT; ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="<?= WEBROOT; ?>css/style.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="<?= WEBROOT; ?>index.php">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="category.php" class="nav-link">Catégories</a>
          </li>
          <li class="nav-item">
            <a href="work.php" class="nav-link">Réalisations</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container">
       <?= flash(); ?>
    </div>

