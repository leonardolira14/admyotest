<div class="container margin-top-30">
	<div class="row">
		<div class=" col-12 titulos  text-center margin-bottom-30"><h4><strong>VISITAS RECIBIDAS</strong></h4></div>
	</div>
</div>
<div class="container margin-top-20">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 cbluex ">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title numcalif" id="clientes">0</div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="PorMejorado">CLIENTES</p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 cbluex ">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title pendientes" id="prove">0</div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="PorEmpeorado">PROVEEDORES</p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 cbluex ">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title pendientes" id="otros">0</div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="PorMantenido">OTROS</p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 cbluex ">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title pendientes" id="anonimas">0</div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="PorMantenido">ANONIMAS</p></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container margin-top-30">
	<div class="row">
		<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center" style="margin: 0 auto;">
			<div id="" class="form-group">
				<label for="nc">Año</label>
				<select   class="form-control" id="anio1" lld="pf" name="anio" llc="anio" >
					<option value="">Selecciona</option>
					<?
					for($i=2010;$i<=date('Y');$i++) {
						if($i==date('Y')){
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
		<div class=" col-12 titulos  text-center margin-bottom-30"><h5><strong class="anios"></strong></h5></div>
	</div>
</div>
<div class="container">
	<div class="row tables ">
		<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>QUIEN HA VISITADO SU PERFIL </strong></h4></div>
		<div class="col-12 margin-top-10">
			<div class="row" id="listClie">
				
			</div>										
		</div>
	</div>
</div>
<script>
	$(function(){
		obt={};
		$("#preeload").show();
		var fecha = new Date();
		var ano = fecha.getFullYear();
		obt["anio"]=ano;
		ayuda.senddata(obt,"<?= base_URL()?>visitas/visitas",function(data){
			lin=JSON.parse(data);
			cade="";
			console.log(lin);
			$(".anios").text("VISITAS "+lin.anio)
			$("#anonimas").text(lin.datos.Cuadros.Anonimas)
			$("#clientes").text(lin.datos.Cuadros.Clientes)
			$("#otros").text(lin.datos.Cuadros.Otros)
			$("#prove").text(lin.datos.Cuadros.Proveedores)
			ayuda.graficar('g1',"Visitas /"+lin.anio,'Numero',lin.datos.Visitas,lin.datos.Catego);
			for(key in lin.datos.listVisitas){
				cade+="<div class='col-10 titulos' ><h5> <strong>"+lin.datos.listVisitas[key].Razon_Social+"</h5></strong></div>";
				cade+="<div class='col-2 titulos text-center'>"+lin.datos.listVisitas[key].Num+"</div><div class='col-12 hr'></div>";
			} 
			$("#listClie").html(cade);
		})
	})
$(document).on('change','#anio1',function(){
		obt={};
		$("#preeload").show();
		obt["anio"]=$(this).val();
		ayuda.senddata(obt,"<?= base_URL()?>visitas/visitas",function(data){
			lin=JSON.parse(data);
			cade="";
			console.log(lin);
			$(".anios").text("VISITAS "+lin.anio)
			$("#anonimas").text(lin.datos.Cuadros.Anonimas)
			$("#clientes").text(lin.datos.Cuadros.Clientes)
			$("#otros").text(lin.datos.Cuadros.Otros)
			$("#prove").text(lin.datos.Cuadros.Proveedores)
			ayuda.graficar('g1',"Visitas /"+lin.anio,'Numero',lin.datos.Visitas,lin.datos.Catego);
			for(key in lin.datos.listVisitas){
				cade+="<div class='col-10 titulos' ><h5> <strong>"+lin.datos.listVisitas[key].Razon_Social+"</h5></strong></div>";
				cade+="<div class='col-2 titulos text-center'>"+lin.datos.listVisitas[key].Num+"</div><div class='col-12 hr'></div>";
			} 
			$("#listClie").html(cade);
			$("#preeload").hide();
		})
})
</script>