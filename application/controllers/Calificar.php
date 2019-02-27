<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Calificar extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Usuarios');
		$this->load->model('Model_Empresa');
		$this->load->model('Model_Registro');
		$this->load->model('Model_Calificaciones');
		$this->load->model('Model_Notificaciones');
		$this->load->model('Model_Email');
		$this->load->helper('form');
	}
	public function calificar(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$dat["empresas"]=$this->Model_Empresa->GetEmpresasPcalif('');
			$dat["giros"]=$this->Model_Registro->getSector();
			$this->load->view('views/calificar',$dat);
			$this->load->view('footer'); 
			
		}else{
			redirect('');
		}
	}
	public function empresas(){
		$re=$this->Model_Empresa->GetEmpresasPcalif();
		echo json_encode ($re);
	}
	public function usuariomaster(){
		$datos=json_decode($_POST["datos"]);

		$rs=$this->Model_Usuarios->usuarioMaster($datos->num);
		echo  json_encode($rs);
	}
	/*
	/ funcion para obtener el cuestionario 
	*/
	public function cuestionario(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$_ID_Empresa=$this->session->userdata('IDEmpresa');
			}else{
				$_ID_Empresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($_ID_Empresa);
			$this->load->view('head/head_profile',$n);
			
			$_RFC_Empresa_receptora=$this->input->post("rfc");
			$_Razon_Social_Empresa_receptora=$this->input->post("razon_social");
			$_Email_Empresa_receptora=$this->input->post("correo_electronico");
			$_Giro_Empresa_receptora=$this->input->post("giro");
			$_SubGiro_Empresa_receptora=$this->input->post("sub_giro");
			$_Rama_Empresa_receptora=$this->input->post("rama");
			$_tipo_receptora=$this->input->post('realizapara');
			$_flag_paso=TRUE;
			if($_RFC_Empresa_receptora==="" || $_RFC_Empresa_receptora===NULL){
				$_data["pass"]=0;
				$_data["mensaje"]="RFC no valido";
				$_flag_paso=FALSE;
			}else if($_Razon_Social_Empresa_receptora==="" || $_Razon_Social_Empresa_receptora===NULL){
				$_data["pass"]=0;
				$_data["mensaje"]="Razon Social no valida";
				$_flag_paso=FALSE;
			}else if($_Email_Empresa_receptora==="" || $_Email_Empresa_receptora===NULL){
				$_data["pass"]=0;
				$_data["mensaje"]="Correo Electrónico no valido";
				$_flag_paso=FALSE;
			}	
			
			if($_flag_paso):
					//obtengo los datos de la empresa que se va a calificar
				$_datos_empresa_emisora=$this->Model_Empresa->DatosEmpresa($_ID_Empresa);
				$_datos_empresa_receptora=$this->Model_Empresa->datosRFCEm($_RFC_Empresa_receptora);
				if($_datos_empresa_emisora->IDEmpresa===$_datos_empresa_receptora->IDEmpresa):
					$_data["pass"]=0;
					$_data["mensaje"]="Usted no puede calificarse a si mismo";
					$_flag_paso=FALSE;
				elseif($_datos_empresa_receptora===false):
					$_flag_paso=TRUE;
					//si no esta esa empresa hago el preregistro
					$this->Model_Empresa->AddEmpresa($persona='PFAE',$_Razon_Social_Empresa_receptora,"",$_RFC_Empresa_receptora,$_Giro_Empresa_emisora,$_SubGiro_Empresa_receptora,$_Rama_Empresa_receptora);
					$_datos_empresa_receptora=$this->Model_Empresa->datosRFCEm($_RFC_Empresa_emisora);
					//registro el correo del usuario
					$_token_usario_receptor=$this->Model_Usuarios->Preusuario($_Email_Empresa_receptora,$_datos_empresa_receptora->IDEmpresa);
					//mando el mail al usario para avisarle que ha sido registrado en admyo
					$this->Model_Email->invitar_usuario($_datos_empresa_receptora->Razon_Social,$_Email_Empresa_receptora,"PGEG243%",$_token_usario_receptor);
				endif;
				$_datos_usuario_receptor=$this->Model_Usuarios->DatosUsuarioCorreo($_Email_Empresa_receptora);
				//si el usuario no esta agregado lo agregamos
				if($_datos_usuario_receptor===false)
				{
						$_token_usario_receptor=$this->Model_Usuarios->Preusuario($_Email_Empresa_receptora,$_datos_empresa_receptora->IDEmpresa);
						//envio un correo para avisarle al usuario que sea registrado
						$this->Model_Email->invitar_usuario($_datos_empresa_receptora->Razon_Social,$_Email_Empresa_receptora,"PGEG243%",$_token_usario_receptor);
				}else if($_datos_usuario_receptor->IDEmpresa!=$_datos_empresa_receptora->IDEmpresa){
					$_data["pass"]=0;
					$_data["mensaje"]="La dirección de correo electrónico que decea calificar pertenece a otra empresa";
					$_flag_paso=FALSE;
				}
				
			endif;

				//una ves que ya tengo los datos verifico mi bandera de paso 
			
			if($_flag_paso)
			{
				$_data["cuestionario"]=$this->Model_Calificaciones->cuestionario($_tipo_receptora,$_datos_empresa_emisora->IDEmpresa,$_datos_empresa_receptora->IDEmpresa);
				$_data["Razon_Social"]=$_Razon_Social_Empresa_receptora;
				$_data["IDEmpresa_Receptora"]=$_datos_empresa_receptora->IDEmpresa;
				$_data["Giro"]=$_Giro_Empresa_receptora;
				$_data["SubGiro"]=$_SubGiro_Empresa_receptora;
				$_data["Rama"]=$_Rama_Empresa_receptora;
				$_data["IDUsuario_receptor"]=$_datos_usuario_receptor->IDUsuario;
				$_data["Tipo_receptora"]=$_tipo_receptora;
				$this->load->view('views/cuestionario',$_data);
			}else{
				$dat["giros"]=$this->Model_Registro->getSector();
				$dat["errors"]=$_data;
				$this->load->view('views/calificar',$dat);
			}
			$this->load->view('footer');
		}else{
			redirect('');
		}

	}
	public function cuestionario1(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);
			$tipo =  $this->uri->segment(3);
			$res=$this->Model_Calificaciones->cuestionario($tipo);
			$this->load->view('views/cuestionario',$res);
			$this->load->view('footer');
			
		}else{
			redirect('');
		}
	}
	public function calcular(){
		_is_post();
		_is_ajax_request();
		$datos=json_decode($_POST["datos"]);
		if($this->session->userdata('IDEmpresa')):
				$_ID_Empresa_emisora=$this->session->userdata('IDEmpresa');
		endif;
		if($this->session->userdata('IDUsuario')):
				$_ID_Usuario_emisor=$this->session->userdata('IDUsuario');
		endif;
		

		//ahora obtengo las varibles
		$_ID_Empresa_receptora=$datos[0]->datos[0]->empresa_receptora;
		$_ID_Giro_receptora=$datos[0]->datos[0]->giro_receptora;
		$_ID_SubGiro_receptora=$datos[0]->datos[0]->subgiro_receptora;
		$_ID_Rama_receptora=$datos[0]->datos[0]->rama_receptora;
		$_ID_Usuario_receptor=$datos[0]->datos[0]->usuario_receptora;
		$_Tipo_receptora=$datos[0]->datos[0]->tipo_receptora;
		

		//AHORA OBTENGO LOS DATOS DE LA EMPRESA EMISORA
		$_datos_empresa_emisora=$this->Model_Empresa->DatosEmpresa($_ID_Empresa_emisora);
		$_IDGiro_emisora=$this->Model_Empresa->Get_Giro_Principal($_ID_Empresa_emisora);
		$_datos_usuario_emisor=$this->Model_Usuarios->DatosUsuario($_ID_Usuario_emisor);
		

		//AHORA OBTENGO LOS DATOS DE LA EMPRESA RECEPTORA
		$_datos_empresa_receptora=$this->Model_Empresa->DatosEmpresa($_ID_Empresa_receptora);
		$_datos_usuario_receptor=$this->Model_Usuarios->DatosUsuario($_ID_Usuario_receptor);
		if($_Tipo_receptora==="cliente"){
			$descipt="calificacionC";
		}else{
			$descipt="calificacionp";
		}	
		$this->Model_Notificaciones->AddNotificacion($_ID_Empresa_receptora,$descipt,$_ID_Empresa_emisora);
		

		//ahora agrego la valoracion
		$_ID_valoracion=$this->Model_Calificaciones->AddValoracion($_ID_Usuario_emisor,$_ID_Empresa_emisora,$_IDGiro_emisora,$_ID_Usuario_receptor,$_ID_Empresa_receptora,$_ID_Giro_receptora,"Activa",$_Tipo_receptora);
		$_obtenidos=0;
		$_posibles=0;
		$_Preguntas="";
		foreach ($datos[0]->respuesta as $pregunta) {
			$puntos=$this->Model_Calificaciones->AddDetalleValoracion2($_ID_valoracion,$pregunta->pregunta,$pregunta->respuesta);
			$_posibles=$_posibles+(float)$puntos["PuntosPosibles"];
			$_obtenidos=$_obtenidos+(float)$puntos["PuntosObtenidos"];
			$_Preguntas=$_Preguntas."|*|".$puntos["Pregunta"]."|".$puntos["Respuesta"];
		}
		$_promedio=round(($_obtenidos/$_posibles)*10,2);
		$this->Model_Empresa->addRelacion($_ID_Empresa_emisora,$_ID_Empresa_receptora,$_Tipo_receptora);
		
		/*
		//
		//envio de correos
		//
		*/
		$this->Model_Email->recibir_valoracion($_datos_usuario_receptor->Correo,$_datos_empresa_emisora->Razon_Social,$_datos_empresa_receptora->Razon_Social,$_Tipo_receptora,$_Preguntas,$_promedio);
		
		$this->Model_Email->enviar_valoracion($_datos_usuario_emisor->Correo,$_Tipo_receptora,$_datos_empresa_emisora->Razon_Social,$_promedio,$_datos_empresa_receptora->Razon_Social,$_Preguntas);
		/*
		//
		//envio de respuesta
		//
		*/
		$dat["Pass"]=1;
		$dat["Mesanje"]=$_promedio;
		echo json_encode($dat);
	}
	public function modificar(){
		if($this->session->userdata('logueado')){
			if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
			$n["notif"]=$this->Model_Notificaciones->NumNot($IDEmpresa);
			$this->load->view('head/head_profile',$n);		
			$this->load->view('views/recalificar');
			$this->load->view('footer');
			
		}else{
			redirect('');
		}
	}
	public function recalcular(){
		$datos=json_decode($_POST["datos"]);
		var_dump($datos);
		if($this->session->userdata('IDEmpresa')){
				$IDEmpresa=$this->session->userdata('IDEmpresa');
			}else{
				$IDEmpresa=$datos->IDEmpresa;
			}
		$resp=$this->Model_Calificaciones->modificacal($datos->num,$datos->repuestas,$IDEmpresa);
		if($resp["Tipo"]="Cliente"){
			$descipt="calificacionrc";
		}else{
			$descipt="calificacionrp";
		}
		$this->Model_Notificaciones->AddNotificacion($resp["valorada"],$descipt,$IDEmpresa);
		var_dump($resp);
	}
}