<script>
	calificar.listadependencias(<?=json_encode($cuestionario["listas_dependencias"])?>);
</script>
<div class="container margin-top-40">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
			<div class="row text-center">
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 barrita" style="margin: 0 auto;"><h5>CALIFICANDO A LA EMPRESA: <span class="titn"><?= $Razon_Social?></span></h5></div>
			</div>
		</div>
	</div>
</div>
<div class="container margin-top-40" id="Preguntas">
	<div class="row tables">
		<div class=" titulos-blanco  bgazul text-center thead col-12"><h4><strong>Preguntas</strong></h4></div>
		<? 
		foreach ($cuestionario["Preguntas"] as $key) {
			if($key["dependecia"]==="Si"){
				?>
				<div class="col-12 col-sm-12 col-xl-12 col-md-12 col-lg-12 tr-table d-none" data-desc="<?=$key["Nump"]?>">
					<div class="row">
						<div class="col-12 col-sm-12 col-xl-12 col-md-12 col-lg-12">
							<span class="preg">¿<?=$key["Pregunta"] ?>?</span>
						</div>
						<div class="col-12 col-sm-12 col-xl-12 col-md-12 col-lg-12 text-center d-flex justify-content-end">
							<?

							if(trim($key["Forma"])=="Si/No"){
								?>
								<form>
									<div class="row">
										<div class="col-12">
											<ul>
												<li>
													<input type="radio"  id="R1si<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>" value="SI" name="R">
													<label for="R1si<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>">SI</label>
													<div class="check"></div>
												</li>
												<li>
													<input type="radio" id="R1no<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>" value="NO" name="R">
													<label for="R1no<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>">NO</label>
													<div class="check"></div>
												</li>
											</ul>
										</div>
									</div>
								</form>
								<?
							}else if(trim($key["Forma"])=="Si/No/NA"){
								?>
								<form>
									<div class="row">
										<div class="col-12">
											<ul>
												<li>
													<input type="radio" id="R1si<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>" value="SI" name="R">
													<label for="R1si<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>">SI</label>
													<div class="check"></div>
												</li>
												<li>
													<input type="radio" id="R1no<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>" value="NO" name="R">
													<label for="R1no<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>">NO</label>
													<div class="check"></div>
												</li>
												<li>
													<input type="radio" id="R1na<?=$key["Nump"]?>" value="NA" llc="<?=$key["Nump"]?>" name="R">
													<label for="R1na<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>">NA</label>
													<div class="check"></div>
												</li>
											</ul>
										</div>
									</div>
								</form>
								<?
							}else if(trim($key["Forma"])=='Dias' || trim($key["Forma"])=='Horas'){
								?>
								<form>
									<div class="row">
										<div class="col-12">
											<input type="number" value="0" llc="<?=$key["Nump"]?>" class="form-control">
										</div>
									</div>
								</form>
								<?
							}else if(trim($key["Forma"])=='Si/No/NA/NS'){
								?>
								<form>
									<div class="row">
										<div class="col-12">
											<ul>
												<li>
													<input type="radio" id="R1si<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>" value="SI" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1si<?=$key["Nump"]?>">SI</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1no<?=$key["Nump"]?>" value="NO" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1no<?=$key["Nump"]?>">NO</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1no<?=$key["Nump"]?>" value="NA" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1na<?=$key["Nump"]?>">NA</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1no<?=$key["Nump"]?>" value="NS" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1ns<?=$key["Nump"]?>">NS</label>
													<div class="check"></div>
												</li>
											</ul>
										</div>
									</div>
								</form>
								<?
							}else if(trim($key["Forma"])=='No tiene/NA/NS/Si/No'){
								?>
								<form>
									<div class="row">
										<div class="col-12">
											<ul>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1si<?=$key["Nump"]?>" value="SI" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1si<?=$key["Nump"]?>">SI</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1no<?=$key["Nump"]?>" value="NO" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1no<?=$key["Nump"]?>">NO</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1no<?=$key["Nump"]?>" value="NA" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1na<?=$key["Nump"]?>">NA</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1no<?=$key["Nump"]?>" value="NS" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1ns<?=$key["Nump"]?>">NS</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1nt<?=$key["Nump"]?>" value="NT" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1nt<?=$key["Nump"]?>">No Tiene</label>
													<div class="check"></div>
												</li>
											</ul>
										</div>
									</div>
								</form>
								<?
							}else if(trim($key["Forma"])=='OP'){
								?>
								<form>
									<div class="row">
										<div class="col-12">
											<ul>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1-1<?=$key["Nump"]?>" value="Recomendación" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1-1<?=$key["Nump"]?>">Recomendación</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1-2<?=$key["Nump"]?>" value="Admyo" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1-2<?=$key["Nump"]?>">Admyo</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1-3<?=$key["Nump"]?>" value="Asociaciones" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1-3<?=$key["Nump"]?>">Asociaciones</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1-4<?=$key["Nump"]?>" value="Feria" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1-4<?=$key["Nump"]?>">Feria</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1-5<?=$key["Nump"]?>" value="Web/Buscadores" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1-5<?=$key["Nump"]?>">Web/Buscadores</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1-6<?=$key["Nump"]?>" value="Publicidad" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1-6<?=$key["Nump"]?>">Publicidad</label>
													<div class="check"></div>
												</li>
											</ul>
										</div>
									</div>
								</form>	
								<?
							}
							?>
						</div>
					</div>
				</div>
				<?
			}else{
				?>
				<div class="col-12 col-sm-12 col-xl-12 col-md-12 col-lg-12 tr-table">
					<div class="row">
						<div class="col-12 col-sm-12 col-xl-12 col-md-12 col-lg-12">
							<span class="preg">¿<?=$key["Pregunta"] ?>?</span>
						</div>
						<div class="col-12 col-sm-12 col-xl-12 col-md-12 col-lg-12 text-center d-flex justify-content-end">
							<?

							if(trim($key["Forma"])=="Si/No"){
								?>
								<form>
									<div class="row">
										<div class="col-12">
											<ul>
												<li>
													<input type="radio" id="R1si<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>" value="SI" name="R">
													<label for="R1si<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>">SI</label>
													<div class="check"></div>
												</li>
												<li>
													<input  type="radio" id="R1no<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>" value="NO" name="R">
													<label for="R1no<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>">NO</label>
													<div class="check"></div>
												</li>
											</ul>
										</div>
									</div>
								</form>
								<?
							}else if(trim($key["Forma"])=="Si/No/NA"){
								?>
								<form>
									<div class="row">
										<div class="col-12">
											<ul>
												<li>
													<input type="radio" id="R1si<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>" value="SI" name="R">
													<label for="R1si<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>">SI</label>
													<div class="check"></div>
												</li>
												<li>
													<input type="radio" id="R1no<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>" value="NO" name="R">
													<label for="R1no<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>">NO</label>
													<div class="check"></div>
												</li>
												<li>
													<input type="radio" id="R1na<?=$key["Nump"]?>" value="NA" llc="<?=$key["Nump"]?>" name="R">
													<label for="R1na<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>">NA</label>
													<div class="check"></div>
												</li>
											</ul>
										</div>
									</div>
								</form>
								<?
							}else if(trim($key["Forma"])=='Dias' || trim($key["Forma"])=='Horas'){
								?>
								<form>
									<div class="row">
										<div class="col-12">
											<input type="number" value="0" llc="<?=$key["Nump"]?>" class="form-control">
										</div>
									</div>
								</form>
								<?
							}else if(trim($key["Forma"])=='Si/No/NA/NS'){
								?>
								<form>
									<div class="row">
										<div class="col-12">
											<ul>
												<li>
													<input type="radio" id="R1si<?=$key["Nump"]?>" llc="<?=$key["Nump"]?>" value="SI" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1si<?=$key["Nump"]?>">SI</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1no<?=$key["Nump"]?>" value="NO" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1no<?=$key["Nump"]?>">NO</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1no<?=$key["Nump"]?>" value="NA" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1na<?=$key["Nump"]?>">NA</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1no<?=$key["Nump"]?>" value="NS" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1ns<?=$key["Nump"]?>">NS</label>
													<div class="check"></div>
												</li>
											</ul>
										</div>
									</div>
								</form>
								<?
							}else if(trim($key["Forma"])=='No tiene/NA/NS/Si/No'){
								?>
								<form>
									<div class="row">
										<div class="col-12">
											<ul>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1si<?=$key["Nump"]?>" value="SI" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1si<?=$key["Nump"]?>">SI</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1no<?=$key["Nump"]?>" value="NO" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1no<?=$key["Nump"]?>">NO</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1no<?=$key["Nump"]?>" value="NA" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1na<?=$key["Nump"]?>">NA</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1no<?=$key["Nump"]?>" value="NS" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1ns<?=$key["Nump"]?>">NS</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1nt<?=$key["Nump"]?>" value="NT" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1nt<?=$key["Nump"]?>">No Tiene</label>
													<div class="check"></div>
												</li>
											</ul>
										</div>
									</div>
								</form>
								<?
							}else if(trim($key["Forma"])=='OP'){
								?>
								<form>
									<div class="row">
										<div class="col-12">
											<ul>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1-1<?=$key["Nump"]?>" value="Recomendación" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1-1<?=$key["Nump"]?>">Recomendación</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1-2<?=$key["Nump"]?>" value="Admyo" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1-2<?=$key["Nump"]?>">Admyo</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1-3<?=$key["Nump"]?>" value="Asociaciones" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1-3<?=$key["Nump"]?>">Asociaciones</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1-4<?=$key["Nump"]?>" value="Feria" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1-4<?=$key["Nump"]?>">Feria</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1-5<?=$key["Nump"]?>" value="Web/Buscadores" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1-5<?=$key["Nump"]?>">Web/Buscadores</label>
													<div class="check"></div>
												</li>
												<li>
													<input llc="<?=$key["Nump"]?>" type="radio" id="R1-6<?=$key["Nump"]?>" value="Publicidad" name="R">
													<label llc="<?=$key["Nump"]?>" for="R1-6<?=$key["Nump"]?>">Publicidad</label>
													<div class="check"></div>
												</li>
											</ul>
										</div>
									</div>
								</form>	
								<?
							}
							?>
						</div>
					</div>
				</div>
				<?
			}
		}
		?>
	</div>
