<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Buscar extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('selec_Titulo');
	}
public function DatosEmpresa($IDEmpresa){
		$this->db->select('*');
		$this->db->from('empresa');
		$this->db->where('IDEmpresa',$IDEmpresa);	
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			 return false;
		}else{
			return $respu->result()[0];
		}
		
	}
	public function Buscar($palabra){
		//primero busco la por la razon social
		$encon=[];
		$sql="Razon_Social Like '%$palabra%'";
		$this->db->select('IDEmpresa');
		$this->db->from('empresa');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()!=0){
			foreach ($respu->result() as $key) {
				array_push($encon,array("num"=>$key->IDEmpresa));
			}
		}
		//primero busco la por la nombre comerciial
		$encon2=[];
		$sql="Nombre_Comer Like '%$palabra%'";
		$this->db->select('IDEmpresa');
		$this->db->from('empresa');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()!=0){
			foreach ($respu->result() as $key) {
				array_push($encon,array("num"=>$key->IDEmpresa));
			}
		}
		//primero busco la por el RFC
		$encon3=[];
		$sql="RFC Like '%$palabra%'";
		$this->db->select('IDEmpresa');
		$this->db->from('empresa');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()!=0){
			foreach ($respu->result() as $key) {
				array_push($encon,array("num"=>$key->IDEmpresa));
			}
		}
		//primero busco la por el producto
		$encon4=[];
		$sql="Producto Like '%$palabra%'";
		$this->db->select('IDEmpresa');
		$this->db->from('productos');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()!=0){
			foreach ($respu->result() as $key) {
				if($key->IDEmpresa!=1037){
					array_push($encon,array("num"=>$key->IDEmpresa));
				}
				
			}
		}
		//primero busco la por el marca
		
		$sql="Marca Like '%$palabra%'";
		$this->db->select('IDEmpresa');
		$this->db->from('marcas');
		$this->db->where($sql);
		$respu=$this->db->get();
		if($respu->num_rows()!=0){
			foreach ($respu->result() as $key) {
				if($key->IDEmpresa!=1037){
					array_push($encon,array("num"=>$key->IDEmpresa));
				}
			}
		}
		//ya que termine con las buscuedas uno todos los arrays
		//$resulttados=array_merge($encon,$encon2,$encon3,$encon4,$encon5);
		$resulttados = array_map('unserialize', array_unique(array_map('serialize', $encon)));
		$encon5=[];
		$fechas=docemeces();
		$_fecha_inicio_actual=$fechas[0]."-".date("d");
		$_fecha_fin_actual=$fechas[12]."-".date("d");
			

		foreach ($resulttados as $key) {
			if($key["num"]!=="0"){
				
				$dat=$this->DatosEmpresa($key["num"]);
				$media_cliente=$this->obtener_imagen($_fecha_inicio_actual,$_fecha_fin_actual,$key["num"],"Cliente");
				$media_proveedor=$this->obtener_imagen($_fecha_inicio_actual,$_fecha_fin_actual,$key["num"],"Proveedor");
				($media_cliente===0)? $media_cliente=0:$media_cliente=$media_cliente->mediageneral;
				($media_proveedor===0)?$media_proveedor=0:$media_proveedor=$media_proveedor->mediageneral;
				
				array_push($encon5,array("Media_proveedor"=>$media_proveedor,"Media_cliente"=>$media_cliente,"num"=>$key["num"],"Razon_Social"=>$dat->Razon_Social,"Logo"=>$dat->Logo,"Nombre_Comer"=>$dat->Nombre_Comer,"RFC"=>$dat->RFC));
			}
				
		}
		return $encon5;

	}
	public function obtener_imagen($_fecha_inicio_actual,$_fecha_fin_actual,$IDEmpresa,$tipo_persona)
	{
		if($tipo_persona==="Cliente"){
			$tb='tbimagen_cliente';
			$linoferta="";
		}else{
			$tb='tbimagen_proveedor';
			$linoferta=",round(sum(P_Obt_Oferta)/sum(P_Pos_Oferta)*10,2) as mediaoferta";
		}
		$promedios_actuales=$this->db->select("round(sum(P_Ob_Generales)/sum(P_Pos_Generales)*10,2) as mediageneral,round(sum(P_Obt_Calidad)/sum(P_Pos_Calidad)*10,2) mediacalidad,round(sum(P_Obt_Cumplimiento)/sum(P_Pos_Cumplimiento)*10,2) as mediacumplimiento,sum(N_Calificaciones)as numcalif".$linoferta)->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio_actual' and  '$_fecha_fin_actual'")->get($tb);
		if($promedios_actuales->row()->mediageneral===NULL){
			return 0;
		}else{
			return $promedios_actuales->row();
		}
		
	}
}