<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class PerfilBuscado extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Usuarios');
		$this->load->model('Model_Empresa');
		$this->load->model('Model_Registro');
		$this->load->model('Model_Calificaciones');
		$this->load->model('Model_Notificaciones');
		$this->load->model('Model_Imagen');
		$this->load->model('Model_Riesgo');
		$this->load->helper('form');
	}
	public function perfil($_fecha_tipo="A",$_IDEmpresa_buscada){
			
		$id1 =  $this->uri->segment(3);
		if($id1!=""){
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
			$data["tip"]=$_fecha_tipo;
			$data["perfilbuscado"]=true;
			$data["datosperfil"]=$this->Model_Empresa->datosempresa($_IDEmpresa_buscada);
			$data["datosimg"]=$this->Model_Imagen->imgcliente($_IDEmpresa_buscada,$_fecha_tipo,"Cliente");
			$this->load->view('views/newvista/imgcliente',$data);
			$this->load->view('footer');
		}else{
			redirect('/perfil/resultados');
		}
		
	}
	public function perfilprov($_Tipo_persona,$_fecha_tipo,$_IDEmpresa_buscada){
			
		$id1 =  $this->uri->segment(3);
		if($id1!=""){
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
			$data["tip"]=$_fecha_tipo;
			$data["perfilbuscado"]=true;
			$data["datosperfil"]=$this->Model_Empresa->datosempresa($_IDEmpresa_buscada);
			$data["datosimg"]=$this->Model_Imagen->imgcliente($_IDEmpresa_buscada,$_fecha_tipo,$_Tipo_persona);
			$this->load->view('views/newvista/imgproveedor',$data);
			$this->load->view('footer');
		}else{
			redirect('/perfil/resultados');
		}
		
	}
	/*
	funcion para los detalle de las empresas 
	*/
	public function detallesimagen($_Tipo_persona,$_fecha_tipo,$_IDEmpresa_buscada){

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
			$data["tip"]=$_Tipo_persona;
			$data["fecha"]=$_fecha_tipo;
			$data["perfilbuscado"]=true;
			$data["datosperfil"]=$this->Model_Empresa->datosempresa($_IDEmpresa_buscada);
			$data["detallesimagen"]=json_encode( $this->Model_Imagen->detalleImagen($_Tipo_persona,$_IDEmpresa_buscada,$_fecha_tipo));
			$this->load->view('views/newvista/detalleimagen',$data);
			$this->load->view('footer');
		}
		
		/*
		funcion para obtenr el riesgo de clientes 
		*/
		public function riesgoclientes($_fecha_tipo,$_IDEmpresa_buscada){
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
			$datar["fecha"]=$_fecha_tipo;
			$datar["perfilbuscado"]=true;
			$datar["datosperfil"]=$this->Model_Empresa->datosempresa($_IDEmpresa_buscada);
			$datar["rec"]=json_encode($this->Model_Riesgo->obtenerrisgos($_IDEmpresa_buscada,"clientes",$_fecha_tipo));
			$datar["tip"]=$_fecha_tipo;
			$this->load->view("views/newvista/riesgocliente",$datar);
			$this->load->view('footer');
		}
		/*
		funcion para obtenr el riesgo de proveedores 
		*/
	public function riesgoproveedores($_fecha_tipo,$_IDEmpresa_buscada){
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
		$datar["fecha"]=$_fecha_tipo;
		$datar["perfilbuscado"]=true;
		$datar["datosperfil"]=$this->Model_Empresa->datosempresa($_IDEmpresa_buscada);
		$datar["rec"]=json_encode($this->Model_Riesgo->obtenerrisgos($_IDEmpresa_buscada,"proveedores",$_fecha_tipo));
		$datar["tip"]=$_fecha_tipo;
		$this->load->view("views/newvista/riesgocliente",$datar);
		$this->load->view('footer');
	}
	/*
	funcion para obtener los detalles de riesgo de una empresa
	*/
	public function detallesrieesgo($_Tipo_persona,$_fecha_tipo,$_IDEmpresa_buscada){
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
		$date["tip"]=$_Tipo_persona;
		$date["Fecha"]=$_fecha_tipo;
		$date["perfilbuscado"]=true;
		$date["datosperfil"]=$this->Model_Empresa->datosempresa($_IDEmpresa_buscada);
		$date["rec"]=json_encode($this->Model_Riesgo->detalles($_Tipo_persona,$_fecha_tipo,$_IDEmpresa_buscada));
		$this->load->view("views/newvista/detallesriesgo",$date);
		$this->load->view('footer');
	}
	public function datosempresa(){
			
		$id1 =  $this->uri->segment(3);
		if($id1!=""){
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
			$dat["num"]=$id1;
			$dat["datos"]=$this->Model_Empresa->DatosEmpresa($id1);
			$dat["giros"]=$this->Model_Empresa->GirosParaDatos($id1);
			$dat["marcas"]=$this->Model_Empresa->ObenerMacarcas($id1);
			$this->load->view('perfilbuscado/datosempresa',$dat);
			$this->load->view('footer');
		}else{
			redirect('/perfil/resultados');
		}
		
	} 
	public function contacto(){
			
		$id1 =  $this->uri->segment(3);
		if($id1!=""){
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
			$dat["num"]=$id1;
			$dat["datos"]=$this->Model_Empresa->DatosEmpresa($id1);
			$this->load->view('perfilbuscado/contacto',$dat);
			$this->load->view('footer');
		}else{
			redirect('/perfil/resultados');
		}
		
	} 
	public function usuarios(){
			
		$id1 =  $this->uri->segment(3);
		if($id1!=""){
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
			
			$dat["num"]=$id1;
			$dat["datos"]=$this->Model_Empresa->DatosEmpresa($id1);
			$dat["usuarios"]=$this->Model_Usuarios->usuariosvisibles($id1);
			$this->load->view('perfilbuscado/usuarios',$dat);
			$this->load->view('footer');
		}else{
			redirect('/perfil/resultados');
		}
		
	}
	public function certificaciones(){
		$id1 =  $this->uri->segment(3);
		if($id1!=""){
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
			
			$dat["num"]=$id1;
			$dat["datos"]=$this->Model_Empresa->DatosEmpresa($id1);
			$dat["certificaciones"]=$this->Model_Empresa->GetCertificaciones($id1);
			$this->load->view('perfilbuscado/certificaciones',$dat);
			$this->load->view('footer');
		}else{
			redirect('/perfil/resultados');
		}
	} 
	public function asociaciones(){
		$id1 =  $this->uri->segment(3);
		if($id1!=""){
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
			
			$dat["num"]=$id1;
			$dat["datos"]=$this->Model_Empresa->DatosEmpresa($id1);
			$dat["asociaciones"]=$this->Model_Empresa->Getasociaciones($id1,'');
			$this->load->view('perfilbuscado/asociaciones',$dat);
			$this->load->view('footer');
		}else{
			redirect('/perfil/resultados');
		}
	} 
		public function productosyservicios(){
		$id1 =  $this->uri->segment(3);
		if($id1!=""){
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

			$dat["num"]=$id1;
			$dat["datos"]=$this->Model_Empresa->DatosEmpresa($id1);
			$dat["productos"]=$this->Model_Empresa->getServicios($id1);
			$this->load->view('perfilbuscado/productos',$dat);
			$this->load->view('footer');
		}else{
			redirect('/perfil/resultados');
		}
	} 
	public function calificacionesproveedores(){
		$id1 =  $this->uri->segment(3);
		if($id1!=""){
			if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else if(isset($datos->IDEmpresa)){
				$IDEmpresa=$datos->IDEmpresa;
			}else{
				$IDEmpresa=0;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);

		}else{
			$this->load->view('head/head');
			$IDEmpresa=0;
		}
			$data["datos"]=$this->Model_Empresa->bdatos_titulo();
			$this->load->view('helper/titulo',$data);
			$dat["num"]=$id1;
			$dat["Activas"]=$this->Model_Calificaciones->CalificacionesA($id1,"Recibida","Proveedor",date("Y"),"Activa");
			$dat["grafica"]=$this->Model_Calificaciones->CalificacionesdeunAnio($id1,"Recibida","Proveedor",date("Y"),"Activa");
			$dat["proveedores"]=$this->Model_Empresa->datProveedores($id1);
			$rezpj=$this->Model_Empresa->esclienteprove($IDEmpresa,$id1);
		
			if($rezpj!=false){
				$dat["promcues"]=$this->Model_Calificaciones->promporcuestion($id1,"Cliente");
			}else{
				$dat["promcues"]=false;
			}

			$this->load->view('perfilbuscado/calificacionesproveedores',$dat);
			$this->load->view('footer');
		}else{
			redirect('/perfil/resultados');
		}
	} 
	public function calificacionesclientes(){
		$id1 =  $this->uri->segment(3);
		if($id1!=""){
			if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else if(isset($datos->IDEmpresa)){
				$IDEmpresa=$datos->IDEmpresa;
			}else{
				$IDEmpresa=0;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);

		}else{
			$this->load->view('head/head');
			$IDEmpresa=0;
		}
			$data["datos"]=$this->Model_Empresa->bdatos_titulo();
			$this->load->view('helper/titulo',$data);
			$dat["num"]=$id1;
			$dat["Activas"]=$this->Model_Calificaciones->CalificacionesA($id1,"Recibida","Cliente",date("Y"),"Activa");
			$dat["clientes"]=$this->Model_Empresa->datClientes($id1);
			$rezpj=$this->Model_Empresa->esclienteprove($IDEmpresa,$id1);
		
			if($rezpj!=false){
				$dat["promcues"]=$this->Model_Calificaciones->promporcuestion($id1,"Proveedor");
			}else{
				$dat["promcues"]=false;
			}
			$this->load->view('perfilbuscado/calificacionesclientes',$dat);
			$this->load->view('footer');
		}else{
			redirect('/perfil/resultados');
		}
	} 
	
}