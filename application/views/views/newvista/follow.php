<?
//vdebug($datosempresas[0]);
?>
<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text text-uppercase">
			Empresas en seguimiento
		</div>
		<div class="banner-resumen"></div>
	</div>
</div>
<div class="container m-t-50 m-b-50">
	<div class="row">
		<?	
			if($datosempresas!==false)
			{
				foreach ($datosempresas as $empresa) {
					?>
					<div class="col-12 m-t-20 m-b-20 card shadow">
						<div class="row d-flex align-items-center">
							<div class="card-title col-12 bgblue p-b-10 p-t-10">
								<h4 class="text-center  text-white text-uppercase"><?= $empresa["razon_social"]?></h4>
							</div>

							<div class="col-2">
								<img class="card-img-top" src="<?= ($empresa["Logo"]==='')?base_url().'assets/img/foto-no-disponible.jpg':base_url().'assets/img/logosEmpresas/'.$empresa["Logo"];?>" alt="Card image cap">
							</div>
							<div class="col-10">
								<div class="row ">	
									<div class="col-5">
										<h5 class="text-muted text-center text-oranges">Imagen como cliente</h5>
										<div class="row">
											<div class="col-6 p-b-20 p-t-20">	
												<h6 class="  text-blue m-b-20 text-center"> Calidad</h6>
												<div class="row">
													<div class="col-6 text-right "><small><?= $empresa["imagencliente"]["Calidad"]["media"]?> </small></div>
													<div class="col-6 text-left <?= $empresa["imagencliente"]["Calidad"]["incremento"]["class"]?>"><small><strong>
																
														<?= $empresa["imagencliente"]["Calidad"]["incremento"]["num"]?>

													</strong> <i class="fa fa-arrow-up" aria-hidden="true"></i> </small></div>
												</div>							
											</div>
											<div class="col-6 p-b-20 p-t-20">	
												<h6 class="  text-blue m-b-20 text-center "> Cumplimiento</h6>
												<div class="row">
													<div class="col-6 text-right"><small><?= $empresa["imagencliente"]["Cumplimiento"]["media"]?> </small></div>
													<div class="col-6 text-left <?= $empresa["imagencliente"]["Cumplimiento"]["incremento"]["class"]?>"><small><strong><?= $empresa["imagencliente"]["Cumplimiento"]["incremento"]["num"]?></strong> <i class="fa fa-arrow-up" aria-hidden="true"></i></small></div>
												</div>							
											</div>
										</div>
									</div>
							
									<div class="col-7">
										<h5 class="text-muted text-center text-oranges">Imagen como proveedor</h5>
										<div class="row">
											<div class="col-4 p-b-20 p-t-20">	
												<h6 class="  text-blue m-b-20 text-center "> Calidad</h6>
												<div class="row">
													<div class="col-6 text-right">
														<small>
															<?= $empresa["imagenproveedor"]["Calidad"]["media"]?> 
														</small>
													</div>
													<div class="col-6 text-left <?= $empresa["imagenproveedor"]["Calidad"]["incremento"]["class"]?>">
														<small>
															<strong>
																<?= $empresa["imagenproveedor"]["Calidad"]["incremento"]["num"]?>
															</strong> 
															<i class="fa fa-arrow-up" aria-hidden="true"></i>
														</small>
													</div>
												</div>							
											</div>
											<div class="col-4 p-b-20 p-t-20">	
												<h6 class="  text-blue m-b-20 text-center"> Cumplimiento</h6>
												<div class="row">
													<div class="col-6 text-right"><small><?= $empresa["imagenproveedor"]["Cumplimiento"]["media"]?></small></div>
													<div class="col-6 text-left  <?= $empresa["imagenproveedor"]["Cumplimiento"]["incremento"]["class"]?>"><small><strong><?= $empresa["imagenproveedor"]["Cumplimiento"]["incremento"]["num"]?></strong> <i class="fa fa-arrow-up" aria-hidden="true"></i> </small></div>
												</div>							
											</div>
											<div class="col-4 p-b-20 p-t-20">	
												<h6 class="  text-blue m-b-20 text-center"> Oferta</h6>
												<div class="row">
													<div class="col-6 text-right"><small><?= $empresa["imagenproveedor"]["Oferta"]["media"]?> </small></div>
													<div class="col-6 text-left <?= $empresa["imagenproveedor"]["Oferta"]["incremento"]["class"]?>"><small><strong><?= $empresa["imagenproveedor"]["Oferta"]["incremento"]["num"]?></strong>  <i class="fa fa-arrow-up" aria-hidden="true"></i></small></div>
												</div>							
											</div>
										</div>
									</div>
								</div>
								<div class="row">	
									<div class="col-5">
										<h5 class="text-muted text-center text-oranges">Riesgo de clientes</h5>
										<div class="row">
											<div class="col-6 p-b-20 p-t-20">	
												<h6 class="  text-blue m-b-20 text-center"> Calidad</h6>
												<div class="row">
													<div class="col-4 text-center text-success">
														<small>
															Me <br>
															<?= $empresa["riesgocliente"]["mejoradoscalidad"]["num"]?> 
														</small>
													</div>
													<div class="col-4 text-center  text-blue"><small>Ma <br><?= $empresa["riesgocliente"]["mantenidoscalidad"]["num"]?> </small></div>
													<div class="col-4 text-center text-red"><small>Em<br><?= $empresa["riesgocliente"]["empeoradoscalidad"]["num"]?> </small></div>
													
												</div>							
											</div>
											<div class="col-6 p-b-20 p-t-20">	
												<h6 class="  text-blue m-b-20 text-center"> Cumplimiento</h6>
												<div class="row">
													<div class="col-4 text-center text-success"><small>Me.<br><?= $empresa["riesgocliente"]["mejoradoscumplimiento"]["num"]?> </small></div>
													<div class="col-4 text-center text-blue"><small>Ma. <br><?= $empresa["riesgocliente"]["mantenidoscumplimiento"]["num"]?> </small></div>
													<div class="col-4 text-center text-red"><small>Em. <br><?= $empresa["riesgocliente"]["empeoradoscumplimiento"]["num"]?> </small></div>
												</div>							
											</div>
										</div>
									</div>
									
									<div class="col-7">
										<h5 class="text-muted text-center text-oranges">Riesgo de proveedores</h5>
										<div class="row">
											<div class="col-4 p-b-20 p-t-20">	
												<h6 class="  text-blue m-b-20 text-center"> Calidad</h6>
												<div class="row">
													<div class="col-4 text-center text-success"><small>Me. <br><?= $empresa["riesgoproveedor"]["mejoradoscalidad"]["num"]?> </small></div>
													<div class="col-4 text-center text-blue"><small>Ma. <br> <?= $empresa["riesgoproveedor"]["mantenidoscalidad"]["num"]?> </small></div>
													<div class="col-4 text-center text-red"><small>Em. <br><?= $empresa["riesgoproveedor"]["empeoradoscalidad"]["num"]?> </small></div>
												</div>							
											</div>
											<div class="col-4 p-b-20 p-t-20">	
												<h6 class="  text-blue m-b-20 text-center"> Cumplimento</h6>
												<div class="row">
													<div class="col-4 text-center text-success"><small>Ma<br><?= $empresa["riesgoproveedor"]["mejoradoscumplimiento"]["num"]?> </small></div>
													<div class="col-4 text-center text-blue"><small>Me <br><?= $empresa["riesgoproveedor"]["mantenidoscumplimiento"]["num"]?> </small></div>
													<div class="col-4 text-center text-red"><small>Em <br><?= $empresa["riesgoproveedor"]["empeoradoscumplimiento"]["num"]?> </small></div>
												</div>							
											</div>
											<div class="col-4 p-b-20 p-t-20">	
												<h6 class="  text-blue m-b-20 text-center"> Oferta</h6>
												<div class="row">
													<div class="col-4 text-center text-success"><small>Me <br><?= $empresa["riesgoproveedor"]["mejoradosoferta"]["num"]?> </small></div>
													<div class="col-4 text-center text-blue"><small>Ma <br><?= $empresa["riesgoproveedor"]["mantenidosoferta"]["num"]?> </small></div>
													<div class="col-4 text-center text-red"><small>Em <br><?= $empresa["riesgoproveedor"]["empeoradosoferta"]["num"]?> </small></div>
												</div>							
											</div>
										</div>
									</div>
								</div>	
							</div>


						</div>

						<div class="row m-t-30 m-b-30">
							<div class="col-12">
								<div class="col-12">
		<small>Acotacones: Ma="Mantenidos", Me="Mejorados", Em="Empeorados"</small>
	</div>
							</div>
						</div>
						<div class="row d-flex justify-content-end  bgblue">
							<div class="btn-group" role="group" aria-label="Basic example">
								<a href="<?= base_URL('bajafollow/').$empresa["num"]?>" class="btn btn-primary"><i class="fa fa-ban" aria-hidden="true"></i> Dejar de seguir</a>
								<a href="<?= base_URL('calificar/')?>" class="btn btn-primary"> <i class="fa fa-star" aria-hidden="true"></i> Calificar</a>
								<div lld="<?=$empresa["numempresa"]?>" llc="<?=base_URL('perfilimgcliente/A/').$empresa["numempresa"]?>" class="btn btn-primary float-right link"><i class="fa fa-user" aria-hidden="true"></i> Ver Perfil</div>
							</div>
						</div>
					</div>
					<?
				}
			}
		?>
		
	</div>
</div>

