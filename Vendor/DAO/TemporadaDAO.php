<?php
namespace Vendor\DAO;
use Vendor\Model\Temporada;
use Vendor\Model\Serie;
use Vendor\Lib\Util;
use Vendor\DAO\EpisodioDAO;

class TemporadaDAO{
	private $con;
	private $episodioDao;

	public function __construct($con, EpisodioDao $episodioDao){
		$this->con = $con;
		$this->episodioDao = $episodioDao;
	}

	public function adiciona(Temporada $temporada){
		$query = "insert into Temporada (serieId,nome) 
				   values(
				   {$temporada->getSerieId()},			
				   '{$temporada->getNome()}')";
		return $this->con->query($query);
	}

	public function remove(Temporada $temporada){
		$query = "delete from Temporada where id = {$temporada->getId()}";
	}

	public function lista($id){
		$query = "SELECT * FROM Temporada WHERE serieId = {$id}";
		$result = $this->con->query($query);
	
		$temporadas = array();

		while($temporadaArray = $result->fetch(\PDO::FETCH_ASSOC)){
			$temporada = new Temporada($id);
			$temporada = Util::popula($temporada,$temporadaArray);

			$episodios = $this->episodioDao->lista($temporada->getId());
			$temporada->setEpisodios($episodios);

			array_push($temporadas, $temporada);
		}

		return $temporadas;
	}

	public function buscaPorNome($nome){
		$query = "SELECT * FROM Temporada WHERE nome = '{$nome}' ORDER BY id DESC";
		
		$result = $this->con->query($query);
		return $result->fetch(\PDO::FETCH_ASSOC);
	}
}
