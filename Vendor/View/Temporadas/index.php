<!DOCTYPE html>
<html>
<head>
	<title>Lista de temporadas</title>
	<link rel="stylesheet" type="text/css" href="/Vendor/View/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Vendor/View/css/index.css">
</head>
<body>
  <?php include 'Vendor/View/Shared/Header.php' ?>
  <ul class="list-group form-inline">
    <?php foreach ($viewBag["temporadas"] as $temporada): ?>
      <a href="index.php?c=Episodio&m=index&serieId=<?=$viewBag['serieId']?>&temporadaId=<?=$temporada->getId()?>" class="list-group-item">
       <?= $temporada->getNome(); ?>
       <span class="badge">
        <?= $temporada->getEpisodiosTerminados() ?>
        /
        <?= sizeof($temporada->getEpisodios()); ?>
      </span>
      </a>
    <?php endforeach ?>
    <a href="index.php?c=Serie&m=index" class="btn btn-success">voltar</a>
  </ul>
</body>
</html>