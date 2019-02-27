
<div class="container margin-top-40">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
			<div class="row text-center">
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 barrita" style="margin: 0 auto;"><h5>CALIFICANDO A LA EMPRESA: <span class="titn"></span></h5></div>
			</div>
		</div>
	</div>
</div>
<div class="container margin-top-40" id="Preguntas">
	<div class="row tables">

	</div>
</div>
<div class="container margin-top-20 margin-bottom-40">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 btn btn-primary aling-center" llc="calificar" style="margin: 0 auto;">
			<i class="fa fa-save" aria-hidden="true"></i> CALIFICAR

		</div>
	</div>
</div>
<div id="mensaje-confirm2" class="izimodal" data-title="Mensaje de Admyo" >
	<div class="container-fluid margin-top-20 margin-bottom-20">
		<div class="row">
			<div class="col-12 text-center">
				<h4><span>! Gracias por su Tiempo¡</span></h4>
				</div>
				<div class="col-12 margin-top-10 text-center">
					<h4>La calificación final es: <span class="fincal"></span> </h4>
				</div>
				<div class="col-12 text-center margin-top-20">
					<div class="row">
						<div class=" col-xl-6">
							<div style="margin:0 auto;" class="link col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 btn btn-primary aling-center" llc="/perfil" >
								Ir a Perfil

							</div>

						</div>
						<div class=" col-xl-6">
							<div style="margin:0 auto;" class="link col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 btn btn-primary aling-center" llc="/calificar/calificar">
								Volver a Calificar

							</div>

						</div>

					</div>
				</div>
			</div>
		</div>	
	</div>
	<div id="mensaje-confirm" class="izimodal" data-title="Mensaje de Admyo" >
		<div class="container-fluid margin-top-20 margin-bottom-20">
			<div class="row">
				<div class="col-12 ">
					<h4><span>Las preguntas "No contestadas" se consideran como negativas</span></h4>
				</div>
				<div class="col-12 text-center text-center">
					<h5><span>¿Enviar Respuestas?</span></h5>
				</div>
				<div class="col-12 text-center margin-top-20">
					<div class="row">
						<div class=" col-xl-6">
							<div style="margin:0 auto;" class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 btn btn-primary aling-center" llc="SIPIS" >
								SI

							</div>

						</div>
						<div class=" col-xl-6">
							<div style="margin:0 auto;" class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 btn btn-primary aling-center" onclick="$('#mensaje-confirm').iziModal('close')">
								NO

							</div>

						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
	<script>
$(function(){
	ayuda.poncuestionario();
})
$(document).on('click','div[llc="calificar"]',function(){
	ayuda.msj_enviar();
})
$(document).on('click','div[llc="SIPIS"]',function(){
	ayuda.recalcular();
})
</script>