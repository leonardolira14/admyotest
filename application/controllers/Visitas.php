<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Visitas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Usuarios');
		$this->load->model('Model_Empresa');
		$this->load->model('Model_Visitas');
		$this->load->helper('form');
	}
	public function Visitas(){
		if($this->session->userdata('logueado')){
			if(isset($_POST["datos"])){
				$datos=json_decode($_POST["datos"]);
				$anio=$datos->anio;
			}else{
				$anio=date('Y');
			}
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$data["datos"]=$this->Model_Visitas->Visitas($IDEmpresa,$anio);
			$data["anio"]=$anio;
			echo json_encode($data);
		}else{
			redirect('');
		}
	}
	public function Visitasv2($met){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);

			if($met==="M"){
				$datar["rec"]=json_encode($this->Model_Visitas->VisitasGeneral($IDEmpresa,'M'));
				$datar["recc"]=json_encode($this->Model_Visitas->detalles($IDEmpresa,'A'));
			}else if($met==="A"){
				$datar["rec"]=json_encode($this->Model_Visitas->VisitasGeneral($IDEmpresa,'A'));
				$datar["recc"]=json_encode($this->Model_Visitas->detalles($IDEmpresa,'A'));
			}
			$datar["tip"]=$met;
			$this->load->view("views/newvista/visitas",$datar);
			$this->load->view('footer');

		}else{
			redirect('');
		}
	}
	//funcion para los detalles de visitas
	public function detallesvisitas($met){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			if($met==="M"){
				
			}else if($met==="A"){
				$datar["rec"]=json_encode($this->Model_Visitas->detalles($IDEmpresa,'A'));
			}
			$datar["tip"]=$met;
			$this->load->view("views/newvista/master");
			$this->load->view("views/newvista/detallevisita",$datar);
		
		}else{
			echo false;
		}
	}
	
	
}