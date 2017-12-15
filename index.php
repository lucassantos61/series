<?php 
include "autoload.php";

if(isset($_GET["m"])){
	$metodo = $_GET["m"];
}
else{
	$metodo = "index";
}

$metodo = strtolower($metodo);

if(isset($_GET["c"])){
	$nomeParcialController = $_GET["c"];
	$nomeParcialController = ucfirst(strtolower($nomeParcialController));
}
else{
	$nomeParcialController = "Index";
}

$nomeController = "Vendor\\Controller\\{$nomeParcialController}Controller";

 $controller = new $nomeController();
 $view = $controller->$metodo();
 
 $view->render();
?>
