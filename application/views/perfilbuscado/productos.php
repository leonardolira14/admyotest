<div class="container-fluid">
	<div class="row banner ">
		<div class="bg-b"></div>
			<div class="text">
				<h4>PRODUCTOS Y SERVICIOS de la empresa</h4>
				<h3><?=$datos->Razon_Social?></h3>
			</div>
			<div class="banner-imgclie"></div>
		</div>
	</div>
</div>
<div class="container margin-top-30">
	<div class="row tables ">
		<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>PRODUCTOS Y SERVICIOS</strong></h4></div>
			<?
			if($productos!=false){
				foreach ($productos as $key) {
					?>
					<div class="col-12 col-sm-12 col-md-2 col-xl-2 col-lg-12 ">
						<?
							if($key->Foto==""){
								?>
								<img src="/assets/img/foto-no-disponible.jpg" class="img-fluid" alt="">
								<?
							}else{
								?>
								<img src="/assets/img/logosmarcas/<?=$key->Foto?>" class="img-fluid" alt="">
								<?
							}
						?>
					</div>
					<div class="col-12 col-sm-12 col-md-2 col-xl-2 col-lg-12 tr-table">
						<div class="row">
							<div class="col-12"><?=$key->Producto?></div>
							<div class="col-12"><?=$key->Descripcion?></div>
							<div class="col-12"><?=$key->Promocion?></div>
						</div>
					</div>
					<div class="col-12 hr"></div>
					<?

				}
			}
		?>			
		</div>
</div>