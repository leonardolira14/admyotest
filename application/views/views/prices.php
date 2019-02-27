<style>
	.basic .td-titulo{
		text-align: center;
		color: #fff;
		background:#F2BD1D;
		padding: 2.8em 1.8em 2em;
    	border-bottom: 20px;
	}
.estandar .td-titulo{
		text-align: center;
		color: #fff;
		background:#F2BD1D;
		padding: 2.8em 1.8em 2em;
		border-bottom: 20px;
    	background: #C85814;
    border-bottom: 2px solid #84390c
	}
.corporativo .td-titulo{
		text-align: center;
		color: #fff;
		background:#512884;
		padding: 2.8em 1.8em 2em;
		border-bottom: 20px;
    border-bottom: 2px solid #512884
	}
.empresarial .td-titulo{
		text-align: center;
		color: #fff;
		background:#028f87;
		padding: 2.8em 1.8em 2em;
		border-bottom: 20px;
    border-bottom: 2px solid #028f87
	}
.div-prices table{
	width: 100%;
}

.div-prices td{
	color: #C7C4C4;
    font-size: 15px;
    text-align: center;
    display: block;
    padding: 16px 0;
    text-decoration: none;
    font-weight: 400;
    font-family:  'Prosto One', cursive;
}
.td-titulo,.registro{
	border-radius: 15px 15px 0px 0px;
}
.td-titulo span{
	font-family:  'Prosto One', cursive;
	font-size: 2em;
}
.td-titulo p{
	font-family:  'Prosto One', cursive;
	font-size: 1.6em;
	font-weight: 700;
}
.img-prices{
	position: relative;
    top: 50px;
    width: 180px;
}
.basic .registro{
		text-align: center;
		color: #fff;
		background:#F2BD1D;
		border-bottom: 2px solid #F2BD1D;
    	font-family:  'Prosto One', cursive;
	font-size: 1.6em; 
}
.estandar .registro{
		text-align: center;
		color: #fff;
		    background: #C85814;
    border-bottom: 2px solid #84390c;
    	font-family:  'Prosto One', cursive;
	font-size: 1.6em; 
}
.corporativo .registro{
		text-align: center;
		color: #fff;
		    background: #512884;
    border-bottom: 2px solid #028f87 ;
    	font-family:  'Prosto One', cursive;
	font-size: 1.6em; 
}
.empresarial .registro{
		text-align: center;
		color: #fff;
		    background: #028f87;
    border-bottom: 2px solid #512884;
    	font-family:  'Prosto One', cursive;
	font-size: 1.6em; 
}
.div-prices td:hover{
	color: #005d8f;
}
.div-prices .registro:hover{
	color: #005d8f;
	cursor: pointer;
}
.div-prices .td-titulo:hover{
	color: #fff;
}
.paksc:hover{
	
	-webkit-transition: all 1000ms ease-in;
    -webkit-transform: scale(1.1);
    -ms-transition: all 1000ms ease-in;
    -ms-transform: scale(1.1);   
    -moz-transition: all 1000ms ease-in;
    -moz-transform: scale(1.1);
    transition: all 1000ms ease-in;
    transform: scale(1.1);

}
</style>
<div class="container testimoniales">
	<div class="row">
		<div class="col-12 text-center">
		<span class="align-center">ELIGE UN PLAN</span>
				<br>
				<img src="<?=  base_url(); ?>/assets/img/pleca-titulos.png" class="align-center" alt="">
		</div>
	</div>
</div>

