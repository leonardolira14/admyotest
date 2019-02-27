<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');
class Model_Usuarios extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('selec_Titulo');
		$this->constant="vkq4suQesgv6FVvfcWgc2TRQCmAc80iE";
	}
	//funcion para obtner los datos del usuario
	public function DatosUsuario($IDUsuario){
		$sql="IDUsuario='$IDUsuario'";
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			return false;
		}else{
			return $respu->result()[0];
		}
	}
	public function DatosUsuarioCorreo($Correo){
		$sql="Correo='$Correo'";
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			return false;
		}else{
			return $respu->result()[0];
		}
	}
	public function usuarioMaster($IDEmpresa){
		$sql="IDEmpresa='$IDEmpresa' and Tipo_Usuario='Master'";
		$this->db->select('Correo');
		$this->db->from('usuarios');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()==0){
		$sql="IDEmpresa='$IDEmpresa' limit 1";
		$this->db->select('Correo');
		$this->db->from('usuarios');
		$this->db->where($sql);
		$respu=$this->db->get();
			return $respu->result()[0];	
		}else{
			return $respu->result()[0];
		}
	}
	public function AddUsuario($IDEmpresa,$nombre="",$apellidos="",$puesto="",$email,$c1="",$c2="",$visible=1,$tipous="Master")
	{
		if(!isset($tipous)){
			$tipous="";
		}
		if($c1!=$c2){
			return "Las contraseñas no son Iguales.";
		}else{
			$clave=md5($c2.$this->constant).":".$this->constant;
			$data=array(
				"Nombre"=>$nombre,
				"Apellidos"=>$apellidos,
				"Puesto"=>$puesto,
				"Correo"=>$email,
				"password"=>$clave,
				"visible"=>$visible,
				"Status"=>1,
				"Fecha_Alta"=>date('Y-m-d H:i:s'),
				"Token_Activar"=>md5(date('Y-m-d').$nombre.$clave),
				"IDEmpresa"=>$IDEmpresa,
				"Tipo_Usuario"=>$tipous
				);

			 $this->db->insert('usuarios', $data);
			return md5(date('Y-m-d').$nombre.$clave);
		}

	}
	public function Preusuario($correo,$IDEmpresa){
		$sql="Correo='$correo'";
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()!=0){
			$clave=md5('PGEG243%'.$this->constant).":".$this->constant;
			$array=array("Correo"=>$correo,"IDEmpresa"=>$IDEmpresa,"Fecha_Alta"=>date('Y-m-d H:i:s'),"Token_Activar"=>md5(date('Y-m-d').$IDEmpresa.$correo,$clave));
			$this->db->insert("usuarios",$array);
			return md5(date('Y-m-d').$IDEmpresa.$correo);
		}else{
			return false;
		}

	}
	public function restablecercontra($correo){
		$clave1="PGhrYKg32";
		$clave=md5($clave1.$this->constant).":".$this->constant;
		$a=array("password"=>$clave);
		$sql="Correo='$correo'";
		$this->db->where($sql);
		$this->db->update("usuarios",$a);
		return $clave1;
	}
	public function verificaCorreo($correo){
		$select="Correo='$correo'";
		$this->db->where($select);
		$resp=$this->db->get("usuarios");
		if($resp->num_rows()==0){
			return true;
		}else{
			return false;
		}
	}
	public function GetUsuarios($IDEmpresa,$atstus){
		$sql="IDEmpresa='$IDEmpresa' and Status='$atstus'";
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			return false;
		}else{
			return $respu->result();
		}
	}
	public function login($usuario,$clave){
		$clave=md5($clave.$this->constant).":".$this->constant;
		$sql="Correo='".$usuario."' AND password='".$clave."'";
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			return false;
		}else{
			return $respu;
		}

	}
	//agregar un acceso y mantener la sesion abierta;
	public function addAcceso($iduaurio){
		$token=md5($iduaurio.date('Y-m-d H:i:s'));
		$data=array(
			'IDUsuario'=>$iduaurio,'fecha'=>date('Y-m-d H:i:s'),'token'=>$token,'activo'=>1
			);
		$this->db->insert('sessionapk',$data);
		return $token;	
	}
	//para cerrar sesision
	public function cierraSession($token){
		$array=array(
			"activo"=>0
			);
		$this->db->where('token', $token["token"]);	
		$this->db->update('sessionapk', $array);
	}
	public function ModDatosUser($idusuario,$nombre,$apellidos,$puesto,$correo,$visible){
		$array=array(
			"Nombre"=>$nombre,
			"Apellidos"=>$apellidos,
			"Correo"=>$correo,
			"Puesto"=>$puesto,
			"visible"=>$visible
			);
		$this->db->where('IDUsuario',$idusuario);
		return $this->db->update('usuarios', $array);	
	}
	public function MoDMaster($user,$IDEmpresa){
		//quito todos los master
		$array=array(
			"Tipo_Usuario"=>""
			);
		$this->db->where('IDEmpresa',$IDEmpresa);
		 $this->db->update('usuarios', $array);	
		 $array=array(
			"Tipo_Usuario"=>"Master"
			);
		$this->db->where('IDUsuario',$user);
		return $this->db->update('usuarios', $array);	
	}
	public function DelUser($user){
		
			$array=array(
			"Status"=>0
			);
		$this->db->where('IDUsuario',$user);
		return $this->db->update('usuarios', $array);	
		
		
	}
	public function usuariosvisibles($IDEmpresa){
		$sql="IDEmpresa='$IDEmpresa' and Status='1' and Visible='1' ";
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			return false;
		}else{
			return $respu->result();
		}
	}	
	public function ModContra($idusuario,$contra,$c2,$c3){
		if($c2!=$c3){
			return "Las contraseñas deben ser iguales";
		}else{
			$clave=md5($contra.$this->constant).":".$this->constant;
			$this->db->select('*');
			$this->db->from('usuarios');
			$this->db->where("IDUsuario",$idusuario);
			$respu=$this->db->get();
			if($respu->num_rows()==0){
				return false;
			}else{
				$dats=$respu->result()[0];
				if($dats->password!=$clave){
					return "La contraseña actual no coincide";
				}else{
					$clave=md5($c3.$this->constant).":".$this->constant;
					$array=array("password"=>$clave);
					$this->db->where("IDUsuario",$idusuario);
					return $this->db->update('usuarios', $array);
				}
			}
		}

	}
	public function activartoken($token){
		$sql="Token_Activar='$token' and Status='0'";
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			return false;
		}else{
			$array=array("Status"=>1);
			$this->db->where("Token_Activar='$token'");
			$this->db->update("usuarios",$array);
			return true;
		}
	}	
}

