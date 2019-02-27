<?
/**
 * Controlador para una empresa
 */
class Empresa extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Model_Empresa");
		$this->load->model("Model_Usuarios");
		$this->load->model("Model_Notificaciones");
	}
	/*
	funcion para agregar una empresa
	*/
	public function addempresa(){
		_is_post();
		_is_ajax_request();

		$_RazonSocial=$this->input->post("razon_social");
		$_Nombre_Comercial=$this->input->post("nombre_comercial");
		$_RFC=$this->input->post("rfc");
		$_Tipo_Empresa=$this->input->post("tipo_empresa");
		$_no_empleados=$this->input->post("no_empleados");
		$_facturacion_anual=$this->input->post("facturacion_anual");
		$descripcion_empresa=$this->input->post("descripcion_empresa");

	}
	/*
	//funcion para dar de alta una empresa follow
	*/
	public function follow(){
		_is_post();
		_is_ajax_request();
		//para poder regiatrar una empresa necesito el id de la empresa
		$datos=json_decode($_POST["datos"]);
		$_IDEmpresa=0;
		if($this->session->userdata('IDEmpresa')){
			$_IDEmpresa=$this->session->userdata('IDEmpresa');
		}
		if($_IDEmpresa===0){
			$_data["pass"]=0;
		}else{
			$_datos_Empresa=$this->Model_Empresa->DatosEmpresa($_IDEmpresa);
			if($_datos_Empresa->TipoCuenta==="basic"){
				if($_datos_Empresa->NoEmpleados==="1-10"){
					$_data["pass"]="1";
				}else{
					$_data["pass"]="2";
				}	
			}else{		
				$this->Model_Empresa->addFollow($_IDEmpresa,$datos->datos->num);
				$this->Model_Notificaciones->AddNotificacion($datos->datos->num,"Follow",$_IDEmpresa);
				$_data["pass"]="3";
			}
		}
		echo json_encode($_data);
	}
	/*
	funcion para Modificar una empresa
	*/
	public function updateempresa(){
		_is_post();
		_is_ajax_request();
		//primero valido si el usuario que traigo es master si no lo es no puede hacer cambios
		$_ID_Usuario=$this->input->post("usuario_cambio");
		$_datos_usuario=$this->Model_Usuarios->DatosUsuario($_ID_Usuario);
		if($_datos_usuario->Tipo_Usuario==="Master"){
			$config=array( 
					array(
						'field'=>'razon_social',
						'label'=>'Razon Social', 
						'rules'=>'trim|required|xss_clean|min_length[3]'
						
					),
					array(
						'field'=>'nombre_comercial',
						'label'=>'Nombre Comercial', 
						'rules'=>'trim|required|xss_clean'
						
					),
					array(
						'field'=>'rfc',
						'label'=>'R.F.C.', 
						'rules'=>'trim|required|xss_clean'
						
					),
					array(
						'field'=>'tipo_empresa',
						'label'=>'Tipo de Empresa', 
						'rules'=>'trim|required|xss_clean'
						
					),
					array(
						'field'=>'no_empleados',
						'label'=>'No. de Empleados', 
						'rules'=>'trim|required|xss_clean'
						
					),
					array(
						'field'=>'facturacion_anual',
						'label'=>'Facturacion Anual', 
						'rules'=>'trim|required|xss_clean'
						
					),
					array(
						'field'=>'descripcion_empresa',
						'label'=>'Descripción de la Empresa ', 
						'rules'=>'trim|required|xss_clean|min_length[20]|max_length[5000]'
						
					)
				);
			$this->form_validation->set_rules($config);
			$array=array("required"=>'El campo %s es obligatorio',"valid_email"=>'El campo %s no es valido',"min_length[3]"=>'El campo %s debe ser mayor a 3 Digitos',"min_length[20]"=>'El campo %s debe ser mayor a 20 Digitos',"max_length[5000]"=>'El campo %s debe ser menor a 5000 Digitos',"min_length[10]"=>'El campo %s debe ser mayor a 10 Digitos','alpha'=>'El campo %s debe estar compuesto solo por letras',"matches"=>"Las contraseñas no coinciden",'is_unique'=>'El contenido del campo %s ya esta registrado');
			$this->form_validation->set_message($array);
			if($this->form_validation->run() !=false)
			{
				$_ID_Empresa=$this->input->post("num");
				$_Razon_Social=$this->input->post("razon_social");
				$_Nombre_Comercial=$this->input->post("nombre_comercial");
				$_RFC=$this->input->post("rfc");
				$_tipo_Empresa=$this->input->post("tipo_empresa");
				$_no_empleados=$this->input->post("no_empleados");
				$_facturacion_anual=$this->input->post("facturacion_anual");
				$descripcion_empresa=$this->input->post("descripcion_empresa");
				//ahora actualizo la parte de datos principales
				$rec=$this->Model_Empresa->UpdateGen($_Razon_Social,$_Nombre_Comercial,$_RFC,$_tipo_Empresa,$_no_empleados,$_facturacion_anual,$descripcion_empresa,$_ID_Empresa);
				
				$dat["pass"]=1;
				$dat["mensaje"]="Datos Actualizados";
			}else{
				$dat["pass"]=2;
				$dat["mensaje"]=validation_errors();
			}
		}else{
			$dat["pass"]=1;
			$dat["mensaje"]="No estas autorizado para realizar cambios dentro de admyo";
		}
		echo json_encode($dat);
	}
	
}