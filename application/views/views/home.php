<script src='<?= base_url(); ?>assets/css/slick/slick.min.js'></script>
<link rel='stylesheet prefetch' href='<?= base_url(); ?>assets/css/slick/slick.css'>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/slick/slick-theme.css"/>
<style>	
.img-phone{
	position: absolute;
    left: 50%;
    top: 50%;
    transform: translateX(-50%) translateY(-50%);
    z-index: ;
}
.embed-container {
    position: relative;
    padding-bottom: 56.25%;
    width: 87%;
    height: 0;
    overflow: hidden;
    border-radius: 20px;
    
}
.embed-container iframe {
   position: absolute;
    top: 15%;
    left: 14%;
    width: 85%;
    height: 63%;
    border-radius: 6px;
}
.fon2{
	background: url("/assets/img/fondo-imagen-top.png")center center no-repeat;
	background-size: cover;
}
</style>
<script>
	$(function(){
		$("#que-gano").iziModal({
			title: 'ADMYO',
			headerColor: '#005d8f',
			fullscreen: true,
			
		});
		
		$('div[llc="carrusel"]').slick({
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 2000,
			variableWidth: true
		});
		
		
	})
</script>
<div class="container-fluid fon2">
	<div class="row">
		<div class="col-12 col-md-6 col-xl-6 col-lg-6 div1-home" style="text-align: center;">
			<div class="cuadroazul">
			<div class="triangulo"></div>
			<div class="content-box">
				<img src="<?= base_url(); ?>/assets/img/icono-registro.png" class="img-fluid center-block imgicon" alt="">
				<div class="raya img-fluid margin-top-30"></div>
				<img src="<?= base_url(); ?>/assets/img/texto.png" class="img-fluid margin-top-10" alt="">
			</div>				
			</div>
			
			<img src="<?= base_url(); ?>/assets/img/mujer-registro-admyo.png" class='img-fluid imgchava' alt="">
		</div>
		<div class="col-12 col-md-6 col-xl-6 col-lg-6 margin-bottom-40 div1-home" style="text-align: center;">
		<div class="cuadrogris text-center ">
				<img src="<?= base_url(); ?>/assets/img/cuadro-gris.png" class='img-fluid' alt="">
				
			</div>
			<img src="<?= base_url(); ?>/assets/img/hombre-login-admyo.png" class='img-fluid' alt="">
		</div>		
	</div>