</div>
<input type="hidden" value="<?=$IDEmpresa_Receptora?>" name="empresa_receptora">
<input type="hidden" value="<?=$Giro?>" name="giro_receptora">
<input type="hidden" value="<?=$SubGiro?>" name="subgiro_receptora">
<input type="hidden" value="<?=$Rama?>" name="rama_receptora">
<input type="hidden" value="<?=$IDUsuario_receptor?>" name="usuario_receptora">
<input type="hidden" value="<?=$Tipo_receptora?>" name="tipo_receptora">
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
						<div style="margin:0 auto;" class="link col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 btn btn-primary aling-center" llc="<?=base_URL()?>ImgCliente/A" >
							Ir a Imagen

						</div>

					</div>
					<div class=" col-xl-6">
						<div style="margin:0 auto;" class="link col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 btn btn-primary aling-center" llc="<?=base_URL()?>calificar">
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
	$(document).on('click','div[llc="calificar"]',function(){
		var obt=[];
		var dat=[];
		$("#Preguntas  input").each(function(index){
				if(($(this).attr("type")=="radio") && (($(this).is(':checked')))){
					obt.push({"pregunta":$(this).attr("llc"),"respuesta":$(this).val()})
				}else if($(this).attr("type")=="number"){
					obt.push({"pregunta":$(this).attr("llc"),"respuesta":$(this).val()})
				}
			})
		dat=[{
			"respuesta":obt,
			"datos":[{"empresa_receptora":$("input[name='empresa_receptora']").val(),"giro_receptora":$("input[name='giro_receptora']").val(),"subgiro_receptora":$("input[name='subgiro_receptora']").val(),"rama_receptora":$("input[name='rama_receptora']").val(),"usuario_receptora":$("input[name='usuario_receptora']").val(),"tipo_receptora":$("input[name='tipo_receptora']").val()}]
		}];
			help.setlocal("empresa_calif",dat);
			
		$("#mensaje-confirm").iziModal("open")

	})
	$(document).on("click",'div[llc="SIPIS"]',function(){
		$(this).html("Cargando...").addClass("disabled")
		help.senddata(help.getlocal("empresa_calif"),"<?= base_URL()?>calificar/calcular",function(respuesta){
			var dat=JSON.parse(respuesta);
			if(dat.Pass===1){
				$('#mensaje-confirm').iziModal('close')
				$("#mensaje-confirm2 .fincal").text(dat.Mesanje);
				mscalificacion()
			}
		});
	})
</script>
