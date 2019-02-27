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
<div class="container margin-top-40" id="Dats-Genral">
	<div class="row">
		<a class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link" href="<?=base_URL()?>PerfilBuscado/datosempresa/<?=$num?>" >
			<div class="tab ">
				<i class="fa fa-home ibtn bgblue-1  white"></i>
				GENERAL
			</div>
		</a>
		<a class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center  link" href="<?=base_URL()?>PerfilBuscado/contacto/<?=$num?>" >
			<div class="tab current">
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
		<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>DATOS DE CONTACTO </strong></h4></div>
		<div class="row tablesd">
				<div class="col-12 tr-table">DIRECCIÓN FISCAL</div>
				<div class="col-12 tr-table">
					<div class="row">
						<div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"><i class="fa fa-map-marker fa-2x ibtn bgblue-1 white"></i></div>
						<div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-6">
							<?= $datos->Direc_Fiscal.", Col. ".$datos->Colonia.", ".$datos->Ciudad.", ".$datos->Estado ?>
						</div>
						<div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"><i class="fa fa-globe fa-2x ibtn bgblue-1 white"></i></div>
						<div class="col-10 col-sm-10 col-md-2 col-lg-2 col-xl-2">
							<?= $datos->Pais?>
						</div>
					</div>
				</div>
			<div class="col-12 tr-table">PÁGINA WEB</div>
			<div class="col-12 tr-table">
					<div class="row">
						<div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2"><i class="fa fa-globe fa-2x ibtn bgblue-1 white"></i></div>
						<div class="col-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
							<a href="http://<?= $datos->Sitio_Web?>" target="_blank"><?= $datos->Sitio_Web?></a>
						</div>
						
				</div>
			</div>
		</div>

	</div>
</div>
