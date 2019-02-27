<?php
if (!defined('BASEPATH'))
   exit('No direct script access allowed');

class Contacto extends CI_Controller {

	public function __constructor(){
		parent::__constructor();
	}
	public function index()
	{
		if($this->session->userdata('logueado')){
			$this->load->view('head/head_profile');
		}else{
			$this->load->view('head/head');
		}
		$this->load->view('views/contacto');
		$this->load->view('footer');
	}
}
