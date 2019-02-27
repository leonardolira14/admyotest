<script>
	$(document).on("click",'div[data-toggle="tab"]',function () {
		$("div[data-toggle='tab']").removeClass("current")
		$(this).addClass("current");
		$(".tab-pane").removeClass("show active")
		$($(this).attr("llc")).tab('show');
	})
$(document).on('click','div[lld="btn"]',function(){
	obt={};
	obt["persona"]=$(this).attr("llc");
	var div="#"+$(this).attr("llc")
	$bandera=0;
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
			if(ayuda.getlocal("tipplan")==false){
				console.log(ayuda.getlocal("tipplan"));
				msplanes();
			}else{
				obt["plan"]=ayuda.getlocal("tipplan");
			}

		ayuda.senddata(obt,"registro/addEmpresa",function(data){
			lin=JSON.parse(data)
			if(lin.pass!=1){
				$("#msjerror").iziModal('setSubtitle',lin.mensaje);
				mserror();
			}else{
				ayuda.setlocal("datospago",obt);
				if(obt["plan"]["plan"]=="basic"){
					ayuda.goto("/home/gracias");
				}else{
					ayuda.goto("/home/metodopago");
				}
			}
			console.log(data);
		});
		
	}
});
$(document).on('change','select[llc="sector"]',function(){
	var obj={};
	obj["sector"]=$(this).val();
	var dim=$(this).attr("lld")
	ayuda.senddata(obj,"registro/getSubsector",function(data){
		   var cade="<option value='m'>Selecciona</option>";
			var lin=JSON.parse(data);
			for(key in lin.subnivel ){
				cade+="<option value='"+lin.subnivel[key].numero+"'>"+lin.subnivel[key].nombre+"</option>";		
			}

			$("#"+dim +" select[llc='Subsector']").html(cade);
		});
})
$(document).on('change','select[llc="Subsector"]',function(){
	var obj={};
	obj["rama"]=$(this).val();
	var dim=$(this).attr("lld")
	ayuda.senddata(obj,"registro/getrama",function(data){
		   var cade="<option value='m'>Selecciona</option>";
			var lin=JSON.parse(data);
			for(key in lin.rama ){
				cade+="<option value='"+lin.rama[key].numero+"'>"+lin.rama[key].nombre+"</option>";	
			}
			$("#"+dim +" select[llc='Rama']").html(cade);
		});
})
$(document).ready(function(){
	if(ayuda.getlocal("tipplan")==false){
		console.log(ayuda.getlocal("tipplan"));
			msplanes();
				
	}
})
$(document).on('click','img[llc="plan-select"]',function(){
	obt={};
	obt["plan"]=$(this).attr("llc-tip");
	obt["price"]=$(this).attr("llc-price");
	ayuda.setlocal("tipplan",obt)
	console.log(obt);
	$("#planes-mini").iziModal("close");

})
</script>
<div class="container">
	<div class="row">
		<div class="col-12 titulos text-center">
			REGISTRO
		</div>	
	</div>
</div>
<div class="container margin-top-30">
	<div class="row" >
		
		<div class="col-12 col-xs-12 col-md-6 col-lg-6 col-xl-6 text-center  ">
			<div class="tab current"   id="pf-tab" data-toggle="tab" llc="#pf" role="tab" aria-controls="home" aria-expanded="true">
				<i class="fa fa-map-marker ibtn bgblue-1 white"></i>
			PERSONAS FÍSICAS
			</div>
		</div>
		<div class="col-12 col-xs-12 col-md-6 col-lg-6 col-xl-6 text-center "  >
			<div class="tab " id="pm-tab" data-toggle="tab" llc="#pm" role="tab" aria-controls="profile" aria-expanded="true">
			<i class="fa fa-map-marker ibtn bgblue-1 white"></i>
			PERSONAS MORALES
		</div>
		</div>
	</div>
</div>	
<div class="container margin-top-30 ">
	<div class="row">
		<div class="col-12 tab-content margin-bottom-30 shadow-1" id="myTabContent">
			<div class="tab-pane fade show active" id="pf" role="tabpanel" aria-labelledby="pf-tab">
				<div class="container margin-top-30 margin-bottom-30">
					<div class="row" >

						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
							<label for="rz">Razon Social</label>
								<input requerid="requerid" type="text" id="rz" llc="Razon Social" name="rz" class="form-control" placeholder="Nombre"> 
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
							    <label for="nc">Nombre Comercial</label>
								<input requerid="requerid" type="text" class="form-control" id="nc" name="nc" llc="Nombre Comercial"  placeholder="Nombre Comercial"> 
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">RFC(Registro Federal de Contribuyentes)</label>
								<input requerid="requerid" type="text" class="form-control" id="rfc" name="rfc" llc="RFC"  placeholder="RFC"> 
							</div>
						</div>
						<div class="col-12 hr margin-top-20 margin-bottom-20"></div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Sector</label>
								<select requerid="requerid"   class="form-control" id="sector" lld="pf" name="sector" llc="sector" >
									<option value="">Selecciona</option>
									<?php
										foreach ($sector->result() as $sectorh) {?>
											<option value="<?= $sectorh->IDNivel1 ?>"><?= $sectorh->Giro ?></option>
									<?php	}			?>
								</select> 
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Subsector</label>
								<select requerid="requerid"  class="form-control" id="subsector" lld="pf" name="subsector" llc="Subsector" >
									<option value="m">Selecciona</option>
								</select> 
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Rama</label>
								<select  class="form-control" id="rama" name="rama"  lld="pf" llc="Rama" >
									<option value="m">Selecciona</option>
								</select> 
							</div>
						</div>
						<div class="col-12 hr margin-top-20 margin-bottom-20"></div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Estado</label>
								<select requerid="requerid"  class="form-control" id="estado" name="estado" llc="Estado" >
									<option value="m">Selecciona</option>
									<?php
										foreach ($estados->result() as $estado) {?>
											<option value="<?= $estado->nom_ent ?>"><?= $estado->nom_ent ?></option>
									<?php	}			?>
								</select> 
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Correo Electronico</label>
								<input requerid="requerid" type="email" class="form-control" id="email"  placeholder="E-Mail" name="email" llc="Correo Electronico" >
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Contraseña</label>
								<input requerid="requerid" type="password" name="clave" class="form-control" id="clave"  placeholder="Contraseña"  llc="Contraseña" >
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Confirmar Contraseña</label>
								<input requerid="requerid" type="password" class="form-control" id="clave2"  placeholder="Confirmar Contraseña" name="clave2" llc="Confirmar Contraseña " >
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 align-center btn btn-primary" llc="pf" lld="btn">
							ENVIAR
						</div>
						<div class="col-10 margin-top-30 mx-auto">
							<div class="custom-control custom-checkbox">
							  <input type="checkbox" class="custom-control-input" name="av" id="av1">
							  <label class="custom-control-label" for="av1">Deseo recibir información de ADMYO en mi correo electrónico y acepto los <a href="https://admyo.com/terminosycondiciones">TÉRMINOS Y CONDICIONES</a>, así como el <a href="#">AVISO DE PRIVACIDAD</a>.</label>
							</div>
						</div>

					</div>
				</div>
			</div>
