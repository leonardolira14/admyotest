<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Perfil extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Usuarios');
		$this->load->model('Model_Empresa');
		$this->load->model('Model_Registro');
		$this->load->model('Model_Calificaciones');
		$this->load->model('Model_Notificaciones');
		$this->load->model('Model_Clieprop');
		$this->load->model('Model_Proveedores');
		$this->load->model('Model_Imagen');
		$this->load->model('Model_Riesgo');
		$this->load->helper('form');
	}
	public function index()
	{
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datosPerfil($this->session->userdata('IDEmpresa'));
			$this->load->view('helper/titulo',$data);
			$this->load->view('views/perfil',$data);
			$this->load->view('footer');

		}else{
			redirect('');
		}	
	}
	public function datosuaurio(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Usuarios->DatosUsuario($this->session->userdata('IDUsuario'));
			$this->load->view('views/datosusuario',$data);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function notificaciones(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			
			$dat["notificaciones"]=$this->Model_Notificaciones->getNotific($IDEmpresa);
			$this->load->view('views/notificaciones',$dat);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function asociaciones(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			
			$dats["asociaciones"]=$this->Model_Empresa->Getasociaciones($IDEmpresa,"");
			$this->load->view('views/asociaciones',$dats);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function certificaciones(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			
			$dats["certificacion"]=$this->Model_Empresa->GetCertificaciones($IDEmpresa);
			$this->load->view('views/certificaciones',$dats);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function productosyservicios(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			
			$dato["servicios"]=$this->Model_Empresa->getServicios($IDEmpresa);
			$this->load->view('views/productosyservicios',$dato);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function DaTUser()
	{
		
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$datos=json_decode($_POST["datos"]);
			$data["pass"]=true;
			$data["datos"]=$this->Model_Usuarios->DatosUsuario($datos->user);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function UpdateUser(){
		$datos=json_decode($_POST["datos"]);
		$data["datos"]=$this->Model_Usuarios->ModDatosUser($datos->num,$datos->Nombre,$datos->Apellidos,$datos->Puesto,$datos->Email,$datos->Visible);
		echo json_encode($data);
	}
	public function datosempresa(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			
			$data["datos"]=$this->Model_Empresa->DatosEmpresa($this->session->userdata('IDEmpresa'));
			$data["factAnual"]=$this->Model_Empresa->FaturacionAnuales();
			$data["NoEmplado"]=$this->Model_Empresa->NumerodeEmpleados();
			$data["TipoEmpresa"]=$this->Model_Empresa->TipoEmpresa();
			$data["GirosEmpresa"]=$this->Model_Empresa-> GirosParaDatos($this->session->userdata('IDEmpresa'));
			$data["marcas"]=$this->Model_Empresa->ObenerMacarcas($this->session->userdata('IDEmpresa'));
			$data["sector"]=$this->Model_Registro->getSector();
			$this->load->view('views/datosempresa',$data);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function DelUser()
	{
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$datos=json_decode($_POST["datos"]);
			if($datos->user==$IDUsuario){
				$data["datos"]="El Usuario Master no pude eliminarse a si mismo";
			}else{
				$data["datos"]=$this->Model_Usuarios->DelUser($datos->user);
			}
			
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	//funcio para poner un giro en principal
	public function PrincipalGiro(){
		$datos=json_decode($_POST["datos"]);

		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		if($this->session->userdata('IDEmpresa')){
			$IDEmpresa=$this->session->userdata('IDEmpresa');
		}else{
			$IDEmpresa=$datos->IDEmpresa;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$data["datos"]=$this->Model_Empresa->PrincipalGiro($datos->giro,$IDEmpresa);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	//funcion para borrar un giro
	public function DeleteGri(){
		$datos=json_decode($_POST["datos"]);

		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		if($this->session->userdata('IDEmpresa')){
			$IDEmpresa=$this->session->userdata('IDEmpresa');
		}else{
			$IDEmpresa=$datos->IDEmpresa;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$data["datos"]=$this->Model_Empresa->DelGiro($datos->giro,$IDEmpresa);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);

	}
	public function DelMarca(){
		$datos=json_decode($_POST["datos"]);

		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$data["datos"]=$this->Model_Empresa->DelMarca($datos->marca);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function DatMarca(){
		$datos=json_decode($_POST["datos"]);

		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$data["datos"]=$this->Model_Empresa->DelMarca($datos->marca);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function contacto(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			
			$data["datos"]=$this->Model_Empresa->DatosEmpresa($IDEmpresa);
			$data["estados"]=$this->Model_Registro->GetEntidad();
			$data["telefonos"]=$this->Model_Empresa->GetTel($IDEmpresa);	
			$this->load->view('views/Pcontacto',$data);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function usuariomaster(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$datos["usuarios"]=$this->Model_Usuarios->GetUsuarios($IDEmpresa,'1');
			$this->load->view('views/usuariomaster',$datos);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function AddGiroEmpresa(){
		$datos=json_decode($_POST["datos"]);

		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		if($this->session->userdata('IDEmpresa')){
			$IDEmpresa=$this->session->userdata('IDEmpresa');
		}else{
			$IDEmpresa=$datos->IDEmpresa;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$data["datos"]=$this->Model_Empresa->AddGiro($IDEmpresa,$datos->sector,$datos->Subsector,$datos->Rama);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	//funcion para actualizar los datos de la empresa general
	public function UpdateEmpresaGen(){
		$datos=json_decode($_POST["datos"]);

		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$rz=$datos->Razon_Social;
			$nc=$datos->Nombre_Comercial;
			$rfc=$datos->RFC;
			$te=$datos->Tipo_Empresa;
			$ne=$datos->No_Empleados;
			$fa=$datos->Facturacion_Anual;
			$p=$datos->Perfil;
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$data["datos"]=$this->Model_Empresa->UpdateGen($rz,$nc,$rfc,$te,$ne,$fa,$p,$IDEmpresa);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);

	}
	//funcion para agregar la marca contdo y la imagen
	public function AddLogoMarca(){
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}

		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$config=[];
			$config["upload_path"]="./assets/img/logosmarcas/";
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
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

				$data["pass"]=1;$data["mensaje"]=$imagen ;
			}
		}else{

			$data["pass"]=0;
			$data["mensaje"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function AddLogoEmpresa(){
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		if($this->session->userdata('IDEmpresa')){
			$IDEmpresa=$this->session->userdata('IDEmpresa');
		}else{
			$IDEmpresa=$datos->IDEmpresa;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$config=[];
			$config["upload_path"]="./assets/img/logosEmpresas/";
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
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
				$data["mensaje"]= $this->Model_Empresa->RegistraLogo($imagen,$IDEmpresa);
				$data["pass"]=1;
			}
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function AddMarca(){
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$datos=json_decode($_POST["datos"]);
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$data["datos"] = $this->Model_Empresa->ADDMarcar($datos->marca,$datos->imagen,$IDEmpresa); 
		}
		else
		{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);

	} 
	//funcion para obtener los datos de una marca en especial
	public function DatosMarca(){
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$datos=json_decode($_POST["datos"]);
			$datas["pass"]=1;
			$datas["marca"]=$this->Model_Empresa->DatMarca($datos->marca);
		}
		else
		{
			$datas["pass"]=2;
			$datas["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($datas);
	}
	public function UpdateMarca(){
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$datos=json_decode($_POST["datos"]);
			$data["datos"]=$this->Model_Empresa->UpdateMarca($datos->IDMarca,$datos->Marca,$datos->logo);
		}
		else
		{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function AddTel(){
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$datos=json_decode($_POST["datos"]);
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$data["datos"]=$this->Model_Empresa->AddTel($datos->Lada_Nacional.$datos->Telefono,$datos->Tipo,$IDEmpresa,$IDUsuario);
		}
		else
		{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);

	}
	public function DelTel(){
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$datos=json_decode($_POST["datos"]);
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$data["datos"]=$this->Model_Empresa->DelTel($datos->tel);
		}
		else
		{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function DatTel(){
		$datos=json_decode($_POST["datos"]);
		$data["datos"]=$this->Model_Empresa->DatTel($datos->tel);
		echo json_encode($data);
	}
	public function ModiTel(){
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$datos=json_decode($_POST["datos"]);
			$data["datos"]=$this->Model_Empresa->ModiTel($datos->Lada_Nacional.$datos->Telefono,$datos->Tipo,$datos->idtel);
		}
		else
		{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function ModDatosEmpresa(){
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
			$data["datos"]=$this->Model_Empresa->ModDatosEmpresa($IDEmpresa,$datos->Pagina_Web,$datos->Codigo_Postal,$datos->Colonia,$datos->Direccion,$datos->Estado,$datos->Municipio);
		}
		else
		{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function MoDMaster(){
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		if($this->session->userdata('IDEmpresa')){
			$IDEmpresa=$this->session->userdata('IDEmpresa');
		}else{
			$IDEmpresa=$datos->IDEmpresa;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$datos=json_decode($_POST["datos"]);
			$data["datos"]=$this->Model_Usuarios->MoDMaster($datos->user,$IDEmpresa);
		}
		else
		{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function ModDatosUser(){
		$datos=json_decode($_POST["datos"]);
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->ModDatosUser($IDUsuario,$datos->Nombre,$datos->Apellidos,$datos->Puesto,$datos->Email,$datos->Visible);
		echo json_encode($data);

	}
	public function ModContra(){
		$datos=json_decode($_POST["datos"]);
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->ModContra($IDUsuario,$datos->Contraseña,$datos->Nueva_Contraseña,$datos->Confirmar_Contraseña);
		echo json_encode($data);
	}
	public function AddUsuario()
	{
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
			$this->Model_Usuarios->AddUsuario($IDEmpresa,$datos->Nombre,$datos->Apellidos,$datos->Puesto,$datos->Email,$datos->Contraseña,$datos->Confirmar_Contraseña,$datos->Visible,"");
			$data["datos"]=true;
		}
		else
		{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function AddProd(){
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
			$data["datos"]=$this->Model_Empresa->AddProd($IDEmpresa,$datos->Producto,$datos->promocion,$datos->Descripcion,$datos->Foto);
		}
		else
		{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function AddLogoProd(){
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}

		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$config=[];
			$config["upload_path"]="./assets/img/logoprod/";
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
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

				$data["pass"]=1;$data["mensaje"]=$imagen ;
			}
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function AccProd(){
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$datos=json_decode($_POST["datos"]);
			if($datos->acc=="1"){
				$data["datos"]=$this->Model_Empresa->DelProd($datos->prod);

			}else if($datos->acc=="2"){
				$data["pass1"]=1;
				$data["datos"]=$this->Model_Empresa->DatProd($datos->prod);
			}else if($datos->acc=="3"){
				$data["pass1"]=1;
				$data["datos"]=$this->Model_Empresa->UpdateProd($datos->num,$datos->Producto,$datos->promocion,$datos->Descripcion,$datos->Foto);
			}
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);
	}
	public function calificacionesrecibidasc(){
		if($this->session->userdata('logueado')){
			if(isset($_POST["datos"])){
				$datos=json_decode($_POST["datos"]);
			}
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datos_titulo();
			$this->load->view('helper/titulo',$data);		
			$datos["Activas"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Recibida","Cliente",date("Y"),"Activa");
			$datos["Pendientes"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Recibida","Cliente",date("Y"),"Pendiente");
			$datos["grafica"]=$this->Model_Calificaciones->CalificacionesdeunAnio($IDEmpresa,"Recibida","Cliente",date("Y"),"Activa");
			$datos["anio"]=date("Y");
			$this->load->view('views/calificacionesrecibidasclientes',$datos);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function calificacionesrealizadasc(){
		if($this->session->userdata('logueado')){
			if(isset($_POST["datos"])){
				$datos=json_decode($_POST["datos"]);
			}
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datos_titulo();
			$this->load->view('helper/titulo',$data);
			$datos["Activas"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Realizada","Proveedor",date("Y"),"Activa");
			$datos["Pendientes"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Realizada","Proveedor",date("Y"),"Pendiente");
			$datos["grafica"]=$this->Model_Calificaciones->CalificacionesdeunAnio($IDEmpresa,"Realizada","Proveedor",date("Y"),"Activa");
			$datos["anio"]=date("Y");
			$this->load->view('views/calificacionesrealizadasc',$datos);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function calificacionesrecibidasp(){
		if($this->session->userdata('logueado')){
			if(isset($_POST["datos"])){
				$datos=json_decode($_POST["datos"]);
			}
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datos_titulo();
			$this->load->view('helper/titulo',$data);
			$datos["Activas"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Recibida","Proveedor",date("Y"),"Activa");
			$datos["Pendientes"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Recibida","Proveedor",date("Y"),"Pendiente");
			$datos["grafica"]=$this->Model_Calificaciones->CalificacionesdeunAnio($IDEmpresa,"Recibida","Proveedor",date("Y"),"Activa");
			$datos["anio"]=date("Y");
			$this->load->view('views/calificacionesrecibidasprovee',$datos);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function clientes(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datos_titulo();
			$this->load->view('helper/titulo',$data);
			
			$data["clientes"]=$this->Model_Empresa->datClientes($IDEmpresa);
			$this->load->view('views/clientes',$data);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function RecibidasClientes(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datos_titulo();
			$this->load->view('helper/titulo',$data);
			
			$data["clientes"]=$this->Model_Empresa->datClientes($IDEmpresa);
			$this->load->view('views/RecibidasClientes',$data);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function VisibleEmpre(){
		$datos=json_decode($_POST["datos"]);
		if($this->session->userdata('IDUsuario')){
			$IDUsuario=$this->session->userdata('IDUsuario');
		}else{
			$IDUsuario=$datos->IDUsuario;
		}
		if($this->session->userdata('IDEmpresa')){
			$IDEmpresa=$this->session->userdata('IDEmpresa');
		}else{
			$IDEmpresa=$datos->IDEmpresa;
		}
		$data["datos"]=$this->Model_Usuarios->DatosUsuario($IDUsuario);
		if($data["datos"]->Tipo_Usuario=="Master"){
			$data["datos"]=$this->Model_Empresa->VisibleEmpre($IDEmpresa,$datos->empresa,$datos->tipo,$datos->status);
		}else{
			$data["datos"]="Sin Acceso a estas funciones.";
		}
		echo json_encode($data);

	}
	public function proveedores(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datos_titulo();
			$this->load->view('helper/titulo',$data);
			
			$data["proveedores"]=$this->Model_Empresa->datProveedores($IDEmpresa);
			$this->load->view('views/proveedores',$data);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function RealizadasProveedores(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datos_titulo();
			$this->load->view('helper/titulo',$data);
			$data["proveedores"]=$this->Model_Empresa->datProveedores($IDEmpresa);
			$this->load->view('views/RealizadasProveedores',$data);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function calificacionesC(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datos_titulo();
			$this->load->view('helper/titulo',$data);
			$datos["clientes"]=$this->Model_Empresa->datClientes($IDEmpresa);
			$datos["calificaciones"]=$this->Model_Calificaciones->CalificacionesAcumuladasBruto($IDEmpresa,"Recibida","Cliente",'','','','');
			$this->load->view('views/calificacionesC',$datos);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function calificacionesP(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datos_titulo();
			$this->load->view('helper/titulo',$data);
			$datos["clientes"]=$this->Model_Empresa->datProveedores($IDEmpresa);
			$datos["calificaciones"]=$this->Model_Calificaciones->CalificacionesAcumuladasBruto($IDEmpresa,"Recibida","Proveedor",'','','','');
			$this->load->view('views/calificacionesP',$datos);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function calificacionesrealizadasp(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('logueado')){
				if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
				$data["datos"]=$this->Model_Empresa->datos_titulo();
				$this->load->view('helper/titulo',$data);
				if(isset($_POST["datos"])){
					$datos=json_decode($_POST["datos"]);
				}
				$datos["Activas"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Realizada","Cliente",date("Y"),"Activa");
				$datos["Pendientes"]=$this->Model_Calificaciones->CalificacionesA($IDEmpresa,"Realizada","Cliente",date("Y"),"Pendiente");
				$datos["grafica"]=$this->Model_Calificaciones->CalificacionesdeunAnio($IDEmpresa,"Realizada","Cliente",date("Y"),"Activa");
				$datos["anio"]=date("Y");
				$this->load->view('views/calificacionesrealizadasp',$datos);
				$this->load->view('footer');
			}else{
				redirect('');
			}
		}else{
			redirect('');
		}
	}
	public function realizadasclientestotal(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			
			$datos["clientes"]=$this->Model_Clieprop->listaclientes($IDEmpresa);
			$datos["calificaciones"]=$this->Model_Calificaciones->CalificacionesAcumuladasBruto($IDEmpresa,"Realizada","Cliente",'','','','');
			$this->load->view('views/realizadasclientestotal',$datos);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function realizadasprovetotales(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			
			$datos["clientes"]=$this->Model_Proveedores->listaproveedores($IDEmpresa);
			$datos["calificaciones"]=$this->Model_Calificaciones->CalificacionesAcumuladasBruto($IDEmpresa,"Realizada","Proveedor",'','','','');
			$this->load->view('views/realizadasprovetotales',$datos);
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function reputacionc(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datos_titulo();
			$this->load->view('helper/titulo',$data);
			$this->load->view('views/reputacionc');
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function reputacionp(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datos_titulo();
			$this->load->view('helper/titulo',$data);
			$this->load->view('views/reputacionp');
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function visitas(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$data["datos"]=$this->Model_Empresa->datos_titulo();
			$this->load->view('helper/titulo',$data);
			$this->load->view('views/visitas');
			$this->load->view('footer');
		}else{
			redirect('');
		}
	}
	public function resultados()
	{
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			
			$this->load->view('views/resultados');
			$this->load->view('footer');
		}else{
			$this->load->view('head/head');
			$this->load->view('views/resultados');
			$this->load->view('footer');
		}	
	}
	/*
	funcion para obtener las empresas que me siguen
	*/
	public function followbussines(){
		//primero necesito saber si esta logueando si no lo saco al home
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$_IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$_IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($_IDEmpresa);
			$this->load->view('head/head_profile',$n);
			//ahora obtengo las empresas que voy a seguir 
			$empresas=$this->Model_Empresa->getfollow($_IDEmpresa);
			$_data["datosempresas"]=false;
			if($empresas!=false){
				$_data["datosempresas"]=[];
				foreach ($empresas as $empresa) {
					$imagencliente=$this->Model_Imagen->imgcliente($empresa->IDEmpresa,"A","Cliente",TRUE);
					$imagenproveedor=$this->Model_Imagen->imgcliente($empresa->IDEmpresa,"A","Proveedor",TRUE);
					$riesgocliente=$this->Model_Riesgo->obtenerrisgos($empresa->IDEmpresa,"clientes","A",TRUE);
					$riesgoproveedor=$this->Model_Riesgo->obtenerrisgos($empresa->IDEmpresa,"proveedores","A",TRUE);
					array_push($_data["datosempresas"],array("num"=>$empresa->IDFollow,"Logo"=>$empresa->Logo,"razon_social"=>$empresa->Razon_Social,"numempresa"=>$empresa->IDEmpresa,"imagencliente"=>$imagencliente,"imagenproveedor"=>$imagenproveedor,"riesgocliente"=>$riesgocliente,"riesgoproveedor"=>$riesgoproveedor));
				}
			}
			
			$this->load->view('views/newvista/follow',$_data);
			$this->load->view('footer');

		}else{
			redirect('');
		}
	}
	public function bajafollow($num){
		$this->Model_Empresa->Bajafolow($num);
		redirect(base_URL()."followbussines");
	}
	

}