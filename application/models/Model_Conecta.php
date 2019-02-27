<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');
require_once("assets/php/conekta-php/lib/Conekta.php");
class Model_Conecta extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('selec_Titulo');
		$this->constant="vkq4suQesgv6FVvfcWgc2TRQCmAc80iE";
		$this->apikey="key_wgxJ3a87hr5zUHBcX1yLuA";
		$this->description="Plan Admyo";
		$this->currency="MXN";
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
	public function CdatosUsuario($usuario){
		$sql="IDUsuario='$usuario'";
		$this->db->select('Correo');
		$this->db->where($sql);
		$this->db->from('usuarios');
		$resp=$this->db->get();
		return $resp->result()[0]->Correo;
	}
	public function Targeta($nombre,$correo,$token,$plan,$precio){
		$precio=floatval($precio)*100;
		if($precio==99900){
			$plan="Plan-Estandar";
		}else if($precio==300000){
			$plan="Plan-Empresarial";
		}else if($precio==1000000){
			$plan="Plan-Coporativo";
		}
		try {
		 
		\Conekta\Conekta::setApiKey($this->apikey);
					$data=array(
				"name" => $nombre,
				"email" => $correo,
				"phone"=>"+52181818181",
				"payment_sources" => array(
				  array(
					  "type" => "card",
					  "token_id" => $token
				  )
				)//payment_sources
			  );
		 $response = \Conekta\Customer::create($data);  
		 $order=$response->createSubscription(
		 	array(
		 		'plan'=>$plan
		 	)
		 	);
		  return $order;
		} 
		catch (Exception $e) {
		  // Catch all exceptions including validation errors.
		 return $e->getMessage(); 
		}
	} 
	public function oxxo($amount,$nombre,$correo,$tel,$nombreplan){
		if(count($amount)<5)
				{
					$amount=floatval($amount)*100;
				}
		\Conekta\Conekta::setApiKey($this->apikey);
		$request=array(
			"line_items" => array(
			  array(
				"name" => $this->description." ".$nombreplan,
				"unit_price" =>$amount,
				"quantity" => 1
			  )//first line_item
			),
			 	"currency" => $this->currency,
				"customer_info" => array(
					  "name" => $nombre,
					  "email" => $correo,
					  "phone" => "+52".$tel
					),
					"charges" => array(
				array(
					"payment_method" => array(
							"type" => "oxxo_cash"
					)//payment_method
				) //first charge
			) //charges
		);
		try{
				$response = \Conekta\Order::create($request);  	
				return $response;
		}catch (Exception $e) {
		  	// Catch all exceptions including validation errors.
		  	return $e->getMessage(); 
		}
	}
	public function tranfer($amount, $nombre, $correo, $tel, $nombreplan){
		if(count($amount)<5)
				{
					$amount=floatval($amount)*100;
				}
		\Conekta\Conekta::setApiKey($this->apikey);
		$request=array(
				"line_items"=>array(
						array(
							"name" => $this->description." ".$nombreplan,
							"unit_price" =>$amount,
							"quantity" => 1
							)//unico item s pagar
					),
				"currency" => "MXN",
				"customer_info"=>array(
					"name" => $nombre,
			        "email" => $correo,
			        "phone" => $tel
					),
				"charges"=>array(
					array(
						"payment_method"=>array(
							"type"=> "spei"
							)
						)
					)
			);
		try {
			$response = \Conekta\Order::create($request);  	
				return $response;
		} catch (Exception $e) {
				return $e->getMessage(); 
		
		}
	}
	public function activarpago($ref){
		$sql="IDOrden='$ref'";
		$this->db->select('*');
		$this->db->where($sql);
		$resp=$this->db->get("reg_pago");
		//obtenfo los datos de la empresa
		$datosempresa=$this->DatosEmpresa($resp->resul()[0]->IDEmpresa);
		//obtenfo los datos del usuario que pago
		$datosusuario=$this->CdatosUsuario($resp->resul()[0]->IDUsurio);
		//ahora actualizo los dias de pago de la empresa
		$array=array("DiasPago"=>date('d'),"Esta"=>1);
		$this->db->where("IDEmpresa='".$resp->resul()[0]->IDEmpresa."'");
		$this->db->update("empresa",$array);
		ms_confirmpago($datosusuario,$datosempresa->Razon_Social,date('d'),date("m"),date("y"),$resp->resul()[0]->monto);
		
	}
}