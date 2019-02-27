<?
/**
 * Modelo para recalcular el riesgo de una empresa
 */
class ClassName extends AnotherClass
{
	
	function __construct()
	{
		$this->load->database();
	}
	//funcion para regenerar la tabla de riesgo
	public function updateRiesgo($_IDEmpresa,$_lugar_viejo,$_lugar_nuevo){
		//primero reviso si esa empresa ya tiene registros anteriores
		$sql=$this->db->select("*")->where()->get();
	}
}