<div class="container div-prices margin-bottom-50" >
	<div class="row " >
		<!--Inicio del item--><div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 text-center basic paksc">
		<img class="img-fliud img-prices" src="<?=  base_url(); ?>/assets/img/basico.png" alt="">
		<table>
			<tr>
				<td class="td-titulo">
					<span>Basic</span>
					<p>$0 MNX</p>
				</td>
			</tr>
			<tr>
				<td>Desarrollar Perfil</td>
			</tr>
			<tr>
				<td>Calificar empresas</td>
			</tr>
			<tr>
				<td>Ver perfiles de clientes y proveedrores</td>
			</tr>
			<tr>
				<td>Alertas desempeño de clientes y proveedores</td>
			</tr>
			<tr>
				<td>Api WEB</td>
			</tr>
			<tr>
				<td>Ver resumen de cualquier empresa</td>
			</tr>
			<tr>
				<td>15 Productos / Servicios</td>
			</tr>
			<tr>
				<td>Plataforma móvil</td>
			</tr>
			<tr>
				<td llc-price="0" llc="registros" lld="basic" class="registro">Registrate Aquí</td>
			</tr>
		</table>
		</div><!--Fin del item-->
		<!--Inicio del item--><div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 text-center paksc estandar">
		<img class="img-fliud img-prices" src="<?=  base_url(); ?>/assets/img/circulo-4.png" alt="">
		<table>
			<tr>
				<td class="td-titulo">
					<span>Estandar</span>
					<p>$999 MNX</p>
				</td>
			</tr>
			<tr>
				<td>Desarrollar Perfil</td>
			</tr>
			<tr>
				<td>Calificar empresas</td>
			</tr>
			<tr>
				<td>Ver perfiles de clientes y proveedrores</td>
			</tr>
			<tr>
				<td>Alertas desempeño de clientes y proveedores</td>
			</tr>
			<tr>
				<td>Api WEB</td>
			</tr>
			<tr>
				<td>Seguimiento de Cualquier empresa</td>
			</tr>
			<tr>
				<td>50 Productos / Servicios</td>
			</tr>
			<tr>
				<td>Plataforma móvil</td>
			</tr>
			<tr>
				<td llc-price="999" llc="registros" lld="Estandar" class="registro">Registrate Aquí</td>
			</tr>
		</table>
		</div><!--Fin del item-->
		<!--Inicio del item--><div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 text-center paksc empresarial">
		<img class="img-fliud img-prices" src="<?=  base_url(); ?>/assets/img/circulo-1.png" alt="">
		<table>
			<tr>
				<td class="td-titulo">
					<span>Empresarial</span>
					<p>$3,000 MNX</p>
				</td>
			</tr>
			<tr>
				<td>Estandar más</td>
			</tr>
			<tr>
				<td>Api WEB</td>
			</tr>
			<tr>
				<td>Plataforma móvil</td>
			</tr>
			<tr>
				<td>30 descargas QVAL</td>
			</tr>
			<tr>
				<td>Gestion de desempeño de cada uno de los operadores QVAL</td>
			</tr>
			<tr>
				<td>Publicar 10 necesidad de proveeduría al mes</td>
			</tr>
			<tr>
				<td>Ofertas Ilimitadas al mes sobre necesidades de proveeduria de terceros</td>
			</tr>
			<tr>
				<td llc="registros" lld="Empresarial" class="registro">Registrate Aquí</td>
			</tr>
		</table>
		</div><!--Fin del item-->
		<!--Inicio del item--><div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 text-center paksc corporativo">
		<img class="img-fliud img-prices" src="<?=  base_url(); ?>/assets/img/corporativo.png" alt="">
		<table>
			<tr>
				<td class="td-titulo">
					<span>Coporativo</span>
					<p>$10,000 MNX</p>
				</td>
			</tr>
			
			<tr>
				<td>Estandar más</td>
			</tr>
			<tr>
				<td>Informes de desempeño riesgo y oportunidad sectorial geografico</td>
			</tr>
			<tr>
				<td>Incorporación de indicadores propios al sistema, su seguimiento e informes</td>
			</tr>
			<tr>
				<td>descargas QVAL Ilimitadas</td>
			</tr>
			<tr>
				<td>Gestion de desempeño de cada uno de los operadores QVAL</td>
			</tr>
			<tr>
				<td>Publicar necesidad de proveeduría Ilimitadas al mes</td>
			</tr>
			<tr>
				<td>Ofertas Ilimitadas al mes sobre necesidades de proveeduria de terceros</td>
			</tr>
			<tr>
				<td  llc="registros" lld="Coporativo" class="registro">Registrate Aquí</td>
			</tr>
		</table>
		</div><!--Fin del item-->

	</div>
</div>
<div class="izimodal" data-title="Mensaje de Admyo" id="msj-cotacto">
	<div class="container margin-top-20 margin-bottom-30">
		<div class="row">
			<div class="col-12 text-center">
			<h5><span>Para brindarle un mejor servicio sobre este plan porfavor ingrese la siguiente información y un asesor se pondra en conctacto con usted</span></h5>
		</div>
		<div class="col-12 margin-top-20">
			<div id="" class="form-group">
							<label for="rz">Nombre y Apellidos</label>
								<input requerid="requerid" type="text" id="nombre" llc="Nombre y Apellidos" name="nombre" class="form-control" placeholder="Nombre y Apelldos"> 
							</div>
		</div>
		<div class="col-12">
			<div id="" class="form-group">
							<label for="rz">Correo Electronico</label>
								<input requerid="requerid" type="email" id="rz" llc="Correo Electronico" name="email" class="form-control" placeholder="Email"> 
							</div>
		</div>
		<div class="col-12">
			<div id="" class="form-group">
							<label for="rz">Telefono</label>
								<input requerid="requerid" type="text" id="tel" llc="Telefono" name="tel" class="form-control" placeholder="Telefono"> 
							</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 align-center btn btn-primary" llc="enviar-mensaje" lld="btn">
							ENVIAR
						</div>
		</div>
	</div>
</div>
<script>
	$(document).on("click",'td[llc="registros"]',function(){
		if($(this).attr("lld")=="Estandar" || $(this).attr("lld")=="basic" ){
			obt={};
			obt["plan"]=$(this).attr("lld");
			obt["price"]=$(this).attr("llc-price");
			ayuda.setlocal("tipplan",obt);
			ayuda.goto("/registro");
		}else{
			obt={};
			obt["plan"]=$(this).attr("lld");
			ayuda.setlocal("tipplan",obt);
			console.log(obt);
			$("#msj-cotacto").iziModal("open")
		}
	})
	$(document).on("click",'div[llc="enviar-mensaje"]',function(){
		var div="#msj-cotacto";
		bandera=0;
		obt={};
		ub=ayuda.getlocal("tipplan");
		obt["Plan"]=ub["plan"]
		$(div+" .form-control").each(function(index){
			if(ayuda.formval(this,div)==true){
				bandera=1;
				obt[$(this).attr("name")]=$(this).val();
			}else{
				bandera=3;
				return false;
			}
		})

		if(bandera==1){	
			ayuda.senddata(obt,"/home/mandacot",function(){
				$("#msj-cotacto").iziModal("close")
				$("#msjsucces").iziModal('setSubtitle',"Mensaje enviado");
				 mssucces();
			})
		}
	})
</script>