usbl <?php
namespace Vendor\Controller;
use Vendor\DAO\EpisodioDAO;
use Vendor\Lib\View;
use Vendor\Factory\ConnectionFactory;

class EpisodioController{
	private $episodioDao;
	private $con;

	public function __construct(){
		$this->con = ConnectionFactory::getConnection();
		
		$this->episodioDao = new EpisodioDAO($this->con);
	}

	public function index(){
		$serieId = $_GET["serieId"];
		$temporadaId = $_GET["temporadaId"];
		$episodios = $this->episodioDao->lista($temporadaId);

		$view = new View('index','Episodios');
		$view->viewBag("episodios",$episodios);
		$view->viewBag("serieId",$serieId);
		$view->viewBag("temporadaId",$temporadaId);

		return $view;
	}

	public function alteraStatus(){
		$serieId = $_GET["serieId"];
		$temporadaId = $_GET["temporadaId"];
		$statusArray = ($_POST["status"] == "") ? array() : $_POST["status"];

		$this->episodioDao->alteraStatusDosEpisodios($statusArray,$temporadaId);

		header("Location: index.php?c=Temporada&m=index&serie=".$serieId);
	}
}