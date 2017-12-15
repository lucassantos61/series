<?php
namespace Vendor\Model;
class Episodio{
	private $id;
	private $status = FALSE;
	private $nome;
	private $temporadaId;
	
	public function __construct($temporadaId){
		$this->temporadaId = $temporadaId;
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNome(){
		return $this->nome;
	}	

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getTemporadaId(){
		return $this->temporadaId;
	}

	public function setTemporadaId($id){
		$this->temporadaId = $id;
	}

	public function marcarVisto(){
		$this->status = TRUE;
	}

	public function marcarNaoVisto(){
		$this->status = FALSE;
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $status;
	}
}