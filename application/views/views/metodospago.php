<div class="container-fluid funvlue ">
	<div class="row margin-bottom-30">
		<div class="col-12 tutilos-blanco margin-top-30">
			FORMAS DE PAGO
		</div>
		<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 " style="margin:0 auto;" >
			<div class="">
				<div class="fun-wrap">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-3 col-xl-3 col-lg-3"><img llc="/Home/targeta" src="/assets/img/boton-pagos.png" alt="" class="img-fluid link"></div>
						<div class="col-12 col-sm-12 col-md-3 col-xl-3 col-lg-3"><img llc="/Home/oxxo" src="/assets/img/boton-pagos2.png" alt="" class="img-fluid link"></div>
						<div class="col-12 col-sm-12 col-md-3 col-xl-3 col-lg-3"><img onclick="$('#pcode').iziModal('open')" src="/assets/img/boton-pagos 3.png" alt="" class="img-fluid"></div>
						<div class="col-12 col-sm-12 col-md-3 col-xl-3 col-lg-3"><img  llc="/home/spei" src="/assets/img/boton-pagos 4.png" alt="" class="img-fluid link"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="izimodal"  id="pcode" data-title="Codigo de Promocion">
	<div class="container margin-top-30">
		<div class="row">
			<div class="col-12">
				<h5><span>Ingresa el código que contiene tu tarjeta de promoción sin guiones o espacios en blanco, este tiene descuento durante los siguientes 3 meses.</span></h5>
			</div>
			<div class="col-12">
				<div class="form-group">
					<div class="input-group">
						<input type="text" class="form-control" id="code" placeholder="">
						<div class="input-group-addon"><i class="fa fa-barcode" aria-hidden="true"></i></div>
					</div>
				</div>
			</div>
			<div class="col-12 margin-top-30 margin-bottom-30">
				<div class="row">
					<div  llc="ing-cod" class="col-5 btn btn-buscar aling-center" style="margin:0 auto;"> REVISAR Y CONTINUAR </div>
				</div>


			</div>
			<div class="col-12">
				<div class="row"><div class=" text-center col-12 alert alert-warning d-none" role="alert">
				
			</div></div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).on('click','div[llc="ing-cod"]',function(){
		if(ayuda.getlocal("datospago")==false){
			$("#msjerror").iziModal('setSubtitle',"Error no hay datos de registro");
					mserror();
		}else{
		obt={};
		$("#pcode .alert").html("<progress></progress>").removeClass("d-none");
		obu=ayuda.getlocal("datospago");
		obt["code"]=$("#code").val();
		obt["plan"]=obu["plan"]["plan"];
		obt["price"]=obu["plan"]["price"];
		obt["rfc"]=obu["rfc"];
		obt["regCorreo"]=obu["email"];
		ayuda.senddata(obt,"/home/codepag",function(data){
			lin=JSON.parse(data);
			if(lin.pass==0){
				$("#pcode .alert").html(lin.mensaje).removeClass("d-none");
			}else{
				ayuda.goto("/home/gracias");
				ayuda.removeloc("tipplan")
				ayuda.removeloc("datospago")
			}
			
		})
	}
	})
</script>
