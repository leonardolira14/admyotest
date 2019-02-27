<script>
	$(function(){
		$('[data-toggle="popover"]').popover({ trigger: "hover focus" });
		$('.datepicker').pickadate({
			 selectMonths: true,
  			 selectYears: true,
  			 format:'yyyy-mm-dd',
  			 firstDay: 1
		})
	})
$(document).on('click','div[llc="btnf"]',function(){
	obt={};
	$("#preeload").show();
	obt["Fecha1"]=$("input[llc='fecha1']").val();
	obt["Fecha2"]=$("input[llc='fecha2']").val();
	obt["Status"]=$("select[llc='status']").val();
	obt["cliente"]=$("select[llc='cliente']").val();
	obt["tipo"]="Proveedor";
	obt["forma"]="Recibida";
	console.log(obt);
	ayuda.senddata(obt,"/calificaciones/CalificacionesBruto",function(data){
		lin=JSON.parse(data);
		cade="";
		calificaciones=lin.calificaciones;
		for(key in calificaciones){
			cade+='<div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 centrar-vertical-contend" id="image-cal">';
			if(lin.calificaciones[key].Logo==""){
			cade+='<img src="../assets/img/foto-no-disponible.jpg" class="img-fluid" alt="'+lin.calificaciones[key].Razon_Social+'">';
			}else{
				cade+='<img src="../assets/img/logosEmpresas/'+lin.calificaciones[key].Logo+'" class="img-fluid" alt="'+lin.calificaciones[key].Razon_Social+'">';
			}
			if(lin.calificaciones[key].Status_Valora=="PendienteA"){
				status="Pendinete de Anulación";
				icon="fa-ban";
				leyenda="Pendiente de Anulación";
			}else if(lin.calificaciones[key].Status_Valora=="Pendiente"){
				status="Pendiente de Resolución";
				icon="fa-ban";
				leyenda="Pendiente de Resolución";
			}else{
				status=lin.calificaciones[key].Status_Valora;
				icon="fa-retweet";
				leyenda="Solicitar Cambio";
			}
			if(lin.calificaciones[key].Fecha_Resolu=="0000-00-00"){
				fec1="-";
			}else{
				fec1=lin.calificaciones[key].Fecha_Modif;
			}
			if(lin.calificaciones[key].Fecha_Modif=="0000-00-00"){
				fec="-";
			}else{
				fec=lin.calificaciones[key].Fecha_Modif;
			}
			cade+='</div><div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7" id="Texto-cal">';
			cade+='<div class="col-12">Estatus:<span class="spantb">'+status+'</span></div>';
			cade+='<div class="col-12">Fecha de Calificación:<span class="spantb"> '+lin.calificaciones[key].Fecha+'</span></div>';			
			cade+='<div class="col-12">Razón Socaial:<span class="minitit"> '+lin.calificaciones[key].Razon_Social+'</span></div>';
			cade+='<div class="col-12">Nombre Comercial:<span class="spantb"> '+lin.calificaciones[key].Nombre_comer+'</span></div>';
			cade+='<div class="col-12">Calificación:<span class="spantb"> '+lin.calificaciones[key].Calificacion+'</span></div>';
			cade+='<div class="col-12">Nombre de Usario que califica:<span class="spantb"> '+lin.calificaciones[key].Nombre+" "+lin.calificaciones[key].Apellidos+'</span></div>';
			cade+='<div class="col-12">Correo Electronico de Usario que califica:<span class="spantb"> '+lin.calificaciones[key].Correo+'</span></div>';
			cade+='<div class="col-12">Fecha de Petición:<span class="spantb">'+fec1+'</span></div>';
			cade+='<div class="col-12">Fecha de Modificación:<span class="spantb"> '+fec+'</span></div>';
			cade+='</div>';
			cade+='<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 centrar-vertical-contend" id="acciones-cal">';
			cade+='<div class="row">';
			
			cade+='<i class="fa fa-search bgblue-1 white iconos_botones" lld="invisble-empre" llc='+lin.calificaciones[key].IDValora+'" data-toggle="popover" title="" data-original-title="Ver Detalles" aria-describedby="popover618033"></i>';
			cade+='<i class="fa '+icon+' bgblue-1 white iconos_botones" lld="invisble-empre" llc='+lin.calificaciones[key].IDValora+'" data-toggle="popover" title="" data-original-title="'+leyenda+'" aria-describedby="popover618033"></i></div>';
			cade+='</div></div><div class="col-12 hr"></div>';

		}
		$("#abss").html(cade);
		$("#preeload").hide();
	})
	
})
$(document).on("click",'div[llc="solicita"]',function(){
	obt={};
	obt["tip"]=$("#mod-solicitud input:radio[name=radio-stacked]:checked").attr("llc");
	obt["num"]=$("#mod-solicitud input:radio[name=radio-stacked]:checked").val();
	ayuda.solicitud(obt);
})
$(document).on("click",'i.fa-retweet',function(){
	$tp=$(this).attr("llc");
	$("#mod-solicitud input").attr("value",$tp)
	$("#mod-solicitud").iziModal("open");
})
$(document).on("click",".fa-search",function(){
	ayuda.detallescuestion($(this).attr("llc"))
	
})
</script>

