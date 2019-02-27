<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Notificaciones extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Notificaciones');
		$this->load->model('Model_Visitas');
		$this->load->helper('form');
	}
	public function vista(){
		if(isset($_POST["datos"])){
			$datos=json_decode($_POST["datos"]);
		echo $this->Model_Notificaciones->Vista($datos->not);
		}
	}
	public function AddVisita(){
		if(isset($_POST["datos"])){
			$datos=json_decode($_POST["datos"]);
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else if(isset($datos->IDEmpresa)){
				$IDEmpresa=$datos->IDEmpresa;
			}else{
				$IDEmpresa=0;
			}
			$this->Model_Visitas->Addvisita($datos->num,$IDEmpresa);
		    $this->Model_Notificaciones->AddNotificacion($datos->num,"vista",$IDEmpresa);
		}
	}

}