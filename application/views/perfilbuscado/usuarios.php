<div class="container-fluid">
	<div class="row banner ">
		<div class="bg-b"></div>
			<div class="text">
				<h4>usuarios de la empresa</h4>
				<h3><?=$datos->Razon_Social?></h3>
			</div>
			<div class="banner-imgclie"></div>
		</div>
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
			<div class="tab ">
				<i class="fa fa-phone-square ibtn bgblue-1 white"></i>
				CONTACTO
			</div>
		</a>
		<a class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center  link" href="<?=base_URL()?>PerfilBuscado/usuarios/<?=$num?>" >
			<div class="tab current">
				<i class="fa fa-user ibtn bgblue-1 white "></i>
				USUARIO
			</div>
		</a>
		
	</div>
</div>
<div class="container margin-top-30">
	<div class="row tables ">
		<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>USUARIOS</strong></h4></div>
		<?
		if($usuarios!=false){
			foreach ($usuarios as $key) {
				?>
					<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 tr-table"><?= $key->Nombre." ".$key->Apellidos?></div>
					<div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 tr-table"><?=$key->Correo?></div>
					<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 tr-table"><?=$key->Puesto?></div>
					<div class="col-12 hr"></div>
				<?
			}
		}
		?>
</div>
</div>
