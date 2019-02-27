
<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text">
			MIS <?= $misque?>
		</div>
		<div class="banner-resumen"></div>
	</div>
</div>
<?
	if($misque==="Proveedores"){
		?>
		<div class="container-fluid margin-top-30 menu-tab">
	<div class="row">
		<a href="<?= base_URL() ?>resumenproveedor" class="col-12  col-md-4 col-lg-4 col-xl-4  text-center link">
		
			<div class="tab ">
				<i class="fa fa-line-chart ibtn bgblue-1 white text-uppercase"></i>
					RESUMEN
			</div>
		</a>
		<a href="<?= base_URL() ?>lista<?= $misque ?>" class="col-12 col-md-4 col-lg-4 col-xl-4  text-center link">
			<div class="tab current">
				<i class="fa fa-users ibtn bgblue-1 white text-uppercase"></i>
					MIS <?= $misque ?>
			</div>
		</a>
		<a href="<?= base_URL() ?>realizadas<?= $misque ?>" class="col-12 col-md-4 col-lg-4 col-xl-4  text-center link">
			<div class="tab ">
				<i class="fa fa-puzzle-piece ibtn bgblue-1 white text-uppercase"></i>
					CALIFICACIONES REALIZADAS
			</div>
		</a>
	</div>
</div>
	
		<?
	}else{
		?>
			<div class="container-fluid m-t-30 m-b-30 menu-tab">
	<div class="row">
		<a href="<?= base_URL() ?>resumencliente" class="col-12  col-md-4 col-lg-4 col-xl-4  text-center link">
		
			<div class="tab ">
				<i class="fa fa-line-chart ibtn bgblue-1 white"></i>
					RESUMEN
			</div>
		</a>
		<a href="<?= base_URL() ?>listaclientes" class="col-12 col-md-4 col-lg-4 col-xl-4  text-center link">
			<div class="tab current">
				<i class="fa fa-users ibtn bgblue-1 white"></i>
					MIS <?= $misque?>
			</div>
		</a>
		<a href="<?= base_URL() ?>realizadasclientes" class="col-12 col-md-4 col-lg-4 col-xl-4  text-center link">
			<div class="tab ">
				<i class="fa fa-puzzle-piece ibtn bgblue-1 white"></i>
					CALIFICACIONES REALIZADAS
			</div>
		</a>
	</div>
</div>
		<?
	}
?>
<div class="container margin-top-30">
	<div>
		
		<div class="row margin-top-30">
			
				<? 
				foreach ($lista as $key) {
					?>
					<div class="col-12 m-b-50">
				<div class="card w-100 shadow bg-white rounded">
					<div class="card-body">
						<div class="media">
							<label for="" class="mr-3 label-logo">
								<?
					if( $key["Logo"]==""){
						?>
							<img  src="<?= base_url() ?>/assets/img/foto-no-disponible.jpg"  alt="">
						<?
					}else{
						?>
						<img  src="<?= base_url() ?>/assets/img/logosEmpresas/<?= $key['Logo'] ?>"  alt="">
						<?
					}
					?>
					</label>
							
						  <div class="media-body">
							  <div class="row">
							  	<div class="col-7">
							  		<div class="row">
							  			<div class="col-12 ">Razon Social:<strong class="titulo"> <?= $key["Razon_Social"] ?></strong></div>	
										<div class="col-12 ">Nombre Comercial:<strong class="titulo"> <?= $key["Nombre_Comer"] ?></strong></div>	
										<div class="col-12 ">RFC:<strong class="titulo"> <?= $key["RFC"] ?></strong></div>	
							  		</div>
							  	</div>
							  	<div class="col-12  col-md-5 col-lg-5 col-xl-5 centrar-vertical-contend" >
								<div class="row">
									<div class="col-4 text-center" >
										<i class="fa fa-user-times bgblue-1 white iconos_botones" lld="visble-empre" llc="" data-toggle="popover" title="Quitar Relación C/P"></i>
									</div>
									<div class="col-4 text-center" >
										<i class="fa fa-phone bgblue-1 white iconos_botones" lld="visble-empre" llc="" data-toggle="popover" title="Contactar"></i>
									</div>
									<div class="col-4 text-center" >
										<i class="fa fa-eye  bgblue-1 white iconos_botones link" llc="/PerfilBuscado/perfil/<?= $key["num"] ?>" data-toggle="popover" title="Visitar Perfil" ></i>
										
									</div>
								</div>
							</div>
								
								
							</div>
						  </div>
						</div>
					</div>
				</div>
			</div>
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