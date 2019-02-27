<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Busquedas extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Buscar');
		$this->load->model('Model_Notificaciones');
		$this->load->helper('form');
	}
	public function buscar(){
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
		$config=array( array(
					'field'=>'inputsearch', 
					'label'=>'Buscar', 
					'rules'=>'trim|required|xss_clean'					
				));
		$this->form_validation->set_rules($config);
			$array=array("required"=>'El campo %s es obligatorio');
			$this->form_validation->set_message($array);
		if($this->form_validation->run() !=false){
			$palabra=$this->input->post("inputsearch");
			$dat["lista"]=$this->Model_Buscar->Buscar($palabra);
		}else{
			$dat["error"]=validation_errors();
		}
		$this->load->view('views/resultados',$dat);
		$this->load->view('footer');
		//$data["resultado"]=
		
		
	}
}