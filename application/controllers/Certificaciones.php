<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Certificaciones extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Usuarios');
		$this->load->model('Model_Empresa');
		$this->load->model('Model_Registro');
		$this->load->helper('form');
	}
	public function subirarcvhivo(){
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$config=[];
			$config["upload_path"]="./assets/certificaciones/";
			$config['allowed_types'] = 'gif|jpg|png|pdf';
			$config['max_size'] = '200000';
			$this->load->library('upload', $config);
	//SI LA IMAGEN FALLA AL SUBIR MOSTRAMOS EL ERROR EN LA VISTA UPLOAD_VIEW
			if (!$this->upload->do_upload('file')) {
				$error = array('error' => $this->upload->display_errors());
				$data["pass"]=0;$data["mensaje"]=$error["error"];
			} else {
    	//EN OTRO CASO SUBIMOS LA IMAGEN, CREAMOS LA MINIATURA Y HACEMOS 
    //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN
				$file_info = $this->upload->data();
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN
				$imagen = $file_info["file_name"];

				$data["pass"]=1;
				$data["mensaje"]=$imagen ;
			}

		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function AddCertif(){
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
			$datos=json_decode($_POST["datos"]);
			$data["datos"]=$this->Model_Empresa->AddCert($IDEmpresa,$datos->Nombre_Certificacion,$datos->Fecha_Certificacion,
				$datos->Calificacion,$datos->Nombre_Archivo);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function DelCert(){
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
			
			$data["datos"]=$this->Model_Empresa->DelCert($datos->certif);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function DatCert(){
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
					$datos=json_decode($_POST["datos"]);
			$data["pass"]=1;
			$data["datos"]=$this->Model_Empresa->DatCert($datos->certif);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function UpdateCertif(){
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
					$datos=json_decode($_POST["datos"]);
			$data["pass"]=1;
			$data["datos"]=$this->Model_Empresa->UpdateCert($datos->num,$datos->Nombre_Certificacion,$datos->Fecha_Certificacion,$datos->Calificacion,$datos->Nombre_Archivo);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
}