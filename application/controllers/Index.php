<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __constructor(){
		parent::__constructor();
	}
	public function index()
	{
		$this->load->view('head/head');
		$this->load->view('views/home');
		$this->load->view('views/prices');
		$this->load->view('footer');
	}
}
