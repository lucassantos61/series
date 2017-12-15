<!DOCTYPE html>
<html>
<head>
	<title>Lista de séries</title>
	<link rel="stylesheet" type="text/css" href="/Vendor/View/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Vendor/View/css/index.css">
</head>
<body>
<?php include 'Vendor/View/Shared/Header.php' ?>
<ul class="list-group form-inline">
    <?php foreach ($viewBag["series"] as $serie): ?>
      <a href="index.php?c=Temporada&m=index&serie=<?=$serie->getId()?>"
       class="list-group-item">
       <?= $serie->getNome(); ?>
      </a>
    <?php endforeach ?>
  </ul>
</body>
</html>
