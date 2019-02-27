<?
$rec=json_decode($rec);
?>
<script type="text/javascript">
 	var seriecierc= <?= json_encode($rec->seriecir); ?>;
 	var evolucion= <?= json_encode($rec->evolucion); ?>;
 	
 	google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(function(){
    	help.graficarv2(seriecierc,"","grafica1","c","");
    	help.graficarv2(evolucion,"","grafica2","l","");
    	
    });
 </script>
<div class="container-fluid">
	<div class="row banner ">
		 <?
			 if(isset($perfilbuscado)){
			 	?>
			 	<div class="bg-b"></div>
				<div class="text">
			 	<?
			 	if($tip==="M"){
			 		
			  	?>
					<h4>El Riesgo por la reputación de los proveedores de</h4>
					<h3><?= $datosperfil->Razon_Social?></h3>
					<h5>basado en las calificaciones recibidas de sus proveedores en un mes.</h5>
				<?
				}
				else{
					?>
					<h4>El Riesgo por la reputación de los proveedores de</h4>
					<h3><?= $datosperfil->Razon_Social?></h3>
					<h5>basado en las calificaciones recibidas de los proveedores en 12 meses.</h5>
					<?
				}
			 }else{
			 	?>
			 	<div class="bg"></div>
				<div class="text">
			 	<?
			 	if($tip==="M"){
			  	?>
				Tu Riesgo por la reputación de tus proveedores
				<br>
				<h5>basado en las calificaciones recibidas de tus proveedores en un mes.</h5>
				<?
				}
				else{
					?>
					Tu Riesgo por la reputación de tus proveedores
					<br>
					<h5>basado en las calificaciones recibidas de tus proveedores en 12 meses.</h5>
					<?
				}
			 }
			  
			?>
		</div>
		<div class="banner-imgclie"></div>
	</div>
