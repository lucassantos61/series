<?php
namespace Vendor\Controller;
use Vendor\Model\Temporada;
use Vendor\DAO\SerieDAO;
use Vendor\DAO\TemporadaDAO;
use Vendor\DAO\EpisodioDAO;
use Vendor\Lib\View;
use Vendor\Factory\ConnectionFactory;

class TemporadaController{
	private $temporadaDao;
	private $episodioDao;
	private $con;

	public function __construct(){
		$this->con = ConnectionFactory::getConnection();
		
		$this->episodioDao = new EpisodioDAO($this->con);
		$this->temporadaDao = new TemporadaDAO($this->con,$this->episodioDao);
	}

	public function index(){
		$serieId = $_GET["serie"];
		$temporadas = $this->temporadaDao->lista($serieId);

		$view = new View('index','Temporadas');
		$view->viewBag("temporadas",$temporadas);
		$view->viewBag("serieId",$serieId);

		return $view;
	}
}