</div>
<div class="container margin-bottom-40">
	<div class="row align-items-center">
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<img src="<?=  base_url(); ?>/assets/img/tel.png" class="img-fluid img-phone" alt="">
			<div class="margint">

				<div class="embed-container">
						<iframe width="560" height="200" src="https://www.youtube.com/embed/R34MP-qDKBw?rel=0" frameborder="0" allowfullscreen></iframe>
			</div>
				
			</div>
				
			</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div class="cuadroazul-bl text-center align-self-center">
				<span class="">¿QUÉ GANAS PARTICIPANDO EN ADMYO?</span>
				<p class="margin-top-10"><span ><i onclick=" $('#que-gano').iziModal('open');" class="fa fa-plus-circle" aria-hidden="true"></i></span>
					<br><span class="">VER MAS</span></p>
				</div>
			</div>
		</div>	
	</div>
	<div class="container-fluid mas-calificadas">
		<div class="row  align-items-center " >
			<div class="col-12  text-center">
				<div class="div-tx align-middle align-center">EMPRESAS MEJOR CALIFICADAS</div>
				<div class="col-10 align-center">
					<div class="variable-width" llc="carrusel" style="overflow: hidden;">
						<div> <div class="contn"><img src="<?=  base_url(); ?>/assets/img/logosEmpresas/280.gif" class="img-fluid container-carrucel__image" ></div></div>
					
						<div> <div class="contn"><img src="<?=  base_url(); ?>/assets/img/logosEmpresas/1049.png" class="img-fluid container-carrucel__image" ></div></div>
						<div> <div class="contn"><img src="<?=  base_url(); ?>/assets/img/logosEmpresas/1101.jpeg" class="img-fluid container-carrucel__image" ></div></div>
						<div> <div class="contn"><img src="<?=  base_url(); ?>/assets/img/logosEmpresas/1188.png" class="img-fluid container-carrucel__image" ></div></div>
						<div> <div class="contn"><img src="<?=  base_url(); ?>/assets/img/logosEmpresas/avatar_310113110353.jpg" class="img-fluid container-carrucel__image" ></div></div>
						
					</div>
				</div>

			</div>
			<div class="col-12  text-center">
				<div class="div-tx align-middle align-center">EMPRESAS QUE MÁS CALIFICAN</div>
				<div class="col-10 align-center">
					<div class="variable-width" llc="carrusel" style="overflow: hidden;">
						<div> <div class="contn"><img src="<?=  base_url(); ?>/assets/img/logosEmpresas/logo_63.png" class="img-fluid container-carrucel__image" ></div></div>
						<div> <div class="contn"><img src="<?=  base_url(); ?>/assets/img/logosEmpresas/logo_250.png" class="img-fluid container-carrucel__image" ></div></div>
						<div> <div class="contn"><img src="<?=  base_url(); ?>/assets/img/logosEmpresas/logo_1042.jpg" class="img-fluid container-carrucel__image" ></div></div>
						<div> <div class="contn"><img src="<?=  base_url(); ?>/assets/img/logosEmpresas/logo_1003.jpg" class="img-fluid container-carrucel__image" ></div></div>
						<div> <div class="contn"><img src="<?=  base_url(); ?>/assets/img/logosEmpresas/logo_1026.png" class="img-fluid container-carrucel__image" ></div></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container testimoniales margin-top-40" >
		<div class="row">
			<div class="col-12 col-12 col-12 text-center">
				<span class="align-center">TESTIMONIALES</span>
				<br>
				<img src="<?=  base_url(); ?>/assets/img/pleca-titulos.png" class="align-center" alt="">
				<div class="services-wrap ">
					<div class="service-tag">
						<img src="<?=  base_url(); ?>/assets/img/services-tag.png" alt="services tag">
					</div>
					<ul class="feature-textimoniales clearfix">
						<div class=" col-12">
							<div class="service-box bgwhite shadow-2">
								<li class="test-div col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="service-icon">
										<center><img class='img-fluid' src="<?=  base_url(); ?>/assets/img/testimonial/th1.png"></center>
									</div>
									<div class="service-title">
										<h5>LITHO OFFSET ANDINA, S.A. DE C.V. (México)</h5>
									</div>
									<div class="service-disc">
										<p>“Con admyo un nuevo cliente me ha podido encontrar y no me ha dado problemas con el pago”</p>
									</div>
								</li>
								<li class="test-div col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
									<div class="service-icon">
										<center><img src="<?=  base_url(); ?>/assets/img/testimonial/th3.png" class='img-fluid'></center>
									</div>
									<div class="service-title">
										<h5>Netmar S.A. de C.V. (México)</h5>
									</div>
									<div class="service-disc">
										<p>“Con la reputación que me han dado mis clientes he podido generar una cuenta importante”</p>
									</div>
								</li>
								<li class="test-div col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">							
									<div class="service-icon">
										<center><img class='img-fluid' src="<?=  base_url(); ?>/assets/img/testimonial/th2.png"></center>
									</div>
									<div class="service-title">
										<h5>Matas Lorenzo (México)</h5>
									</div>
									<div class="service-disc">
										<p>“He podido recuperar una cuenta morosa gracias a la presión y seguimiento que le ha dado admyo”</p>
									</div>
								</li>
							</div>
						</div>	
					</ul>
				</div>
			</div>
		</div>
	</div>
<div id="que-gano">
  <img id="adentroims" src="<?= base_url(); ?>/assets/img/Infografia-Admyo.jpg" class="img-fluid align-center" alt="">
</div>
