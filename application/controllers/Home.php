<?php
if (!defined('BASEPATH'))
   exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Notificaciones');
		$this->load->model('Model_Registro');
		$this->load->model('Model_Conecta');
		$this->load->model('Model_Empresa');
		$this->load->model('Model_Usuarios');
		$this->load->helper('selec_Titulo');
	}
	public function indexold()
	{
		$this->load->view('head/head');
		$this->load->view('views/home');
		$this->load->view('views/prices');
		$this->load->view('footer');
	}
	public function index()
	{
		$respuesta["Estados"]=$this->Model_Registro->GetEstadoss('42');
		$respuesta["Idiomas"]=$this->Model_Registro->AllIdiomas();
		$respuesta["Paises"]=$this->Model_Registro->AllPais();
		$respuesta["sector"]=$this->Model_Registro->getSector();
		$this->load->view('views/newvista/master');
		$this->load->view('views/newvista/home',$respuesta);
		
		
	}
	public function completadatos($IDEmpresa){
		$respuesta["datos"]=$this->Model_Empresa->DatosEmpresa($IDEmpresa);
		$respuesta["Estados"]=$this->Model_Registro->GetEstadoss($respuesta["datos"][0]->Pais);
		$respuesta["Idiomas"]=$this->Model_Registro->AllIdiomas();
		$respuesta["Paises"]=$this->Model_Registro->AllPais();
		$respuesta["sector"]=$this->Model_Registro->getSector();
		$respuesta["datos"]=$this->Model_Empresa->DatosEmpresa($IDEmpresa);
		$respuesta["tiposempresa"]=$this->Model_Empresa->TipoEmpresa();
		$respuesta["noempleados"]=$this->Model_Empresa->NumerodeEmpleados();
		$respuesta["fac"]=$this->Model_Empresa->FaturacionAnuales();
		$respuesta["num"]=$IDEmpresa;
		$this->db->select('*');
		$this->load->view('views/newvista/master');
		$this->load->view('views/newvista/completereg',$respuesta);
	}


	//function para obtener los estados segun el pais
	public function getsstado($ai){
		
			$pais=$_GET["Pais"];
		
		
		$respuesta["estados"]=$this->Model_Registro->GetEstadoss($pais);
		echo json_encode($respuesta);

	}
	public function gracias(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
		
		}else{
			$this->load->view('head/head');
		}
		
		$this->load->view('views/gracias');
		$this->load->view('footer');
	}
	public function planes(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
		
		}else{
			$this->load->view('head/head');
		}
		
		$this->load->view('views/prices');
		$this->load->view('footer');
	}
	public function metodopago(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
		
		}else{
			$this->load->view('head/head');
		}
		
		$this->load->view('views/metodospago');
		$this->load->view('footer');
	}
	public function targeta(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
		
		}else{
			$this->load->view('head/head');
		}
		
		$this->load->view('views/targeta');
		$this->load->view('footer');
	}
	public function oxxo(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
		
		}else{
			$this->load->view('head/head');
		}
		
		$this->load->view('views/oxxo');
		$this->load->view('footer');
	}
	public function spei(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
		
		}else{
			$this->load->view('head/head');
		}
		
		$this->load->view('views/transfer');
		$this->load->view('footer');
	}
	public function pagartargeta(){
		$datos=json_decode($_POST["datos"]);
		$resp=$this->Model_Conecta->Targeta($datos->nombre." ".$datos->apellidos,$datos->email,$datos->token,$datos->plan,$datos->price);
		if(count($resp)==1){
			$data["pass"]=0;
			$data["mensaje"]=$resp;
		}else{
			$data["pass"]=1;
			$data["mensaje"]="ok";
			//registro el pago
			//obtenfo los datos de la empresa por medio del rfc
			$dat=$this->Model_Empresa->datosRFCEm($datos->rfc);
			$dat2=$this->Model_Usuarios->DatosUsuarioCorreo($datos->regCorreo);

			$this->Model_Empresa->RegPago($dat->IDEmpresa,'Targeta',$resp->id,$dat2->IDUsuario,'Pagado',$datos->price,$datos->plan);
			
			//actualizo los dias de pago 
			$this->Model_Empresa->DiasPago($dat->IDEmpresa); 
			//mando el mail
		}
		echo json_encode($data);
	}
	public function pagaroxxo(){
		$datos=json_decode($_POST["datos"]);
		$respuesta=$this->Model_Conecta->oxxo($datos->price,$datos->nombre." ".$datos->apellidos,$datos->email,$datos->tel,$datos->plan);
		if(count($respuesta)==1){
			$data["pass"]=0;
			$data["mensaje"]=$respuesta;
		}else{
			$data["pass"]=1;
		$data["mensaje"]=array("ID"=>$respuesta->id,"Metodopago"=>$respuesta->charges[0]->payment_method->service_name,"NoReferencia"=>$respuesta->charges[0]->payment_method->reference,"Totalpagar"=>$respuesta->amount,"Moneda"=>$respuesta->currency,"Cantidad"=>$respuesta->line_items[0]->quantity,"Producto"=>$respuesta->line_items[0]->name,"total"=>$respuesta->line_items[0]->unit_price);

			$dat=$this->Model_Empresa->datosRFCEm($datos->rfc);
			$dat2=$this->Model_Usuarios->DatosUsuarioCorreo($datos->regCorreo);

			$this->Model_Empresa->RegPago($dat->IDEmpresa,'Pago Oxxo',$respuesta->id,$dat2->IDUsuario,'Proceso',$datos->price,$datos->plan);
			
			//mando el mail
		}
			echo json_encode($data);
	}
	public function trasnfer(){
		$datos=json_decode($_POST["datos"]);
		$r=$this->Model_Conecta->tranfer($datos->price, $datos->nombre." ".$datos->apellidos, $datos->email, $datos->tel, $datos->plan);
		if(count($r)==1){
			$data["pass"]=0;
			$data["mensaje"]=$r;
		}else{
			$data["pass"]=1;
		$data["mensaje"]=array("ID"=>$r->id,"Banco"=>$r->charges[0]->payment_method->receiving_account_bank,"Cable"=>$r->charges[0]->payment_method->receiving_account_number,"Total"=>$r->amount/100);
		$dat=$this->Model_Empresa->datosRFCEm($datos->rfc);
		$dat2=$this->Model_Usuarios->DatosUsuarioCorreo($datos->regCorreo);
		$this->Model_Empresa->RegPago($dat->IDEmpresa,'SPEI',$r->id,$dat2->IDUsuario,'Proceso',$datos->price,$datos->plan);
		}
		echo json_encode($data);
	} 
	public function codepag(){
		if(isset($_POST["datos"])){
			$datos=json_decode($_POST["datos"]);
			$res=$this->Model_Empresa->revCode($datos->code);
			if($res==true){
				$da["pass"]=1;
				$da["mensaje"]="ok";
				$dat=$this->Model_Empresa->datosRFCEm($datos->rfc);
				$dat2=$this->Model_Usuarios->DatosUsuarioCorreo($datos->regCorreo);
				$this->Model_Empresa->RegPago($dat->IDEmpresa,'CODE',$datos->code,$dat2->IDUsuario,'Pagado',$datos->price,$datos->plan);
				$this->Model_Empresa->DiasPago($dat->IDEmpresa); 
			}else{
				$da["pass"]=0;
				$da["mensaje"]="Codigo no valido, verifique los digitos y la fecha de expiracion";
			}
			echo json_encode($da);
		}
	}
	public function mandacot(){
		if(isset($_POST["datos"])){
			//wnvio un mail
			$datos=json_decode($_POST["datos"]);
			enviarcotizacion($datos->email,$datos->nombre,$datos->tel,$datos->Plan);
		}else{
			$resp= mail_invitarUsu("lira@ztark.mx","RazonSoail","Token","clave");
			var_dump($resp);
		}
	}
}
