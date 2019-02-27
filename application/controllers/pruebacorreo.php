<?

/**
 * 
 */
class pruebacorreo extends CI_Controller
{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Usuarios');
		$this->load->model('Model_Empresa');
		$this->load->model('Model_Email');
		$this->load->helper('form');
	}

	public function prueba1(){
		$this->Model_Email->invitar_usuario("RAzon Social","lira053@gmail.com","PGEG243%","token");
	}
}