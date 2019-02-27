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
	obt["tipo"]="Cliente";
	obt["forma"]="Realizada";
	ayuda.senddata(obt,"<?=base_URL()?>/calificaciones/CalificacionesBruto",function(data){
		lin=JSON.parse(data);
		console.log(lin);
		cade="";
		calificaciones=lin.calificaciones;
		for(key in calificaciones){
			cade+='<div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 centrar-vertical-contend" id="image-cal">';
			if(lin.calificaciones[key].Logo==""){
			cade+='<img src="<?=base_URL()?>/assets/img/foto-no-disponible.jpg" class="img-fluid" alt="'+lin.calificaciones[key].Razon_Social+'">';
			}else{
				cade+='<img src="<?=base_URL()?>/assets/img/logosEmpresas/'+lin.calificaciones[key].Logo+'" class="img-fluid" alt="'+lin.calificaciones[key].Razon_Social+'">';
			}
			if(lin.calificaciones[key].Status=="PendienteA"){
				status="Pendinete de Anulación";
				icon="fa-ban";
				leyenda="Pendiente de Anulación";
				accion='<i class="fa '+icon+' bgblue-1 white iconos_botones" lld="invisble-empre" llc='+lin.calificaciones[key].IDValora+'" data-toggle="popover" title="" data-original-title="'+leyenda+'" aria-describedby="popover618033"></i></div>';
			}else if(lin.calificaciones[key].Status=="Pendiente"){
				status="Pendiente de Resolución";
				icon="fa-ban";
				leyenda="Pendiente de Resolución";
				accion='<i class="fa '+icon+' bgblue-1 white iconos_botones" lld="invisble-empre" llc='+lin.calificaciones[key].IDValora+'" data-toggle="popover" title="" data-original-title="'+leyenda+'" aria-describedby="popover618033"></i></div>';
			}else{
				status="Activa";
				accion="";
			}
			fec1=lin.calificaciones[key].FechaPuesta;
			fec=lin.calificaciones[key].FechaModificacion;
			
			cade+='</div><div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7" id="Texto-cal">';
			cade+='<div class="col-12">Estatus:<span class="spantb">'+status+'</span></div>';
			cade+='<div class="col-12">Fecha de Calificación:<span class="spantb"> '+lin.calificaciones[key].Fecha+'</span></div>';			
			cade+='<div class="col-12">Razón Socaial:<span class="minitit"> '+lin.calificaciones[key].Razon_Social+'</span></div>';
			cade+='<div class="col-12">Nombre Comercial:<span class="spantb"> '+lin.calificaciones[key].Nombre_comer+'</span></div>';
			cade+='<div class="col-12">Nombre de Usuario que califica:<span class="spantb"> '+lin.calificaciones[key].UsuarioEmisor+'</span></div>';
			cade+='<div class="col-12">Correo Electronico de Usuario que califica:<span class="spantb"> '+lin.calificaciones[key].CorreoEmisor+'</span></div>';
			cade+='<div class="col-12">Nombre de Usuario a quien calificá:<span class="spantb"> '+lin.calificaciones[key].UsuarioReceptor+'</span></div>';
			cade+='<div class="col-12">Correo Electronico de Usuario a quien calificá:<span class="spantb"> '+lin.calificaciones[key].CorreoReceptor+'</span></div>';
			cade+='<div class="col-12">Fecha de Petición:<span class="spantb">'+fec1+'</span></div>';
			cade+='<div class="col-12">Fecha de Modificación:<span class="spantb"> '+fec+'</span></div>';
			cade+='</div>';
			cade+='<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 centrar-vertical-contend" id="acciones-cal">';
			cade+='<div class="row">';
			cade+='<i class="fa fa-eye bgblue-1 white iconos_botones link" llc="/PerfilBuscado/perfil/'+lin.calificaciones[key].IDValora+'" data-toggle="popover" title="Visitar Perfil" data-original-title="" aria-describedby="popover618033"></i>';
			cade+='<i class="fa fa-search bgblue-1 white iconos_botones" lld="invisble-empre" llc='+lin.calificaciones[key].IDValora+'" data-toggle="popover" title="" data-original-title="Ver Detalles" aria-describedby="popover618033"></i>';
			cade+=accion;
			cade+='</div></div><div class="col-12 hr"></div>';

		}
		$("#abss").html(cade);
		$("#preeload").hide();
	})
	
})
$(document).on("click",".fa-search",function(){
	ayuda.detallescuestion($(this).attr("llc"))
	
})
$(document).on('click','i[lld="modificar"]',function(){
	ayuda.modificarcal($(this).attr("llc"));
	
})
</script>
<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text">
			CALIFICACIONES REALIZADAS A CLIENTES
		</div>
		<div class="banner-resumen"></div>
	</div>
