<div class="container-fluid">
	<div class="row banner ">
		<div class="bg-b"></div>
			<div class="text">
				<h4>CERTIFICACIONES de la empresa</h4>
				<h3><?=$datos->Razon_Social?></h3>
			</div>
			<div class="banner-imgclie"></div>
		</div>
	</div>
</div>
<div class="container margin-top-30">
	<div class="row tables ">
		<div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>CERTIFICACIONES</strong></h4></div>
		<?
			if($certificaciones!=false){
				foreach ($certificaciones as $key) {
					?>
					<div class="col-12 tr-table">Nombre de Certificación: <?= $key->Norma?></div>
					<div class="col-12 tr-table">Fecha de Certificación: <?= $key->Fecha?></div>
					<div class="col-12 tr-table">Calificación: <?= $key->Calif?></div>
					<div class="col-12 tr-table">Ver <a href="/asserts/certificaciones/<?= $key->Archivo?>" target="_blank"><?= $key->Archivo?></a></div>
					<div class="col-12 hr"></div>
					<?

				}
			}
		?>					
		</div>
</div>