<?php
namespace Vendor\Model;
use Vendor\Model\Episodio;
use Vendor\DAO\EpisodioDAO;
use Vendor\DAO\TemporadaDAO;
use Vendor\Lib\Util;

class Serie{
	private $id;
	private $nome;
	private $temporadas = array();

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

	public function getTemporadas(){
		return $this->temporadas;
	}

	public function setTemporadas(array $temporadas){
		$this->temporadas = $temporadas;
	}

	public function montaSerie($nome,$temporadas,$qtddEpisodios,
	 EpisodioDAO $episodioDao,TemporadaDAO $temporadaDao){
		$this->nome = $nome;
		
		for($contTemp = 0;$contTemp < $temporadas;$contTemp++) {
			$temporada = new Temporada($this->getId());
			$temporada->setNome($this->getNome()." temporada ".($contTemp+1));
			$temporadaDao->adiciona($temporada);

			Util::popula($temporada,$temporadaDao->buscaPorNome($temporada->getNome()));

			$episodios = array();
			for($contEpi = 0; $contEpi < $qtddEpisodios; $contEpi++){
				$episodio = new Episodio($temporada->getId());
				
				$episodio->setNome("episodio ".($contEpi+1));
				$episodioDao->adiciona($episodio);

				array_push($episodios, $episodio);
			}
			$temporada->setEpisodios($episodios);

			array_push($this->temporadas, $temporada);
		}
	}
}