<div class="container margin-top-30">
	<div class="row">
		<div class=" col-12 titulos  text-center margin-bottom-30"><h4><strong>CALIFICACIONES RECIBIDAS DE PROVEEDORES</strong></h4></div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link" llc="/perfil/calificacionesrecibidasp">
			<div class="tab ">
				<i class="fa fa-line-chart ibtn bgblue-1 white"></i>
				TOTALES
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link" llc="/perfil/proveedores">
			<div class="tab">
				<i class="fa fa-users ibtn bgblue-1 white"></i>
				PROVEEDORES
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link" llc="/perfil/calificacionesP">
			<div class="tab current">
				<i class="fa fa-puzzle-piece ibtn bgblue-1 white"></i>
				CALIFICACIONES
			</div>
		</div>
	</div>
</div>
<div class="container margin-top-40">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
			<div id="" class="form-group">
				<label for="nc">Fecha Inicio</label>
				<input type="text" class="form-control datepicker" id="rfc" name="rfc" llc="fecha1"  placeholder="Fecha Inicio"> 
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
			<div id="" class="form-group">
				<label for="nc">Fecha Fin</label>
				<input  type="text" class="form-control datepicker " id="rfc" name="rfc" llc="fecha2"  placeholder="Fecha Fin"> 
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
			<div class="form-group">
				<label for="nc">Status</label>				
				<select llc="status" name="" class="form-control" id="">
						<option value="">Selecciona</option>
						<option value="Activa">Activas</option>
						<option value="Pendiente">Pendinete de Resolución</option>
						<option value="PendienteA">Pendinete de Anulacion</option>
				</select>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
			<div   class="form-group">
				<label for="nc">Proveedores</label>
				<select llc="cliente" name="" class="form-control" id="">
				<option value="">Selecciona</option>
				<?
				 foreach ($clientes as $key) {
				 	?>
				 	<option value="<?=$key["num"] ?>"><?=$key["Razon_Social"] ?></option>
				 	<?
				 }
				?>

				</select>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 align-center btn btn-primary margin-top-20" llc="btnf" lld="btn">
			Filtrar
		</div>
	</div>
</div>

