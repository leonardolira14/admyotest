<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Proveedores extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Notificaciones');
		$this->load->model('Model_Proveedores');
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
			$data["rec"]=json_encode($this->Model_Proveedores->Resumen($IDEmpresa));
			$this->load->view('views/newvista/resumenproveedor',$data);
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
			$data["lista"]=$this->Model_Proveedores->listaproveedores($IDEmpresa);
			$data["misque"]="Proveedores";
			$this->load->view('views/newvista/lista',$data);
			$this->load->view('footer');			
		}else{
			redirect('');
		}
	}
}