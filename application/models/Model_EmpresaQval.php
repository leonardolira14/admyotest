<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_EmpresaQval extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->constante="FpgH456Gtdgh43i349gjsjf%ttt";
		
	}
	public function AddEmpresa($persona,$rz,$nc,$rfc,$estado,$esta,$idioma,$pais,$IDEmpresa){
		$db_qval=$this->load->database('qval', TRUE); 
		$array=array("Razon_Social"=>$rz,"RFC"=>$rfc,"Persona"=>$persona,
			"Estado"=>$estado,
			"Nombre_Comercial"=>$nc,
			"Esta"=>$esta,
			"Idioma"=>$idioma,
			"Pais"=>$pais,
			"IDAdmyo"=>$IDEmpresa
		);
		$db_qval->insert("empresas",$array);
		$select="RFC='$rfc'";
		$resp=$db_qval->where($select)->get("empresas");
		$IDempresa= $resp->result()[0]->IDEmpresa; 
		return $IDempresa;
	}
	public function AddUsuarioQval($idempresa,$nombre,$apellidos,$correo,$clave,$Est){
		$clave=md5($clave.$this->constante);
		$db_qval=$this->load->database('qval', TRUE); 
		$array=array('IDEmpresa' => $idempresa,'Nombre'=>$nombre,"Apellidos"=>$apellidos,'Correo'=>$correo,"Usuario"=>$correo,"Clave"=>$clave,"Est"=>$Est,"IDConfig"=>'1',"funciones"=>'["1","1","1","1","1","1","1","1","1"]',"Puesto"=>"Master");
		$db_qval->insert("usuario",$array);
		//ahora agrego un perfil para que pueda acceder a qval 
		$array=array("IDEmpresa"=>$idempresa,"Nombre"=>"Grupo Default","Tipo"=>"I","Status"=>"1",);
		$db_qval->insert("grupos",$array);
	}
}