<div class="container margin-top-30 margin-bottom-30 " >
	<div class="row tables ">
		<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>CALIFICACIONES </strong></h4></div>
		<div class="col-12 margin-top-10">
			<div class="row" id="abss">
				<?
					if($calificaciones!=false){
						foreach ($calificaciones as $key) {
							?>
							<div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 centrar-vertical-contend" id="image-cal">
								<? if($key->Logo==""){
										?>
										<img src="<?= base_URL()?>/assets/img/foto-no-disponible.jpg" class="img-fluid" alt="<?= $key->Razon_Social?>">
										<?

								}else{
									?>
									<img src="<?= base_URL()?>/assets/img/logosEmpresas/<?= $key->Logo?>" class="img-fluid" alt="<?= $key->Razon_Social?>">
									<?
								}
								?>
							</div>
							<div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7" id="Texto-cal">
								<? if($key->Status_Valora=="PendineteA"){
									$status="Pendinete de Anulación";
									$icon="fa-ban";
									$leyenda="Pendiente de Anulación";
								}else if($key->Status_Valora=="Pendiente"){
									$status="Pendiente de Resolución";
									$icon="fa-ban";
									$leyenda="Pendiente de Resolución";
								}else{
									$status=$key->Status_Valora;
									$icon="fa-retweet";
									$leyenda="Solicitar Cambio";
								}
								if($key->Fecha_Resolu=="0000-00-00"){
									$fec1="-";
								}else{
									$fec1=$key->Fecha_Modif;
								}
								if($key->Fecha_Modif=="0000-00-00"){
									$fec="-";
								}else{
									$fec=$key->Fecha_Modif;
								}

								?>
								<div class="col-12">Estatus:<span class="spantb"> <?= $status?></span></div>
								<div class="col-12">Fecha de Calificación:<span class="spantb"> <?= $key->Fecha?></span></div>			
								<div class="col-12">Razón Socaial:<span class="minitit"> <?= $key->Razon_Social?></span></div>
								<div class="col-12">Nombre Comercial:<span class="spantb"> <?= $key->Nombre_comer?></span></div>
								<div class="col-12">Calificación:<span class="spantb"> <?= $key->Calificacion?></span></div>
								<div class="col-12">Nombre de Usario que califica:<span class="spantb"> <?= $key->Nombre." ".$key->Apellidos?></span></div>
								<div class="col-12">Correo Electronico de Usario que califica:<span class="spantb"> <?= $key->Correo?></span></div>

								<div class="col-12">Fecha de Petición:<span class="spantb"> <?= $fec1?></span></div>
								<div class="col-12">Fecha de Modificación:<span class="spantb"> <?= $fec?></span></div>
							</div>
							<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 centrar-vertical-contend" id="acciones-cal">
								<div class="row">
									
									<i class="fa fa-search bgblue-1 white iconos_botones" lld="invisble-empre" llc="<?= $key->IDValora?>" data-toggle="popover" title="" data-original-title="Ver Detalles" aria-describedby="popover618033"></i>

									<i class="fa <?= $icon;  ?> bgblue-1 white iconos_botones" lld="invisble-empre" llc="<?= $key->IDValora?>" data-toggle="popover" title="" data-original-title="<?= $leyenda;  ?>" aria-describedby="popover618033"></i>
								</div>
							</div>
							<div class="col-12 hr"></div>
							<?
						}
					}
						?>
				
			</div>
		</div>
	</div>
</div>
		<div class="izimodal" id="mod-solicitud" data-title="Solicitud de Cambio">
		<div class="container margin-top-30 margin-bottom-20">
			<div class="row">
				<dic class="col-12 text-center">
					<h4><span class="minitit">SELECCIONE EL MOTIVO DE LA SOLICITUD</span></h4>
				</dic>
				<dic class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 align-center" >
					<form>
						<div class="row">
							<div class="col-12 margin-top-20">
								<label class="custom-control custom-radio mb-2 mr-sm-2 mb-sm-2">
									<input llc="sinrelacion" id="radioStacked2" name="radio-stacked" type="radio" class="custom-control-input" required>
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description"><h6><strong>Sin relación comercial</strong></h6></span>
								</label>
							</div>
							<div class="col-12 col-12 margin-top-20 margin-bottom-20">
								<label class="custom-control custom-radio mb-2 mr-sm-2 mb-sm-2">
									<input llc="cambio" id="radioStacked2" name="radio-stacked" type="radio" class="custom-control-input" required>
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description"><h6><strong>Cambio de valoración Cliente/Proveedor</strong></h6></span>
								</label>
							</div>
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 align-center btn btn-primary margin-top-20" llc="solicita" lld="">
								Solicitar
							</div>
						</div>
					</form>
				</dic>
			</div>
		</div>
		</div>
<div class="izimodal" id="mod-detalles" data-fullscreen="true" data-title="Cuestionario">
	<div class="row tables">
		
	</div>
</div>