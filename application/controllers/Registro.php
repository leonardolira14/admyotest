<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registro extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Model_Registro');
		$this->load->model('Model_Usuarios');
		$this->load->model('Model_Empresa');
		$this->load->model('Model_EmpresaQval');
		$this->load->model('Model_Email');
		$this->load->helper('selec_Titulo');
		$this->load->helper('security');
		$this->load->library(array('email', 'form_validation'));
	}
	public function index()
	{
		if($this->session->userdata('logueado')){
			$this->load->view('head/head_profile');
		}else{
			$this->load->view('head/head');
		}
		
		$respuesta["estados"]=$this->Model_Registro->getEstados();	
		$respuesta["sector"]=$this->Model_Registro->getSector();
		$this->load->view('views/registro',$respuesta);
		$this->load->view('footer');
	}
	public function getSubsector(){
		$subsector=json_decode($_POST["datos"]);
		$respuesta=$this->Model_Registro->getSubSector($subsector->sector);
		$dat=[];
		foreach ($respuesta->result() as $key=>$value) {
			array_push($dat,array("nombre"=>$respuesta->result()[$key]->Giro,"numero"=>$respuesta->result()[$key]->IDNivel2));
		}
		$datos["subnivel"]=$dat;
		echo json_encode($datos);
		//var_dump($respuesta->result());
	}
	public function getrama(){
		$subsector=json_decode($_POST["datos"]);
		$respuesta=$this->Model_Registro->getRama($subsector->rama);
		$dat=[];
		foreach ($respuesta->result() as $key=>$value) {
			array_push($dat,array("nombre"=>$respuesta->result()[$key]->Giro,"numero"=>$respuesta->result()[$key]->IDNivel2));
		}
		$datos["rama"]=$dat;
		echo json_encode($datos);
		//var_dump($respuesta->result());
	}
	//funcion para login app
	
	//funcion para login
	public function login(){
		_is_post();
		_is_ajax_request();
		$config=array( array(
					'field'=>'correo', 
					'label'=>'Correo Electrónico', 
					'rules'=>'trim|required|valid_email|xss_clean'					
				));
		$this->form_validation->set_rules($config);
			$array=array("required"=>'El campo %s es obligatorio',"valid_email"=>'El campo %s no es valido',"min_length[3]"=>'El campo %s debe ser mayor a 3 Digitos',"min_length[10]"=>'El campo %s debe ser mayor a 10 Digitos','alpha'=>'El campo %s debe estar compuesto solo por letras',"matches"=>"Las contraseñas no coinciden",'is_unique'=>'El contenido del campo %s ya esta registrado');
		$this->form_validation->set_message($array);
		if($this->form_validation->run() !=false){
			$usuario=$this->input->post("correo");
	  		$clave=$this->input->post("clave");
	  		
	  		$respuesta["ad"]=$this->Model_Usuarios->login($usuario,$clave);
		if($respuesta["ad"]!=false){
			$datost["pass"]=1;
			$datost["token"]=$this->Model_Usuarios->addAcceso($respuesta["ad"]->result()[0]->IDUsuario);
			$datost["usuario"]=$respuesta["ad"]->result()[0]->IDUsuario;
			$datost["empresa"]=$respuesta["ad"]->result()[0]->IDEmpresa;
			$usuario_data=array(
				"IDUsuario"=>$respuesta["ad"]->result()[0]->IDUsuario,
				"IDEmpresa"=>$respuesta["ad"]->result()[0]->IDEmpresa,
				"token"=>$datost["token"],
				'logueado'=>TRUE
			);
			$this->session->set_userdata($usuario_data);	
			}else{
			$datost["pass"]=0;
			$datost["mensaje"]="Usuario y/o contraseña no valido";
			}
	  	}else{
	  		$datost["pass"]=0;
			$datost["mensaje"]=validation_errors();
	  	}
		
		echo json_encode($datost);
		
	}
	public function obtener_clave(){
		$datos=json_decode($_POST["datos"]);
		$tp=$this->Model_Usuarios->DatosUsuarioCorreo($datos->email);
		if($tp!=false){
			$res=$this->Model_Usuarios->restablecercontra($datos->email);
			ResetPassword($datos->email,$res);
			$data["pass"]=1;
			$data["mensaje"]="Se ha enviado un E-Mail";
		}else{
			$data["pass"]=0;
			$data["mensaje"]="Correo electronico no encontrado";
		}
		echo json_encode($data);
	}
	public function cerrar_session(){
		$data["token"]=$this->session->userdata("token");
		$this->Model_Usuarios->cierraSession($data);
		$usuario_data=array('logueado'=>FALSE);
		$this->session->set_userdata($usuario_data);
		$this->session->sess_destroy();
		$datos["pass"]=1;
		echo json_encode($datos);

	}
	public function preempresa(){
		$datos=json_decode($_POST["datos"]);
		$num=$this->Model_Empresa->Preempresa($datos->Razon_Social,$datos->RFC,$datos->sector,$datos->Subsector,$datos->Rama);
		
		$token=$this->Model_Usuarios->Preusuario($datos->EMAIL,$num);
		if($token!=false){
			mail_invitarUsu($datos->EMAIL,$datos->Razon_Social,$token,'PGEG243%');	
		}
		
		$data["num"]=$num;
		echo json_encode($data);
	}
	public function addEmpresa(){
		//primero recibo los datos 
		if(isset($_POST["datos"])){
			$datos=json_decode($_POST["datos"]);
			if($datos->persona=="pf"){
				//verifico que las contraseñas sean validas si no mando un error
				if($datos->clave!=$datos->clave2){
					$dat["pass"]=0;
					$dat["mensaje"]="Las contraseñas no coinciden.";
				}else if($this->Model_Usuarios->verificaCorreo($datos->email)==false){
					$dat["pass"]=0;
					$dat["mensaje"]="El correo que trata de usar ya esta en uso";
				}else if($this->Model_Empresa->verificaRFC($datos->rfc)==false){
					$dat["pass"]=0;
					$dat["mensaje"]="El RFC que trata de usar ya esta en uso";
				}else if($this->Model_Empresa->verificarazon($datos->rz)==false){
					$dat["pass"]=0;
					$dat["mensaje"]="La Razon Social que trata de usar ya esta en uso";
				}else{
					if($datos->plan->plan=="basic"){
						$resp=$this->Model_Empresa->AddEmpresa($datos->persona,$datos->rz,$datos->nc,$datos->rfc,$datos->sector,$datos->subsector,$datos->rama,$datos->estado,$datos->plan->plan,"1");
						$token=$this->Model_Usuarios->AddUsuario($resp,'','','',$datos->email,$datos->clave,$datos->clave2,'1',"Master");
						mail_activarus($datos->email,$datos->rz,$token,$datos->clave);
						$tp=$this->Model_Usuarios->DatosUsuarioCorreo($datos->email);
						$this->Model_Empresa->RegPago($resp,'Efectivo',md5($resp.$datos->nc),$tp->IDUsuario,'Pagado','0','Basic');
					}else{
						$resp=$this->Model_Empresa->AddEmpresa($datos->persona,$datos->rz,$datos->nc,$datos->rfc,$datos->sector,$datos->subsector,$datos->rama,$datos->estado,$datos->plan->plan,"3");
						$token = $this->Model_Usuarios->AddUsuario($resp,'','','',$datos->email,$datos->clave,$datos->clave2,'1',"Master");
						mail_activarus($datos->email,$datos->rz,$token,$datos->clave);
					}
					$dat["num"]=$resp;
					$dat["pass"]=1;
					$dat["mensaje"]="ok";
				}
				
				echo json_encode($dat);
			
			}else if($datos->persona=="pm"){
				//verifico que las contraseñas sean validas si no mando un error

				if($datos->clave!=$datos->clave2){
					$dat["pass"]=0;
					$dat["mensaje"]="Las contraseñas no coinciden.";
				}else if($this->Model_Usuarios->verificaCorreo($datos->email)==false){
					$dat["pass"]=0;
					$dat["mensaje"]="El correo que trata de usar ya esta en uso";
				}else if($this->Model_Empresa->verificaRFC($datos->rfc)==false){
					$dat["pass"]=0;
					$dat["mensaje"]="El RFC que trata de usar ya esta en uso";
				}else if($this->Model_Empresa->verificarazon($datos->nombre)==false){
					$dat["pass"]=0;
					$dat["mensaje"]="El RFC que trata de usar ya esta en uso";
				}else{
					if($datos->plan->plan=="basic"){
						$resp=$this->Model_Empresa->AddEmpresa($datos->persona,$datos->nombre,$datos->nc,$datos->rfc,$datos->sector,$datos->subsector,$datos->rama,$datos->estado,$datos->plan->plan,"1");
						$token=$this->Model_Usuarios->AddUsuario($resp,'','','',$datos->email,$datos->clave,$datos->clave2,'1',"Master");
						mail_activarus($datos->email,$datos->nombre,$token,$datos->clave);
						$tp=$this->Model_Usuarios->DatosUsuarioCorreo($datos->email);
						$this->Model_Empresa->RegPago($resp,'Efectivo',md5($resp.$datos->nc),$tp->IDUsuario,'Pagado','0','Basic');
					}else{
						$resp=$this->Model_Empresa->AddEmpresa($datos->persona,$datos->nombre,$datos->nc,$datos->rfc,$datos->sector,$datos->subsector,$datos->rama,$datos->estado,$datos->plan->plan,"3");
						$token=$this->Model_Usuarios->AddUsuario($resp,$datos->nombre,'','',$datos->email,$datos->clave,$datos->clave2,'1',"Master");
						mail_activarus($datos->email,$datos->rz,$token,$datos->clave);
					}
					$dat["pass"]=1;
					$dat["mensaje"]="ok";
				}
				echo json_encode($dat);
			}else{
				exit();
			}
		}else{
			exit();
		}
	}
	public function addpm(){
			
			$config=array( array(
					'field'=>'email', 
					'label'=>'Correo Electronico', 
					'rules'=>'trim|required|valid_email|xss_clean|is_unique[usuarios.Correo]'					
				),
				array(
					'field'=>'idioma',
					'label'=>'Idioma', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'pais',
					'label'=>'Pais', 
					'rules'=>'trim|required|xss_clean'
					
				),array(
					'field'=>'estado',
					'label'=>'Estado', 
					'rules'=>'trim|required|xss_clean'
					
				),array(
					'field'=>'razon',
					'label'=>'Razon Social', 
					'rules'=>'trim|required|xss_clean|is_unique[empresa.Razon_Social]'
					
				),
				array(
					'field'=>'comercial',
					'label'=>'Nombre Comercial', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'rfc',
					'label'=>'R.F.C.', 
					'rules'=>'trim|required|xss_clean|is_unique[empresa.RFC]'
					
				),
				array(
					'field'=>'sector',
					'label'=>'Sector', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'nombre',
					'label'=>'Nombre', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'p1',
					'label'=>'Contraseña', 
					'rules'=>'callback_valid_password'
					
				),
				array(
					'field'=>'p2',
					'label'=>'Confirmar Contraseña', 
					'rules'=>'matches[p1]'
					
				),
				array(
					'field'=>'termininos',
					'label'=>'Terminos y condiciones', 
					'rules'=>'required|xss_clean'
					
				),

			);
			$this->form_validation->set_rules($config);
			$array=array("required"=>'El campo %s es obligatorio',"valid_email"=>'El campo %s no es valido',"min_length[3]"=>'El campo %s debe ser mayor a 3 Digitos',"min_length[10]"=>'El campo %s debe ser mayor a 10 Digitos','alpha'=>'El campo %s debe estar compuesto solo por letras',"matches"=>"Las contraseñas no coinciden",'is_unique'=>'El contenido del campo %s ya esta registrado');
			$this->form_validation->set_message($array);
			
	  		if($this->form_validation->run() !=false){
	  			//recibo las varuables
	  			$persona="PM";
	  			$idioma=$this->input->post("idioma");
	  			$pais=$this->input->post("pais");
	  			$estado=$this->input->post("estado");
	  			$rz=$this->input->post("razon");
	  			$nc=$this->input->post("comercial");
	  			$rfc=$this->input->post("rfc");
	  			$n1=$this->input->post("sector");
	  			$n2=$this->input->post("subsector");
	  			$n3=$this->input->post("rama");
	  			$nombre=$this->input->post("nombre");
	  			$email=$this->input->post("email");
	  			$p1=$this->input->post("p1");
	  			$p2=$this->input->post("p2");
	  			$apellidos=$this->input->post("apellidos");
	  			//si todo fue bien ahora inserto la empresa
	  			$IDEmpresa=$this->Model_Empresa->AddEmpresa($persona,$rz,$nc,$rfc,$n1,$n2,$n3,$estado,'basic','1',$idioma,$pais);
	  			$token=$this->Model_Usuarios->AddUsuario($IDEmpresa,$nombre,$apellidos,'',$email,$p1,$p2,'1','Master');
	  			$this->Model_Email->Activar_Usuario($token,$email,$rz);
	  			 //ahora realizo el registro en qval
	  			  $idempresa=$this->Model_EmpresaQval->AddEmpresa($persona,$rz,$nc,$rfc,$estado,'1',$idioma,$pais,$IDEmpresa);
	  			 $this->Model_EmpresaQval->AddUsuarioQval($idempresa,$nombre,$apellidos,$email,$p1,'2');
	  			 $dat["pass"]=1;
	  			 $dat["mensaje"]=$IDEmpresa;	  			
	  		}else{
	  				$dat["pass"]=0;
					$dat["mensaje"]=validation_errors();
	  		}	
			echo json_encode($dat);
		
	}
	public function addpf(){
		$config=array( array(
					'field'=>'email', 
					'label'=>'Correo Electronico', 
					'rules'=>'trim|required|valid_email|xss_clean|is_unique[usuarios.Correo]'					
				),
				array(
					'field'=>'idioma',
					'label'=>'Idioma', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'pais',
					'label'=>'Pais', 
					'rules'=>'trim|required|xss_clean'
					
				),array(
					'field'=>'estado',
					'label'=>'Estado', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'comercial',
					'label'=>'Nombre Comercial', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'rfc',
					'label'=>'R.F.C.', 
					'rules'=>'trim|required|xss_clean|is_unique[empresa.RFC]'
					
				),
				array(
					'field'=>'sector',
					'label'=>'Sector', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'nombre',
					'label'=>'Nombre', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'p1',
					'label'=>'Contraseña', 
					'rules'=>'callback_valid_password'
					
				),
				array(
					'field'=>'p2',
					'label'=>'Confirmar Contraseña', 
					'rules'=>'matches[p1]'
					
				),
				array(
					'field'=>'termininos',
					'label'=>'Terminos y condiciones', 
					'rules'=>'required|xss_clean'
					
				),

			);
			$this->form_validation->set_rules($config);
			$array=array("required"=>'El campo %s es obligatorio',"valid_email"=>'El campo %s no es valido',"min_length[3]"=>'El campo %s debe ser mayor a 3 Digitos',"min_length[10]"=>'El campo %s debe ser mayor a 10 Digitos','alpha'=>'El campo %s debe estar compuesto solo por letras',"matches"=>"Las contraseñas no coinciden",'is_unique'=>'El contenido del campo %s ya esta registrado');
			$this->form_validation->set_message($array);
			
	  		if($this->form_validation->run() !=false){
	  			//recibo las varuables
	  			$persona="PF";
	  			$idioma=$this->input->post("idioma");
	  			$pais=$this->input->post("pais");
	  			$estado=$this->input->post("estado");
	  			$rz=$this->input->post("nombre");
	  			$nc=$this->input->post("comercial");
	  			$rfc=$this->input->post("rfc");
	  			$n1=$this->input->post("sector");
	  			$n2=$this->input->post("subsector");
	  			$n3=$this->input->post("rama");
	  			$nombre=$this->input->post("nombre");
	  			$email=$this->input->post("email");
	  			$p1=$this->input->post("p1");
	  			$p2=$this->input->post("p2");
	  			$apellidos=$this->input->post("apellidos");
	  			//si todo fue bien ahora inserto la empresa
	  			 $IDEmpresa=$this->Model_Empresa->AddEmpresa($persona,$rz." ".$apellidos,$nc,$rfc,$n1,$n2,$n3,$estado,'basic','1',$idioma,$pais);
	  			 $token=$this->Model_Usuarios->AddUsuario($IDEmpresa,$nombre,$apellidos,'',$email,$p1,$p2,'1','Master');
	  			 $this->Model_Email->Activar_Usuario($token,$email,$rz." ".$apellidos);
	  			   $idempresa=$this->Model_EmpresaQval->AddEmpresa($persona,$rz." ".$apellidos,$nc,$rfc,$estado,'1',$idioma,$pais,$IDEmpresa);
	  			 $this->Model_EmpresaQval->AddUsuarioQval($idempresa,$nombre,$apellidos,$email,$p1,'2');
	  			 $dat["pass"]=1;
	  			 $dat["mensaje"]=$IDEmpresa;
	  			
	  		}else{
	  				$dat["pass"]=0;
					$dat["mensaje"]=validation_errors();
	  		}	
			echo json_encode($dat);
	}
	public function qvpm(){
		
			$config=array( array(
					'field'=>'email', 
					'label'=>'Correo Electronico', 
					'rules'=>'trim|required|valid_email|xss_clean|is_unique[usuarios.Correo]'					
				),
				array(
					'field'=>'idioma',
					'label'=>'Idioma', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'pais',
					'label'=>'Pais', 
					'rules'=>'trim|required|xss_clean'
					
				),array(
					'field'=>'estado',
					'label'=>'Estado', 
					'rules'=>'trim|required|xss_clean'
					
				),array(
					'field'=>'razon',
					'label'=>'Razon Social', 
					'rules'=>'trim|required|xss_clean|is_unique[empresa.Razon_Social]'
					
				),
				array(
					'field'=>'comercial',
					'label'=>'Nombre Comercial', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'rfc',
					'label'=>'R.F.C.', 
					'rules'=>'trim|required|xss_clean|is_unique[empresa.RFC]'
					
				),
				array(
					'field'=>'sector',
					'label'=>'Sector', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'nombre',
					'label'=>'Nombre', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'p1',
					'label'=>'Contraseña', 
					'rules'=>'callback_valid_password'
					
				),
				array(
					'field'=>'p2',
					'label'=>'Confirmar Contraseña', 
					'rules'=>'matches[p1]'
					
				),
				array(
					'field'=>'termininos',
					'label'=>'Terminos y condiciones', 
					'rules'=>'required|xss_clean'
					
				),

			);
			$this->form_validation->set_rules($config);
			$array=array("required"=>'El campo %s es obligatorio',"valid_email"=>'El campo %s no es valido',"min_length[3]"=>'El campo %s debe ser mayor a 3 Digitos',"min_length[10]"=>'El campo %s debe ser mayor a 10 Digitos','alpha'=>'El campo %s debe estar compuesto solo por letras',"matches"=>"Las contraseñas no coinciden",'is_unique'=>'El contenido del campo %s ya esta registrado');
			$this->form_validation->set_message($array);
			
	  		if($this->form_validation->run() !=false){
	  			//recibo las varuables
	  			$persona="PM";
	  			$idioma=$this->input->post("idioma");
	  			$pais=$this->input->post("pais");
	  			$estado=$this->input->post("estado");
	  			$rz=$this->input->post("razon");
	  			$nc=$this->input->post("comercial");
	  			$rfc=$this->input->post("rfc");
	  			$n1=$this->input->post("sector");
	  			$n2=$this->input->post("subsector");
	  			$n3=$this->input->post("rama");
	  			$nombre=$this->input->post("nombre");
	  			$email=$this->input->post("email");
	  			$p1=$this->input->post("p1");
	  			$p2=$this->input->post("p2");
	  			$apellidos=$this->input->post("apellidos");
	  			//si todo fue bien ahora inserto la empresa
	  			$IDEmpresa=$this->Model_Empresa->AddEmpresa($persona,$rz,$nc,$rfc,$n1,$n2,$n3,$estado,'basic','1',$idioma,$pais);
	  			$token=$this->Model_Usuarios->AddUsuario($IDEmpresa,$nombre,$apellidos,'',$email,$p1,$p2,'1','Master');
	  			 mail_activarus($email,$rz,$token,$p1);
	  			 //ahora realizo el registro en qval
	  			  $idempresa=$this->Model_EmpresaQval->AddEmpresa($persona,$rz,$nc,$rfc,$estado,'1',$idioma,$pais,$IDEmpresa);
	  			 $this->Model_EmpresaQval->AddUsuarioQval($idempresa,$nombre,$apellidos,$email,$p1,'1');
	  			 $dat["pass"]=1;
	  			 $dat["mensaje"]=$IDEmpresa;
	  			
	  		}else{
	  				$dat["pass"]=0;
					$dat["mensaje"]=validation_errors();
	  		}	
			echo json_encode($dat);
	}
	public function qvpf(){
		$config=array( array(
					'field'=>'email', 
					'label'=>'Correo Electronico', 
					'rules'=>'trim|required|valid_email|xss_clean|is_unique[usuarios.Correo]'					
				),
				array(
					'field'=>'idioma',
					'label'=>'Idioma', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'pais',
					'label'=>'Pais', 
					'rules'=>'trim|required|xss_clean'
					
				),array(
					'field'=>'estado',
					'label'=>'Estado', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'comercial',
					'label'=>'Nombre Comercial', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'rfc',
					'label'=>'R.F.C.', 
					'rules'=>'trim|required|xss_clean|is_unique[empresa.RFC]'
					
				),
				array(
					'field'=>'sector',
					'label'=>'Sector', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'nombre',
					'label'=>'Nombre', 
					'rules'=>'trim|required|xss_clean'
					
				),
				array(
					'field'=>'p1',
					'label'=>'Contraseña', 
					'rules'=>'callback_valid_password'
					
				),
				array(
					'field'=>'p2',
					'label'=>'Confirmar Contraseña', 
					'rules'=>'matches[p1]'
					
				),
				array(
					'field'=>'termininos',
					'label'=>'Terminos y condiciones', 
					'rules'=>'required|xss_clean'
					
				),

			);
			$this->form_validation->set_rules($config);
			$array=array("required"=>'El campo %s es obligatorio',"valid_email"=>'El campo %s no es valido',"min_length[3]"=>'El campo %s debe ser mayor a 3 Digitos',"min_length[10]"=>'El campo %s debe ser mayor a 10 Digitos','alpha'=>'El campo %s debe estar compuesto solo por letras',"matches"=>"Las contraseñas no coinciden",'is_unique'=>'El contenido del campo %s ya esta registrado');
			$this->form_validation->set_message($array);
			
	  		if($this->form_validation->run() !=false){
	  			//recibo las varuables
	  			$persona="PF";
	  			$idioma=$this->input->post("idioma");
	  			$pais=$this->input->post("pais");
	  			$estado=$this->input->post("estado");
	  			$rz=$this->input->post("nombre");
	  			$nc=$this->input->post("comercial");
	  			$rfc=$this->input->post("rfc");
	  			$n1=$this->input->post("sector");
	  			$n2=$this->input->post("subsector");
	  			$n3=$this->input->post("rama");
	  			$nombre=$this->input->post("nombre");
	  			$email=$this->input->post("email");
	  			$p1=$this->input->post("p1");
	  			$p2=$this->input->post("p2");
	  			$apellidos=$this->input->post("apellidos");
	  			//si todo fue bien ahora inserto la empresa
	  			 $IDEmpresa=$this->Model_Empresa->AddEmpresa($persona,$rz." ".$apellidos,$nc,$rfc,$n1,$n2,$n3,$estado,'basic','1',$idioma,$pais);
	  			 $token=$this->Model_Usuarios->AddUsuario($IDEmpresa,$nombre,$apellidos,'',$email,$p1,$p2,'1','Master');
	  			 mail_activarus($email,$rz." ".$apellidos,$token,$p1);
	  			  $idempresa=$this->Model_EmpresaQval->AddEmpresa($persona,$rz." ".$apellidos,$nc,$rfc,$estado,'1',$idioma,$pais,$IDEmpresa);
	  			 $this->Model_EmpresaQval->AddUsuarioQval($idempresa,$nombre,$apellidos,$email,$p1,'1');
	  			 $dat["pass"]=1;
	  			 $dat["mensaje"]=$IDEmpresa;
	  			
	  		}else{
	  				$dat["pass"]=0;
					$dat["mensaje"]=validation_errors();
	  		}	
			echo json_encode($dat);
	}
	//funcion para actualizar el registro de las empresas
	public function finreg(){
		$IDEmpresa=$this->input->post("num");
		$persona=$this->input->post("persona");
		$idioma=$this->input->post("idioma");
		$pais=$this->input->post("pais");
		$estado=$this->input->post("estado");
		$rz=$this->input->post("nombre");
		$nc=$this->input->post("comercial");
		$rfc=$this->input->post("rfc");
		$web=$this->input->post("pagina");
		$te=$this->input->post("te");
		$nem=$this->input->post("nemp");
		$fac=$this->input->post("fac");
		$perfil=$this->input->post("perfil");
		//ahora actualizo los datos de la empresa en admyo
		$this->Model_Empresa->actualizadatos($rz,$nc,$rfc,$te,$nem,$fac,$perfil,$web,$IDEmpresa);
		//ahora actualizo los datos en qval
		
		

	} 
	public function valid_password($password = '')
	{
		$password = trim($password);
		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', 'El campo {field} es requerido.');
			return FALSE;
		}
		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'El campo {field}  debe tener al menos una letra minúscula.');
			return FALSE;
		}
		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'El campo {field} debe tener al menos una letra mayuscula.');
			return FALSE;
		}
		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'El campo {field} debe tener al menos un número.');
			return FALSE;
		}
		if (preg_match_all($regex_special, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'El campo {field} debe tener al menos un carácter especial.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
			return FALSE;
		}
		if (strlen($password) < 6)
		{
			$this->form_validation->set_message('valid_password', 'El campo {field} debe tener al menos 6 caracteres de longitud.');
			return FALSE;
		}
		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', 'El campo {field} no debe de exceder los 32 caracter de longitud.');
			return FALSE;
		}
		return TRUE;
	}
}

  
