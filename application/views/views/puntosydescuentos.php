<style>
	.f-1{
		background-color: rgba(0, 0, 0, 0);
		background-repeat: no-repeat;
		background-image: url(../assets/img/slider/como-funciona-admyo-2.jpg);
		background-size: cover;
		background-position: center center;
		height: 400px;
		opacity: 1;
		visibility: inherit;
	}
	

</style>
<script>
	$(document).on("click",'div[data-toggle="tab"]',function () {
		$("div[data-toggle='tab']").removeClass("current")
		$(this).addClass("current");
		$(".tab-pane").removeClass("show active")
	 $($(this).attr("llc")).tab('show');
	})
</script>
<div class="container-fluid">
	<div class="row f-1">

		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-bottom-30 div-txt text-center">
			<div class="div-1 align-middle">PUNTOS Y </div>
			<div class="div-2 align-middle">DESCUENTOS</div>
		</div>
		<div class="col-6 div-imgd">
			<img src="<?= base_url(); ?>assets/img/slider/fondos-seccion-imagenes-footer.png"  class="img-fluid">
		</div>

	</div>	
</div>
<div class="container margin-top-30">
	<div class="row" >
		
		<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 text-center tab current"   id="home-tab" data-toggle="tab" llc="#home" role="tab" aria-controls="home" aria-expanded="true">
			<i class="fa fa-map-marker ibtn bgblue-1 white"></i>
		CALIFICACIONES
		</div>
		<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 text-center tab"  id="dperfil-tab" data-toggle="tab" llc="#dperfil" role="tab" aria-controls="profile" aria-expanded="true">
		<i class="fa fa-map-marker ibtn bgblue-1 white"></i>
				DATOS PERFILES
		</div>
		<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 text-center tab"  id="ranking-tab" data-toggle="tab" llc="#ranking" role="tab" aria-controls="profile" aria-expanded="true">
		<i class="fa fa-map-marker ibtn bgblue-1 white"></i>
				RANKING
		</div>
		<div class="col-12 col-xs-12 col-md-3 col-lg-3 col-xl-3 text-center tab"  id="recomendar-tab" data-toggle="tab" llc="#recomendar" role="tab" aria-controls="profile" aria-expanded="true">
		<i class="fa fa-map-marker ibtn bgblue-1 white"></i>
				RECOMENDAR
		</div>		
			<div class="col-12 tab-content margin-bottom-30 shadow-1" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					<center>
					<img src="<?= base_url(); ?>/assets/img/Puntos-y-descuentos/admyo-calificacionesEmpresas.png" class="img-fluid align-center">
					</center>
				</div>
				<div class="tab-pane fade " id="dperfil" role="tabpanel" aria-labelledby="dperfil-tab">
				<center>
					<img src="<?= base_url(); ?>/assets/img/Puntos-y-descuentos/admyo-datosperfiles.png" class="img-fluid -center">
				</center>
				</div>
	
				<div class="tab-pane fade" id="ranking" role="tabpanel" aria-labelledby="ranking-tab">
				<center>
					<img src="<?= base_url(); ?>/assets/img/Puntos-y-descuentos/admyo-ranking.png" class="img-fluid align-center">
				</center>
				</div>

				<div class="tab-pane fade " id="recomendar" role="tabpanel" aria-labelledby="recomendar-tab">
				<center>
					<img src="<?= base_url(); ?>/assets/img/Puntos-y-descuentos/admyo-recomendar.png" class="img-fluid align-center">
				</center>
				</div>

			</div>
		
	</div>
</div>
