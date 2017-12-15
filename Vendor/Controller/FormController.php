<?php
namespace Vendor\Controller;

use Vendor\Lib\View;
use Vendor\Lib\Util;
use Vendor\Model\Serie;
use Vendor\Factory\ConnectionFactory;
use Vendor\DAO\SerieDAO;
use Vendor\DAO\TemporadaDAO;
use Vendor\DAO\EpisodioDAO;

class FormController{
	private $con;
	private $serieDao;
	private $temporadaDao;
	private $episodioDao;

	public function __construct(){
		$this->con = ConnectionFactory::getConnection();
		
		$this->episodioDao = new EpisodioDAO($this->con);
		$this->temporadaDao = new TemporadaDAO($this->con,$this->episodioDao);
		$this->serieDao = new SerieDAO($this->con,$this->temporadaDao);
	}
	
	public function adiciona(){
		$view = new View("form","Series");
		$conteudo = array('nome' => $_POST["nome"], 'temporadas' => $_POST["temporadas"],'episodios' => $_POST["episodeos"]);
		if (array_search("", $conteudo)) {
			$menssagem = "Por favor, insira uma serie com nome temporadas e episodios.";
			header("Location: /index.php?c=Serie&m=form&menssagem=".$menssagem);
			return;
		}
			$serie = new Serie();
			$serie->setNome($conteudo['nome']);
			$menssagem = $this->serieDao->adiciona($serie)?"Adicionado com sucesso":"Ocorreu um erro ao adicionar";
			$serie = Util::popula($serie,$this->serieDao->buscaPorNome($conteudo['nome']));
			$serie->montaSerie($conteudo['nome'],$conteudo['temporadas'],$conteudo['episodios'],$this->episodioDao,$this->temporadaDao);
		header("Location: /index.php?c=Serie&m=form&menssagem=".$menssagem);
		return;
	}

	public function remove(){
		$view = new View("form","Series");
		$serieId = ($_POST['serie'] == "") ? 0 : $_POST['serie'];
		if (!$this->serieDao->remove($serieId) || $serieId == 0 ){
			$menssagem = "Selecione uma serie para ser removida";
			header("Location: /index.php?c=Serie&m=form&menssagem=".$menssagem);
			return;	
		}
		
		$menssagem = "Serie removida com sucesso";
		header("Location: /index.php?c=Serie&m=form&menssagem=".$menssagem);
		return;

	}
}