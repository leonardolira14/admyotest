<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Asociaciones extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Usuarios');
		$this->load->model('Model_Empresa');
		$this->load->model('Model_Registro');
		$this->load->helper('form');
	}

	public function AddAsocia(){
		$datos=json_decode($_POST["datos"]);
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			if($this->session->userdata('IDEmpresa')){
					$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
						$IDEmpresa=$datos->IDEmpresa;
			}
			
			$data["datos"]=$this->Model_Empresa->AddAsocia($IDEmpresa,$datos->Nombre_Asociacion,$datos->Web);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function DatAsocia(){
		$datos=json_decode($_POST["datos"]);
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$data["pass"]=1;
			$data["datos"]=$this->Model_Empresa->Getasociaciones("",$datos->asocia);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function DeleteAsocia(){
		$datos=json_decode($_POST["datos"]);
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){		
			$data["datos"]=$this->Model_Empresa->DeleteAsocia($datos->asocia);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function UpdateAsocia(){
		$datos=json_decode($_POST["datos"]);
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			if($this->session->userdata('IDEmpresa')){
					$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
						$IDEmpresa=$datos->IDEmpresa;
			}
			
			$data["datos"]=$this->Model_Empresa->UpdateAsocia($datos->num,$datos->Nombre_Asociacion,$datos->Web);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
}