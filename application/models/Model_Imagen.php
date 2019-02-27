<?
/**
 * funion para obter la parte de imagen
 */
class Model_Imagen extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('selec_Titulo');
	}
	//funcion para obtener los clientes
	public function ObtenerClientes($idempresa){
		$clientes1=[];
		//esta relacion es para obtener en la tabla tbrelacion las que esten como IDEmpresaPque es la principal
		$sql=$this->db->select('*')->where("IDEmpresaP='$idempresa' and Tipo='cliente'")->get("tbrelacion");
		if($sql->num_rows()!=0){	
			foreach ($sql->result() as $provedor) {
				array_push($clientes1,array("num"=>$provedor->IDEmpresaB));
			}
		}
		//ahora obtengo las que estan en la IDEmpresaB pero como cliente
		$sql=$this->db->select('*')->where("IDEmpresaB='$idempresa' and Tipo='proveedor'")->get("tbrelacion");
		$clientes2=[];
		if($sql->num_rows()!=0){
			foreach ($sql->result() as $provedor) {
				array_push($clientes2,array("num"=>$provedor->IDEmpresaP));
			}
		}
		$clientes=array_merge($clientes1,$clientes2);
		$clientes = array_map('unserialize', array_unique(array_map('serialize', $clientes)));
		return $clientes;
	}
	//funcion para obtener los proveedores
	public function ObtenerProveedores($idempresa){
		$proveedores1=[];
		//esta relacion es para obtener en la tabla tbrelacion las que esten como IDEmpresaPque es la principal
		$sql=$this->db->select('*')->where("IDEmpresaP='$idempresa' and Tipo='proveedor'")->get("tbrelacion");
		if($sql->num_rows()!=0){	
			foreach ($sql->result() as $provedor) {
				array_push($proveedores1,array("num"=>$provedor->IDEmpresaB));
			}
		}
		//ahora obtengo las que estan en la IDEmpresaB pero como cliente
		$sql=$this->db->select('*')->where("IDEmpresaB='$idempresa' and Tipo='cliente'")->get("tbrelacion");
		$proveedores2=[];
		if($sql->num_rows()!=0){
			foreach ($sql->result() as $provedor) {
				array_push($proveedores2,array("num"=>$provedor->IDEmpresaP));
			}
		}
		$proveedores=array_merge($proveedores1,$proveedores2);
		$proveedores = array_map('unserialize', array_unique(array_map('serialize', $proveedores)));
		return $proveedores;
	}
	//funcion para obtenre las imagen de como cliente basado en las calificaciones de proveedores
	public function imgcliente($IDEmpresa,$tipo_fecha,$tipo_persona,$resumen=FALSE){
		$fechas=docemeces();
		$fechas2=docemecespasados();
		$_media_calidad_actual=0;
		$_media_calidad_pasado=0;
		$_media_cumplimiento_actual=0;
		$_media_cumplimiento_pasado=0;
		$_media_oferta_actual=0;
		$_media_oferta_pasado=0;
		$_media_general_actual=0;
		$_media_general_pasada=0;
		$_Numero_de_calificaciones_actual=0;
		$_Numero_de_calificaciones_pasado=0;
		
		if($tipo_fecha==="A")
		{
			$_fecha_inicio_actual=$fechas[0]."-".date("d");
			$_fecha_fin_actual=$fechas[12]."-".date("d");
			$_fecha_inicio_pasada=$fechas2[0]."-".date("d");
			$_fecha_fin_pasada=$fechas2[12]."-".date("d");
			$fecha_evolucion_inicio=explode("-",$fechas[0]);
			$fecha_evolucion_fin=explode("-",$fechas[12]);
			$fechas_rango=$fechas;
		}else{
			$_fecha_inicio_actual=$fechas[11]."-".date("d");
			$_fecha_fin_actual=$fechas[12]."-".date("d");
			$_fecha_inicio_pasada=$fechas[9]."-".date("d");
			$_fecha_fin_pasada=$fechas[10]."-".date("d");
			$fecha_evolucion_inicio=explode("-",$fechas[11]);
			$fecha_evolucion_fin=explode("-",$fechas[12]);
			$inicio=date("d");
			$para=31;
			$mes=$fecha_evolucion_inicio[1];
			$anio=$fecha_evolucion_inicio[0];
		}
		/*
		///
		//primero necesito numero de calificaciones 
		//esto lo calculo con la suma de todas las calificaciones de la tabla de imagen ya sea de cliente o proveedor
		*/

		if($tipo_persona==="Cliente"){
			$tb='tbimagen_cliente';
			$linoferta="";
		}else{
			$tb='tbimagen_proveedor';
			$linoferta=",round(sum(P_Obt_Oferta)/sum(P_Pos_Oferta)*10,2) as mediaoferta";
		}
			//traigo los registros de la tabla de imagen_cliente
			$promedios_actuales=$this->db->select("round(sum(P_Ob_Generales)/sum(P_Pos_Generales)*10,2) as mediageneral,round(sum(P_Obt_Calidad)/sum(P_Pos_Calidad)*10,2) mediacalidad,round(sum(P_Obt_Cumplimiento)/sum(P_Pos_Cumplimiento)*10,2) as mediacumplimiento,sum(N_Calificaciones)as numcalif".$linoferta)->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio_actual' and  '$_fecha_fin_actual'")->get($tb);
			$promedios_pasadas=$this->db->select("round(sum(P_Ob_Generales)/sum(P_Pos_Generales)*10,2) as mediageneral,round(sum(P_Obt_Calidad)/sum(P_Pos_Calidad)*10,2) mediacalidad,round(sum(P_Obt_Cumplimiento)/sum(P_Pos_Cumplimiento)*10,2) as mediacumplimiento,sum(N_Calificaciones)as numcalif".$linoferta)->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio_pasada' and  '$_fecha_fin_pasada'")->get($tb);		
	
		if($promedios_pasadas->result()[0]->mediageneral!==NULL)
			{
				$_media_general_pasada=$promedios_pasadas->result()[0]->mediageneral;
				$_media_calidad_pasado=$promedios_pasadas->result()[0]->mediacalidad;
				$_media_cumplimiento_pasado=$promedios_pasadas->result()[0]->mediacumplimiento;
				$_Numero_de_calificaciones_pasado=$promedios_pasadas->result()[0]->numcalif;
				if($tipo_persona==="Proveedor"){
					$_media_oferta_pasado=$promedios_pasadas->result()[0]->mediaoferta;
				}
				
			}
			if($promedios_actuales->result()[0]->mediageneral!==NULL)
			{
				$_media_general_actual=$promedios_actuales->result()[0]->mediageneral;
				$_media_calidad_actual=$promedios_actuales->result()[0]->mediacalidad;	
				$_media_cumplimiento_actual=$promedios_actuales->result()[0]->mediacumplimiento;
				$_Numero_de_calificaciones_actual=$promedios_actuales->result()[0]->numcalif;
				if($tipo_persona==="Proveedor"){
					$_media_oferta_actual=$promedios_actuales->result()[0]->mediaoferta;		
				}
				
			}
			$_data["aumentop"]=_increment($_media_general_actual,$_media_general_pasada,"imagen");
			$_data["Calidad"]=array("media"=>$_media_calidad_actual,"incremento"=> _increment($_media_calidad_actual,$_media_calidad_pasado,"imagen"));
			$_data["Cumplimiento"]=array("media"=>$_media_cumplimiento_actual,"incremento"=>_increment($_media_cumplimiento_actual,$_media_cumplimiento_pasado,"imagen"));
			if($tipo_persona==="Proveedor"){
			$_data["Oferta"]=array("media"=>$_media_cumplimiento_actual,"incremento"=>_increment($_media_oferta_actual,$_media_oferta_pasado,"imagen"));
			}
			$_data["totalCalif"]=$_Numero_de_calificaciones_actual;
			$_data["Media"]=$_media_general_actual;
			$_data["aumento"]=_increment($_Numero_de_calificaciones_actual,$_Numero_de_calificaciones_pasado,"imagen");
		if($resumen===FALSE){
			if($tipo_fecha==="A"){
				$evolucion=[["Dias","No de calificaciones"]];
				$_evolucion_media=[["Dias","Media de calificaciones"]];
				foreach ($fechas_rango as $fechacom) {
					$datos=explode("-", $fechacom);
					$cuantas=$this->Total_calificaciones($fechacom."-01",$fechacom."-31",$IDEmpresa,$tipo_persona);
					array_push($evolucion,[da_mes($datos[1])."-".$datos[0],(int)$cuantas]);
					$cuantas=$this->Media_calificaciones($fechacom."-01",$fechacom."-31",$IDEmpresa,$tipo_persona);
					array_push($_evolucion_media,[da_mes($datos[1])."-".$datos[0],(float)$cuantas]);
				}			
			}
			
				if($tipo_fecha==="M"){
					$evolucion=[["Meses","No de calificaciones"]];
					$_evolucion_media=[["Meses","Media de calificaciones"]];				
					while($inicio<=$para){
						if($inicio===31){
							$para=date("d");
							$inicio=1;
							$mes=$fecha_evolucion_fin[1];
							$anio=$fecha_evolucion_fin[0];
							$fechacom=$anio."-".$mes;
							$cuantas=$this->Total_calificaciones($fechacom."-".$inicio,$fechacom."-".$inicio,$IDEmpresa,$tipo_persona);
							array_push($evolucion,[$inicio."-".da_mes($mes),(int)$cuantas]);
							$cuantas=$this->Media_calificaciones($fechacom."-".$inicio,$fechacom."-".$inicio,$IDEmpresa,$tipo_persona);
							array_push($_evolucion_media,[$inicio."-".da_mes($mes),(float)$cuantas]);
						}else{
							$fechacom=$anio."-".$mes;
							$cuantas=$this->Total_calificaciones($fechacom."-".$inicio,$fechacom."-".$inicio,$IDEmpresa,$tipo_persona);

							array_push($evolucion,[$inicio."-".da_mes($mes),(int)$cuantas]);

							$cuantas=$this->Media_calificaciones($fechacom."-".$inicio,$fechacom."-".$inicio,$IDEmpresa,$tipo_persona);
							array_push($_evolucion_media,[$inicio."-".da_mes($mes),(float)$cuantas]);
							$inicio++;
						}
					}
				}
				$_data["serievolucion"]=$evolucion;
				$_data["evolucionmedia"]=$_evolucion_media;	
			}
			
						
			return $_data;
	}
	public function Total_calificaciones($_fecha_inicio,$_fecha_fin,$IDEmpresa,$forma){
		if($forma==="Cliente"){
			$sql=$this->db->select('sum(N_Calificaciones) as Numcalificaciones')->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio' and  '$_fecha_fin'")->get('tbimagen_cliente');
		}else{
			$sql=$this->db->select('sum(N_Calificaciones) as Numcalificaciones')->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio' and  '$_fecha_fin'")->get('tbimagen_proveedor');
		}
		
		if($sql->num_rows()===0){
			return 0;
		}else{
			return $sql->result()[0]->Numcalificaciones;
		}
	}
	public function Media_calificaciones($_fecha_inicio,$_fecha_fin,$IDEmpresa,$forma){
		if($forma==="Cliente"){
			$sql=$this->db->select('round(sum(P_Ob_Generales)/sum(P_Pos_Generales)*10,2) as mediageneral')->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio' and  '$_fecha_fin'")->get('tbimagen_cliente');
		}else{
			$sql=$this->db->select('round(sum(P_Ob_Generales)/sum(P_Pos_Generales)*10,2) as mediageneral')->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio' and  '$_fecha_fin'")->get('tbimagen_proveedor');
		}
		
		if($sql->num_rows()===0){
			return 0;
		}else{
			return $sql->result()[0]->mediageneral;
		}
	}
	/*
	resumen de imagen para las empresas seguidas
	*/
	public function resumenImagen($IDEmpresa,$_tipo_usuario,$forma)
	{
		$fechas=docemeces();
		$fechas2=docemecespasados();
		$_media_calidad_actual=0;
		$_media_calidad_pasado=0;
		$_media_cumplimiento_actual=0;
		$_media_cumplimiento_pasado=0;
		$_media_oferta_actual=0;
		$_media_oferta_pasado=0;
		$_media_general_actual=0;
		$_media_general_pasada=0;
		$_Numero_de_calificaciones_actual=0;
		$_Numero_de_calificaciones_pasado=0;
		$_tipo_personas=["Cliente","Proveedor"];
			$_fecha_inicio_actual=$fechas[0]."-".date("d");
			$_fecha_fin_actual=$fechas[12]."-".date("d");
			$_fecha_inicio_pasada=$fechas2[0]."-".date("d");
			$_fecha_fin_pasada=$fechas2[12]."-".date("d");
			$fecha_evolucion_inicio=explode("-",$fechas[0]);
			$fecha_evolucion_fin=explode("-",$fechas[12]);
			$fechas_rango=$fechas;
		foreach ($_tipo_personas as $tipo_persona) {
			
		
		if($tipo_persona==="Cliente"){
			$tb='tbimagen_cliente';
			$linoferta="";
		}else{

			$tb='tbimagen_proveedor';
			$linoferta=",round(sum(P_Obt_Oferta)/sum(P_Pos_Oferta)*10,2) as mediaoferta";
			
		}

		//traigo los registros de la tabla de imagen_cliente
			$promedios_actuales=$this->db->select("round(sum(P_Ob_Generales)/sum(P_Pos_Generales)*10,2) as mediageneral,round(sum(P_Obt_Calidad)/sum(P_Pos_Calidad)*10,2) mediacalidad,round(sum(P_Obt_Cumplimiento)/sum(P_Pos_Cumplimiento)*10,2) as mediacumplimiento,sum(N_Calificaciones)as numcalif".$linoferta)->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio_actual' and  '$_fecha_fin_actual'")->get($tb);
			$promedios_pasadas=$this->db->select("round(sum(P_Ob_Generales)/sum(P_Pos_Generales)*10,2) as mediageneral,round(sum(P_Obt_Calidad)/sum(P_Pos_Calidad)*10,2) mediacalidad,round(sum(P_Obt_Cumplimiento)/sum(P_Pos_Cumplimiento)*10,2) as mediacumplimiento,sum(N_Calificaciones)as numcalif".$linoferta)->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio_pasada' and  '$_fecha_fin_pasada'")->get($tb);
		
		if($promedios_pasadas->result()[0]->mediageneral!==NULL)
			{
				$_media_general_pasada=$promedios_pasadas->result()[0]->mediageneral;
				$_media_calidad_pasado=$promedios_pasadas->result()[0]->mediacalidad;
				$_media_cumplimiento_pasado=$promedios_pasadas->result()[0]->mediacumplimiento;
				$_Numero_de_calificaciones_pasado=$promedios_pasadas->result()[0]->numcalif;
				if($tipo_persona==="Proveedor"){
					$_media_oferta_pasado=$promedios_pasadas->result()[0]->mediaoferta;
				}
				
			}
			if($promedios_actuales->result()[0]->mediageneral!==NULL)
			{
				$_media_general_actual=$promedios_actuales->result()[0]->mediageneral;
				$_media_calidad_actual=$promedios_actuales->result()[0]->mediacalidad;	
				$_media_cumplimiento_actual=$promedios_actuales->result()[0]->mediacumplimiento;
				$_Numero_de_calificaciones_actual=$promedios_actuales->result()[0]->numcalif;
				if($tipo_persona==="Proveedor"){
					$_media_oferta_actual=$promedios_actuales->result()[0]->mediaoferta;		
				}
				
			}
			$_data["aumentop_".$tipo_persona]=_increment($_media_general_actual,$_media_general_pasada,"imagen");
			$_data["Calidad_".$tipo_persona]=array("media"=>$_media_calidad_actual,"incremento"=> _increment($_media_calidad_actual,$_media_calidad_pasado,"imagen"));
			$_data["Cumplimiento_".$tipo_persona]=array("media"=>$_media_cumplimiento_actual,"incremento"=>_increment($_media_cumplimiento_actual,$_media_cumplimiento_pasado,"imagen"));
			if($tipo_persona==="Proveedor"){
			$_data["Oferta_".$tipo_persona]=array("media"=>$_media_cumplimiento_actual,"incremento"=>_increment($_media_oferta_actual,$_media_oferta_pasado,"imagen"));
			}
			$_data["totalCalif_".$tipo_persona]=$_Numero_de_calificaciones_actual;
			$_data["Media_".$tipo_persona]=$_media_general_actual;
			$_data["aumento_".$tipo_persona]=_increment($_Numero_de_calificaciones_actual,$_Numero_de_calificaciones_pasado,"imagen");

		}

		return $_data;
		
	}
	public function promediorang($IDEmpresa,$date1,$date2,$categoria,$tipo,$status){
		$listasid=[];
		//obtengo los ide las calificaciones segun los criterios
		$sql=$this->db->select('IDCalificacion')->where("IDEmpresaReceptor='$IDEmpresa' and Status='$status' and Emitidopara='$tipo' and DATE(FechaRealizada) between '$date1'  and '$date2'")->get('tbcalificaciones');
		$listnomencla=$this->db->select($categoria)->where("Tipo='$tipo'")->get("tbconfigcuestionarios");
		$numenclaturas=explode(",",$listnomencla->result()[0]->$categoria);

		foreach ($numenclaturas as $nomenclatura) {
			if($nomenclatura!=""){
				$datos=$this->DatsPreguntas($nomenclatura);
				array_push($listasid,$datos->IDPregunta);
			}
		}
		if($sql->num_rows===0){
			return false;
		}else{
			$puntosposibles=0;
			$puntosobtenidos=0;
				//ahora obtengo las nomenclaturas del listado dependiendo que es

			foreach ($sql->result() as $calificacion)
			{
				foreach ($listasid as $idpregunta) 
				{
					$sqll=$this->db->select('PuntosObtenidos,PuntosPosibles')->where("IDPregunta='$idpregunta' and IDCalificacion='".$calificacion->IDCalificacion."'")->get("tbdetallescalificaciones");
					if($sqll->num_rows()==0){
						$puntosposibles=$puntosposibles+0;
						$puntosobtenidos=$puntosobtenidos+0;
					}else{
						$puntosposibles=$puntosposibles+$sqll->result()[0]->PuntosPosibles;
						$puntosobtenidos=$puntosobtenidos+$sqll->result()[0]->PuntosObtenidos;
					}

				}
			}
			if($puntosobtenidos===0 || $puntosposibles===0){
				$promedio=0;
			}else{
				$promedio=round(($puntosobtenidos/$puntosposibles)*10,2);
			}
			
		}
		return $promedio;
		
	}
	//fucion que obtiene el numero de calificaiones totales en un rango de fechas
	public function totcalifd($anio,$mes,$dia,$IDEmpresa,$forma){
		$sql=$this->db->select('count(*) as total')->where("IDEmpresaReceptor='$IDEmpresa' and Emitidopara='$forma' and DATE(FechaRealizada) between '$anio-$mes-$dia' and '$anio-$mes-$dia' group by IDEmpresaReceptor")->get('tbcalificaciones');
		if($sql->num_rows()===0){
			$calificaciones=0;
		}else{
			$calificaciones=$sql->result()[0]->total;
		}
		return $calificaciones;
	}
	//fucion que obtiene el numero de calificaiones totales en un rango de fechas
	public function mediacalificacionesd($anio,$mes,$dia,$IDEmpresa,$forma){
		$sql=$this->db->select('sum(PuntosObtenidos) as puntosobtenido,sum(PuntosPosibles)as puntosposibles')->from('tbcalificaciones')->join('tbdetallescalificaciones','tbdetallescalificaciones.IDCalificacion=tbcalificaciones.IDCalificacion')->where("IDEmpresaReceptor='$IDEmpresa' and Emitidopara='$forma' and DATE(FechaRealizada) between '$anio-$mes-$dia' and '$anio-$mes-$dia'")->get();
		if($sql->num_rows()===0){
			$calificaciones=0;
		}else if($sql->result()[0]->puntosobtenido===NULL && $sql->result()[0]->puntosposibles===NULL){
			$calificaciones=0;
		}else{
			$calificaciones=_media_puntos($sql->result()[0]->puntosobtenido,$sql->result()[0]->puntosposibles);
		}
		return $calificaciones;
	}
	//fucion que obtiene el numero de calificaiones totales en un rango de fechas
	public function totcalif($anio,$mes,$IDEmpresa,$forma){
		$sql=$this->db->select('count(*) as total')->where("IDEmpresaReceptor='$IDEmpresa' and date(FechaRealizada) between '".$anio."-".$mes."-01' and '".$anio."-".$mes."-31' and Status='Activa' and Emitidopara='$forma' group by IDEmpresaReceptor")->get('tbcalificaciones');
		if($sql->num_rows()===0){
			$calificaciones=0;
		}else{
			$calificaciones=$sql->result()[0]->total;
		}
		return $calificaciones;
	}
	public function mediacalif($anio,$mes,$IDEmpresa,$forma){
		$sql=$this->db->select('sum(PuntosObtenidos) as puntosobtenido,sum(PuntosPosibles)as puntosposibles')->from('tbcalificaciones')->join('tbdetallescalificaciones','tbdetallescalificaciones.IDCalificacion=tbcalificaciones.IDCalificacion')->where("IDEmpresaReceptor='$IDEmpresa' and date(FechaRealizada) between '".$anio."-".$mes."-01' and '".$anio."-".$mes."-31' and Status='Activa' and Emitidopara='$forma'")->get();
		if($sql->num_rows()===0){
			$calificaciones=0;
		}else if($sql->result()[0]->puntosobtenido===NULL && $sql->result()[0]->puntosposibles===NULL){
			$calificaciones=0;
		}else{
			$calificaciones=_media_puntos($sql->result()[0]->puntosobtenido,$sql->result()[0]->puntosposibles);
		}
		return $calificaciones;
	}
	//funcion para loa datoa de pregunta por ID
	public function datos_preguntaID($IDPregunta)
	{
		$sql=$this->db->select("*")->where("IDPregunta='$IDPregunta'")->get("preguntas_val");
		return $sql->result()[0];
	}
	//funcion para obtener el listado de ID de preguntas segun sea el tipo
	public function listpreguntas($categoria,$tipo,$giro){
		if($categoria!=""){
			$listasid=[];
			$listnomencla=$this->db->select($categoria)->where("Tipo='".$tipo."' and IDNivel2='$giro'")->get("tbconfigcuestionarios");			
			
			return $listnomencla->row();
		}
		
	}
	//funcion para obtener los detalles de las preguntas
	public function DatsPreguntas($Nomclatura){
		$sql=$this->db->select('*')->where("Nomenclatura='$Nomclatura'")->get("preguntas_val");
		return $sql->result()[0];

	}
	//obtener el promedio y el aumento en una categoria sea cumplimento calidad oferta o recomendaciones
	public function Promedioauemntocategoria($categoria,$IDEmpresa,$Tipo,$Forma){
		$matrispreguntas=[];
		$puntosposibles=0;
		$puntosobtenidos=0;
		$puntosposibles2=0;
		$puntosobtenidos2=0;
		$promedio1=0;
		$promedio2=0;
			//obtengo las nomenclaturas de las preguntas dependiendo la categoria
		$sql=$this->db->select($categoria)->where("Tipo='$Tipo'")->get('tbconfigcuestionarios');
		$nomenclaturas=explode(",",$sql->result()[0]->$categoria);
			//convierto las nomenclaturas en id
		foreach ($nomenclaturas as $pregunta) {
			$preg=$this->DatsPreguntas($pregunta);
			array_push($matrispreguntas,$preg->IDPregunta);
		}
			//ahora busco esa pregunta en la base de datos dependiendo si es por año o por mes
			

		$fechas=docemeces();
		$fechas2=docemecespasados();
		if($Forma==="A"){
			
				//ahora tengo ya que tengo los ids de las preguntas solo de detealles de preguntas obtengo los puntos posibles y los puntos obtendios los sumo y los divido entre 10 para obtener la media de una categoria;
			//obtengo los id de las valoraciones que he tendio por empresa
			$sql=$this->db->select('IDCalificacion')->where("Status='Activa' and Emitidopara='$Tipo' and IDEmpresaReceptor='$IDEmpresa' and DATE(FechaRealizada) between '".$fechas[0]."-01' and '".$fechas[12]."-31'")->get('tbcalificaciones');

			if($sql->num_rows()!=0){
				foreach ($sql->result() as $valoracion) {
					foreach ($matrispreguntas as $pregunta) {
						//12 meses actuales
						$sql=$this->db->select("sum(PuntosPosibles) as puntosposibles,sum(PuntosObtenidos) as puntosobtenidos")->where("DATE(FechaRealiza) between '".$fechas[0]."-01' and '".$fechas[12]."-31' and IDPregunta='$pregunta' and IDCalificacion='$valoracion->IDCalificacion'")->get('tbdetallescalificaciones');

						if($sql->num_rows()!=0){
							$puntosposibles=$puntosposibles+(int)$sql->result()[0]->puntosposibles;
							$puntosobtenidos=$puntosobtenidos+(int)$sql->result()[0]->puntosobtenidos;
						}
					}
				}
			}
			
			$sql=$this->db->select('IDCalificacion')->where("Status='Activa' and Emitidopara='$Tipo' and IDEmpresaReceptor='$IDEmpresa' and DATE(FechaRealizada) between '".$fechas2[0]."-01' and '".$fechas2[12]."-31'")->get('tbcalificaciones');
			if($sql->num_rows()!=0){
				foreach ($sql->result() as $valoracion) {
					foreach ($matrispreguntas as $pregunta) {
						//doce meses pasados
						$sql=$this->db->select("sum(PuntosPosibles) as puntosposibles,sum(PuntosObtenidos) as puntosobtenidos")->where("DATE(FechaRealiza) between '".$fechas2[0]."-01' and '".$fechas2[12]."-31' and IDPregunta='$pregunta' and IDCalificacion='$valoracion->IDCalificacion'")->get('tbdetallescalificaciones');
						if($sql->num_rows()!=0){
							$puntosposibles2=$puntosposibles2+(int)$sql->result()[0]->puntosposibles;
							$puntosobtenidos2=$puntosobtenidos2+(int)$sql->result()[0]->puntosobtenidos;
						}
					}
				}
			}
			
			$_promedio_actual=_media_puntos($puntosobtenidos,$puntosposibles);
			$_promedio_pasado=_media_puntos($puntosobtenidos2,$puntosposibles2);
			
			 	
		}else if($Forma==="M"){
			//mes actual
			$sql=$this->db->select('IDCalificacion')->where("Status='Activa' and Emitidopara='$Tipo' and IDEmpresaReceptor='$IDEmpresa' and DATE(FechaRealizada) between '".date("Y")."-".(date("m")-1)."-".date("d")."' and '".date("Y-m-d")."'")->get('tbcalificaciones');
			
			if($sql->num_rows()!=0){
				foreach ($sql->row() as $valoracion) {
					foreach ($matrispreguntas as $pregunta) {
						$sql=$this->db->select("sum(PuntosPosibles) as puntosposibles,sum(PuntosObtenidos) as puntosobtenidos")->where("DATE(FechaRealiza) between '".date("Y")."-".(date("m")-1)."-".date("d")."' and '".date("Y-m-d")."' and IDPregunta='$pregunta' and IDCalificacion='$valoracion'")->get('tbdetallescalificaciones');
						

						if($sql->num_rows()!=0){
							$puntosposibles=$puntosposibles+(int)$sql->result()[0]->puntosposibles;
							$puntosobtenidos=$puntosobtenidos+(int)$sql->result()[0]->puntosobtenidos;
						}

					}
				}
			}
			$_promedio_actual=_media_puntos($puntosobtenidos,$puntosposibles);
			$puntosposibles=0;
			$puntosobtenidos=0;
			//mes anterior
			$sql=$this->db->select('IDCalificacion')->where("Status='Activa' and Emitidopara='$Tipo' and IDEmpresaReceptor='$IDEmpresa' and DATE(FechaRealizada) between '".$fechas[11]."-01' and '".$fechas[11]."-".date("d")."'")->get('tbcalificaciones');
			if($sql->num_rows()!=0){
				foreach ($sql->result() as $valoracion) {
					foreach ($matrispreguntas as $pregunta) {
						$sql=$this->db->select("sum(PuntosPosibles) as puntosposibles,sum(PuntosObtenidos) as puntosobtenidos")->where("DATE(FechaRealiza) between '".$fechas[11]."-01' and '".$fechas[11]."-".date("d")."' and IDPregunta='$pregunta' and IDCalificacion='$valoracion->IDCalificacion'")->get('tbdetallescalificaciones');
						if($sql->num_rows()!=0){
							$puntosposibles=$puntosposibles+(int)$sql->result()[0]->puntosposibles;
							$puntosobtenidos=$puntosobtenidos+(int)$sql->result()[0]->puntosobtenidos;
						}
					}
				}
			}
			$_promedio_pasado=_media_puntos($puntosobtenidos,$puntosposibles,"imagen");	
			}

			$data["incremento"]=_increment($_promedio_actual["num"],$_promedio_pasado["num"],"imagen");			
			$data["media"]=$_promedio_actual;
			return $data;
	}
	public function detalleImagen($forma,$IDEmpresa,$tipo)
	{
		$tipo_fecha=$tipo;
		$tipo_persona=$forma;
		$fechas=docemeces();
		$fechas2=docemecespasados();
		$_media_calidad_actual=0;
		$_media_calidad_pasado=0;
		$_media_cumplimiento_actual=0;
		$_media_cumplimiento_pasado=0;
		$_media_oferta_actual=0;
		$_media_oferta_pasado=0;
		$_media_general_actual=0;
		$_media_general_pasada=0;
		$_Numero_de_calificaciones_actual=0;
		$_Numero_de_calificaciones_pasado=0;
		
		if($tipo_fecha==="A")
		{
			$_fecha_inicio_actual=$fechas[0]."-".date("d");
			$_fecha_fin_actual=$fechas[12]."-".date("d");
			$_fecha_inicio_pasada=$fechas2[0]."-".date("d");
			$_fecha_fin_pasada=$fechas2[12]."-".date("d");
			$fecha_evolucion_inicio=explode("-",$fechas[0]);
			$fecha_evolucion_fin=explode("-",$fechas[12]);
			$fechas_rango=$fechas;
		}else{
			$_fecha_inicio_actual=$fechas[11]."-".date("d");
			$_fecha_fin_actual=$fechas[12]."-".date("d");
			$_fecha_inicio_pasada=$fechas[9]."-".date("d");
			$_fecha_fin_pasada=$fechas[10]."-".date("d");
			$fecha_evolucion_inicio=explode("-",$fechas[11]);
			$fecha_evolucion_fin=explode("-",$fechas[12]);
			$inicio=date("d");
			$para=31;
			$mes=$fecha_evolucion_inicio[1];
			$anio=$fecha_evolucion_inicio[0];
		}
		/*
		ahora obtengo los giros que tiene asignados y muestro el principal
		*/
		$sql=$this->db->select('*')->where("IDEmpresa='$IDEmpresa' and Principal='1'")->get("giroempresa");
		$_Giro_Principal=$sql->row()->IDGiro2;
		
		/*
		///
		//primero necesito numero de calificaciones 
		//esto lo calculo con la suma de todas las calificaciones de la tabla de imagen ya sea de cliente o proveedor
		*/
		if($tipo_persona==="Cliente"){
			$listapreguntascalidad=$this->listpreguntas("Calidad",$forma,$_Giro_Principal);
			$listapreguntascumplimento=$this->listpreguntas("Cumplimiento",$forma,$_Giro_Principal);
			$listacp=$this->ObtenerClientes($IDEmpresa);
			//traigo los registros de la tabla de imagen_cliente
			$promedios_actuales=$this->db->select("round(sum(P_Ob_Generales)/sum(P_Pos_Generales)*10,2) as mediageneral,round(sum(P_Obt_Calidad)/sum(P_Pos_Calidad)*10,2) mediacalidad,round(sum(P_Obt_Cumplimiento)/sum(P_Pos_Cumplimiento)*10,2) as mediacumplimiento,sum(N_Calificaciones)as numcalif")->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio_actual' and  '$_fecha_fin_actual'")->get('tbimagen_cliente');
			$promedios_pasadas=$this->db->select("round(sum(P_Ob_Generales)/sum(P_Pos_Generales)*10,2) as mediageneral,round(sum(P_Obt_Calidad)/sum(P_Pos_Calidad)*10,2) mediacalidad,round(sum(P_Obt_Cumplimiento)/sum(P_Pos_Cumplimiento)*10,2) as mediacumplimiento,sum(N_Calificaciones)as numcalif")->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio_pasada' and  '$_fecha_fin_pasada'")->get('tbimagen_cliente');
			
			
			
		}else{
			$listacp=$this->ObtenerProveedores($IDEmpresa);
			$listapreguntascalidad=$this->listpreguntas("Calidad",$forma,$_Giro_Principal);
			$listapreguntascumplimento=$this->listpreguntas("Cumplimiento",$forma,$_Giro_Principal);
			$listapreguntasoferta=$this->listpreguntas("Oferta",$forma,$_Giro_Principal);
			$promedios_actuales=$this->db->select("round(sum(P_Ob_Generales)/sum(P_Pos_Generales)*10,2) as mediageneral,round(sum(P_Obt_Calidad)/sum(P_Pos_Calidad)*10,2) mediacalidad,round(sum(P_Obt_Cumplimiento)/sum(P_Pos_Cumplimiento)*10,2) as mediacumplimiento,sum(N_Calificaciones)as numcalif")->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio_actual' and  '$_fecha_fin_actual'")->get('tbimagen_proveedor');
			$promedios_pasadas=$this->db->select("round(sum(P_Ob_Generales)/sum(P_Pos_Generales)*10,2) as mediageneral,round(sum(P_Obt_Calidad)/sum(P_Pos_Calidad)*10,2) mediacalidad,round(sum(P_Obt_Cumplimiento)/sum(P_Pos_Cumplimiento)*10,2) as mediacumplimiento,round(sum(P_Obt_Oferta)/sum(P_Pos_Oferta)*10,2) as mediaoferta,sum(N_Calificaciones)as numcalif")->where("IDEmpresa='$IDEmpresa' and date(Fecha) between '$_fecha_inicio_pasada' and  '$_fecha_fin_pasada'")->get('tbimagen_proveedor');
		}
		
		if($promedios_pasadas->result()[0]->mediageneral!==NULL)
			{
				$_media_general_pasada=$promedios_pasadas->result()[0]->mediageneral;
				$_media_calidad_pasado=$promedios_pasadas->result()[0]->mediacalidad;
				$_media_cumplimiento_pasado=$promedios_pasadas->result()[0]->mediacumplimiento;
				$_Numero_de_calificaciones_pasado=$promedios_pasadas->result()[0]->numcalif;
				if($tipo_persona==="Proveedor"){
					$_media_oferta_pasado=$promedios_pasadas->result()[0]->mediaoferta;
				}
				
			}
			if($promedios_actuales->result()[0]->mediageneral!==NULL)
			{
				$_media_general_actual=$promedios_actuales->result()[0]->mediageneral;
				$_media_calidad_actual=$promedios_actuales->result()[0]->mediacalidad;	
				$_media_cumplimiento_actual=$promedios_actuales->result()[0]->mediacumplimiento;
				$_Numero_de_calificaciones_actual=$promedios_actuales->result()[0]->numcalif;
				if($tipo_persona==="Proveedor"){
					$_media_oferta_actual=$promedios_actuales->result()[0]->mediaoferta;		
				}
				
			}
			$_data["Calidad"]=array("media"=>$_media_calidad_actual,"incremento"=> _increment($_media_calidad_actual,$_media_calidad_pasado,"imagen"));
			$_data["Cumplimiento"]=array("media"=>$_media_cumplimiento_actual,"incremento"=>_increment($_media_cumplimiento_actual,$_media_cumplimiento_pasado,"imagen"));
			if($tipo_persona==="Proveedor"){
			$_data["Oferta"]=array("media"=>$_media_cumplimiento_actual,"incremento"=>_increment($_media_oferta_actual,$_media_oferta_pasado,"imagen"));
			}

		if($tipo==="A"){
			$fech1="'".$fechas[0]."-01' and '".$fechas[12]."-31'";
			$fech2="'".$fechas2[0]."-01' and '".$fechas2[12]."-31'";
		}else{
			$fech1="'".$fechas[11]."-".date('d')."' and '".$fechas[12]."-".date('d')."'";
			$fech2="'".$fechas[9]."-".date('d')."' and '".$fechas[10]."-".date('d')."'";
		}

		$listadatosp=[];
		
		$listapreguntascalidad=explode(",",$listapreguntascalidad->Calidad);
		foreach ($listapreguntascalidad as $preguntacalidad) { 
			//primero vamos con calidad
			$totalprimero=0;
			$totalsegundo=0;
			$numeroclientesevaluados=0;
			$datospregunta=$this->datos_preguntaID($preguntacalidad);
			if($datospregunta->Forma!="AB" || $datospregunta->Forma!="OP"){
				$total=$this->cuantaspreguntascorrectas($IDEmpresa,$fech1,$forma,$preguntacalidad,$datospregunta->Condicion,$datospregunta->Forma);
				$totalprimero=$totalprimero+$total;
				$totalsegundo=$totalsegundo+$this->cuantaspreguntascorrectas($IDEmpresa,$fech2,$forma,$preguntacalidad,$datospregunta->Condicion,$datospregunta->Forma);
				
				array_push($listadatosp,array("Pregunta"=>$datospregunta->Pregunta,"Totalcalificaciones"=>$totalprimero,"respuesta"=>$datospregunta->Condicion,"serie"=>[[" ","Actual","Pasado" ],[" ",$totalprimero,$totalsegundo]]));
			}		
		}
		$_data["listCalidad"]=$listadatosp;
		$listadatosp=[];
		
		$listapreguntascumplimento=explode(",",$listapreguntascumplimento->Cumplimiento);
		foreach ($listapreguntascumplimento as $preguntacalidad) { 
			//primero vamos con calidad
			$totalprimero=0;
			$totalsegundo=0;
			$numeroclientesevaluados=0;
			$datospregunta=$this->datos_preguntaID($preguntacalidad);
			if($datospregunta->Forma!="AB" || $datospregunta->Forma!="OP"){
				$total=$this->cuantaspreguntascorrectas($IDEmpresa,$fech1,$forma,$preguntacalidad,$datospregunta->Condicion,$datospregunta->Forma);
				$totalprimero=$totalprimero+$total;
				$totalsegundo=$totalsegundo+$this->cuantaspreguntascorrectas($IDEmpresa,$fech2,$forma,$preguntacalidad,$datospregunta->Condicion,$datospregunta->Forma);
				array_push($listadatosp,array("Pregunta"=>$datospregunta->Pregunta,"Totalcalificaciones"=>$totalprimero,"respuesta"=>$datospregunta->Condicion,"serie"=>[[" ","Actual","Pasado"],[" ",$totalprimero,$totalsegundo]]));
			}		
		}
		$_data["listCumplimiento"]=$listadatosp;
		//vemos si esta la de oferta si no esta nos pasamos derecho
		if(isset($listapreguntasoferta))
		{
			$listadatosp=[];
			$listapreguntasoferta=explode(",",$listapreguntasoferta->Oferta);
			foreach ($listapreguntasoferta as $preguntacalidad) 
			{ 
				//primero vamos con calidad
				$totalprimero=0;
				$totalsegundo=0;
				$numeroclientesevaluados=0;
				$datospregunta=$this->datos_preguntaID($preguntacalidad);
				if($datospregunta->Forma!="AB" || $datospregunta->Forma!="OP")
				{
					$total=$this->cuantaspreguntascorrectas($IDEmpresa,$fech1,$forma,$preguntacalidad,$datospregunta->Condicion,$datospregunta->Forma);
					$totalprimero=$totalprimero+$total;
					$totalsegundo=$totalsegundo+$this->cuantaspreguntascorrectas($IDEmpresa,$fech2,$forma,$preguntacalidad,$datospregunta->Condicion,$datospregunta->Forma);
					array_push($listadatosp,array("Pregunta"=>$datospregunta->Pregunta,"Totalcalificaciones"=>$totalprimero,"respuesta"=>$datospregunta->Condicion,"serie"=>[[" ","Actual","Pasado"],[" ",$totalprimero,$totalsegundo]]));
				}		
			}
			$_data["listOferta"]=$listadatosp;
		}

		return $_data;

	}
	//funcion para saber cuantos contestaron esa pregunta la respuesta correcta
	public function cuantaspreguntascorrectas($IDEmpresa,$rangofecha,$para,$IDPregunta,$respuesta,$tipopregunta){
		$tipopregunta=trim($tipopregunta);
		if($tipopregunta==="Dias" || $tipopregunta==="Horas" || $tipopregunta==="Num" ){
			$sql=$this->db->select("avg(Respuesta) as total")->from("tbcalificaciones")->join("tbdetallescalificaciones","tbdetallescalificaciones.IDCalificacion=tbcalificaciones.IDCalificacion")->where("tbcalificaciones.IDEmpresaReceptor=$IDEmpresa and date(FechaRealizada) between ".$rangofecha." and Emitidopara='$para' and IDPregunta='$IDPregunta' and Respuesta='$respuesta'")->get();

		}else if($tipopregunta==="Si/No/NA" || $tipopregunta==="Si/No" || $tipopregunta==="Si/No/NA/NS" || $tipopregunta="Si/No/No Aplica" || $tipopregunta==="No tiene/NA/NS/Si/No"){
			$sql=$this->db->select("count(*) as total")->from("tbcalificaciones")->join("tbdetallescalificaciones","tbdetallescalificaciones.IDCalificacion=tbcalificaciones.IDCalificacion")->where("tbcalificaciones.IDEmpresaReceptor=$IDEmpresa and date(FechaRealizada) between ".$rangofecha." and Emitidopara='$para' and IDPregunta='$IDPregunta' and Respuesta='$respuesta'")->get();
		}
		return $sql->result()[0]->total;
	}

}