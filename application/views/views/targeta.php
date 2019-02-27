<div class="container-fluid funvlue">
	<div class="row">
		<div class="col-12 tutilos-blanco margin-top-30">
			PAGO CON TARJETA DE CRÉDITO Ó DÉBITO
		</div>
		<div class="container margin-top-30" id="dat-target">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-bottom-20">
					<label for="" class="separacionn" style="color: white; text-align: left;">NOMBRE</label>	
					<div class="input-group mb-2 mb-sm-0">
						<input type="text" requerid="requerid" name="nombre" class="form-control" llc="Nombre" id="nombre" placeholder="">
						<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6  margin-bottom-20">
					<label for="" class="separacionn" style="color: white; text-align: left;">APELLIDOS</label>	
					<div class="input-group mb-2 mb-sm-0">
						<input type="text" requerid="requerid" name="apellidos" class="form-control" llc="Apellidos" id="apellidos" placeholder="">
						<div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6  margin-bottom-20">
					<label for="" class="separacionn" style="color: white; text-align: left;">CORREO ELECTRÓNICO</label>	
					<div class="input-group mb-2 mb-sm-0">
						<input type="email" requerid="requerid" name="email" class="form-control" llc="E-Mail" id="email" placeholder="">
						<div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<label for="" class="separacionn" style="color: white; text-align: left;">NÚMERO DE TARGETA</label>	
					<div class="input-group mb-2 mb-sm-0">
						<input  requerid="requerid" type="number" max="16" name="targeta" class="form-control" llc="Numero de Targeta" id="targeta" placeholder="">
						<div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<label for="" class="separacionn" style="color: white; text-align: left;">FECHA DE VENCIMIENTO</label>	
					<div class=row>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div class="input-group ">
								<select requerid="requerid" name="anio" class="form-control" llc="Año Vencimiento" id="anio">
									<option value="">selecciona</option>
									<? for($i=2017;$i<=2030;$i++){
										?>
										<option value="<?=$i?>"><?=$i?></option>
										<?
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div class="input-group">
								<select requerid="requerid" name="mes" class="form-control" llc="Mes Vencimiento" id="mes">
									<option value="">selecciona</option>
									<? for($i=1;$i<=12;$i++){
										if($i<10){
											?>
											<option value="<?=$i?>">0<?=$i?></option>
											<?
										}else{
											?>
											<option value="<?=$i?>"><?=$i?></option>
											<?
										}
										
									}
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<label for="" class="separacionn" style="color: white; text-align: left;">CVC / CSC</label>	
							<div class="input-group mb-2 mb-sm-0">
								<input type="number" max="4" requerid="requerid" name="cvv" class="form-control" llc="CVC/CSC" id="cvv" placeholder="">
								<div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<label for="" class="separacionn" style="color: white; text-align: left;">TIPO DE PAGO</label>
							<img src="/assets/img/iconos-pagos.png"  class="img-fluid" alt="">
						</div>
					</div>
				</div>
				<div class="col-12 margin-top-30 ">
					<div class="row">
						<div  llc="pagar" class="col-5 btn btn-buscar aling-center" style="margin:0 auto;"> REVISAR Y CONTINUAR </div>
					</div>

					
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-top-30 margin-bottom-30">
							<label for="" class="separacionn" style="color: white; text-align: left;">2017, GURPO CONEKTAME S.A. DE C.V. TODOS LOS DERECHOS RESERVADOS</label>
						
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-top-30 margin-bottom-30">
							
							<img src="/assets/img/logo6.png"  class="img-fluid" alt="">
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-top-30 margin-bottom-30 text-centerS">
							
							<img src="/assets/img/seguridad.png"  class="img-fluid" style="margin: 0 auto;"  alt="">
				</div>
			</div>
		</div>
		
	</div>
</div>
<script>
	$(function(){
		if(ayuda.getlocal("datospago")){
				ob=ayuda.getlocal("datospago");
				if(ob["nombre"]){
					$("#nombre").val(ob["nombre"]);
					$("#nombre").val(ob["apellidos"]);	
				}else{
					$("#nombre").val(ob["rz"]);
				}
		}
	})
	$(document).on('click','div[llc="pagar"]',function(){
		if(ayuda.getlocal("datospago")==false){
			$("#msjerror").iziModal('setSubtitle',"Error no hay datos de registro");
					mserror();
		}else{
		$("#preeload").show()
		obt={};
		obu=ayuda.getlocal("datospago");
		obt["plan"]=obu["plan"]["plan"];
		obt["price"]=obu["plan"]["price"];
		obt["rfc"]=obu["rfc"];
		obt["regCorreo"]=obu["email"];
		var div="#dat-target";
		$bandera=0;
		$(div+" .form-control").each(function(index){
			if(ayuda.formval(this,div)==true){
				bandera=1;
				obt[$(this).attr("name")]=$(this).val();
			}else{
				$("#preeload").hide()
				bandera=3;
				return false;
			}
		})

		if(bandera==1){		
			ayuda.gentoks(obt);
		}}
		})
	</script>

