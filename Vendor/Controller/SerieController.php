<?php
namespace Vendor\Controller;

use Vendor\Lib\View;
use Vendor\Model\Serie;
use Vendor\Factory\ConnectionFactory;
use Vendor\DAO\SerieDAO;
use Vendor\DAO\TemporadaDAO;
use Vendor\DAO\EpisodioDAO;

class SerieController{
	private $serieDao;
	private $temporadaDao;
	private $episodioDao;
	private $con;

	public function __construct(){
		$this->con = ConnectionFactory::getConnection();
		$this->episodioDao = new EpisodioDAO($this->con);
		$this->temporadaDao = new TemporadaDAO($this->con,$this->episodioDao);
		$this->serieDao = new SerieDAO($this->con,$this->temporadaDao);
	}

	public function index(){
		$series = $this->serieDao->lista();	

		$view = new View('index','Series');
		$view->viewBag('series',$series);
		
		return $view;
	}

	public function form(){
		$series = $this->serieDao->lista();
		
		$view = new View('form','Series');
		$view->viewBag('series',$series);
		$view->viewBag('mensagem','');
		$view->viewBag('removido','');
		return $view;
	}
}