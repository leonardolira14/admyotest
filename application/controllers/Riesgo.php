<?
/**
 * 
 */
class Riesgo extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Notificaciones');
		$this->load->model('Model_Riesgo');
		$this->load->model('Model_Imagen');
		$this->load->helper('selec_Titulo');
	}
	public function RiesgoClientes($met){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$datar["rec"]=json_encode($this->Model_Riesgo->obtenerrisgos($IDEmpresa,"clientes",$met));
			$datar["tip"]=$met;
			$this->load->view("views/newvista/riesgocliente",$datar);
			$this->load->view('footer');

		}else{
			redirect('');
		}
	}
	public function RiesgoProveedor($met){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$datar["rec"]=json_encode($this->Model_Riesgo->obtenerrisgos($IDEmpresa,"proveedores",$met));
	
			$datar["tip"]=$met;
			$this->load->view("views/newvista/riesgoproveedor",$datar);
			$this->load->view('footer');

		}else{
			redirect('');
		}
	}
	public function detalles($tipo,$fecha)
	{
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$date["tip"]=$tipo;
			$date["Fecha"]=$fecha;
			$date["rec"]=json_encode($this->Model_Riesgo->detalles($tipo,$fecha,$IDEmpresa));
			
			$this->load->view("views/newvista/detallesriesgo",$date);
			$this->load->view('footer');

		}else{
			redirect('');
		}
	}
}