<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Registro extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database(); 
	}
	public function revisarfc($rfc){
			$respuesta=$this->db->where("RFC='$rfc'")->get('empresa');
		if($respuesta->num_rows()>0){
			return $respuesta;}
		else{return falses;}
	}

	public function getEmpresas(){
		$respuesta=$this->db->get('empresa');
		if($respuesta->num_rows()>0){
			return $respuesta;
		}else{ return $respuesta;}
	}
	public function AllPais(){
		$respuesta=$this->db->query("SELECT * FROM pais ORDER BY paisnombre  ASC");
		if($respuesta->num_rows()>0){
			return $respuesta->result();
		}else{ return false;}
	}
	public function getAllEstados(){
		$respuesta=$this->db->get('estado');
		if($respuesta->num_rows()>0){
			return $respuesta;
		}else{ return $respuesta;}

	}
	public function GetEntidad(){
		$respuesta=$this->db->get('entidad');
		if($respuesta->num_rows()===0){
			return false;
		}else{ return $respuesta->result();}

	}
	public function GetEstadoss($pais){
		$respuesta=$this->db->where("ubicacionpaisid='$pais'")->get('estado');
		if($respuesta->num_rows()>0){
			return $respuesta->result();
		}else{  return false;}

	}
	public function AllIdiomas(){
		$respuesta=$this->db->query("SELECT * FROM idiomas ");
		if($respuesta->num_rows()>0){
			return $respuesta->result();
		}else{ return false;}
	}
	public function getSector(){
		$respuesta=$this->db->get('gironivel1');
		if($respuesta->num_rows()>0){
			return $respuesta;
		}else{ return $respuesta;}
	}
	public function getSubSector($idsector){
		$this->db->where('IDNivel1',$idsector);
		$respuesta=$this->db->get('gironivel2');
		if($respuesta->num_rows()>0){
			return $respuesta;
		}else{ return false;}
	}
	public function getRama($idsector){
		$this->db->where('IDNivel2',$idsector);
		$respuesta=$this->db->get('gironivel3');
		if($respuesta->num_rows()>0){
			return $respuesta;
		}else{ return $respuesta;}
	}
	
}

