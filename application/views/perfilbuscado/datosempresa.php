<div class="container-fluid">
	<div class="row banner ">
		<div class="bg-b"></div>
			<div class="text">
				<h4>datos de la empresa</h4>
				<h3><?=$datos->Razon_Social?></h3>
			</div>
			<div class="banner-imgclie"></div>
		</div>
	</div>
</div>

<div class="container margin-top-40" id="Dats-Genral">
	<div class="row">
		<a class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link" href="<?=base_URL()?>PerfilBuscado/datosempresa/<?=$num?>" >
			<div class="tab current">
				<i class="fa fa-home ibtn bgblue-1  white"></i>
				GENERAL
			</div>
		</a>
		<a class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center  link" href="<?=base_URL()?>PerfilBuscado/contacto/<?=$num?>" >
			<div class="tab">
				<i class="fa fa-phone-square ibtn bgblue-1 white"></i>
				CONTACTO
			</div>
		</a>
		<a class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center  link" href="<?=base_URL()?>PerfilBuscado/usuarios/<?=$num?>" >
			<div class="tab ">
				<i class="fa fa-user ibtn bgblue-1 white "></i>
				USUARIO
			</div>
		</a>
		
	</div>
</div>
<div class="container margin-top-30">
	<div class="row tables ">
		<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>DATOS GENERALES DE LA EMPRESA </strong></h4></div>
		<div class="col-12 margin-top-10">
			<div class="row" id="listClie">
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 centrar-vertical-contend">
					<? 
						if($datos->Logo==""){
							?>
							<img src="<?=base_URL('assets/img/foto-no-disponible.jpg')?>" class="img-fluid log-empes" alt="<?=$datos->Razon_Social?>">
							<?
						}else{
							?>
							<img src="<?= base_URL('assets/img/logosEmpresas/');?><?= $datos[0]->Logo?>" class="img-fluid log-empes" alt="<?=$datos->Razon_Social?>">
							<?
						}
					?>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="padding: 5em 10px;">
					<div class="row">	
						<div class="col-10" style="margin: 0 auto;">
							<div class="row tablesd">
								<div class="col-12">
									<div class="row">
									<div class="col-2 tr-table"><i class="fa fa-circle fa-2x ibtn bgblue-1 white"></i></div><div class="col-10 tr-table"><?=$datos->Razon_Social?></div>
										
									</div>
								</div>
								<div class="col-12">
									<div class="row">
											<div class="col-2 tr-table"><i class="fa fa-registered fa-2x ibtn bgblue-1 white"></i></div><div class="col-10 tr-table"><?=$datos->Nombre_Comer?></div>
									</div>
								</div>
								<div class="col-12">
									<div class="row">
										<div class="col-2 tr-table"><i class="fa fa-users fa-2x ibtn bgblue-1 white"></i></div><div class="col-10 tr-table"><?=$datos->NoEmpleados?></div>
									</div>
								</div>
						
						<div class="col-12">
									<div class="row">
											<div class="col-2 tr-table"><i class="fa fa-usd fa-2x ibtn bgblue-1 white "></i></div><div class="col-10 tr-table"><?=$datos->FacAnual?></div>

									</div>
								</div>
						
					</div>
						</div>					
					</div>	
				</div>
			</div>										
		</div>
	</div>
</div>
<div class="container margin-top-30 margin-bottom-30">
	<div class="row  ">

		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-bottom-30">
			<div class="row tables">
				<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>GIROS </strong></h4></div>
				<?
					foreach ($giros as $key ) {
						?>
						<div class="col-12 tr-table"><?=$key["Giro"]?></div>
						<?
					}
				?>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-bottom-30">
				<div class="row tables">
				<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>MARCAS </strong></h4></div>
				
				<?
				if($marcas!=false){


					foreach ($marcas as $key ) {
						if($key->logo==""){
							?>
							<div class="col-3 tr-table">
								<img src="/assets/img/foto-no-disponible.jpg" class="img-fluid" alt="">
							<?
						}else{
							?>
							<div class="col-3 tr-table">
								<img src="/assets/img/logosmarcas/<?=$key->logo?>" class="img-fluid" alt="">
							<?
						}
						?>
						</div>
						<div class="col-9 tr-table centrar-vertical-contend"><?=$key->Marca?></div>
						<?
					}
					}
				?>
			</div>
		</div>
	</div>
</div>