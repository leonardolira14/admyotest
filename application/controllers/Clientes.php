<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Clientes extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Notificaciones');
		$this->load->model('Model_Clieprop');
		$this->load->helper('form');
	}
	public function Resumen(){
		if($this->session->userdata('logueado')){
			
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["rec"]=json_encode($this->Model_Clieprop->Resumen($IDEmpresa));
			$this->load->view('views/newvista/resumenclientes',$data);
			$this->load->view('footer');			
		}else{
			redirect('');
		}
	}
	public function lista(){
		if($this->session->userdata('logueado')){
			
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["lista"]=$this->Model_Clieprop->listaclientes($IDEmpresa);
			$data["misque"]="Clientes";
			$this->load->view('views/newvista/lista',$data);
			$this->load->view('footer');			
		}else{
			redirect('');
		}
	}
}