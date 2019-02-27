<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set ("America/Mexico_City");
if (!defined('BASEPATH'))
   exit('No direct script access allowed');

class Activar extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Notificaciones');
		$this->load->model('Model_Conecta');
		$this->load->model('Model_Empresa');
		$this->load->model('Model_Usuarios');
		$this->load->helper('selec_Titulo');
	}
	public function acttoken(){
		$id1 =  $this->uri->segment(3);
		if($id1!=""){
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
		
			$resp=$this->Model_Usuarios->activartoken($id1);
			if($id1==''){
					$data["dat"]="Token no valido, Intente de nuevo.";
			}else if($resp==true){
					$data["dat"]="<span class='text-center'>Cuenta Activada</span><p class='text-center'>!Bienvenido¡";
			}else{
				$data["dat"]="ENHORABUENA, ACABAS DE ACTIVAR TU CUENTA.<p>GRACIAS POR CONFIAR EN NOSOTROS.<p>EL EQUIPO DE ADMYO";
			}
			$this->load->view('views/activarusu',$data);
		    $this->load->view('footer');
		}else{
		
		}
	}
	public function activarpago(){
		$result = @file_get_contents('php://input');
		$fp = fopen('acceso.txt', 'w+');
		fwrite($fp, $result);
		$data = json_decode($result);
		http_response_code(200);
		if(isset($data)){
			if($data->type=='charge.paid'){
				$numreferencia=$data->data->object->order_id;
				$this->Model_Conecta->activarpago($numreferencia);
			}
		}
		
	}
}