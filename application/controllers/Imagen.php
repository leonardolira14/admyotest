<?

class Imagen extends CI_Controller
{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Notificaciones');
		$this->load->model('Model_Empresa');
		$this->load->model('Model_Imagen');
		$this->load->helper('selec_Titulo');
	}
	//funcion para mostrar imagen como cliente basado en calificaciones de proveedores
	Public function ImgCliente($tip){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$data["tip"]=$tip;
			$data["datosimg"]=$this->Model_Imagen->imgcliente($IDEmpresa,$tip,"Cliente");
			$this->load->view('head/head_profile',$n);
			$this->load->view('views/newvista/imgcliente',$data);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	Public function ImgProveedor($tip){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$data["tip"]=$tip;
			$data["datosimg"]=$this->Model_Imagen->imgcliente($IDEmpresa,$tip,"Proveedor");
			$this->load->view('head/head_profile',$n);
			$this->load->view('views/newvista/imgproveedor',$data);
			$this->load->view('footer');
			
		}else{
			$this->load->view('footer');
			redirect('');
		}
	}
	public function detalles($tip,$fecha){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$data["tip"]=$tip;
			$data["fecha"]=$fecha;
			$data["detallesimagen"]=json_encode( $this->Model_Imagen->detalleImagen($tip,$IDEmpresa,$fecha));
			$this->load->view('head/head_profile',$n);
			$this->load->view('views/newvista/detalleimagen',$data);
			$this->load->view('footer');
			
		}else{
			$this->load->view('footer');
			redirect('');
		}
	}

}