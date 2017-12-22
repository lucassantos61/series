<?php
namespace Vendor\DAO;
use Vendor\Model\Episodio;
use Vendor\Model\Temporada;
use Vendor\Lib\Util;

class EpisodioDAO{
	private $con;

	public function __construct($con){
		$this->con = $con;
	}

	public function adiciona(Episodio $episodio){
		$query = "insert into Episodio (nome,temporadaId) 
				   values('{$episodio->getNome()}',{$episodio->getTemporadaId()})";
		return $this->con->query($query);
	}

	public function remove(Temporada $temporada){
		$query = "DELETE FROM Episodio WHERE id = :id";
		$statement = $this->con->prepare($query);
		$statement->bindValue(':id',$temporada->getId());
		return $statement->execute();
	}

	public function lista($id){
		$query = "SELECT * FROM Episodio WHERE temporadaId = {$id}";
		$result = $this->con->query($query);

		$episodios = array();

		while($episodioArray = $result->fetch(\PDO::FETCH_ASSOC)){
			$episodio = new Episodio($id);
			$episodio = Util::popula($episodio,$episodioArray);

			array_push($episodios, $episodio);
		}
		return $episodios;
	}

	public function alteraStatusDosEpisodios(array $episodios,$temporadaId){
		$this->con->beginTransaction();
		$ids = count($episodios) > 0 ? implode(",",$episodios) : 0;
		$query = "update Episodio set status = 1 where id in ($ids) and temporadaId = {$temporadaId}";
		$query1 = $this->con->query($query);
		$query = "update Episodio set status = 0 where id not in ($ids) and temporadaId = {$temporadaId}";
		$query2 = $this->con->query($query);
		if ($query1 && $query2){
			$this->con->commit();	
			return;
		}
			$this->con->rollback();			
			return;
	}
}
