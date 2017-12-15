<?php 
	$series = $viewBag["series"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gerenciador</title>
	<link rel="stylesheet" type="text/css" href="/Vendor/View/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Vendor/View/css/form.css">
</head>
<body>
<?php include 'Vendor/View/Shared/Header.php' ?>
<?php if (isset($_GET["menssagem"])) { ?>
	<div class="alert alert-info text-center">
		<?= $_GET["menssagem"] ?>
	</div>
<?php } ?>
<h2>Adicione uma serie!</h2>
<form class="form-horizontal adiciona" action="index.php?c=Form&m=adiciona" method="POST">
	<div class="form-group">
	  <label class="col-md-4 control-label" for="textinput">Nome</label>  
	  <div class="col-md-4">
	  	<input id="nome" name="nome" type="text" placeholder="digite o nome da serie" class="form-control input-md">
	  </div>
	</div>
	<div class="form-group">  
	  <label class="col-md-4 control-label" for="textinput">Quantidade de temporadas</label>  
	  <div class="col-md-4">
	  	<input name="temporadas" type="number" placeholder="0" min="0" class="form-control input-md">
	  </div>
	</div>
	<div class="form-group">  
	  <label class="col-md-4 control-label" for="textinput">Quantidade de episodeos por temporada</label>  
	  <div class="col-md-4">
	  	<input name="episodeos" type="number" placeholder="0" min="0" class="form-control input-md">
	  </div>
	</div>
	<div class="form-group">
  		<div class="col-md-6 control-label">
    		<button type="submit" class="btn btn-success">Salvar</button>
  		</div>
	</div>
</form>

<hr>
<?php if (isset($removido)) { ?>
	<div class="alert alert-info text-center">
		<?= $removido ?>
	</div>
<?php } ?>
<h2>Remova uma serie!</h2>
<form class="remove" action="index.php?c=Form&m=remove" method="POST">
	<div class="form-group">
	  <div class="control-label">
	    <select name="serie" class="form-control">
	    <?php foreach ($series as $serie): ?>
	    	<option value="<?= $serie->getId(); ?>"><?= $serie->getNome(); ?></option>
	    <?php endforeach ?>
	    </select>
	  </div>
	</div>
	<div class="form-group">
  		<div class="col-md-6 control-label">
    		<button type="submit" class="btn btn-danger">Remover</button>
  		</div>
	</div>
</form>
</body>
</html>