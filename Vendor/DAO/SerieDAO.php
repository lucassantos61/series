<?php
namespace Vendor\DAO;

use Vendor\Lib\Util;
use Vendor\Model\Serie;
use Vendor\DAO\TemporadaDAO;

class SerieDAO{
	private $con;
	private $temporadaDao;

	public function __construct($con,TemporadaDAO $temporadaDao){
		$this->con = $con;
		$this->temporadaDao = $temporadaDao;
	}

	public function adiciona(Serie $serie){
		$query = "INSERT INTO Serie (nome) VALUES(:serie)";
		$statement = $this->con->prepare($query);
		$statement->bindValue(':serie',$serie->getNome());
		return $statement->execute();
	}

	public function remove(Serie $serie){
		$query = "DELETE FROM Serie WHERE id = :id";
		$statement = $this->con->prepare($query);
		$statement->bindValue(':id',$serie->getId());
		return $statement->execute();
	}

	public function lista(){
		$query = "SELECT * FROM Serie";
		//$statement = $this->con->prepare();
		$result = $this->con->query($query);
		$series = array();
		
		while($serieArray = $result->fetch(\PDO::FETCH_ASSOC)){			
			$serie = new Serie();
			$serie = Util::popula($serie,$serieArray);
			
			$temporadas = $this->temporadaDao->lista($serie->getId());
			$serie->setTemporadas($temporadas);
			
			array_push($series, $serie);
		}
		return $series;
	}

	public function buscaPorNome(string $nome){
	    $query = "SELECT * FROM Serie WHERE nome = :nome ORDER BY id DESC";
	    $statement = $this->con->prepare($query);
	    $statement->bindParam(':nome',$nome);
	    $statement->execute();
					
	    return $statement->fetch(\PDO::FETCH_ASSOC);
	}
}
