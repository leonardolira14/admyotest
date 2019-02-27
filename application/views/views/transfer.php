<script src="/assets/js/src/JsBarcode.all.js"></script>
<script src="/assets/js/src/printThis.js"></script>
<div class="container-fluid funvlue" id="todo-tick">
	<div class="row">
		<div class="col-12 tutilos-blanco margin-top-30">
			PAGO CON SPEI
		</div>
		<div class="container margin-top-30" id="dat-oxxo">
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
					<label for="" class="separacionn" style="color: white; text-align: left;">TELEFONO</label>	
					<div class="input-group mb-2 mb-sm-0">
						<input type="text" requerid="requerid" name="tel" class="form-control" llc="Telefono" id="tel" placeholder="">
						<div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
					<label for="" class="separacionn" style="color: white; text-align: left;">CORREO ELECTRONICO</label>	
					<div class="input-group mb-2 mb-sm-0">
						<input type="email" requerid="requerid" name="email" class="form-control" llc="Correo Electronico" id="email" placeholder="">
						<div class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
					</div>
				</div>
			
				
				
				<div class="col-12 margin-top-30 ">
					<div class="row">
						<div  llc="pagar" class="col-5 btn btn-buscar aling-center " style="margin:0 auto; cursor: pointer;"> REVISAR Y CONTINUAR </div>
					</div>
						
					
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-top-30 margin-bottom-30">
							<label for="" class="separacionn" style="color: white; text-align: left;">2017, GURPO CONEKTAME S.A. DE C.V. TODOS LOS DERECHOS RESERVADOS</label>
						
				</div>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-top-30 margin-bottom-30">
							
							<img src="/assets/img/logo6.png"  class="img-fluid" alt="">
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-top-30 margin-bottom-30 text-center">
							
							<img src="/assets/img/seguridad.png"  class="img-fluid" style="margin: 0 auto;"  alt="">
				</div>
			</div>
		</div>
		
	</div>
</div>
<div class="izimodal" data-title="Datos de Transferencia" id="ms-transfer">
	<div class="container margin-top-30 margin-bottom-30">
		<div class="row">
			<div class="col-12 text-center"><h5><strong>Banco: <span class="banco"></span></strong></h5></div>
			<div class="col-12 text-center"><h5><strong>CABLE: <span class="cable"></span></strong></h5></div>
			<div class="col-12 text-center"><h5><strong>Monto: $<span class="monto"></span></strong></h5></div>
			<div class="col-12"><h5><strong>Al contemplar la transferencia ADMYO te enviará un correo confirmando tu pago de manera inmediata, de esta manera ya podras ingresar.</strong></h5></div>
			<div class="col-12 margin-top-20 ">
					<div class="row">
						<div  llc="/home/gracias" class="col-5 btn btn-buscar aling-center link " style="margin:0 auto; cursor: pointer;">CONTINUAR </div>
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
		var div="#dat-oxxo";
		bandera=0;
		$(div+" .form-control").each(function(index){
			if(ayuda.formval(this,div)==true){
				bandera=1;
				obt[$(this).attr("name")]=$(this).val();
			}else{
				bandera=3;
				return false;
			}
		})

		if(bandera==1){		
			ayuda.senddata(obt,"/Home/trasnfer",function(data){
				lin=JSON.parse(data);
				if(lin.pass!=1){
					$("#preeload").hide();
					$("#msjerror").iziModal('setSubtitle',lin.mensaje);
					mserror();
				}else{
					$("#ms-transfer .banco").text(lin.mensaje.Banco);
					$("#ms-transfer .cable").text(lin.mensaje.Cable);
					$("#ms-transfer .monto").text(lin.mensaje.Total);
					$("#ms-transfer").iziModal("open")
					ayuda.removeloc("datospago")
					ayuda.removeloc("tipplan")
					$("#preeload").hide();
				}
				
			})
		}
		}
		
		})
</script>

