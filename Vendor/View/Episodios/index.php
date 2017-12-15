<!DOCTYPE html>
<html>
<head>
	<title>Lista de episodios</title>
	<link rel="stylesheet" type="text/css" href="/Vendor/View/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Vendor/View/css/index.css">
  <link rel="stylesheet" type="text/css" href="/Vendor/View/css/check-box.css">
</head>
<body>
  <?php include 'Vendor/View/Shared/Header.php' ?>
  
  <form class="list-group form-inline" action="index.php?c=Episodio&m=alteraStatus&temporadaId=<?= $viewBag['temporadaId']?>&serieId=<?= $viewBag['serieId']?>" method="POST">
    <?php foreach ($viewBag["episodios"] as $contador => $episodio): ?>
     <li class="list-group-item">
     <?= $episodio->getNome(); ?>
       <div class="material-switch pull-right">
          <input id="visto<?=$contador+1?>" name="status[<?=$episodio->getId()?>]"
           type="checkbox" 
           <?php
           if($episodio->getStatus() == TRUE){
            echo "checked";
            }?>
            value = "<?=$episodio->getId()?>"
            />
        <label for="visto<?=$contador+1?>" class="label-success"/>
      </div>
    </li>
  <?php endforeach ?>
  <input type="submit" class="btn btn-success" value="voltar">
  </form>
</body>
</html>