<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_Notificaciones extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
public function DatosEmpresa($IDEmpresa){
		$this->db->select('*');
		$this->db->from('empresa');
		$this->db->where('IDEmpresa',$IDEmpresa);	
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			 return false;
		}else{
			return $respu->result();
		}
		
	}
	//obtener las notificaciones de un empresa
	public function getNotific($IDEmpresa){
		$this->db->select('*');
		$this->db->from("Notificaciones");
		$this->db->where("IDEmpresa='$IDEmpresa' order by visto desc, fecha desc limit 25");
		$respu=$this->db->get();
		if($respu->num_rows()==0){
			return false;
		}else{
			$not=[];
			foreach ($respu->result() as $key) {

				if($key->Descript=="vista"){
						if($key->IDEmpresaN==0){
							$descrip="Han visitado su perfil";
							$logo="";
						}else{
							$dat=$this->DatosEmpresa($key->IDEmpresaN);
							$descrip="La empresa  <strong>".$dat[0]->Razon_Social." </strong> ha visitado su perfil.";
							$logo=$dat[0]->Logo;
						}
					$link="/perfil/visitas";
					
				}
				if($key->Descript==="Follow"){
					$dat=$this->DatosEmpresa($key->IDEmpresaN);
					$descrip="La empresa  <strong>".$dat[0]->Razon_Social." </strong> lo esta siguiendo.";
					$logo=$dat[0]->Logo;
					$link="/perfil/calificacionesrecibidasc";
				}
				if($key->Descript=="calificacionC"){
					$dat=$this->DatosEmpresa($key->IDEmpresaN);
					$descrip="La empresa  <strong>".$dat[0]->Razon_Social." </strong> lo ha calificado como Cliente.";
					$logo=$dat[0]->Logo;
					$link="/perfil/calificacionesrecibidasc";
				}
				if($key->Descript=="calificacionp"){
					$dat=$this->DatosEmpresa($key->IDEmpresaN);
					$descrip="La empresa  <strong>".$dat[0]->Razon_Social." </strong> lo ha calificacio como Proveedor";
					$logo=$dat[0]->Logo;
					$link="/perfil/calificacionesrecibidasp";
				}
				if($key->Descript=="calificacionrp"){
					$dat=$this->DatosEmpresa($key->IDEmpresaN);
					$descrip="La empresa  <strong>".$dat[0]->Razon_Social."</strong> lo ha recalificado como Proveedor";
					$logo=$dat[0]->Logo;
					$link="/perfil/calificacionesrecibidasp";
				}
				if($key->Descript=="calificacionrc"){
					$dat=$this->DatosEmpresa($key->IDEmpresaN);
					$descrip="La empresa <strong>".$dat[0]->Razon_Social."</strong> lo ha recalificado como Cliente";
					$logo=$dat[0]->Logo;
					$link="/perfil/calificacionesrecibidasc";
				}
				if($key->visto==1){
					$class="novista";
				}else{
					$class="vista";
				}
				array_push($not,array("Num"=>$key->id,"Fecha"=>$key->fecha,"leyenda"=>$descrip,"link"=>$link,"class"=>$class,"Logo"=>$logo));
			}
			return $not;	
		}
	}
	//funcion para el total de notificaciones
	public function NumNot($IDEmpresa){
		$sql="IDEmpresa='$IDEmpresa' and visto='1'";
		$this->db->select('*');
		$this->db->from("Notificaciones");
		$this->db->where($sql);
		$respu=$this->db->get();
		return $respu->num_rows();
	}
	//funcion para poner en vista una notificacion
	public function Vista($IDNotificacion){
		$array=array("visto"=>'0');
		$this->db->where("id='$IDNotificacion'");
		return $this->db->update('Notificaciones', $array);
	}
	public function AddNotificacion($IDEmpresa,$Descript,$IDEmpresaN){
		$array=array("IDEmpresa"=>$IDEmpresa,"Descript"=>$Descript,"visto"=>'1',"IDEmpresaN"=>$IDEmpresaN);
		return $this->db->insert('Notificaciones',$array);
	}
}