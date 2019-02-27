<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Empresa extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('selec_Titulo');
		$this->constant="vkq4suQesgv6FVvfcWgc2TRQCmAc80iE";
	}
	public function GetEmpresasPcalif(){
		$this->db->select("IDEmpresa,Razon_Social,RFC");
		$this->db->from("empresa");
		$giros=$this->db->get();
		$array=[];
		if($giros->num_rows()>0){
			foreach ($giros->result() as $key) {
				array_push($array,array('num'=>$key->IDEmpresa,'value' =>$key->Razon_Social,"RFC"=>$key->RFC));
			}
			return $array;
		}
	}
	public function datos_titulo(){
		$data["titulo"]=$this->session->userdata("titulo");
		$data["tmletra"]=$this->session->userdata("tmletra");
		$data["class"]=$this->session->userdata("class");
		return $data;
	}
	public function bdatos_titulo(){
		$data["titulo"]=$this->session->userdata("btitulo");
		$data["tmletra"]=$this->session->userdata("btmletra");
		$data["class"]=$this->session->userdata("bclass");
		return $data;
	}
	
	public function datosPerfilBuscado($idempresa){
		//primerp obtengo los datos de la empresa
		$datosempresa=$this->DatosEmpresa($idempresa);
		$data["titulo"]=$datosempresa->Razon_Social;
		$data["tmletra"]=tamleta($datosempresa->Razon_Social);
		$data["Perfil"]=$datosempresa->Perfil;
		$data["Logo"]=$datosempresa->Logo;
		 //ahora obtengo las calificacines acumuladas como cliente que recibe de los proveedores
		$calacum=$this->PromedioCalifAcumuladasTotal($idempresa,"Recibida","Cliente");
		 //ahora obtengo las que va en este mes
		$calacumm=$this->PromedioCalifAcumuladasPorFecha($idempresa,"Recibida","Cliente",date('Y'),date('m'),date('Y'),date('m'),"Activa");


		if($calacum["Promedio"]==0){
			$data["CalifcCliente"]=round($calacumm["Promedio"],2);
			$data["NumCalifcCliente"]=round($calacumm["NumeroTotal"],2);
		}else if($calacumm["Promedio"]==0){
			$data["CalifcCliente"]=round($calacum["Promedio"],2);
			$data["NumCalifcCliente"]=round($calacum["NumeroTotal"],2);
		}else{
			$arriba=($calacum["Promedio"]*$calacum["NumeroTotal"])+($calacumm["Promedio"]*$calacumm["NumeroTotal"]);
			$abajo=$calacumm["NumeroTotal"]+$calacum["NumeroTotal"];
			$promedio=$arriba/$abajo;
			$data["CalifcCliente"]=round($promedio,2);
			$data["NumCalifcCliente"]=$calacumm["NumeroTotal"]+$calacum["NumeroTotal"];
		}
		
		 //ahora repito los pasos para obtener las calificaciones como proveedor recibidas de clientes
		$calacum=$this->PromedioCalifAcumuladasTotal($idempresa,"Recibida","Proveedor");
		 //ahora obtengo las que va en este mes
		$calacumm=$this->PromedioCalifAcumuladasPorFecha($idempresa,"Recibida","Proveedor",date('Y'),date('m'),date('Y'),date('m'),"Activa");
		 //ahora saco el promedio final como cliente 
		if($calacum["Promedio"]==0){
			$data["CalifcProveedor"]=round($calacumm["Promedio"],2);
			$data["NumCalifcProveedor"]=round($calacumm["NumeroTotal"],2);
		}else if($calacumm["Promedio"]==0){
			$data["CalifcProveedor"]=round($calacum["Promedio"],2);
			$data["NumCalifcProveedor"]=round($calacum["NumeroTotal"],2);
		}else{
			$arriba=($calacum["Promedio"]*$calacum["NumeroTotal"])+($calacumm["Promedio"]*$calacumm["NumeroTotal"]);
			$abajo=$calacumm["NumeroTotal"]+$calacum["NumeroTotal"];
			$promedio=$arriba/$abajo;
			$data["CalifcProveedor"]=round($promedio,2);
			$data["NumCalifcProveedor"]=$calacumm["NumeroTotal"]+$calacum["NumeroTotal"];
		}
		
		if($data["CalifcCliente"]<$data["CalifcProveedor"]){
			$data["imgen"]=seleccolorimg($data["CalifcProveedor"]);
			$data["class"]=seleccolor($data["CalifcProveedor"]);
		}else if($data["CalifcCliente"]>$data["CalifcProveedor"]){
			$data["imgen"]=seleccolorimg($data["CalifcCliente"]);
			$data["class"]=seleccolor($data["CalifcCliente"]);
		}else{
			$data["imgen"]=seleccolorimg($data["CalifcProveedor"]);
			$data["class"]=seleccolor($data["CalifcProveedor"]);
		}

		$data["textNumcalif"]=dametextocalifi($data["NumCalifcProveedor"],$data["NumCalifcCliente"]);
		$giros=$this->GirosNivel1Empresa($idempresa);
		$dgiros=[];
		foreach ($giros as $key => $value) {
			if($giros[$key]->IDGiro2===0){
				$res=$this->GirosViejos1($giros[$key]->IDGiro);
				
				array_push($dgiros,array("Giro"=>$res[0]->Giro));
			}else{
				$res=$this->GirosNuevos1($giros[$key]->IDGiro);
				if(isset($res[0]->Giro))
					array_push($dgiros,array("Giro"=>$res[0]->Giro));
			}
		}
		$data["giros"]=$dgiros;
		$data["DiasActualizados"]="Actualizado hace ".$this->DiasActualizados($idempresa)." Dias";
		$varible=$this->session->userdata();
		$varible["bclass"]=$data["class"];
		$varible["btitulo"]=$data["titulo"];
		$varible["btmletra"]=$data["tmletra"];
		$this->session->set_userdata($varible);
		
		return $data;
	}
	//function datos del home
	public function datosPerfil($idempresa){
		//primerp obtengo los datos de la empresa
		$datosempresa=$this->DatosEmpresa($idempresa);
		$data["titulo"]=$datosempresa[0]->Razon_Social;
		$data["tmletra"]=tamleta($datosempresa[0]->Razon_Social);
		$data["Perfil"]=$datosempresa[0]->Perfil;
		$data["Logo"]=$datosempresa[0]->Logo;
		 //ahora obtengo las calificacines acumuladas como cliente que recibe de los proveedores
		$calacum=$this->PromedioCalifAcumuladasTotal($idempresa,"Recibida","Cliente");
		 //ahora obtengo las que va en este mes
		$calacumm=$this->PromedioCalifAcumuladasPorFecha($idempresa,"Recibida","Cliente",date('Y'),date('m'),date('Y'),date('m'),"Activa");

		if($calacum["Promedio"]==0){
			$data["CalifcCliente"]=round($calacumm["Promedio"],2);
			$data["NumCalifcCliente"]=round($calacumm["NumeroTotal"],2);
		}else if($calacumm["Promedio"]==0){
			$data["CalifcCliente"]=round($calacum["Promedio"],2);
			$data["NumCalifcCliente"]=round($calacum["NumeroTotal"],2);
		}else{
			$arriba=($calacum["Promedio"]*$calacum["NumeroTotal"])+($calacumm["Promedio"]*$calacumm["NumeroTotal"]);
			$abajo=$calacumm["NumeroTotal"]+$calacum["NumeroTotal"];
			$promedio=$arriba/$abajo;
			$data["CalifcCliente"]=round($promedio,2);
			$data["NumCalifcCliente"]=$calacumm["NumeroTotal"]+$calacum["NumeroTotal"];
		}

		
		 //ahora repito los pasos para obtener las calificaciones como proveedor recibidas de clientes
		$calacum=$this->PromedioCalifAcumuladasTotal($idempresa,"Recibida","Proveedor");
		 //ahora obtengo las que va en este mes
		$calacumm=$this->PromedioCalifAcumuladasPorFecha($idempresa,"Recibida","Proveedor",date('Y'),date('m'),date('Y'),date('m'),"Activa");
		 //ahora saco el promedio final como cliente 

		if($calacum["Promedio"]==0){
			$data["CalifcProveedor"]=round($calacumm["Promedio"],2);
			$data["NumCalifcProveedor"]=round($calacumm["NumeroTotal"],2);
		}else if($calacumm["Promedio"]==0){
			$data["CalifcProveedor"]=round($calacum["Promedio"],2);
			$data["NumCalifcProveedor"]=round($calacum["NumeroTotal"],2);
		}else{
			$arriba=($calacum["Promedio"]*$calacum["NumeroTotal"])+($calacumm["Promedio"]*$calacumm["NumeroTotal"]);
			$abajo=$calacumm["NumeroTotal"]+$calacum["NumeroTotal"];
			$promedio=$arriba/$abajo;
			$data["CalifcProveedor"]=round($promedio,2);
			$data["NumCalifcProveedor"]=$calacumm["NumeroTotal"]+$calacum["NumeroTotal"];
		}
		
		if($data["CalifcCliente"]<$data["CalifcProveedor"]){
			$data["imgen"]=seleccolorimg($data["CalifcProveedor"]);
			$data["class"]=seleccolor($data["CalifcProveedor"]);
		}else if($data["CalifcCliente"]>$data["CalifcProveedor"]){
			$data["imgen"]=seleccolorimg($data["CalifcCliente"]);
			$data["class"]=seleccolor($data["CalifcCliente"]);
		}else{
			$data["imgen"]=seleccolorimg($data["CalifcProveedor"]);
			$data["class"]=seleccolor($data["CalifcProveedor"]);
		}
		$varible=$this->session->userdata();
		$varible["class"]=$data["class"];
		$varible["titulo"]=$data["titulo"];
		$varible["tmletra"]=$data["tmletra"];
		$this->session->set_userdata($varible);
		$data["textNumcalif"]=dametextocalifi($data["NumCalifcProveedor"],$data["NumCalifcCliente"]);
		$giros=$this->GirosNivel1Empresa($idempresa);
		$dgiros=[];
		foreach ($giros as $key => $value) {
			if($giros[$key]->IDGiro2==0){
				$res=$this->GirosViejos1($giros[$key]->IDGiro);
				array_push($dgiros,array("Giro"=>$res[0]->Giro));
			}else{
				$res=$this->GirosNuevos1($giros[$key]->IDGiro);
				array_push($dgiros,array("Giro"=>$res[0]->Giro));
			}
		}
		$data["giros"]=$dgiros;
		$empeorado=0;
		$mantenido=0;
		$mejorado=0;
		$proveedores=$this->ObtenerProveedores($idempresa);

		foreach ($proveedores as $key) {
			if($key["num"]!=$idempresa){
				$respuesta=$this->ReputaciondeUnaEmpresa($key["num"],date('m'),date('Y'));
				if($respuesta["puesto"]=="Ma"){
					$mantenido++;	
				}
				if($respuesta["puesto"]=="Me"){
					$mejorado++;	
				}
				if($respuesta["puesto"]=="Em"){
					$empeorado++;	
				}		
			}
			
		}

		$data["MantendioProve"]=$mantenido;
		$data["PMantendioProve"]=porcentaje(count($proveedores),$mantenido);
		$data["MejoradoProve"]=$mejorado;
		$data["PMejoradoProve"]=porcentaje(count($proveedores),$mejorado);
		$data["EmpeoradoProve"]=$empeorado;
		$data["PEmpeoradoProve"]=porcentaje(count($proveedores),$empeorado);
		$clientes=$this->ObtenerClientes($idempresa);
		$empeorado=0;
		$mantenido=0;
		$mejorado=0;
		
		foreach ($clientes as $key) {
			
			if($key["num"]!=$idempresa){
				$respuesta=$this->ReputaciondeUnaEmpresa($key["num"],date('m'),date('Y'));
				if($respuesta["puesto"]=="Ma"){
					$mantenido++;	
				}
				if($respuesta["puesto"]=="Me"){
					$mejorado++;	
				}
				if($respuesta["puesto"]=="Em"){
					$empeorado++;	
				}
			}		
		}
		$data["MantendioClientes"]=$mantenido;
		$data["PMantendioClientes"]=porcentaje(count($clientes),$mantenido);
		$data["MejoradoClientes"]=$mejorado;
		$data["PMejoradoClientes"]=porcentaje(count($clientes),$mejorado);
		$data["EmpeoradoClientes"]=$empeorado;
		$data["PEmpeoradoClientes"]=porcentaje(count($clientes),$empeorado);
		//ahora obtengo las visitas 
		$visitasProve=0;
		$visitasClie=0;
		foreach ($proveedores as $key) {

			$visitasProve=$visitasProve+$this->VisitasPorEmpresa($idempresa,$key["num"]);

		}


		//obtengo las visitas de los clintes
		foreach ($clientes as $key) {
					//busco en los proveedores si ya esta ya no cuento su visita
			if(!in_array($key, $proveedores)){
				$visitasClie=$visitasClie+$this->VisitasPorEmpresa($idempresa,$key["num"]);
			}
					//
		}
		//ahora obtengo las anonimas
		$visitasAnonimas=$this->VisitasPorEmpresa($idempresa,0);
		//las sumo y saco el total
		$totalvisitas=$visitasAnonimas+$visitasProve+$visitasClie;
		//resto a las totales 
		$visitasOtras=$this->VisitasTotales($idempresa)-$totalvisitas;
		$data["DiasActualizados"]="Actualizado hace ".$this->DiasActualizados($idempresa)." Dias";
		$data["visitasClientes"]=$visitasClie;
		$data["visitasProveedores"]=$visitasProve;
		$data["visitasAnonimas"]=$visitasAnonimas;
		$data["visitasOtras"]=$visitasOtras;
		$data["NumNot"]=$this->NumNot($idempresa);	
		return $data;
	}
	//funcion para el total de notificaciones
	public function NumNot($IDEmpresa){
		$sql="IDEmpresa='$IDEmpresa' and visto='0'";
		$this->db->select('*');
		$this->db->from("Notificaciones");
		$this->db->where($sql);
		$respu=$this->db->get();
		return $respu->num_rows();
	}
	//funcion para poner un giro en principal
	public function PrincipalGiro($giro,$idempresa){
			//pongo todos los giros en limipio
		$data=array(
			"Principal"=>'0'
		);
		$this->db->where('IDEmpresa',$idempresa);
		$this->db->update('giroempresa', $data);
		$data=array(
			"Principal"=>'1'
		);
		$this->db->where('IDGE',$giro);
		return $this->db->update('giroempresa', $data);	
	}
	//funcion para eliminar ungiro
	public function DelGiro($giro,$idempresa){
		$this->db->select('*');
		$this->db->from('giroempresa');
		$this->db->where("IDEmpresa",$idempresa);
		$giros=$this->db->get();
		if($giros->num_rows()==1){
			return "La empresa no Puede quedarse sin Giros";
		}else{
			$this->db->where('IDGE', $giro);
			return $this->db->delete('giroempresa');	
		}
		
	}
	public function ADDMarcar($marca,$logo,$idempresa){
		$array=array("Marca"=>$marca,"logo"=>$logo,"IDEmpresa"=>$idempresa);
		return $this->db->insert('marcas', $array);

	}
	public function DelMarca($marca){
		$this->db->where('IDMarca', $marca);
		return $this->db->delete('marcas');	
	}
	public function GirosParaDatos($idempresa){
		$giros=$this->db->select('*')->where("IDEmpresa=$idempresa")->get('giroempresa');
		$dgiros=[];
		foreach ($giros->result() as $key) {
			if($key->IDGiro2==0){
				$res=$this->GirosViejos1($key->IDGiro);
				array_push($dgiros,array("Num"=>$key->IDGE,"Giro"=>$res[0]->Giro,"Principal"=>$key->Principal));
			}else{
				$res=$this->GirosNuevos1($key->IDGiro);
				array_push($dgiros,array("Num"=>$key->IDGE,"Giro"=>$res[0]->Giro,"Principal"=>$key->Principal));
			}
		}
		return $dgiros;
	}
	public function VisitasPorEmpresa($idempresa,$idempresa2){
		$sql="IDEmpresa='$idempresa' and IDEmpVisitadora='$idempresa2'";
		$this->db->select('Count(*) as num');
		$this->db->from('visitas');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()!=0){
			return $respu->result()[0]->num;
		}else{
			return 0;
		}
	}
	public function DiasActualizados($idempresa){
		$sql="IDEmpresa='$idempresa' and Forma='Recibida' order by Fecha desc limit 1";
		$this->db->select('Fecha');
		$this->db->from('calificaciones');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()!=0){
			return restar_fecha($respu->result()[0]->Fecha,date('Y-m-d'));
		}else{
			return restar_fecha(date('Y-m-d'),date('Y-m-d'));
		}
	}
	//funcion para las visitas totales
	public function VisitasTotalesAnio($idempresa,$anio){
		$sql="FechaVisita like '$anio%' and IDEmpresa='$idempresa'";
		$this->db->select('Count(*) as num');
		$this->db->from('visitas');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()!=0){
			return $respu->result()[0]->num;
		}else{
			return 0;
		}

	}
	public function VisitasTotales($idempresa){
		$sql="IDEmpresa='$idempresa'";
		$this->db->select('Count(*) as num');
		$this->db->from('visitas');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()!=0){
			return $respu->result()[0]->num;
		}else{
			return 0;
		}
	}
	//funcion para obtener la reputacion
	public function ReputaciondeUnaEmpresa($idempresa,$mes2,$anio2){
		$arriba=0;
		$abajo=0;
		if($mes2=="01"){
			$mes1=12;
			$anio1=$anio2-1;
		}else{
			$mes1=$mes2-1;
			$anio1=$anio2;
		}


		$sql=" IDEmpresa='$idempresa' and Forma='Recibida' and Status_Val='Activa' and date(Fecha) between '$anio1-$mes1-01' and  '$anio1-$mes1-31'";
		$this->db->select('Calificacion');
		$this->db->from('calificaciones');
		$this->db->where($sql);	
		$respu=$this->db->get();
		if($respu->num_rows()!=0){
			foreach ($respu->result() as $key) {
				$arriba=$arriba+$key->Calificacion;
			}
			$abajo=$respu->num_rows();
			$promedio=$arriba/$abajo;
		}else{
			$promedio=0;
		}
		$sql=" IDEmpresa='$idempresa' and Forma='Recibida' and Status_Val='Activa' and date(Fecha) between '$anio2-$mes2-01' and  '$anio2-$mes2-31'";
		$this->db->select('Calificacion');
		$this->db->from('calificaciones');
		$this->db->where($sql);	
		$respu=$this->db->get();
		if($respu->num_rows()!=0){
			foreach ($respu->result() as $key) {
				$arriba=$arriba+$key->Calificacion;
			}
			$abajo=$respu->num_rows();
			$promedio2=$arriba/$abajo;
		}else{
			$promedio2=0;
		}
		if($promedio>$promedio2){
			$data["puesto"]="Em";
			$data["diferencia"]=round($promedio-$promedio2,2);
			$data["leyenda"]="La empresa ha empeorado su reputación.";
			$data["class"]="colorrojo";

		}else if($promedio<$promedio2){
			$data["puesto"]="Me";
			$data["diferencia"]=round($promedio2-$promedio,2);
			$data["leyenda"]="La empresa ha mejorado su reputación.";
			$data["class"]="colorverde";
		}else{
			$data["puesto"]="Ma";
			$data["diferencia"]=round($promedio2);
			$data["leyenda"]="La empresa ha mantenido su calificación.";
			$data["class"]="colorazul";
		}
		return $data;

	}
	public function AddGiro($IDEmpresa,$n1,$n2,$n3){
		$array=array("IDEmpresa"=>$IDEmpresa,"IDGiro"=>$n1,"Principal"=>'0',"IDGiro2"=>$n2,"IDGiro3"=>$n3);
		return $this->db->insert('giroempresa', $array);
	}
	//funcion para saber el giro principal de la empresa
	public function Get_Giro_Principal($_ID_Empresa){
		$_registro=$this->db->select("IDGiro")->where("IDEmpresa=$_ID_Empresa and Principal='1'")->get("giroempresa");
		return $_registro->result()[0]->IDGiro;

	}
	//funcion para llenar los datos de registro completado
	public function actualizadatos($rz,$nc,$rfc,$te,$ne,$fa,$p,$pagina,$IDEmpresa){
		$data=array(
			"Razon_Social"=>$rz,
			"Nombre_Comer"=>$nc,
			"RFC"=>$rfc,
			"TipoEmpresa"=>$te,
			"NoEmpleados"=>$ne,
			"FacAnual"=>$fa,
			"Perfil"=>$p,
			"Sitio_Web"=>$pagina
		);
		$this->db->where('IDEmpresa',$IDEmpresa);
		return $this->db->update('empresa', $data);	
	}
	//funcion para actualizar los datos de la empresagenerales
	public function UpdateGen($rz,$nc,$rfc,$te,$ne,$fa,$p,$IDEmpresa){
		$data=array(
			"Razon_Social"=>$rz,
			"Nombre_Comer"=>$nc,
			"RFC"=>$rfc,
			"TipoEmpresa"=>$te,
			"NoEmpleados"=>$ne,
			"FacAnual"=>$fa,
			"Perfil"=>$p
		);
		$this->db->where('IDEmpresa',$IDEmpresa);
		return $this->db->update('empresa', $data);	
	}
	//funcion para obtener los datos de la empresa
	public function DatosEmpresa($IDEmpresa){
		$this->db->select('*');
		$this->db->from('empresa');
		$this->db->where('IDEmpresa',$IDEmpresa);	
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			return false;
		}else{
			return $respu->row();
		}
		
	}
	public function datosRFCEm($rfc){
		$this->db->select('*');
		$this->db->from('empresa');
		$this->db->where('RFC',$rfc);	
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			return false;
		}else{
			return $respu->result()[0];
		}
		
	}
	public function GirosViejos1($giro){
		$sql="IDGiro='".$giro."'";
		$this->db->select('*');
		$this->db->from('giros');
		$this->db->where($sql);	
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			return 1;
		}else{
			return $respu->result();
		}
	}
	public function GirosNuevos1($giro){
		$sql="IDNivel1='".$giro."'";
		$this->db->select('*');
		$this->db->from('GiroNivel1');
		$this->db->where($sql);	
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			return 1;
		}else{
			return $respu->result();
		}
	}
	public function GirosNivel1Empresa($idempresa){
		$sql="IDEmpresa='".$idempresa."'";
		$this->db->select('*');
		$this->db->from('giroempresa');
		$this->db->where($sql);	
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			return 1;
		}else{
			return $respu->result();
		}
	}
	//funcion para contar el promedio y las calificaciones por mes
	public function PromedioCalifAcumuladasPorFecha($idempresa,$forma,$tipo,$anio1,$mes1,$anio2,$mes2,$status){
		$abajo=0;
		$arriba=0;
		$sql="IDEmpresa='".$idempresa."' and Forma='".$forma."' and Tipo='$tipo' and date(Fecha)  between '".$anio1."-$mes1-01' and '$anio2-$mes2-31' and Status_Val='$status' ";
		$this->db->select('Calificacion');
		$this->db->from('calificaciones');
		$this->db->where($sql);	
		$prove=$this->db->get();
		if($prove->num_rows()!=0){
			foreach ($prove->result() as $resultados) {
				$arriba=$arriba+$resultados->Calificacion;
			}
			$promedio=$arriba/$prove->num_rows();
			$abajo=$prove->num_rows();
		}else{
			$promedio=0;
			$abajo=0;
		}
		$data=array("Promedio"=>$promedio,"NumeroTotal"=>$abajo);
		return $data;

	}
	//funcionpara traer el promedio y las calificaciones totales acumuladas
	public function PromedioCalifAcumuladasTotal($idempresa,$forma,$tipo){
		$abajo=0;
		$arriba=0;
		$sql="IDEmpresa='".$idempresa."' and Forma='".$forma."' and Tipo='".$tipo."'";
		$this->db->select('CalifMed,NumCalif');
		$this->db->from('acumcal');
		$this->db->where($sql);	
		$prove=$this->db->get();
		if($prove->num_rows()!=0){

			foreach ($prove->result() as $resultados) {
				$arriba=$arriba+(($resultados->CalifMed)*($resultados->NumCalif));
				$abajo=$abajo+$resultados->NumCalif;
			}
			if($arriba==0){
				$promedio=0;
			}else{
				$promedio=$arriba/$abajo;
			}

		}else{
			$promedio=0;
		}
		$data=array("Promedio"=>$promedio,"NumeroTotal"=>$abajo);

		return $data;
	}
	//funcion para obtener los proveedores
	public function ObtenerProveedores($idempresa){
		$sql="IDEmpresa='$idempresa' and Forma='Realizada' and Tipo='Cliente' and Status_valora='ACTIVA' group by IDEmpresa_Valorada";
		$this->db->select('IDEmpresa_Valorada');
		$this->db->from('calificaciones');
		$this->db->join('valoraciones','valoraciones.IDValora=calificaciones.IDValora');
		$this->db->where($sql);	
		$prove=$this->db->get();
		$prove1=[];
		if($prove->num_rows()!=0){
			
			foreach ($prove->result() as $provedor) {
				if($provedor->IDEmpresa_Valorada!=$idempresa){
					array_push($prove1,array("num"=>$provedor->IDEmpresa_Valorada));
				}
			}
			
		}
		$sql="IDEmpresa='$idempresa' and Forma='Recibida' and Tipo='Proveedor' and Status_valora='ACTIVA' group by IDEmpresa_Valoradora";
		$this->db->select('IDEmpresa_Valoradora');
		$this->db->from('calificaciones');
		$this->db->join('valoraciones','valoraciones.IDValora=calificaciones.IDValora');
		$this->db->where($sql);	
		$prove=$this->db->get();
		$prove2=[];
		if($prove->num_rows()!=0){
			
			foreach ($prove->result() as $provedor) {
				if($provedor->IDEmpresa_Valoradora!=$idempresa){
					array_push($prove2,array("num"=>$provedor->IDEmpresa_Valoradora));
				}
			}
		}
		$proveedores=array_merge($prove1,$prove2);
		$proveedores = array_map('unserialize', array_unique(array_map('serialize', $proveedores)));
		//var_dump($proveedores);

		return $proveedores;
	}
	//funcion para obtener los clientes
	public function ObtenerClientes($idempresa){
		$sql="IDEmpresa='$idempresa' and Forma='Realizada' and Tipo='Proveedor' and Status_valora='ACTIVA' group by IDEmpresa_Valorada";
		$this->db->select('IDEmpresa_Valorada');
		$this->db->from('calificaciones');
		$this->db->join('valoraciones','valoraciones.IDValora=calificaciones.IDValora');
		$this->db->where($sql);	
		$prove=$this->db->get();
		$prove1=[];
		if($prove->num_rows()!=0){
			
			foreach ($prove->result() as $provedor) {
				if($provedor->IDEmpresa_Valorada!=$idempresa && $provedor->IDEmpresa_Valorada!='1195'){
					array_push($prove1,array("num"=>$provedor->IDEmpresa_Valorada));
				}
			}
		}
		$sql="IDEmpresa='$idempresa' and Forma='Recibida' and Tipo='Cliente' and Status_valora='ACTIVA' group by IDEmpresa_Valoradora";
		$this->db->select('IDEmpresa_Valoradora');
		$this->db->from('calificaciones');
		$this->db->join('valoraciones','valoraciones.IDValora=calificaciones.IDValora');
		$this->db->where($sql);	
		$prove=$this->db->get();
		$prove2=[];
		if($prove->num_rows()!=0){
			
			foreach ($prove->result() as $provedor) {
				if($provedor->IDEmpresa_Valoradora!=$idempresa){
					array_push($prove2,array("num"=>$provedor->IDEmpresa_Valoradora));
				}
			}
		}
		
		$clientes=array_merge($prove1,$prove2);
		$clientes = array_map('unserialize', array_unique(array_map('serialize', $clientes)));

		return $clientes;
	}
	//funcion para seleccionar los tipos de empresa
	public function TipoEmpresa(){
		$array=[];
		$this->db->select('Tipo');
		$prove=$this->db->get('tipoempresa');
		if($prove->num_rows()==0){
			return false;
		}else{
			return $prove->result(); 
		}
	}
	//funcion para seleccionar los numero de empleados
	public function NumerodeEmpleados(){
		$array=[];
		$this->db->select('Num');
		$prove=$this->db->get('numempleados');
		if($prove->num_rows()==0){
			return false;
		}else{
			return $prove->result(); 
		}
	}
	//funcion para seleccionar los nfacturacion anuales
	public function FaturacionAnuales(){
		$array=[];
		$this->db->select('FacAnual');
		$prove=$this->db->get('facanual');
		if($prove->num_rows()==0){
			return false;
		}else{
			return $prove->result(); 
		}

	}
	//funcion para obyener las marcas de una empresa
	public function ObenerMacarcas($IDEmpresa){
		$this->db->select('*');
		$this->db->from('marcas');
		$this->db->where("IDEmpresa='$IDEmpresa'");
		$prove=$this->db->get();
		if($prove->num_rows()==0){
			return false;
		}else{
			return $prove->result(); 
		}
	}
	//funcion para cambiar de logo
	public function RegistraLogo($logo,$IDEmpresa){
		$array=array("Logo"=>$logo);
		$this->db->where('IDEmpresa',$IDEmpresa);
		return $this->db->update('empresa', $array);
	}
	public function DatMarca($marca){
		$this->db->select('*');
		$this->db->from('marcas');
		$this->db->where("IDMarca='$marca'");
		$prove=$this->db->get();
		if($prove->num_rows()==0){
			return false;
		}else{
			return $prove->result(); 
		}
	}
	public function UpdateMarca($IDMarca,$Marca,$logo){
		$array=array("Marca"=>$Marca,"logo"=>$logo);
		$this->db->where('IDMarca',$IDMarca);
		return $this->db->update('marcas', $array);
	}
	//funcies para los telefonos de una empresa
	public function GetTel($IDEmpresa){
		$this->db->select('*');
		$this->db->from('telefonos');
		$this->db->where("IDEmpresa='$IDEmpresa'");
		$prove=$this->db->get();
		if($prove->num_rows()==0){
			return false;
		}else{
			return $prove->result(); 
		}
	}
	public function AddTel($numero,$tipo,$empresa,$IDUsuario){
		$array=array("Tipo_Numero"=>$tipo,"Numero"=>$numero,"IDEmpresa"=>$empresa,"IDUsuario"=>$IDUsuario);
		return $this->db->insert('telefonos', $array);
	}
	public function DelTel($tel){
		$this->db->where("IDTel='$tel'");
		return $this->db->delete('telefonos');
	}
	public function DatTel($tel){
		$this->db->select('*');
		$this->db->from('telefonos');
		$this->db->where("IDTel='$tel'");
		$prove=$this->db->get();
		if($prove->num_rows()==0){
			return false;
		}else{
			return $prove->result(); 
		}
	}
	public function ModiTel($numero,$tipo,$idtel){
		$array=array("Numero"=>$numero,"Tipo_Numero"=>$tipo);
		$this->db->where("IDTel='$idtel'");
		return $this->db->update('telefonos',$array);

	}
	public function ModDatosEmpresa($idempresa,$p,$cp,$c,$d,$e,$m){
		$array=array(
			"Sitio_Web"=>$p,
			"Codigo_Postal"=>$cp,
			"Colonia"=>$c,
			"Direc_Fiscal"=>$d,
			"Estado"=>$e,
			"Deleg_Mpo"=>$m);
		$this->db->where("IDEmpresa='$idempresa'");
		return $this->db->update('empresa',$array);

	}
	public function getServicios($empresa)
	{
		$this->db->select('*');
		$this->db->from('productos');
		$this->db->where("IDEmpresa='$empresa'");
		$prove=$this->db->get();
		if($prove->num_rows()==0){
			return false;
		}else{
			return $prove->result(); 
		}
	}
	public function AddProd($idempresa,$producto,$promocion,$descripcion,$foto){
		$data=array(
			"Producto"=>$producto,
			"Promocion"=>$promocion,
			"Descripcion"=>$descripcion,
			"Foto"=>$foto,
			"IDEmpresa"=>$idempresa
		);
		
		return $this->db->insert('productos',$data);
	}
	public function DelProd($prod){
		$this->db->where("IDProducto='$prod'");
		return $this->db->delete('productos');
	}
	public function DatProd($prod){
		$this->db->select('*');
		$this->db->from('productos');
		$this->db->where("IDProducto='$prod'");
		$prove=$this->db->get();
		if($prove->num_rows()==0){
			return false;
		}else{
			return $prove->result(); 
		}
	}
	public function UpdateProd($prod,$producto,$promocion,$descripcion,$foto){
		$data=array("Producto"=>$producto,"Promocion"=>$promocion,"Descripcion"=>$descripcion,"Foto"=>$foto);
		$this->db->where("IDProducto='$prod'");
		return $this->db->update('productos',$data);

	}
	public function GetCertificaciones($idempresa){
		$this->db->select('*');
		$this->db->from('normascalidad');
		$this->db->where("IDEmpresa='$idempresa'");
		$prove=$this->db->get();
		if($prove->num_rows()==0){
			return false;
		}else{
			return $prove->result(); 
		}
	}
	public function AddCert($IDEmpresa,$norma,$Fecha,$Calif,$Archivo){
		$data=array("Norma"=>$norma,"IDEmpresa"=>$IDEmpresa,"Fecha"=>$Fecha,"Calif"=>$Calif,"Archivo"=>$Archivo);
		return $this->db->insert("normascalidad",$data);
	}
	public function DelCert($cer){
		$this->db->where("IDNorma='$cer'");
		return $this->db->delete("normascalidad");
	}
	public function DatCert($cert){
		$this->db->select('*');
		$this->db->from('normascalidad');
		$this->db->where("IDNorma='$cert'");
		$prove=$this->db->get();
		if($prove->num_rows()==0){
			return false;
		}else{
			return $prove->result(); 
		}
	}
	public function UpdateCert($cert,$norma,$fecha,$calif,$archivo){
		$data=array(
			"Norma"=>$norma,
			"Fecha"=>$fecha,
			"Calif"=>$calif,
			"Archivo"=>$archivo
		);
		$this->db->where("IDNorma='$cert'");
		return $this->db->update("normascalidad",$data);
	}
	public function  Getasociaciones($IDEmpresa,$asocia){
		$this->db->select('*');
		$this->db->from('asociaciones');
		if($asocia!=""){
			$this->db->where("IDAsocia='$asocia'");
		}else{
			$this->db->where("IDEmpresa='$IDEmpresa'");
		}
		$prove=$this->db->get();
		if($prove->num_rows()==0){
			return false;
		}else{
			return $prove->result(); 
		}
	}
	public function AddAsocia($idempresa,$nombre,$web){
		$data=array("IDEmpresa"=>$idempresa,"Asociacion"=>$nombre,"Web"=>$web);
		return $this->db->insert("asociaciones",$data);
	}
	public function UpdateAsocia($asocia,$nombre,$web){
		$data=array("Asociacion"=>$nombre,"Web"=>$web);
		$this->db->where("IDAsocia='$asocia'");
		return $this->db->update("asociaciones",$data);
	}
	public function DeleteAsocia($asocia){
		$this->db->where("IDAsocia='$asocia'");
		return $this->db->delete("asociaciones");
	}
	public function datClientes($idempresa){
		$empresas=[];
		$clientes=$this->ObtenerClientes($idempresa);
		foreach ($clientes as $key) {
			if($key["num"]>0){


				$datos=$this->DatosEmpresa($key["num"]);
				$this->db->select('*');
				$this->db->from('vistas');
				$this->db->where("IDEMuestra='".$key["num"]."' and IDEmpresa='$idempresa'");
				$prove=$this->db->get();


				if($prove->num_rows()==0){


					array_push($empresas,array("Logo"=>$datos[0]->Logo,"num"=>$key["num"],"Razon_Social"=>$datos[0]->Razon_Social,"Nombre_Comer"=>$datos[0]->Nombre_Comer,"RFC"=>$datos[0]->RFC,"Visible"=>"Invisible"));
				}else{
					$T=$prove->result();
					if($T[0]->Status==0){
						array_push($empresas,array("Logo"=>$datos[0]->Logo,"num"=>$key["num"],"Razon_Social"=>$datos[0]->Razon_Social,"Nombre_Comer"=>$datos[0]->Nombre_Comer,"RFC"=>$datos[0]->RFC,"Visible"=>"Invisible"));
					} else{
						array_push($empresas,array("Logo"=>$datos[0]->Logo,"num"=>$key["num"],"Razon_Social"=>$datos[0]->Razon_Social,"Nombre_Comer"=>$datos[0]->Nombre_Comer,"RFC"=>$datos[0]->RFC,"Visible"=>"Visible"));
					}
				}
			}
		}
		return $empresas;
	}
	public function VisibleEmpre($IDEmpresa,$empresa,$tipo,$status){
		$this->db->select('*');
		$this->db->from('vistas');
		$this->db->where("IDEMuestra='".$empresa."' and IDEmpresa='$IDEmpresa' and Tipo='$tipo'");
		$prove=$this->db->get();
		if($prove->num_rows()==0){
			$array=array("IDEMuestra"=>$empresa,"IDEmpresa"=>$IDEmpresa,"Tipo"=>$tipo,"Status"=>$status);
			return $this->db->insert("vistas",$array);
		}else{
			$array=array("Status"=>$status);
			$this->db->where("IDEMuestra='".$empresa."'");
			return $this->db->update("vistas",$array);
		}
	}
	public function datProveedores($idempresa){
		$empresas=[];
		$clientes=$this->ObtenerProveedores($idempresa);
		foreach ($clientes as $key) {
			if($key["num"]>0){


				$datos=$this->DatosEmpresa($key["num"]);
				$this->db->select('*');
				$this->db->from('vistas');
				$this->db->where("IDEMuestra='".$key["num"]."' and IDEmpresa='$idempresa' and Tipo='Proveedor'");
				$prove=$this->db->get();
				if($prove->num_rows()==0){
					array_push($empresas,array("Logo"=>$datos[0]->Logo,"num"=>$key["num"],"Razon_Social"=>$datos[0]->Razon_Social,"Nombre_Comer"=>$datos[0]->Nombre_Comer,"RFC"=>$datos[0]->RFC,"Visible"=>"Invisible"));
				}else{
					$T=$prove->result();
					if($T[0]->Status==0){
						array_push($empresas,array("Logo"=>$datos[0]->Logo,"num"=>$key["num"],"Razon_Social"=>$datos[0]->Razon_Social,"Nombre_Comer"=>$datos[0]->Nombre_Comer,"RFC"=>$datos[0]->RFC,"Visible"=>"Invisible"));
					} else{
						array_push($empresas,array("Logo"=>$datos[0]->Logo,"num"=>$key["num"],"Razon_Social"=>$datos[0]->Razon_Social,"Nombre_Comer"=>$datos[0]->Nombre_Comer,"RFC"=>$datos[0]->RFC,"Visible"=>"Visible"));
					}
				}
			}
		}
		return $empresas;
	}
	public function Preempresa($rz,$rfc,$n1,$n2,$n3){
		$array=array("Razon_Social"=>$rz,"RFC"=>$rfc);
		$this->db->insert("empresa",$array);
		$select="RFC='$rfc'";
		$this->db->where($select);
		$resp=$this->db->get("empresa");
		$IDempresa= $resp->result()[0]->IDEmpresa; 
		$this->AddGiro($IDempresa,$n1,$n2,$n3);
		return $IDempresa;
	}
	public function  AddEmpresa($persona='PFAE',$rz,$nc,$rfc,$n1,$n2,$n3,$estado="",$tipocuenta='basic',$esta='3',$idioma='esl',$pais="MX"){
		
		$array=array("Razon_Social"=>$rz,"RFC"=>$rfc,"Persona"=>$persona,
			"Estado"=>$estado,
			"Nombre_Comer"=>$nc,
			"Esta"=>$esta,
			"TipoCuenta"=>$tipocuenta,
			"Idioma"=>$idioma,
			"Pais"=>$pais
		);
		$this->db->insert("empresa",$array);
		$select="RFC='$rfc'";
		$this->db->where($select);
		$resp=$this->db->get("empresa");
		$IDempresa= $resp->result()[0]->IDEmpresa; 
		$this->AddGiro($IDempresa,$n1,$n2,$n3);
		return $IDempresa;
	}
	public function verificaRFC($rfc){
		$select="RFC='$rfc'";
		$this->db->where($select);
		$resp=$this->db->get("empresa");
		if($resp->num_rows()==0){
			return true;
		}else{
			return false;
		}
		
	}
	public function verificarazon($rz){
		$select="Razon_Social='$rz'";
		$this->db->where($select);
		$resp=$this->db->get("empresa");
		if($resp->num_rows()==0){
			return true;
		}else{
			return false;
		}
	}
	public function RegPago($IDEmpresa,$TipoCuenta,$IDorden,$IDUsuario,$status,$monto,$Plan){
		$data=array(
			"IDEmpresa"=>$IDEmpresa,
			"tipo"=>$TipoCuenta,
			"fecha"=>date('Y-m-d'),
			"hora"=>date('H:m:s'),
			"IDUsuario"=>$IDUsuario,
			"Status_pag"=>$status,
			"monto"=>$monto,
			"plan"=>$Plan,
			"IDOrden"=>$IDorden
		);
		$this->db->insert("reg_pago",$data);

	}
	public function DiasPago($empresa){
		$array=array("DiasPago"=>date('d'));
		$this->db->where("IDEmpresa",$empresa);
		return $this->db->update("empresa",$array);
	}
	public function revCode($code){
		$sql="Codigo='$code' and Est='1' and Fechaexp>='".date('Y-m-d')."'";
		$this->db->where($sql);
		$resp=$this->db->get("codigospromo");
		if($resp->num_rows()==0){
			return false;
		}else{
			$array=array("Est"=>0);
			$this->db->where("Codigo",$code);
			$this->db->update("codigospromo",$array);
			return true;
		}
	}
	public function esclienteprove($empresa,$empresa2){
		$proveedores=$this->ObtenerProveedores($empresa);
		$clientes=$this->ObtenerClientes($empresa);
		$bande=0;
		foreach ($proveedores as $key) {
			if($empresa2==$key["num"]){
				$bande=1;
				break;
			}else{
				$bande=0;
			}
		}
		if($bande==0){
			foreach ($proveedores as $key) {
				if($empresa2==$key["num"]){
					$bande=1;
					break;
				}else{
					$bande=0;
				}
			}
		}

	
		if($bande==1){
			return true;
		}else{
			$dat=$this->DatosEmpresa($empresa);
			if($dat[0]->TipoCuenta!="Basic" || $dat[0]->TipoCuenta!=""){
				return false;
			}else{
				return true; 
			}
			
		}

	}
	public function addRelacion($IDEmpresaP,$IDEmpresaB,$Tipo){
		$tp=$this->db->select('*')->where("IDEmpresaB=$IDEmpresaB and IDEmpresaP=$IDEmpresaP and Tipo='".$Tipo."'")->get("tbrelacion");
		if($tp->num_rows()===0){
			$datos= array('IDEmpresaP' =>$IDEmpresaP,"IDEmpresaB"=>$IDEmpresaB,"Tipo"=>$Tipo);
			$this->db->insert("tbrelacion",$datos);
		}
		
	}
	/*
	funcion para obtener las empresas que me siguen
	*/
	public function getfollow($_IDEmpresa){
		//primero obtnengo los registros de las empresas que sigo
		$sql=$this->db->select("IDFollow,empresa.IDEmpresa,Razon_Social,Logo")->from("tb_follow_empresas")->join("empresa","tb_follow_empresas.IDEmpresaSeguida=empresa.IDEmpresa and Status='1'")->where("IDEmpresaA=$_IDEmpresa")->get();
		return ($sql->num_rows()===0)? false: $sql->result();
		//ahora teno que obtener la imagen
	}
	//funcion para quitar el seguimiento de una empresa
	public function Bajafolow($IDSeguida){
		$array=array("FechaFin"=>date("Y-m-d"),"Status"=>0);
		$this->db->where("IDFollow=$IDSeguida")->update("tb_follow_empresas",$array);
	}
	//funcion agregar una empresa en seguimiento
	public function addFollow($_Empresa,$_Empresa_seguida){
		$sql=$this->db->select("*")->where("IDEmpresaA=$_Empresa and IDEmpresaSeguida=$_Empresa_seguida" )->get("tb_follow_empresas");
		if($sql->num_rows()===0){
			$array=array("IDEmpresaA"=>$_Empresa,"IDEmpresaSeguida"=>$_Empresa_seguida,"Status"=>1);
			$sql=$this->db->insert("tb_follow_empresas",$array);
		}
		
	}

}
