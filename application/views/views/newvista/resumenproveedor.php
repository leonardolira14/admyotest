
 <script type="text/javascript">

 	var tp=<?= $rec; ?>; 	 
 	google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(function(){
    	help.graficarv2(tp.seriecul,"","grafica1","b","Mes");
    	help.graficarv2(tp.serieclientes,"","grafica2","l","Mes");
    	help.graficarv2(tp.serienumerodecalifmes,"","grafica3","l","Mes");
    	help.graficarv2(tp.promediopormes,"","grafica4","l","Mes");
    	
    });
 </script>
<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text">
			Resumen de calificaciones realizadas a mis proveedores
		</div>
		<div class="banner-resumen"></div>
	</div>
</div>
<div class="container-fluid margin-top-30 menu-tab">
	<div class="row">
		<a href="<?= base_URL() ?>resumenproveedor" class="col-12  col-md-4 col-lg-4 col-xl-4  text-center link">
		
			<div class="tab current">
				<i class="fa fa-line-chart ibtn bgblue-1 white"></i>
					RESUMEN
			</div>
		</a>
		<a href="<?= base_URL() ?>listaproveedores" class="col-12 col-md-4 col-lg-4 col-xl-4  text-center link">
			<div class="tab">
				<i class="fa fa-users ibtn bgblue-1 white"></i>
					MIS PROVEEDORES
			</div>
		</a>
		<a href="<?= base_URL() ?>realizadasproveedores" class="col-12 col-md-4 col-lg-4 col-xl-4  text-center link">
			<div class="tab ">
				<i class="fa fa-puzzle-piece ibtn bgblue-1 white"></i>
					CALIFICACIONES REALIZADAS
			</div>
		</a>
	</div>
</div>
<div class="container-fluid ">
	<div class="row m-t-40">
		<div class="col-6 titulo text-center">
			Media de Proveedores calificados en el último trimestre
		</div>
		<div class="col-6 titulo">Número de Proveedores Registrados</div>
	</div>
	<div class="row resumen">
		<div class="col-5">
			<div class="grafica1" id="grafica1">
 				
 			</div>
		</div>
		<div class="col-6">
			<div class="grafica1" id="grafica2">
 				
 			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 titulo">
			Número de calificaciones realizadas a proveedores
		</div>
		<div class="col-12">
			<div class="grafica3l" id="grafica3">
 				
 			</div>
		</div>
	</div>
	<div class="row m-t-80">
		<div class="col-12 titulo">
			Promedio en número de calificaciones realizadas a proveedores
		</div>
		<div class="col-12">
			<div class="grafica3l" id="grafica4">
 				
 			</div>
		</div>
	</div>
</div>