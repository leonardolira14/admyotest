<?
//vdebug($lista);
?>
<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text text-uppercase">
			resultados de busqueda
		</div>
		<div class="banner-resumen"></div>
	</div>
</div>
<div class="container section-result">
	<div class="row m-t-60 m-b-60">
		<?
			if(isset($lista)){
				foreach($lista as $empresa){
					?>
						<div class="col-3 target-result m-b-30">
							<div class="card shadow p-b-20">
								<?php
								if($empresa["Media_cliente"]!==0){
									?>
										<div class="media_cliente btn-circ-left shadow">
										Cliente<br><?=$empresa["Media_cliente"]?>
										</div>
									<?
								}
								?>
								<?php
								if($empresa["Media_proveedor"]!==0){
									?>
									<div class="media_proveedor btn-circ-right shadow">
										Proveedor
										<br><?=$empresa["Media_proveedor"]?>
									</div>
									<?
									}
								?>
								<label class="cont-logo">
									<img src="<?php echo  ($empresa["Logo"]==="") ? base_URL('assets/img/logosEmpresas/foto-no-disponible.jpg') :base_URL('assets/img/logosEmpresas/').$empresa["Logo"]?>" alt="Card image cap">		
								</label>
								
								<div class="card-body">
									<div class="card-title text-center"><?= $empresa["Razon_Social"] ?></div>
								</div>
								<div class="row">
									<div class="col text-center">
										<a href="#" class="addofllow" data-container="body" data-follow='<?=$empresa["num"]?>' data-url="<?= base_url('empresa/follow')?>" data-toggle="popover"  data-content="Seguir">
											<i class="fa fa-location-arrow" aria-hidden="true"></i>
										</a>
									</div>
									<div class="col text-center">
										<a href="<?= base_URL('calificar')?>" data-toggle="popover" data-content="Calificar">
											<i class="fa fa-star" aria-hidden="true "></i>	
										</a>
									</div>
									<div class="col text-center">
										<div class="btnit" lld="<?= $empresa["num"] ?>" llc="<?=base_URL('perfilimgcliente/A/')?><?= $empresa["num"] ?>"  data-toggle="popover"  data-content="Visitar Perfil">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</div>
											
									</div>
								</div>
							</div>
						</div>
					<?
				}
			}
		?>
		
	</div>
</div>
<script>
$(document).on('click','.btnit',function(){
		
		obt={};
		obt["num"]=$(this).attr('lld');
		num=$(this).attr('lld');
		link=$(this).attr('llc')
		ayuda.senddata(obt,"<?=base_URL()?>notificaciones/AddVisita",function(resp){
			console.log(resp)
				ayuda.setlocal("pbn",num);
				//console.log(num);
				ayuda.goto(link);
		})
		
	})</script>

