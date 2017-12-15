<?php
namespace Vendor\Model;

class Temporada{
	private $serieId;
	private $id;
	private $nome;
	private $episodios = array();

	public function __construct($serieId){
		$this->serieId = $serieId;
	}

	public function getSerieId(){
		return $this->serieId;
	}	

	public function setSerieId($id){
		$this->serieId = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getNome(){
		return $this->nome;
	}	

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getEpisodios(){
		return $this->episodios;
	}


	public function setEpisodios($episodios){
		$this->episodios = $episodios;
	}

	public function getEpisodiosTerminados(){
		$quantidade = 0;

		foreach ($this->episodios as $episodio) {
			if($episodio->getStatus()){
				$quantidade++;
			}
		}
		return $quantidade;
	}
}