<?
//vdebug($datosimg);
?>
<script type="text/javascript">
 	var serieevolucion= <?= json_encode($datosimg["serievolucion"]); ?>;
 	var evolucionmedia= <?= json_encode($datosimg["evolucionmedia"]); ?>;
 	google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(function(){
    	<?
    	if($tip==="M"){
    		$label="un mes";
    		?>
    		help.graficarv2(serieevolucion,"","grafica2","l","Dias");
    		help.graficarv2(evolucionmedia,"","grafica3","l","Dias");
    	<?
    	}else if($tip==="A"){
    		$label="12 meses";
    		?>
    		help.graficarv2(serieevolucion,"","grafica2","l","Meses");
    		help.graficarv2(evolucionmedia,"","grafica3","l","Meses");
    		<?
    	}
		?>
    	;
    });
 </script>
<div class="container-fluid">
	<div class="row banner ">
		
			<?
				if(isset($perfilbuscado)){
					?>
					<div class="bg-b"></div>
					<div class="text">
						<h4>La Imagen Como Cliente de</h4>
						
						 <h3><?= $datosperfil->Razon_Social?></h3>
					<?
				}else{
					?>
					<div class="bg"></div>
					<div class="text">
					Tu Imagen Como Cliente
					<br>
					
					<?
				}
			?>
			<h5>basado en calificaciones de proveedores en <?=$label?>.</h5> 
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
			  			if($tip==="M"){
			  				?>
			  				<a href="<?=base_URL()?>perfilimgcliente/M/<?=$datosperfil->IDEmpresa ?>"  class="btn btn-primary active">MES</a>
			  				<a href="<?=base_URL()?>perfilimgcliente/A/<?=$datosperfil->IDEmpresa ?>" class="btn btn-secondary ">12 MESES</a>
			  				<?
			  			}else{
			  				?>
			  				<a href="<?=base_URL()?>perfilimgcliente/M/<?=$datosperfil->IDEmpresa ?>"  class="btn btn-secondary ">MES</a>
			  				<a href="<?=base_URL()?>perfilimgcliente/A/<?=$datosperfil->IDEmpresa ?>" class="btn btn-primary active">12 MESES</a>
			  				<?
			  			}
			  		}else{
			  			if($tip==="M"){
			  				?>
			  				<a href="<?=base_URL()?>ImgCliente/M"  class="btn btn-primary active">MES</a>
			  				<a href="<?=base_URL()?>ImgCliente/A" class="btn btn-secondary ">12 MESES</a>
			  				<?
			  			}else{
			  				?>
			  				<a href="<?=base_URL()?>ImgCliente/M"  class="btn btn-secondary ">MES</a>
			  				<a href="<?=base_URL()?>ImgCliente/A" class="btn btn-primary active">12 MESES</a>
			  				<?
			  			}
			  		}
			  		?>
			  				  
			</div>
 		</div>
 	</div>
 </div>
 <div class="container m-t-20 m-b-30 img-perfil">
 	<div class="row">
 		<div class="col-3">
 			<div class="card w-90" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo d-inline-block h-10">Numero de Calificaciones  en <?= $label?></h6>
			    <div class="container-fluid">
			    	<div class="row">
			    		<div class="col-12 card-text text-center numderes m-b-25">
			    			<?= $datosimg["totalCalif"]  ?>
			    		</div>
			    		<div class="col-12">
			    			<?
			    			if(isset($perfilbuscado)){
			    				?>
			    				<a href="<?= base_URL('perfildetallesimagen/Cliente/'.$tip.'/'.$datosperfil->IDEmpresa)?>" class="btn btn-primary">
			    				<?
			    			}else{
			    				?>
			    				<a href="<?= base_URL('detallesimagen/Cliente/').$tip?>" class="btn btn-primary">
			    				<?
			    			}
			    			?>
			    			Ver Detalles</a>
			    		</div>
			    	</div>
			    </div>			    
			  </div>
			</div>
 		</div>
 		<div class="col-3">
 			<div class="card w-90 bg-light" >
			   <div class="card-body text-center">

			    <h6 class="card-title titulo d-inline-block h-10">Variación de Número de calificaciones en <?= $label?></h6>
			    <div class="container-fuid">
			   		<div class="row">						
			   			<div class="col-12 card-text text-center numderes <?= $datosimg["aumento"]["class"] ?> "><?= ((float)$datosimg["aumento"]["num"]<0)?(float)$datosimg["aumento"]["num"]*-1:(float)$datosimg["aumento"]["num"] ?>%</div>
			   			
			   			<div class="col-3 centrar m-t-10">
			   				<?
			   					if((float)$datosimg["aumento"]["num"]>0){
			   						?>
			   							<img class="img-fluid" src="<?=base_URL()?>assets/img/iconos/arrow-up-solid-green.svg" alt="">
			   						<?
			   					}else if((float)$datosimg["aumento"]["num"]<0){
			   						?>
			   						<img class="img-fluid" src="<?=base_URL()?>assets/img/iconos/arrow-down-solid-red.svg" alt="">
			   						<?
			   					}
			   				?>
			   			</div>
			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 		<div class="col-3">
 			<div class="card w-90" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo d-inline-block h-10">Calificación Media  en <?= $label?></h6>
			   	<div class="container-fluid">
			   		<div class="row d-flex align-items-center">
			   			<div class="col-12 card-text text-center numderes p-t-20 m-b-40">
			   				<?= (float)$datosimg["Media"] ?>
			   			</div>
			   		</div>
			   	</div>
			   
			  </div>
			</div>
 		</div>
 		<div class="col-3">
 			<div class="card w-90 bg-light" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo m-b-20 d-inline-block h-10">Variación de la calificación media en <?= $label?></h6>
					
			   			<p class="card-text text-center numderes <?= $datosimg["aumentop"]["class"]  ?> "><?= ((float)$datosimg["aumentop"]["num"]<0)?(float)$datosimg["aumentop"]["num"]*-1:(float)$datosimg["aumentop"]["num"]  ?>%</p>
			   	<div class="container-fuid p-t-10 m-b-5">
			   		<div class="row">
			   			<div class="col-3 centrar">
			   				<?
			   					if((float)$datosimg["aumentop"]["num"]>0){
			   						?>
			   							<img class="img-fluid" src="<?=base_URL()?>assets/img/iconos/arrow-up-solid-green.svg" alt="">
			   						<?
			   					}else if((float)$datosimg["aumentop"]["num"]<0){
			   						?>
			   						<img class="img-fluid" src="<?=base_URL()?>assets/img/iconos/arrow-down-solid-red.svg" alt="">
			   						<?
			   					}
			   				?>
			   			</div>
			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 	</div>
 </div>
  <div class="container img-perfil m-b-40">
 	<div class="row">
 		<div class="col-3">
 			<div class="card w-90 " >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo d-inline-block h-10">Calificación Media sobre la Calidad  en <?= $label?></h6>
			    <div class="container-fluid h-100 d-inline-block ">
			    	<div class="row d-flex align-items-center">
			    		<div class="col-12 card-text text-center numderes m-b-25">
			    			<?= (float)$datosimg["Calidad"]["media"]  ?>
			    		</div>
			    	</div>
			    </div>
			  </div>
			</div>
 		</div>
 		<div class="col-3">
 			<div class="card w-90 bg-light" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo d-inline-block h-10">Variación de calidad en la calificación media en <?= $label?></h6>
					
							<p class="card-text text-center numderes <?= $datosimg["Calidad"]["incremento"]["class"]  ?> "><?= ((float)$datosimg["Calidad"]["incremento"]["num"]<0)?(float)$datosimg["Calidad"]["incremento"]["num"]*-1:(float)$datosimg["Calidad"]["incremento"]["num"]  ?>%</p>
			   			
			   	<div class="container-fuid p-t-10">
			   		<div class="row">
			   			<div class="col-3 centrar">
			   				<?
			   					if((float)$datosimg["Calidad"]["incremento"]["num"]>0){
			   						?>
			   							<img class="img-fluid" src="<?=base_URL()?>assets/img/iconos/arrow-up-solid-green.svg" alt="">
			   						<?
			   					}else if((float)$datosimg["Calidad"]["incremento"]["num"]<0){
			   						?>
			   						<img class="img-fluid" src="<?=base_URL()?>assets/img/iconos/arrow-down-solid-red.svg" alt="">
			   						<?
			   					}
			   				?>
			   			</div>
			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 		<div class="col-3">
 			<div class="card w-90" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo  d-inline-block h-10">Calificación Media de Cumplimiento en <?= $label?></h6>
			     <div class="container-fluid h-100 d-inline-block ">
			    	<div class="row d-flex align-items-center">
			    		<div class="col-12 card-text text-center numderes ">
			    			<?= (float)$datosimg["Cumplimiento"]["media"];  ?>
			    		</div>
			    	</div>
			    </div>
			   

			   
			  </div>
			</div>
 		</div>
 		<div class="col-3">
 			<div class="card w-90 bg-light" >
			   <div class="card-body text-center">
			    <h6 class="card-title titulo ">Variación de cumplimento en la calificación media en <?= $label?></h6>
					<p class="card-text text-center numderes <?= $datosimg['Cumplimiento']['incremento']['class']  ?> "><?= ((float)$datosimg["Cumplimiento"]["incremento"]["num"]<0)?(float)$datosimg["Cumplimiento"]["incremento"]["num"]*-1:(float)$datosimg["Cumplimiento"]["incremento"]["num"]  ?>%</p>						    
			   	<div class="container-fuid p-t-10">
			   		<div class="row">
			   			<div class="col-3 centrar">
			   				<?
			   				if((float)$datosimg["Cumplimiento"]["incremento"]["num"]>0){
			   						?>
			   							<img class="img-fluid" src="<?=base_URL()?>assets/img/iconos/arrow-up-solid-green.svg" alt="">
			   						<?
			   					}else if((float)$datosimg["Cumplimiento"]["incremento"]["num"]<0){
			   						?>
			   						<img class="img-fluid" src="<?=base_URL()?>assets/img/iconos/arrow-down-solid-red.svg" alt="">
			   						<?
			   					}
			   				?>
			   			</div>
			   		</div>
			   	</div>
			  </div>
			</div>
 		</div>
 	</div>
 </div>
 <div class="container-fluid">
 	<div class="row">
 		<div class="col-6 text-center text-blue titulos"><h5>Evolución de  de calificaciones</h5></div>
 		
 	</div>
 </div>
  <div class="container-fluid">
 	<div class="row img-clie">
 		
 		<div class="col-11">
 			<div class="grafica2" id="grafica2">
 				
 			</div>
 		</div>
 	</div>
 </div>
 <div class="container-fluid">
 	<div class="row">
 		<div class="col-6 text-center text-blue titulos"><h5>Evolución de Media de calificaciones</h5></div>
 		
 	</div>
 </div>
 <div class="container-fluid ">
 	<div class="row img-clie">
 		
 		<div class="col-11">
 			<div class="grafica2" id="grafica3">
 				
 			</div>
 		</div>
 	</div>
 </div>