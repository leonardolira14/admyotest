<?
//vdebug($notificaciones);
?>
<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text">
			GESTIÓN DE NOTIFICACIONES
		</div>
		<div class="banner-imgdats"></div>
	</div>
</div>
<div class="container-fluid margin-top-40 menu-tab" id="Dats-Genral">
	<div class="row">
		<a  href="<?= base_URL()?>datosempresa" class="col-12  col-md-2 col-lg-2 col-xl-2  text-center link" >
			<div class="tab ">
				<i class="fa fa-home ibtn bgblue-1  white"></i>
				DATOS GENERALES
			</div>
		</a>
		<a href="<?= base_URL()?>datoscontacto" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link"  >
			<div class="tab">
				<i class="fa fa-phone-square ibtn bgblue-1 white"></i>
				DATOS DE CONTACTO
			</div>
		</a>
		<a href="<?= base_URL()?>productosyservicios" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link"  >
			<div class="tab ">
				<i class="fa fa-archive ibtn bgblue-1 white "></i>
				PRODUCTOS Y SERVICIOS
			</div>
		</a>
		<a href="<?= base_URL()?>certificaciones" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link"  >
			<div class="tab ">
				<i class="fa fa-certificate ibtn bgblue-1 white"></i>
				CERTIFICACIONES
			</div>
		</a>
		<a href="<?= base_URL()?>asociaciones" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link"  >
			<div class="tab ">
				<i class="fa fa-handshake-o ibtn bgblue-1 white"></i>
				ASOCIACIONES
			</div>
		</a>
		<a href="<?= base_URL()?>notificaciones" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link" l >
			<div class="tab current">
				<i class="fa fa-bell ibtn bgblue-1 white"></i>
				NOTIFICACIONES
			</div>
		</a>
	</div>
</div>

<div class="container m-t-40">
	<div class="row">
		<div class="col-5">
			<div class="card">
			  <div class="card-header bgblue-1 text-white">
					<h5>Novedades en Admyo</h5>
				</div>
				<div class="card-body container-fluid">
					<div class="row ">
						<div class="col-12 ">
							Sin Novedades
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-7">
			<div class="card">
				<div class="card-header bgblue-1 text-white">
					<h5>Notificaciones</h5>
				</div>
				<div class="card-body container-fluid">
					<div class="row ">
						<?
						if($notificaciones!==""){
							foreach ($notificaciones as $notificacion) {
								?>
								<div class="col-12 cont-not <?= $notificacion['class']?>">
									<div class="row d-flex align-items-center">
										<div class="col-12 text-right">
											<small class="text-muted "><?= $notificacion["Fecha"]?></small>
										</div>
										<div class="col-2">
											<label class="cont-img">
												<img src="<?= ($notificacion['Logo']==='')?base_URL('assets/img/logosEmpresas/foto-no-disponible.jpg'):base_URL('assets/img/logosEmpresas/').$notificacion['Logo'] ?>"  alt="">
											</label>
										</div>
										<div class="col-10">
											<?= $notificacion["leyenda"]?>
											<div class="row m-t-40">
												<div class="col-6 text-center">
													<a href="<?= base_URL('calificar')?>" class="btn btn-outline-primary">Calificar</a>
												</div>
												<div class="col-6 text-center">
													<a href="<?= base_URL('perfilimgcliente/A/').$notificacion['Num']?>" class="btn btn-outline-primary">Visitar Perfil</a>
												</div>
											</div>
										</div>


										<hr>
									</div>
								</div>

								<?
							}
						}
						
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>