</div>
 <div class="container m-t-20 rgs-perfil">
 	<div class="row">
 		<div class="col-4">
 			<div class="card w-80" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Cuantos han mejorado</h6>
			    <p class="card-text text-center numderes "><?= $rec->mejorados->numero  ?></p>
			    <div class="container-fuid">
			   		<div class="row d-flex justify-content-center">
			   			
			   			
			   			<div class="col-4 text-center titulo">
			   				<h4><?=(float)round($rec->mejorados->porcentaje)?>%</h4>
			   			</div>

			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 		
 		<div class="col-4">
 			<div class="card w-80" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Cuantos han mantenido</h6>
			    <p class="card-text text-center numderes "><?= $rec->mantenidos->numero  ?></p>
			    <div class="container-fuid">
			   		<div class="row d-flex justify-content-center">
			   			
			   			
			   			<div class="col-4 text-center titulo">
			   				<h4><?=(float)round($rec->mantenidos->porcentaje)?>%</h4>
			   			</div>

			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 		<div class="col-4">
 			<div class="card w-80" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Cuantos han empeorado</h6>
				  <p class="card-text text-center numderes "><?= $rec->empeorados->numero  ?></p>
			    <div class="container-fuid">
			   		<div class="row d-flex justify-content-center">
			   			
			   			
			   			<div class="col-4 text-center titulo">
			   				<h4><?=(float)round($rec->empeorados->porcentaje)?>%</h4>
			   			</div>

			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>

 	</div>
 </div>
 <div class="container ">
 	<div class="row d-flex m-t-40 justify-content-end m-b-30">
 		<div class="col-6 text-right">
 			<div class="btn-group" role="group" aria-label="Basic example">
			  
			  <?
			   if(isset($perfilbuscado))
			   {
			   	?>
					<a href="<?=base_URL()?>perfildetallesriesgo/proveedor/<?= $tip?>/<?= $datosperfil->IDEmpresa?>" class="btn btn-primary">Ver Detalles</a>
			   	<?
			   	if($tip==="M"){
			  		?>
			  		
			  		<a href="<?=base_URL()?>perfilriesgoperfilriesgoproveedores/M/<?= $datosperfil->IDEmpresa?>"  class="btn btn-primary active">MES</a>
			  		<a href="<?=base_URL()?>perfilriesgoperfilriesgoproveedores/A/<?= $datosperfil->IDEmpresa?>" class="btn btn-secondary ">12 MESES</a>
			  		<?
			  	}else{
			  		?>
			  		
					<a href="<?=base_URL()?>perfilriesgoperfilriesgoproveedores/M/<?= $datosperfil->IDEmpresa?>"  class="btn btn-secondary ">MES</a>
			  		<a href="<?=base_URL()?>perfilriesgoperfilriesgoproveedores/A/<?= $datosperfil->IDEmpresa?>" class="btn btn-primary active">12 MESES</a>
			  		<?
			   }

			   }
			   else
			   {
			   	?>
			   	<a href="<?=base_URL()?>detallesriesgo/proveedor/<?= $tip?>" class="btn btn-primary">Ver Detalles</a>
			   <?
			   	if($tip==="M"){
			  		?>
			  		
			  		<a href="<?=base_URL()?>riesgoproveedor/M"  class="btn btn-primary active">MES</a>
			  		<a href="<?=base_URL()?>riesgoproveedor/A" class="btn btn-secondary ">12 MESES</a>
			  		<?
			  	}else{
			  		?>
			  		
					<a href="<?=base_URL()?>riesgoproveedor/M"  class="btn btn-secondary ">MES</a>
			  		<a href="<?=base_URL()?>riesgoproveedor/A" class="btn btn-primary active">12 MESES</a>
			  		<?
			   }
			  	
			  	}
			  ?>
			  
			</div>
 		</div>
 	</div>
 </div>

 <div class="container-fluid">
 	<div class="row">
 		<div class="col-4 text-center text-blue titulos"><h5>General</h5></div>
 		<div class="col-6 text-center text-blue titulos"><h5>Evolución Empeorados</h5></div>
 		
 	</div>
 </div>
 <div class="container-fluid">
 	<div class="row img-clie">
 		<div class="col-5">
 			<div class="grafica1" id="grafica1">
 				
 			</div>
 		</div>
 		<div class="col-6">
 			<div class="grafica2" id="grafica2">
 				
 			</div>
 		</div>
 	</div>
 </div>


 <div class="container rgs-perfil m-b-40">
 	<div class="row">
 		<div class="col-12 titulo text-center">
 			<h3>Calidad</h3>
 		</div>
 		<div class="col-4">
 			<div class="card w-80" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Cuantos han mejorado</h6>
			    <p class="card-text text-center numderes "><?= $rec->mejoradoscalidad->num  ?></p>
			    <div class="container-fuid">
			   		<div class="row d-flex justify-content-center">
			   			
			   			
			   			<div class="col-4 text-center titulo">
			   				<h4><?=(float)round($rec->mejoradoscalidad->porcentaje)?>%</h4>
			   			</div>

			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 		
 		<div class="col-4">
 			<div class="card w-80" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Cuantos han mantenido</h6>
			    <p class="card-text text-center numderes "><?= $rec->mantenidoscalidad->num  ?></p>
			    <div class="container-fuid">
			   		<div class="row d-flex justify-content-center">
			   			
			   			
			   			<div class="col-4 text-center titulo">
			   				<h4><?=(float)round($rec->mantenidoscalidad->porcentaje)?>%</h4>
			   			</div>

			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 		<div class="col-4">
 			<div class="card w-80" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Cuantos han empeorado</h6>
				  <p class="card-text text-center numderes "><?= $rec->empeoradoscalidad->num  ?></p>
			    <div class="container-fuid">
			   		<div class="row d-flex justify-content-center">
			   			
			   			
			   			<div class="col-4 text-center titulo">
			   				<h4><?=(float)round($rec->empeoradoscalidad->porcentaje)?>%</h4>
			   			</div>

			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 	</div>
 </div>
  <div class="container rgs-perfil m-b-40">
 	<div class="row">
 		<div class="col-12 titulo text-center">
 			<h3>Cumplimento</h3>
 		</div>
 		<div class="col-4">
 			<div class="card w-80" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Cuantos han mejorado</h6>
			    <p class="card-text text-center numderes "><?= $rec->mejoradoscumplimiento->num  ?></p>
			    <div class="container-fuid">
			   		<div class="row d-flex justify-content-center">
			   			
			   			
			   			<div class="col-4 text-center titulo">
			   				<h4><?=(float)round($rec->mejoradoscumplimiento->porcentaje)?>%</h4>
			   			</div>

			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 		
 		<div class="col-4">
 			<div class="card w-80" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Cuantos han mantenido</h6>
			    <p class="card-text text-center numderes "><?= $rec->mantenidoscumplimiento->num  ?></p>
			    <div class="container-fuid">
			   		<div class="row d-flex justify-content-center">
			   			
			   			
			   			<div class="col-4 text-center titulo">
			   				<h4><?=(float)round($rec->mantenidoscumplimiento->porcentaje)?>%</h4>
			   			</div>

			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 		<div class="col-4">
 			<div class="card w-80" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Cuantos han empeorado</h6>
				  <p class="card-text text-center numderes "><?= $rec->empeoradoscumplimiento->num  ?></p>
			    <div class="container-fuid">
			   		<div class="row d-flex justify-content-center">
			   			
			   			
			   			<div class="col-4 text-center titulo">
			   				<h4><?=(float)round($rec->empeoradoscumplimiento->porcentaje)?>%</h4>
			   			</div>

			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 	</div>
 </div>
   <div class="container rgs-perfil m-b-40">
 	<div class="row">
 		<div class="col-12 titulo text-center">
 			<h3>Oferta</h3>
 		</div>
 		<div class="col-4">
 			<div class="card w-80" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Cuantos han mejorado</h6>
			    <p class="card-text text-center numderes "><?= $rec->mejoradosoferta->num  ?></p>
			    <div class="container-fuid">
			   		<div class="row d-flex justify-content-center">
			   			
			   			
			   			<div class="col-4 text-center titulo">
			   				<h4><?=(float)round($rec->mejoradosoferta->porcentaje)?>%</h4>
			   			</div>

			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 		
 		<div class="col-4">
 			<div class="card w-80" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Cuantos han mantenido</h6>
			    <p class="card-text text-center numderes "><?= $rec->mantenidosoferta->num  ?></p>
			    <div class="container-fuid">
			   		<div class="row d-flex justify-content-center">
			   			
			   			
			   			<div class="col-4 text-center titulo">
			   				<h4><?=(float)round($rec->mantenidosoferta->porcentaje)?>%</h4>
			   			</div>

			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 		<div class="col-4">
 			<div class="card w-80" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Cuantos han empeorado</h6>
				  <p class="card-text text-center numderes "><?= $rec->empeoradosoferta->num  ?></p>
			    <div class="container-fuid">
			   		<div class="row d-flex justify-content-center">
			   			
			   			
			   			<div class="col-4 text-center titulo">
			   				<h4><?=(float)round($rec->empeoradosoferta->porcentaje)?>%</h4>
			   			</div>

			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 	</div>
 </div>