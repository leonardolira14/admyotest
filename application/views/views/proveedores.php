<div class="container margin-top-30">
	<div class="row">
		<div class=" col-12 titulos  text-center margin-bottom-30"><h4><strong>CALIFICACIONES RECIBIDAS DE PROVEEDORES</strong></h4></div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link" llc="/perfil/calificacionesrecibidasp">
			<div class="tab ">
				<i class="fa fa-line-chart ibtn bgblue-1 white"></i>
				TOTALES
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link" llc="/perfil/proveedores">
			<div class="tab current">
				<i class="fa fa-users ibtn bgblue-1 white"></i>
				PROVEEDORES
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4  text-center link" llc="/perfil/calificacionesP">
			<div class="tab">
				<i class="fa fa-puzzle-piece ibtn bgblue-1 white"></i>
				CALIFICACIONES
			</div>
		</div>
	</div>
</div>
<div class="container margin-top-30">
	<div>
		<div class=" col-12 titulos  text-center margin-bottom-30"><h4><strong>Gestión de Proveedores</strong></h4></div>
		<div class="row margin-top-30">
				<? 
				foreach ($proveedores as $key) {
					if( $key["Logo"]==""){
						?>
							<div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2" style="margin: 0 auto;">
								<img src="<?= base_url() ?>/assets/img/foto-no-disponible.jpg" class="img-fluid" alt="">
							</div>
						<?
					}else{
						?>
							<div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2" style="margin: 0 auto;">
								<img src="<?= base_url() ?>/assets/img/logosEmpresas/<?= $key['Logo'] ?>" class="img-fluid" >
							</div>
						<?
					}
					?>
					<div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 " >
						<div class="row">
							<div class="col-12 ">Razon Social:<strong> <?= $key["Razon_Social"] ?></strong></div>	
							<div class="col-12 ">Nombre Comercial:<strong> <?= $key["Nombre_Comer"] ?></strong></div>	
							<div class="col-12 ">RFC:<strong> <?= $key["RFC"] ?></strong></div>	
							<div class="col-12 "><strong><?= $key["Visible"] ?></strong></div>	
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 centrar-vertical-contend" >
						<div class="row">
							<?
							if($key["Visible"]=="Invisible"){
								?>
								<div class="col-6 " >
								<i class="fa fa-star bgblue-1 white iconos_botones" lld="visble-empre" llc="<?= $key["num"] ?>" data-toggle="popover" title="Hacer Visible"></i>
							</div>
								<?

							}else{
								?>
								<div class="col-6 " >
								<i class="fa fa-star-o bgblue-1 white iconos_botones" lld="invisble-empre" llc="<?= $key["num"] ?>" data-toggle="popover" title="Ocultar"></i>
							</div>
								<?
							}
							?>
							
							<div class="col-6 text-left" >
								<i class="fa fa-eye  bgblue-1 white iconos_botones link" llc="/PerfilBuscado/perfil/<?= $key["num"] ?>" data-toggle="popover" title="Visitar Perfil" ></i>
								
							</div>
						</div>
					</div>
					<div class="col-12 hr"></div>		
					<?
				} ?>
		</div>
		
	</div>
</div>
<script>
	$(function () {
		$('[data-toggle="popover"]').popover({ trigger: "hover focus" });
		
})
$(document).on('click','i[lld="visble-empre"]',function(){
	obt={};
	obt["empresa"]=$(this).attr("llc");
	obt["status"]="1";
	obt["tipo"]="Proveedor";
	ayuda.senddata(obt,"/perfil/VisibleEmpre",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							ayuda.goto("/perfil/proveedores");
						}else{
							$("#add-giro").iziModal("close")
							$("#msjerror").iziModal('setSubtitle',lin.datos);
							mserror();
						}
						
					})
})
$(document).on('click','i[lld="invisble-empre"]',function(){
	obt={};
	obt["empresa"]=$(this).attr("llc");
	obt["status"]="0";
	obt["tipo"]="Proveedor";
	ayuda.senddata(obt,"/perfil/VisibleEmpre",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							ayuda.goto("/perfil/proveedores");
						}else{
							$("#add-giro").iziModal("close")
							$("#msjerror").iziModal('setSubtitle',lin.datos);
							mserror();
						}
						
					})
})
</script>