<div class="container-fluid">
	<div class="row banner ">
		<div class="bg-b"></div>
			<div class="text">
				<h4>Asociaciones de la empresa</h4>
				<h3><?=$datos->Razon_Social?></h3>
			</div>
			<div class="banner-imgclie"></div>
		</div>
	</div>
</div>

<div class="container margin-top-30">
	<div class="row tables ">
		<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>ASOCIACIONES</strong></h4></div>
		<?
			if($asociaciones!=false){
				foreach ($asociaciones as $key) {
					?>
					<div class="col-12 tr-table"><?= $key->Asociacion?></div>
					<div class="col-12 tr-table"><a href="http://<?= $key->Web?>" target="_blank">Sitio Web: <?= $key->Web?></a></div>
					<div class="col-12 hr"></div>
					<?

				}
			}
		?>					
		</div>
</div>