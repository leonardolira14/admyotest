<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Calificaciones extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Usuarios');
		$this->load->model('Model_Empresa');
		$this->load->model('Model_Calificaciones');
		$this->load->helper('form');
	}
	public function TotalCalificacionRC(){
		if(isset($_POST["datos"])){
			$datos=json_decode($_POST["datos"]);
			  if($datos->IDEmpresa!=""){
					$IDEmpresa=$datos->IDEmpresa;
			}else{
					$IDEmpresa=$this->session->userdata('IDEmpresa');
			}
			$data["Activas"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Recibida","Cliente",$datos->anio,"Activa");
			$data["Pendientes"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Recibida","Cliente",$datos->anio,"Pendiente");
			$data["grafica"]=$this->Model_Calificaciones->CalificacionesdeunAnio($IDEmpresa,"Recibida","Cliente",$datos->anio,"Activa");
			$data["anio"]=$datos->anio;
			echo json_encode($data);
		}else{
			exit();
		}
		
	}
	public function TotalCalificacionReC(){
		if(isset($_POST["datos"])){
			$datos=json_decode($_POST["datos"]);
			  if(isset($datos->IDEmpresa)){
					$IDEmpresa=$datos->IDEmpresa;
			}else{
					$IDEmpresa=$this->session->userdata('IDEmpresa');
			}
			$data["Activas"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Realizada","Cliente",$datos->anio,"Activa");
			$data["Pendientes"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Realizada","Cliente",$datos->anio,"Pendiente");
			$data["grafica"]=$this->Model_Calificaciones->CalificacionesdeunAnio($IDEmpresa,"Realizada","Cliente",$datos->anio,"Activa");
			$data["anio"]=$datos->anio;
			echo json_encode($data);
		}else{
			exit();
		}
		
	}
	public function TotalCalificacionRP(){
		if(isset($_POST["datos"])){
			$datos=json_decode($_POST["datos"]);
			
			 if($datos->IDEmpresa!=""){
					$IDEmpresa=$datos->IDEmpresa;
			}else{
					$IDEmpresa=$this->session->userdata('IDEmpresa');
			}

			$data["Activas"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Recibida","Proveedor",$datos->anio,"Activa");
			$data["Pendientes"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Recibida","Proveedor",$datos->anio,"Pendiente");
			$data["grafica"]=$this->Model_Calificaciones->CalificacionesdeunAnio($IDEmpresa,"Recibida","Proveedor",$datos->anio,"Activa");
			$data["anio"]=$datos->anio;
			echo json_encode($data);
		}else{
			exit();
		}
		
		}
		public function TotalCalificacionReP(){
		if(isset($_POST["datos"])){
			$datos=json_decode($_POST["datos"]);
			 if(isset($datos->IDEmpresa)){
					$IDEmpresa=$datos->IDEmpresa;
			}else{
					$IDEmpresa=$this->session->userdata('IDEmpresa');
			}
			$data["Activas"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Realizada","Proveedor",$datos->anio,"Activa");
			$data["Pendientes"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Realizada","Proveedor",$datos->anio,"Pendiente");
			$data["grafica"]=$this->Model_Calificaciones->CalificacionesdeunAnio($IDEmpresa,"Realizada","Proveedor",$datos->anio,"Activa");
			$data["anio"]=$datos->anio;
			echo json_encode($data);
		}else{
			exit();
		}
		
		}
	public function CalificacionesBruto(){
		$datos=json_decode($_POST["datos"]);

			 if(isset($datos->IDEmpresa)){
					$IDEmpresa=$datos->IDEmpresa;
			}else{
					$IDEmpresa=$this->session->userdata('IDEmpresa');
			}
	$data["calificaciones"]=$this->Model_Calificaciones->CalificacionesAcumuladasBruto($IDEmpresa,$datos->forma,$datos->tipo,$datos->Status,$datos->Fecha1,$datos->Fecha2,$datos->cliente);
		echo json_encode($data);
	}
	public function solicita(){
		if(isset($_POST["datos"])){
			$datos=json_decode($_POST["datos"]);
			$rt=$this->Model_Calificaciones->cambioestado($datos->num,$datos->tip);
			//$rt=$this->Model_Calificaciones->cambioestado('940','sinrelacion');
		//$rt=ms_pendienteanulacionvalorada('leon_lira_@hotmail.com',"la razon","la otra razon",'fecha');
	
			//var_dump($rt);
			echo json_encode($rt);
		}else{
			exit();
		}
	}
	public function detallescuestinario(){
		if(isset($_POST["datos"])){
			$datos=json_decode($_POST["datos"]);
			$d=$this->Model_Calificaciones->detallescalif($datos->num);
			echo json_encode($d);
		}else{
			exit();
		}
	}
	public function modificarval(){
		if(isset($_POST["datos"])){
			$datos=json_decode($_POST["datos"]);
			$d=$this->Model_Calificaciones->modificarval($datos->num);
			echo json_encode($d);
		}else{
			exit();
		}
	}

}
