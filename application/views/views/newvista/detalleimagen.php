<?
$rec=json_decode($detallesimagen);
//vdebug($rec->listCalidad);
?>
<script type="text/javascript"> 	
	google.charts.load('current', {'packages':['corechart','bar']});
	google.charts.setOnLoadCallback(function(){
		<?
		for($i=0;$i<=count($rec->listCalidad)-1;$i++){
			?>
			help.graficarv2(<?= json_encode($rec->listCalidad[$i]->serie); ?>,"","calidad-<?=$i?>","cu","");
			<?
		}
		for($i=0;$i<=count($rec->listCumplimiento)-1;$i++){
			?>
			help.graficarv2(<?= json_encode($rec->listCumplimiento[$i]->serie); ?>,"","Cumplimiento-<?=$i?>","cu","");
			<?
		}
		if($tip==="Proveedor"){
			for($i=0;$i<=count($rec->listOferta)-1;$i++){
				?>
				help.graficarv2(<?= json_encode($rec->listOferta[$i]->serie); ?>,"","Oferta-<?=$i?>","cu","");
				<?
			}
		}
		?>    	
	});
</script>
<div class="container-fluid">
	<div class="row banner ">
		
		<?
		if($tip==="Cliente"){
			if(isset($perfilbuscado)){
				?>
				<div class="bg-b"></div>
				<div class="text">
					<h4>Detalles de LA imagen como cliente de</h4>
					<h3><?=$datosperfil->Razon_Social ?></h3>
					<?
				}else{
					?>
					<div class="bg"></div>
					<div class="text">
						Detalles de tu imagen como cliente	
						<br>
						<?
					}
					?>


					<h5>BASADO EN CALIFICACIONES DE PROVEEDORES EN <?= ($fecha==="A") ? "12 meses" :  "un Mes";?></h5> 
					<?

				}else{

					if(isset($perfilbuscado)){
						?>
						<div class="bg-b"></div>
						<div class="text">
							<h4>Detalles de LA imagen como proveedor de</h4>
							<h3><?=$datosperfil->Razon_Social ?></h3>
							<?
						}else{
							?>
							<div class="bg"></div>
							<div class="text">
								Detalles de tu imagen como proveedor	
								<br>
								<?
							}
							?>


							<h5>BASADO EN CALIFICACIONES DE clientes EN <?= ($fecha==="A") ? "12 meses" :  "un Mes";?></h5> 
							<?
						}
						?>

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
								if($fecha==="M"){
									?>
									<a href="<?=base_URL()?>perfildetallesimagen/<?=$tip?>/M/<?=$datosperfil->IDEmpresa ?>"  class="btn btn-primary active">MES</a>
									<a href="<?=base_URL()?>perfildetallesimagen/<?=$tip?>/A/<?=$datosperfil->IDEmpresa ?>" class="btn btn-secondary ">12 MESES</a>
									<?
								}else{
									?>
									<a href="<?=base_URL()?>perfildetallesimagen/<?=$tip?>/M/<?=$datosperfil->IDEmpresa ?>"  class="btn btn-secondary ">MES</a>
									<a href="<?=base_URL()?>perfildetallesimagen/<?=$tip?>/A/<?=$datosperfil->IDEmpresa ?>" class="btn btn-primary active">12 MESES</a>
									<?
								}
							}else{
								if($fecha==="M"){
									?>
									<a href="<?=base_URL()?>detallesimagen/<?=$tip?>/M"  class="btn btn-primary active">MES</a>
									<a href="<?=base_URL()?>detallesimagen/<?=$tip?>/A" class="btn btn-secondary ">12 MESES</a>
									<?
								}else{
									?>
									<a href="<?=base_URL()?>detallesimagen/<?=$tip?>/M"  class="btn btn-secondary ">MES</a>
									<a href="<?=base_URL()?>detallesimagen/<?=$tip?>/A" class="btn btn-primary active">12 MESES</a>
									<?
								}
							}
							?>

						</div>
					</div>
				</div>
			</div>
			<div class="container m-t-50 m-b-30 img-perfil">
				<div class="row">
					<div class="col-6">
						<div class="card w-90" >
							<div class="card-body text-center">
								<h6 class="card-title titulo d-inline-block h-10">Calificación Media  en Calidad</h6>
								<div class="container-fluid">
									<div class="row d-flex align-items-center">
										<div class="col-12 card-text text-center numderes p-t-20 m-b-40">
											<?= $rec->Calidad->media ?>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="col-6">
						<div class="card w-90 bg-light" >
							<div class="card-body text-center">
								<h6 class="card-title titulo d-inline-block h-10">Variación de la calificación media en Calidad</h6>
								<div class="container-fuid">
									<div class="row">

										<div class="col-12 card-text text-center numderes <?= $rec->Calidad->incremento->class?> "><?= $rec->Calidad->incremento->num?></div>

										<div class="col-2 centrar m-t-10">
											<?
											if((float)$rec->Calidad->incremento->num>0){
												?>
												<img class="img-fluid" src="<?=base_URL()?>assets/img/iconos/arrow-up-solid-green.svg" alt="">
												<?
											}else if((float)$rec->Calidad->incremento->num<0){
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
			<div class="container">
				<div class="row">

					<?

			/*
				Inicio de las grafias para calidad
			*/
				for($i=0;$i<=count($rec->listCalidad)-1;$i++) {
					?>
					<div class="col-12 titulo text-center  m-t-60">
						<h5><?= $rec->listCalidad[$i]->Pregunta?></h5>
					</div>
					<div class="col-2 m-t-20">
						<div class="row text-center">

							<div class="col-12 titulo">
								<h6>No de Calificaciones</h6>
							</div>
							<div class="col-12 text-orange">
								<h5 class="text-oranges"><?= $rec->listCalidad[$i]->Totalcalificaciones?></h5>
							</div>
							<div class="col-12 titulo">
								<h6>Respuesta Evalulada</h6>
							</div>
							<div class="col-12 text-oranges">
								<h5><?= $rec->listCalidad[$i]->respuesta?></h5>
							</div>
						</div>
					</div>		
					<div class="col-9" id="calidad-<?= $i?>">

					</div>
					<?
				}
				?>

			</div>
		</div>
		<div class="container m-t-50 m-b-50 img-perfil">
			<div class="row">
				<div class="col-6">
					<div class="card w-90" >
						<div class="card-body text-center">
							<h6 class="card-title titulo d-inline-block h-10">Calificación Media  en Cumplimiento</h6>
							<div class="container-fluid">
								<div class="row d-flex align-items-center">
									<div class="col-12 card-text text-center numderes p-t-20 m-b-40">
										<?= $rec->Cumplimiento->media ?>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card w-90 bg-light" >
						<div class="card-body text-center">
							<h6 class="card-title titulo d-inline-block h-10">Variación de la calificación media en Cumplimento</h6>
							<div class="container-fuid">
								<div class="row">

									<div class="col-12 card-text text-center numderes <?= $rec->Cumplimiento->incremento->class ?> "><?= $rec->Cumplimiento->incremento->num ?></div>

									<div class="col-2 centrar m-t-10">
										<?
										if((float)$rec->Cumplimiento->incremento->num>0)
										{
											?>
											<img class="img-fluid" src="<?=base_URL()?>assets/img/iconos/arrow-up-solid-green.svg" alt="">
											<?
										}else if((float)$rec->Cumplimiento->incremento->num<0){
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
		<div class="container">
			<div class="row m-b-50">

				<?

			/*
				Inicio de las grafias para calidad
			*/
				for($i=0;$i<=count($rec->listCumplimiento)-1;$i++) {
					?>
					<div class="col-12 titulo text-center  m-t-60">
						<h5><?= $rec->listCumplimiento[$i]->Pregunta?></h5>
					</div>
					<div class="col-2 m-t-20">
						<div class="row text-center">

							<div class="col-12 titulo">
								<h6>No de Calificaciones</h6>
							</div>
							<div class="col-12 text-orange">
								<h5 class="text-oranges"><?= $rec->listCumplimiento[$i]->Totalcalificaciones?></h5>
							</div>
							<div class="col-12 titulo">
								<h6>Respuesta Evalulada</h6>
							</div>
							<div class="col-12 text-oranges">
								<h5><?= $rec->listCumplimiento[$i]->respuesta?></h5>
							</div>
						</div>
					</div>		
					<div class="col-9" id="Cumplimiento-<?= $i?>">

					</div>
					<?
				}
				?>

			</div>
		</div>
<?
	if($tip==="Proveedor")
	{
			?>
			<div class="container m-t-50 m-b-50 img-perfil">
				<div class="row">
					<div class="col-6">
						<div class="card w-90" >
							<div class="card-body text-center">
								<h6 class="card-title titulo d-inline-block h-10">Calificación Media  en Oferta</h6>
								<div class="container-fluid">
									<div class="row d-flex align-items-center">
										<div class="col-12 card-text text-center numderes p-t-20 m-b-40">
											<?= $rec->Oferta->media ?>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="col-6">
						<div class="card w-90 bg-light" >
							<div class="card-body text-center">
								<h6 class="card-title titulo d-inline-block h-10">Variación de la calificación media en Oferta</h6>
								<div class="container-fuid">
									<div class="row">

										<div class="col-12 card-text text-center numderes <?= $rec->Oferta->incremento->class?> "><?= $rec->Oferta->incremento->num?></div>
									

										<div class="col-2 centrar m-t-10">
										<?
										if((float)$rec->Oferta->incremento->num>0){
											?>
											<img class="img-fluid" src="<?=base_URL()?>assets/img/iconos/arrow-up-solid-green.svg" alt="">
											<?
										}else if((float)$rec->Oferta->incremento->num<0){
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
		<div class="container">
			<div class="row m-b-50">

				<?

			/*
				Inicio de las grafias para calidad
			*/
				for($i=0;$i<=count($rec->listOferta)-1;$i++) {
					?>
					<div class="col-12 titulo text-center  m-t-60">
						<h5><?= $rec->listOferta[$i]->Pregunta?></h5>
					</div>
					<div class="col-2 m-t-20">
						<div class="row text-center">

							<div class="col-12 titulo">
								<h6>No de Calificaciones</h6>
							</div>
							<div class="col-12 text-orange">
								<h5 class="text-oranges"><?= $rec->listOferta[$i]->Totalcalificaciones?></h5>
							</div>
							<div class="col-12 titulo">
								<h6>Respuesta Evalulada</h6>
							</div>
							<div class="col-12 text-oranges">
								<h5><?= $rec->listOferta[$i]->respuesta?></h5>
							</div>
						</div>
					</div>		
					<div class="col-9" id="Oferta-<?= $i?>">

					</div>
					<?
				}
				?>

			</div>
		</div>
		<?
	}