</div>
<div class="container margin-top-30 menu-tab">
	<div class="row ">
		<a href="<?= base_URL() ?>resumencliente" class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link">
			<div class="tab ">
				<i class="fa fa-line-chart ibtn bgblue-1 white"></i>
					RESUMEN
			</div>
		</a>
		<a href="<?= base_URL() ?>listaclientes" class="col-12 col-md-4 col-lg-4 col-xl-4  text-center link menu-tab">
				<div class="tab">
					<i class="fa fa-users ibtn bgblue-1 white"></i>
					 MIS CLIENTES
				</div>
		</a>
		<a href="<?= base_URL() ?>realizadasclientes" class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link menu-tab">
			<div class="tab current">
				<i class="fa fa-puzzle-piece ibtn bgblue-1 white"></i>
					CALIFICACIONES REALIZADAS
			</div>
		</a>
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
				<label for="nc">Clientes</label>
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
								<? if($key["Logo"]===""){
										?>
										<img src="<?= base_URL()?>/assets/img/foto-no-disponible.jpg" class="img-fluid" alt="<?= $key["Razon_Social"]?>">
										<?

								}else{
									?>
									<img src="<?= base_URL()?>/assets/img/logosEmpresas/<?= $key["Logo"]?>" class="img-fluid" alt="<?= $key["Razon_Social"]?>">
									<?
								}
								?>
							</div>
							<div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7" id="Texto-cal">
								<? if($key["Status"]==="PendienteA"){
									$status="Pendinete de Anulación";
									$icon="fa-ban";
									$leyenda="Pendiente de Anulación";
									$accion='<i onclick=$("#mensaje-Pendientea").iziModal("open") class="fa fa-ban bgblue-1 white iconos_botones" lld="invisble-empre" llc="<?= $key["IDValora"]?>" data-toggle="popover" title="" data-original-title="Pendiente de Anulación" aria-describedby="popover618033"></i>';
								}else if($key["Status"]==="Pendiente"){
									$status="Pendiente de Resolución";
									$icon="fa-ban";
									$accion='<i class="fa fa-wrench bgblue-1 white iconos_botones" lld="modificar" llc="'.$key["IDValora"].'" data-toggle="popover" title="" data-original-title="Pendiente de Resolución" aria-describedby="popover618033"></i>';
								}else{
									$status=$key["Status"];
									$accion="";
								}
									$fec1=$key["FechaPuesta"];						
									$fec=$key["FechaModificacion"];
							?>
								<div class="col-12">Estatus:<span class="spantb"> <?= $status?></span></div>
								<div class="col-12">Fecha de Calificación:<span class="spantb"> <?= $key["Fecha"]?></span></div>			
								<div class="col-12">Razón Social:<span class="minitit"> <?= $key["Razon_Social"]?></span></div>
								<div class="col-12">Nombre Comercial:<span class="spantb"> <?= $key["Nombre_comer"]?></span></div>
								
								<div class="col-12">Nombre de Usuario que califica:<span class="spantb"> <?= $key["UsuarioEmisor"]?></span></div>
								<div class="col-12">Correo Electronico de Usuario que califica:<span class="spantb"> <?= $key["CorreoEmisor"]?></span></div>
								<div class="col-12">Nombre de Usuario a quien calificá:<span class="spantb"> <?= $key["UsuarioReceptor"]?></span></div>
								<div class="col-12">Correo Electronico de Usuario a quien calificá:<span class="spantb"> <?= $key["CorreoReceptor"]?></span></div>

								<div class="col-12">Fecha de Petición:<span class="spantb"> <?= $fec1?></span></div>
								<div class="col-12">Fecha de Modificación:<span class="spantb"> <?= $fec?></span></div>
							</div>
							<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 centrar-vertical-contend" id="acciones-cal">
								<div class="row">
									<i class="fa fa-eye bgblue-1 white iconos_botones link" llc="/PerfilBuscado/perfil/" data-toggle="popover" title="Visitar Perfil" data-original-title="" aria-describedby="popover618033"></i>
									<i class="fa fa-search bgblue-1 white iconos_botones" lld="invisble-empre" llc="<?= $key["IDValora"]?>" data-toggle="popover" title="" data-original-title="Ver Detalles" aria-describedby="popover618033"></i>
									<?=$accion?>
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
<div id="mensaje-Pendientea" class="izimodal" width="700" data-title="Mensaje de Admyo">
	<div class="container">
		<div class="row">
		<div class="col-12">
			<label for="">Este Cliente ha solicitado la anulación de esta Calificación, por motivos de no tener relación alguna, para demostrar lo contrario por favor háganos llegar la siguiente documentación a info@admyo.con con el asunto: “No Anulación de Calificación” seguido de la Razon Social de su empresa.</label>
			<p>Para darle seguimiento a su caso necesitamos que nos adjunte alguno de los siguientes documentos:
				<p>Formato con validez en el que se corrobore que ambas empresas tienen acuerdos comerciales, tales como factura, contrato, etc.
			<p><label>Usted tiene 90 dias apartir de la fecha en que solicito la otra empresa la anulación.</label>
		</div>
	</div>
	</div>
	
</div>
<div class="izimodal" id="mod-detalles" data-fullscreen="true" data-title="Cuestionario">
	<div class="row tables">
		
	</div>
</div>