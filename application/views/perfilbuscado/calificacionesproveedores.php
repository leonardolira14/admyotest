
<div class="container margin-top-30">
	<div class="row">
		<div class=" col-12 titulos  text-center margin-bottom-30"><h4><strong>CALIFICACIONES RECIBIDAS DE PROVEEDORES</strong></h4></div>
	</div>
</div>
<? if($promcues==false){
?>
<div class="container margin-top-40" id="Dats-Genral">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6  text-center ">
			<div class="tab current" lld="totales" llt="listas">
				<i class="fa fa-line-chart ibtn bgblue-1  white"></i>
				TOTALES
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6  text-center" >
			<div class="tab" lld="listas" llt="totales">
				<i class="fa fa-users ibtn bgblue-1 white"></i>
				PROVEEDORES PUBLICOS
			</div>
		</div>	
	</div>
</div>

<?
}else{
?>
<div class="container margin-top-40" id="Dats-Genral">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center ">
			<div class="tab current" lld="totales" llt="todas">
				<i class="fa fa-line-chart ibtn bgblue-1  white"></i>
				TOTALES
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center" >
			<div class="tab" lld="listas" llt="todas">
				<i class="fa fa-users ibtn bgblue-1 white"></i>
				PROVEEDORES PUBLICOS
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center" >
			<div class="tab" lld="cuestinario" llt="todas">
				<i class="fa fa-users ibtn bgblue-1 white"></i>
				MEDIA CUESTIONARIO
			</div>
		</div>	
	</div>
</div>


<?
} ?>

<div class="totales lb-tb">
	<div class="container margin-top-30">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-64 col-lg-6 col-xl-6 cbluex ">
				<div class="cblue">
					<div class="fun-wrap">
						<div class="count  count-title numcalif" id="numcalif"><?=$Activas["NumeroCalif"]?></div>
						<div class="funfact-divider"></div>
						<div class="funfact"><p id="mejorado">NO DE CALIFICACIONES RECIBIDAS/<span class="spanio"> 2017</span></p></div>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-64 col-lg-6 col-xl-6 cbluex ">
				<div class="cblue">
					<div class="fun-wrap">
						<div class="count  count-title pendientes" id="promedio"><?=$Activas["promedio"]?></div>
						<div class="funfact-divider"></div>
						<div class="funfact"><p id="mejorado">PROMEDIO DE EMPRESA/ <span class="spanio">2017</span></p></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container margin-top-30">
		<div class="row">
			<div class=" col-12 titulos  text-center margin-bottom-30"><h4><strong>CALIFICACIONES RECIBIDAS</strong></h4></div>
		</div>
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
<div class="container margin-top-20">
	<div class="row">
		<div id="g1" class="col-12" style="height: 500px;">
		</div>
	</div>
</div>
	<div class="container margin-top-30">
		<div class="row">
			<div class=" col-12 titulos  text-center margin-bottom-30"><h4><strong>CALIFICACIÓN PROMEDIO RECIBIDA</strong></h4></div>
		</div>
	</div>

<div class="container margin-top-20">
	<div class="row">
		<div id="g2" class="col-12" style="height: 500px;">
		</div>
	</div>
</div>
</div>
<div class="listas lb-tb" style="display: none">
	<div class="container">
	<div class="row tables ">
		<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>PROVEEDORES </strong></h4></div>
		<div class="col-12 margin-top-10">
			<div class="row">
			<?
				if($proveedores!=false){
					foreach ($proveedores as $key) {
						if($key["Visible"]=="Visible"){

						
						?>
							<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2">
								<?if($key["Logo"]==""){
									?>
									<img class="img-fluid" src="/assets/img/foto-no-disponible.jpg"  alt="<?=$key["Razon_Social"]?>" />
									<?
								}else{
									?>
									<img  class="img-fluid" src="/assets/img/logosEmpresas/<?=$key["Logo"]?>" alt="">
									<?
								}

								?>
							</div>
							<div class="col-12 col-xs-12 col-md-7 col-lg-7 col-xl-7">
								<div class="row">
									<div class="col-12">Razon Social:<strong><?=$key["Razon_Social"]?></strong></div>
									<div class="col-12">Nombre Comercial:<strong><?=$key["Nombre_Comer"]?></strong></div>
									<div class="col-12">RFC:<strong></strong><?=$key["RFC"]?></div>
								</div>
							</div>
							<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 centrar-vertical-contend">
									<i class="fa fa-eye bgblue-1 white iconos_botones link" llc="/PerfilBuscado/perfil/<?=$key["num"]?>"  data-toggle="popover" title="" data-original-title="Visitar Perfil" aria-describedby="popover41452"></i>
							</div>
						<?
					}
					}
				}
			?>
		</div>
		</div>
	</div>
</div>
</div>
<div class="container cuestinario lb-tb" style="display: none">
	<div class="row tables ">
		<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>Cuestionario </strong></h4></div>
		<? if($promcues!=false){
			foreach ($promcues as $key) {
				?>
				<div class="col-10 margin-top-20 margin-bottom-20"> <h4><strong class="colorazul"><?= $key->Pregunta?></strong></h4></div>
				<div class="col-2 margin-top-20 margin-bottom-20"><h4><strong class="colorazul"><?= round($key->calificacion,2)?></strong></h4></div>
				<?
			}
		}?>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		var date=new Date();
		obt={};
		obt["anio"]=date.getFullYear();
		obt["IDEmpresa"]=ayuda.getlocal("pbn");
		ayuda.senddata(obt,"/calificaciones/TotalCalificacionRP",function(data){
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
		obt["IDEmpresa"]=ayuda.getlocal("pbn");
		ayuda.senddata(obt,"/calificaciones/TotalCalificacionRP",function(data){
						lin=JSON.parse(data);
						console.log(lin)
						ayuda.graficar('g1',"Calificaciones /"+lin.anio,'Numero de Calificaciones',lin.grafica.meses,lin.grafica.catego);
						ayuda.graficar('g2',"Promedios /"+lin.anio,'Numero de Calificaciones',lin.grafica.medias,lin.grafica.catego);
						$("#numcalif").html(" "+lin.Activas.NumeroCalif)
						$("#promedio").html(" "+lin.Activas.promedio)
						$("#pendientes").html(" "+lin.Pendientes.NumeroCalif)
						$(".spanio").html(lin.anio)
						$("#preeload").hide()
					})

	})
	$(document).on('click','.tab',function(){
		$(".tab").removeClass('current');
		$(this).addClass('current');
		$(".lb-tb").css("display","none");
		$("."+$(this).attr("lld")).css("display","block");
		
	})
</script>