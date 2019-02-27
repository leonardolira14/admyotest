<style>
	.f-1{
		background-color: rgba(0, 0, 0, 0);
		background-repeat: no-repeat;
		background-image: url(../assets/img/slider/sala-prensa-admyo-3.jpg);
		background-size: cover;
		background-position: center center;
		height: 400px;
		opacity: 1;
		visibility: inherit;
	}
	
</style>
<script>
	$(document).on("click",'div[data-toggle="tab"]',function () {
		$("div[data-toggle='tab']").removeClass("current")
		$(this).addClass("current");
		$(".tab-pane").removeClass("show active")
	 $($(this).attr("llc")).tab('show');
	})
</script>
<div class="container-fluid">
	<div class="row f-1">

		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-bottom-30 div-txt text-center">
			<div class="div-1 align-middle">SALA DE </div>
			<div class="div-2 align-middle">PRENSA</div>
			<div class="div-3 align-middle">AQUÍ PODRÁ ENCONTRAR DONDE HAN PULICADO ARTICULOS DE NOSOTROS</div>
			<div class="div-4 align-middle">KITS DE PRENSA, NOTAS DE PRENSA Y LOS REPORTES QUE HEMOS PUBLICADO</div>
		</div>
		<div class="col-6 div-imgd">
			<img src="<?= base_url(); ?>assets/img/slider/imagen-banner-3.png"  class="img-fluid">
		</div>
	</div>	
</div>
<div class="container margin-top-30">
	<div class="row" >
		
		<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 text-center tab current"   id="home-tab" data-toggle="tab" llc="#home" role="tab" aria-controls="home" aria-expanded="true">
			<i class="fa fa-map-marker ibtn bgblue-1 white"></i>
		NOTAS DE PRENSA
		</div>
		<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 text-center tab"  id="kit-tab" data-toggle="tab" llc="#kit" role="tab" aria-controls="profile" aria-expanded="true">
		<i class="fa fa-map-marker ibtn bgblue-1 white"></i>
				KIT DE PRENSA
		</div>
		<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 text-center tab"  id="medios-tab" data-toggle="tab" llc="#medios" role="tab" aria-controls="profile" aria-expanded="true">
		<i class="fa fa-map-marker ibtn bgblue-1 white"></i>
				ARTICULOS EN MEDIOS
		</div>
		<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 text-center tab"  id="reporte-tab" data-toggle="tab" llc="#reporte" role="tab" aria-controls="profile" aria-expanded="true">
		<i class="fa fa-map-marker ibtn bgblue-1 white"></i>
				REPORTES
		</div>	
</div>
</div>	
<div class="container ">
	<div class="row">
		<div class="col-12 tab-content margin-bottom-30 shadow-1" id="myTabContent">
			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<center>
					<table class="table table-responsive table-blue">
						  <thead>
						  	<tr>
						  		<td>
						  			Fecha
						  		</td>
						  		<td>
						  			Nota de Prensa
						  		</td>
						  		<td>
						  			Anexo
						  		</td>
						  	</tr>
						  </thead>
						  <tbody>
						  	<tr>
						  		<td>-</td>
						  		<td>-</td>
						  		<td>-</td>
						  	</tr>
						  </tbody>
					</table>
					</center>
			</div>
			<div class="tab-pane fade " id="reporte" role="tabpanel" aria-labelledby="reporte-tab">
					<center>
					<table class="table table-responsive table-blue">
						  <thead>
						  	<tr>
						  		<td>
						  			Fecha
						  		</td>
						  		<td>
						  			Reporte
						  		</td>
						  		<td>
						  			Anexo
						  		</td>
						  	</tr>
						  </thead>
						  <tbody>
						  	<tr>
						  		<td>-</td>
						  		<td>-</td>
						  		<td>-</td>
						  	</tr>
						  </tbody>
					</table>
					</center>
			</div>
			<div class="tab-pane fade" id="medios" role="tabpanel" aria-labelledby="home-tab">
					<center>
					<table class="table table-responsive table-blue">
						  <thead>
						  	<tr>
						  		<td>
						  			Fecha
						  		</td>
						  		<td>
						  			Titulo
						  		</td>
						  		<td>
						  			Medio
						  		</td>
						  		<td>
						  			Anexo
						  		</td>
						  	</tr>
						  </thead>
						  <tbody>
						  	<tr>
						  		<td>22-AGO-2013</td>
						  		<td>Startup Mexicana Admyo - atacando el problema central de un negocio, la comunicación cliente - proveedor</td>
						  		<td>www.lainformacion.com</td>
						  		<td><a href="https://admyo.com/docs/22.08.13.pdf">Ver</a></td>
						  	</tr>
						  	<tr>
						  		<td>14-MAY-2013</td>
						  		<td>Admyo - Ayudan a estrechar lazos</td>
						  		<td>Reforma</td>
						  		<td><a href="https://admyo.com/docs/14.05.13.pdf">Ver</a></td>
						  	</tr>
						  	<tr>
						  		<td>04-FEB-2013</td>
						  		<td>Atrae clientes con tu imagen empresarial</td>
						  		<td>www.elempresario.com.mx</td>
						  		<td><a href="https://admyo.com/docs/04.02.13.pdf">Ver</a></td>
						  	</tr>
						  	<tr>
						  		<td>17-OCT-2013</td>
						  		<td>Nueva Tecnología para el control de riesgos entre clientes y proveedores</td>
						  		<td>EmpreBask México</td>
						  		<td><a href="https://admyo.com/docs/17.10.12.pdf">Ver</a></td>
						  	</tr>
						  	<tr>
						  		<td>25-sep-2012</td>
						  		<td>Admyo: Nueva Tecnología para el control de riesgos entre clientes y proveedores</td>
						  		<td>Club Catalán de negocios</td>
						  		<td><a href="https://admyo.com/docs/25.09.12.pdf">Ver</a></td>
						  	</tr>
						  		<tr>
						  		<td>01-ABR-2012</td>
						  		<td>Startup Mexicana Admyo - atacando el problema central de un negocio, la comunicación cliente . proveedor</td>
						  		<td>ISOPIXEL</td>
						  		<td><a href="https://admyo.com/docs/01.04.13.pdf">Ver</a></td>
						  	</tr>
						  </tbody>
					</table>
					</center>
			</div>
			<div class="tab-pane fade " id="kit" role="tabpanel" aria-labelledby="home-tab">
					<center>
					<table class="table table-responsive table-blue">
						  <thead>
						  	<tr>
						  		<td>
						  			Kit de prensa
						  		</td>
						  		
						  		<td>
						  			Comunicado
						  		</td>
						  	</tr>
						  </thead>
						  <tbody>
						  	<tr>
						  		<td>-</td>
						  		
						  		<td>-</td>
						  	</tr>
						  </tbody>
					</table>
					</center>
			</div>
		</div>
	</div>
</div>
