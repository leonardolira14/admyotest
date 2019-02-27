<div class="container margin-top-30">
	<div class="row">
		<div class=" col-12 titulos  text-center margin-bottom-30"><h4><strong>REPUTACIÓN DE MIS CLIENTES</strong></h4></div>
	</div>
</div>
<div class="container margin-top-20">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 cbluex ">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title numcalif" id="Mejorado">0</div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="PorMejorado">0% MEJORADO</span></p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 cbluex ">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title pendientes" id="Empeorado">0</div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="PorEmpeorado">0% EMPEORADO</p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 cbluex ">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title pendientes" id="Mantenido">0</div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="PorMantenido">0% MANTENIDO</p></div>
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
					<?php
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

<div class="container">
	<div class="row tables ">
		<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>Clientes </strong></h4></div>
		<div class="col-12 margin-top-10">
			<div class="row" id="listClie">
				
			</div>										
		</div>
	</div>
</div>
<script>
	$(function(){
		$("#preeload").show();
		var fecha = new Date();
		var ano = fecha.getFullYear();
		obt={};
		obt["Tipo"]="Clientes";
		obt["anio"]=ano;
		ayuda.senddata(obt,"/Clientes/RepClientesporAnio",function(data){
			lin=JSON.parse(data);
			console.log(lin)
			$("#PorEmpeorado").text(lin.clientes.Porcentajes.PorEmpeorado+"% EMPEORADO");
			$("#PorMantenido").text(lin.clientes.Porcentajes.PorMantenido+"% MANTENIDO");
			$("#PorMejorado").text(lin.clientes.Porcentajes.PorMejorado+"% MEJORADO");
			ayuda.graficar('g1',"Reputación de Clientes /"+lin.anio,'Numero de Clientes',lin.clientes.reputacion,lin.clientes.Catego);
			$("#Empeorado").text(lin.clientes.TotalClientes.Empeorado);
			$("#Mantenido").text(lin.clientes.TotalClientes.Mantenido);
			$("#Mejorado").text(lin.clientes.TotalClientes.Mejorado);
			cade="";
			for(key in lin.clientes.clientes){
				cade+='<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2">'
				if(lin.clientes.clientes[key].Logo==""){
						cade+='<img class="img-fluid" src="../assets/img/foto-no-disponible.jpg"  alt="'+lin.clientes.clientes[key].Razon_Social+'" />'	
				}else{
					cade+='<img class="img-fluid" src="../assets/img/logosEmpresas/'+lin.clientes.clientes[key].Logo+'"  alt="'+lin.clientes.clientes[key].Razon_Social+'" />'	
				}
				cade+='</div><div class="col-12 col-xs-12 col-md-7 col-lg-7 col-xl-7">';
				cade+="<div class='row'>";
				cade+='<div class="col-12">Razon Social:<strong>'+lin.clientes.clientes[key].Razon_Social+'</strong></div>';
				cade+='<div class="col-12">Nombre Comercial:<strong>'+lin.clientes.clientes[key].Nombre_Comer+'</strong></div>';
				cade+='<div class="col-12">RFC:<strong>'+lin.clientes.clientes[key].RFC+'</strong></div>';
				cade+='<div class="col-12">Reputación:<strong class="'+lin.clientes.clientes[key].class+'">'+lin.clientes.clientes[key].leyenda+'</strong></div></div></div>';
				cade+='<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 centrar-vertical-contend">';
				cade+='<a href="/PerfilBuscado/perfil/'+lin.clientes.clientes[key].num+'"><i class="fa fa-eye bgblue-1 white iconos_botones" lld="invisble-empre" llc="" data-toggle="popover" title="" data-original-title="Visitar Perfil" aria-describedby="popover41452"></i></a>'
				cade+='<i class="fa fa-file-text-o bgblue-1 white iconos_botones" lld="invisble-empre" llc="'+lin.clientes.clientes[key].num+'" data-toggle="popover" title="" data-original-title="Ver Cuestionario" aria-describedby="popover41452"></i>';
				cade+="</div><div class='col-12 hr'></div>";
			}
			$("#listClie").html(cade);
			$("#preeload").hide()
		});
	})
$(document).on("change","#anio1",function(){
	$("#preeload").show();
		obt={};
		obt["Tipo"]="Clientes";
		obt["anio"]=$(this).val();
		ayuda.senddata(obt,"/Clientes/RepClientesporAnio",function(data){
			lin=JSON.parse(data);
			console.log(lin)
			$("#PorEmpeorado").text(lin.clientes.Porcentajes.PorEmpeorado+"% EMPEORADO");
			$("#PorMantenido").text(lin.clientes.Porcentajes.PorMantenido+"% MANTENIDO");
			$("#PorMejorado").text(lin.clientes.Porcentajes.PorMejorado+"% MEJORADO");
			ayuda.graficar('g1',"Reputación de Clientes /"+lin.anio,'Numero de Clientes',lin.clientes.reputacion,lin.clientes.Catego);
			$("#Empeorado").text(lin.clientes.TotalClientes.Empeorado);
			$("#Mantenido").text(lin.clientes.TotalClientes.Mantenido);
			$("#Mejorado").text(lin.clientes.TotalClientes.Mejorado);
			cade="";
			for(key in lin.clientes.clientes){
				cade+='<div class="col-12 col-xs-12 col-md-2 col-lg-2 col-xl-2">'
				if(lin.clientes.clientes[key].Logo==""){
						cade+='<img class="img-fluid" src="../assets/img/foto-no-disponible.jpg"  alt="'+lin.clientes.clientes[key].Razon_Social+'" />'	
				}else{
					cade+='<img class="img-fluid" src="../assets/img/logosEmpresas/'+lin.clientes.clientes[key].Logo+'"  alt="'+lin.clientes.clientes[key].Razon_Social+'" />'	
				}
				cade+='</div><div class="col-12 col-xs-12 col-md-7 col-lg-7 col-xl-7">';
				cade+="<div class='row'>";
				cade+='<div class="col-12">Razon Social:<strong>'+lin.clientes.clientes[key].Razon_Social+'</strong></div>';
				cade+='<div class="col-12">Nombre Comercial:<strong>'+lin.clientes.clientes[key].Nombre_Comer+'</strong></div>';
				cade+='<div class="col-12">RFC:<strong>'+lin.clientes.clientes[key].RFC+'</strong></div>';
				cade+='<div class="col-12">Reputación:<strong class="'+lin.clientes.clientes[key].class+'">'+lin.clientes.clientes[key].leyenda+'</strong></div></div></div>';
				cade+='<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 centrar-vertical-contend">';
				cade+='<a href="/PerfilBuscado/perfil/'+lin.clientes.clientes[key].num+'"><i class="fa fa-eye bgblue-1 white iconos_botones" lld="invisble-empre" llc="'+lin.clientes.clientes[key].num+'" data-toggle="popover" title="" data-original-title="Visitar Perfil" aria-describedby="popover41452"></i></a>'
				cade+='<i class="fa fa-file-text-o bgblue-1 white iconos_botones" lld="invisble-empre" llc="'+lin.clientes.clientes[key].num+'" data-toggle="popover" title="" data-original-title="Ver Cuestionario" aria-describedby="popover41452"></i>';
				cade+="</div><div class='col-12 hr'></div>";
			}
			$("#listClie").html(cade);$("#preeload").hide();
			})
})
</script>
