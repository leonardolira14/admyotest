<?
$rec=json_decode($rec);

?>
<script type="text/javascript"> 	
 	google.charts.load('current', {'packages':['corechart','bar']});
    google.charts.setOnLoadCallback(function(){
    	<?
    		for($i=0;$i<=count($rec->calidad)-1;$i++){
    			?>
    				help.graficarv2(<?= json_encode($rec->calidad[$i]->serie); ?>,"","calidad-<?=$i?>","cu","");
    			<?
    		}
    		for($i=0;$i<=count($rec->cumplimiento)-1;$i++){
    			?>
    				help.graficarv2(<?= json_encode($rec->cumplimiento[$i]->serie); ?>,"","cumplimiento-<?=$i?>","cu","");
    			<?
    		}
    		if($rec->tipo==="proveedor"){
    			for($i=0;$i<=count($rec->oferta)-1;$i++){
    			?>
    				help.graficarv2(<?= json_encode($rec->oferta[$i]->serie); ?>,"","oferta-<?=$i?>","cu","");
    			<?
    			}
    		}
    	?>    	
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
				if($rec->tipo==="cliente"){
					?>
					<h4>DETALLES DEl Riesgo por la reputación de los clientes de</h4>
					<h3><?= $datosperfil->Razon_Social?></h3>
					<h5>BASADO EN CALIFICACIONES que han recibido EN un 
				<?
				}else{
				?>
					<h4>DETALLES DEl Riesgo por la reputación de los Proveedores</h4>
					<h3><?= $datosperfil->Razon_Social?></h3>
					<h5>BASADO EN CALIFICACIONES que han recibido EN un 
				<?
				}
				echo ($rec->tipo2==="A") ? "Año" : "Mes";
			}else{
				?>
				<div class="bg"></div>
				<div class="text">
				<?
				if($rec->tipo==="cliente"){
					?>
					<h4>DETALLES DE TU Riesgo por la reputación de tus proveedores</h4>
					
					<h5>BASADO EN CALIFICACIONES que han recibido EN un 
				<?
				}else{
				?>
					<h4>DETALLES DE TU Riesgo por la reputación de tus Proveedores</h4>
					<h5>BASADO EN CALIFICACIONES que han recibido EN un 
				<?
				}
				echo ($rec->tipo2==="A") ? "Año" : "Mes";
			
				}
			?>
			</h5>
		</div>
		<div class="banner-imgclie"></div>
	</div>
</div>
  <div class="container ">
 	<div class="row d-flex m-t-40 justify-content-end m-b-30">
 		<div class="col-6 text-right">
 			<div class="btn-group" role="group" aria-label="Basic example">
			  <?
			  if(isset($perfilbuscado)){
			  		if($rec->tipo2==="M"){
				  		?>
				  		
				  		<a href="<?=base_URL()?>perfildetallesriesgo/<?=$rec->tipo?>/M/<?= $datosperfil->IDEmpresa?>"  class="btn btn-primary active">MES</a>
				  		<a href="<?=base_URL()?>perfildetallesriesgo/<?=$rec->tipo?>/A/<?= $datosperfil->IDEmpresa?>" class="btn btn-secondary ">12 MESES</a>
				  		<?
				  	}else{
				  		?>
				  		
						<a href="<?=base_URL()?>perfildetallesriesgo/<?=$rec->tipo?>/M/<?= $datosperfil->IDEmpresa?>"  class="btn btn-secondary ">MES</a>
				  		<a href="<?=base_URL()?>perfildetallesriesgo/<?=$rec->tipo?>/A/<?= $datosperfil->IDEmpresa?>" class="btn btn-primary active">12 MESES</a>
				  		<?
				  	}
				}
				else
				{
					if($rec->tipo2==="M"){
				  		?>
				  		
				  		<a href="<?=base_URL()?>detallesriesgo/<?=$rec->tipo?>/M"  class="btn btn-primary active">MES</a>
				  		<a href="<?=base_URL()?>detallesriesgo/<?=$rec->tipo?>/A" class="btn btn-secondary ">12 MESES</a>
				  		<?
				  	}else{
				  		?>
				  		
						<a href="<?=base_URL()?>detallesriesgo/<?=$rec->tipo?>/M"  class="btn btn-secondary ">MES</a>
				  		<a href="<?=base_URL()?>detallesriesgo/<?=$rec->tipo?>/A" class="btn btn-primary active">12 MESES</a>
				  		<?
				  	}
				}
			  ?>
			  
			</div>
 		</div>
 	</div>
 </div>
<div class="container rgs-perfil m-t-60 m-b-40">
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
<div class="container">
	<div class="row">
		<?
		for($i=0;$i<=count($rec->calidad)-1;$i++){
		?>
		<div class="col-12 titulo text-center  m-t-60">
			<h5>¿<?= $rec->calidad[$i]->Pregunta?>?</h5>
		</div>
			<div class="col-2 m-t-20">
				<div class="row text-center">
					<div class="col-12 titulo">
						<h6>Empresas Evaluadas</h6>
					</div>
					<div class="col-12">
						<h5 class="text-oranges"><?= $rec->calidad[$i]->TotalClientes?></h5>
					</div>
					<div class="col-12 titulo">
						<h6>Calificaciones</h6>
					</div>
					<div class="col-12 text-orange">
						<h5 class="text-oranges"><?= $rec->calidad[$i]->Totalcalificaciones?></h5>
					</div>
					<div class="col-12 titulo">
						<h6>Respuesta Evalulada</h6>
					</div>
					<div class="col-12 text-oranges">
						<h5><?= $rec->calidad[$i]->respuesta?></h5>
					</div>
				</div>
			</div>		
			<div class="col-10">
				<div class="grafica2" id="calidad-<?= $i ?>">

				</div>
			</div>
			<?
		}
		?>
	</div>
</div>
<div class="container rgs-perfil m-t-70 m-b-40">
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
<div class="container m-b-40">
	<div class="row">
		<?
		for($i=0;$i<=count($rec->cumplimiento)-1;$i++){
		?>
		<div class="col-12 titulo text-center  m-t-60">
			<h5>¿<?= $rec->cumplimiento[$i]->Pregunta?>?</h5>
		</div>
			<div class="col-2 m-t-20">
				<div class="row text-center">
					<div class="col-12 titulo">
						<h6>Empresas Evaluadas</h6>
					</div>
					<div class="col-12 text-oranges">
						<h5><?= $rec->cumplimiento[$i]->TotalClientes?></h5>
					</div>
					<div class="col-12 titulo">
						<h6>Calificaciones</h6>
					</div>
					<div class="col-12 text-oranges">
						<h5><?= $rec->cumplimiento[$i]->Totalcalificaciones?></h5>
					</div>
					<div class="col-12 titulo">
						<h6>Respuesta Evalulada</h6>
					</div>
					<div class="col-12 text-oranges">
						<h5><?= $rec->cumplimiento[$i]->respuesta?></h5>
					</div>
				</div>
			</div>		
			<div class="col-10">
				<div class="grafica2" id="cumplimiento-<?= $i ?>">

				</div>
			</div>
			<?
		}
		?>
	</div>
</div>
<?
if($tip==="proveedor"){
	?>
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
	<div class="container m-b-40">
	<div class="row">
		<?
		for($i=0;$i<=count($rec->oferta)-1;$i++){
		?>
		<div class="col-12 titulo text-center  m-t-60">
			<h5>¿<?= $rec->oferta[$i]->Pregunta?>?</h5>
		</div>
			<div class="col-2 m-t-20">
				<div class="row text-center">
					<div class="col-12 titulo">
						<h6>Empresas Evaluadas</h6>
					</div>
					<div class="col-12 text-oranges">
						<h5><?= $rec->oferta[$i]->TotalClientes?></h5>
					</div>
					<div class="col-12 titulo">
						<h6>Calificaciones</h6>
					</div>
					<div class="col-12 text-oranges">
						<h5><?= $rec->oferta[$i]->Totalcalificaciones?></h5>
					</div>
					<div class="col-12 titulo">
						<h6>Respuesta Evalulada</h6>
					</div>
					<div class="col-12 text-oranges">
						<h5><?= $rec->oferta[$i]->respuesta?></h5>
					</div>
				</div>
			</div>		
			<div class="col-10">
				<div class="grafica2" id="oferta-<?= $i ?>">

				</div>
			</div>
			<?
		}
		?>
	</div>
</div>
	<?
}
?>

