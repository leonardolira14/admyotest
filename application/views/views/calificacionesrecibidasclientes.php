<div class="container margin-top-30">
	<div class="row">
		<div class=" col-12 titulos  text-center margin-bottom-30"><h4><strong>CALIFICACIONES RECIBIDAS DE CLIENTES</strong></h4></div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link" llc="/perfil/calificacionesrecibidasc">
			<div class="tab current">
				<i class="fa fa-line-chart ibtn bgblue-1 white"></i>
				TOTALES
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link" llc="/perfil/clientes">
			<div class="tab">
				<i class="fa fa-users ibtn bgblue-1 white"></i>
				CLIENTES
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link" llc="/perfil/calificacionesC">
			<div class="tab">
				<i class="fa fa-puzzle-piece ibtn bgblue-1 white"></i>
				CALIFICACIONES
			</div>
		</div>
	</div>
</div>
<div class="container-fluid margin-top-30">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-64 col-lg-6 col-xl-6 cbluex ">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title numcalif" id="numcalif"><?=$Activas["NumeroCalif"] ?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado">NO DE CALIFICACIONES RECIBIDAS/<span class="spanio"> <?=$anio ?></span></p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-64 col-lg-6 col-xl-6 cbluex ">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title pendientes" id="pendientes"><?=$Pendientes["NumeroCalif"] ?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado">CALIFICACIONES PENDIENTES DE RESOLUCIÓN/ <span class="spanio"><?=$anio ?></span></p></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container margin-top-30">
	<div class="row">
		<div class=" col-12 titulos  text-center margin-bottom-30"><h4><strong>CALIFICACIONES RECIBIDAS </strong></h4></div>
		<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center" style="margin: 0 auto;">
			<div id="" class="form-group">
				<label for="nc">Año</label>
				<select   class="form-control" id="anio1" lld="pf" name="anio" llc="anio" >
					<option value="">Selecciona</option>
					<?php
					for($i=2010;$i<=date('Y');$i++) {
						if($i==$anio){
							?>
							<option selected value="<?= $i ?>"><?= $i ?></option>
							<?
						}else{
							?>
							<option value="<?= $i ?>"><?= $i ?></option>
							<?	
						}
						
						
					}?>			
				</select> 
			</div>
		</div>
	</div>
</div>
<div class="container margin-top-20">
	<div class="row">
		<div id="g1" class="col-12" style="height: 500px;">
		</div>
	</div>
</div>

<div class="container margin-top-30">
	<div class="row">
		<div class=" col-12 titulos  text-center margin-bottom-30"><h4><strong>CALIFICACIÓN PROMEDIO RECIBIDA </strong></h4></div>
		<div class="col-12 col-sm-12 col-md-64 col-lg-6 col-xl-6 cbluex " style="margin: 0 auto;" >
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title promedio" id="promedio"><?= $Activas["promedio"]; ?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado">PROMEDIO DE EMPRESA/ <span class="spanio">  <?=$anio ?></span></p></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container margin-top-20">
	<div class="row">
		<div id="g2" class="col-12" style="height: 500px;">
		</div>
	</div>
</div>
<script>
	$(function(){
		var date=new Date();
		obt={};
		obt["anio"]=date.getFullYear();
		obt["IDEmpresa"]="";
		ayuda.senddata(obt,"/calificaciones/TotalCalificacionRC",function(data){
			lin=JSON.parse(data);
			ayuda.graficar('g1',"Calificaciones /"+lin.anio,'Numero de Calificaciones',lin.grafica.meses,lin.grafica.catego);
			ayuda.graficar('g2',"Calificaciones /"+lin.anio,'Numero de Calificaciones',lin.grafica.medias,lin.grafica.catego);
			$("#preeload").hide()
		})
	})
	$("#anio1").on("change",function(){
		$("#preeload").show();
		console.log($(this).val())
		obt={};
		obt["anio"]=$(this).val();
		obt["IDEmpresa"]="";
		ayuda.senddata(obt,"/calificaciones/TotalCalificacionRC",function(data){
			lin=JSON.parse(data);
			console.log(lin)
			ayuda.graficar('g1',"Calificaciones /"+lin.anio,'Numero de Calificaciones',lin.grafica.meses,lin.grafica.catego);
			ayuda.graficar('g2',"Calificaciones /"+lin.anio,'Numero de Calificaciones',lin.grafica.medias,lin.grafica.catego);
			$("#numcalif").html(" "+lin.Activas.NumeroCalif)
			$("#promedio").html(" "+lin.Activas.promedio)
			$("#pendientes").html(" "+lin.Pendientes.NumeroCalif)
			$(".spanio").html(lin.anio)
			$("#preeload").hide()
		})

	})
</script>