<div class="tab-pane fade " id="pm" role="tabpanel" aria-labelledby="pm-tab">
				<div class="container margin-top-30 margin-bottom-30">
					<div class="row" >
						 <div class="col-12 subtitulos text-center">DATOS EMPRESA</div>
		
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
							    <label for="nc">Nombre Comercial</label>
								<input requerid="requerid" type="text" class="form-control" id="nc" name="nc" llc="Nombre Comercial"  placeholder="Nombre Comercial"> 
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">RFC(Registro Federal de Contribuyentes)</label>
								<input requerid="requerid" type="text" class="form-control" id="rfc" name="rfc" llc="RFC"  placeholder="RFC"> 
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Sector</label>
								<select requerid="requerid"   class="form-control" id="sector" lld="pm" name="sector" llc="sector" >
									<option value="">Selecciona</option>
									<?php
										foreach ($sector->result() as $sectorh) {?>
											<option value="<?= $sectorh->IDNivel1 ?>"><?= $sectorh->Giro ?></option>
									<?php	}			?>
								</select> 
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Subsector</label>
								<select requerid="requerid"   class="form-control" id="subsector"  lld='pm' name="subsector" llc="Subsector" >
									<option value="">Selecciona</option>
								</select> 
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Rama</label>
								<select   class="form-control" id="rama" name="rama" llc="Rama" >
									<option value="">Selecciona</option>
								</select> 
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Estado</label>
								<select  requerid="requerid"  class="form-control" id="estado" name="estado" llc="Estado" >
									<option value="">Selecciona</option>
									<?php
										foreach ($estados->result() as $estado) {?>
											<option value="<?= $estado->nom_ent ?>"><?= $estado->nom_ent ?></option>
									<?php	}			?>
								</select> 
							</div>
						</div>

						<div class="col-12 subtitulos text-center margin-top-20">DATOS PERSONALES</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Nombre</label>
								<input requerid="requerid" type="text" class="form-control" id="nombre"  placeholder="Nombre" name="nombre" llc="Nombre" >
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Correo Electronico</label>
								<input requerid="requerid" type="email" class="form-control" id="email"  placeholder="E-Mail" name="email" llc="Correo Electronico" >
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Contraseña</label>
								<input requerid="requerid" type="password" class="form-control" id="clave"  placeholder="Contraseña" name="clave" llc="Contraseña" >
							</div>
						</div>
						<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
							<div id="" class="form-group">
								<label for="nc">Confirmar Contraseña</label>
								<input requerid="requerid" type="password" class="form-control" id="clave2"  placeholder="Confirmar Contraseña" name="clave2" llc="Confirmar Contraseña " >
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 align-center btn btn-primary" llc="pm" lld="btn">
							ENVIAR
						</div>
						<div class="col-10 margin-top-30 mx-auto">
							<div class="custom-control custom-checkbox">
							  <input type="checkbox" class="custom-control-input" name="av" id="av2">
							  <label class="custom-control-label" for="av2">Deseo recibir información de ADMYO en mi correo electrónico y acepto los <a href="https://admyo.com/terminosycondiciones">TÉRMINOS Y CONDICIONES</a>, así como el <a href="#">AVISO DE PRIVACIDAD</a>.</label>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>
<div class="izimodal" data-title="Mensaje de Admyo" closekey='false' closebtn='false' over='false' id="planes-mini" >
	<div class="container bgazul ">
		<div class="row">
			<div class="col-12 margin-top-20 margin-bottom-30">
				<h5 class="titulos-blanco"><span>SELECCIONE UNO DE NUESTROS PLANES PARA CONTINUAR CON EL REGISTRO.</span></h5>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<img src="/assets/img/pago-basic.png" class="img-fluid" llc="plan-select" llc-tip="basic" llc-price="0" alt="">
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-bottom-30">
				<img src="/assets/img/pago-estandar.png" class="img-fluid" llc="plan-select" llc-tip="estandar" llc-price="999" alt="">
			</div>
		</div>
	</div>
	
</div>