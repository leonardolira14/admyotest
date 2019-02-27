<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text">
			MIS DATOS DE USUARIO
		</div>
		<div class="banner-user"></div>
	</div>
</div>
<div class="container-fluid m-t-50">
	<div class="row menu-tab">
		
		<a href="<?= base_URL()?>datosuaurio" class="col-12 col-md-6 col-lg-6 col-xl-6  text-center  link "  >
			<div class="tab current">
				<i class="fa fa-user ibtn bgblue-1 white "></i>
				USUARIO
			</div>
		</a>
		<a href="<?= base_URL()?>listausuarios" class="col-12 col-md-6 col-lg-6 col-xl-6  text-center  link" l >
			<div class="tab">
				<i class="fa fa-user-secret ibtn bgblue-1 white text-uppercase"></i>
				listado de usuarios
			</div>
		</a>
	</div>
</div>
<div class="container margin-top-40">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-top-40 " id="datosusuario">
			<div class="tutilos-negros text-center"><h4><strong>DATOS DE USUARIO</strong></h4></div>
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Nombre</label>
				<input type="text" class="form-control" id="nombre" requerid="requerid" llc="Nombre" value="<?= $datos->Nombre ?>" placeholder="Nombre"> 
			</div>
			<div id="" class="form-group">
				<label for="apellidos"  id="lbapellidos" class="control-label">Apellidos</label>
				<input type="text" class="form-control" id="apellidos" requerid="requerid" llc="Apellidos" value="<?= $datos->Apellidos ?>" placeholder="Apellidos"> 
			</div>
			<div id="" class="form-group">
				<label for="apellidos"  id="lbapellidos" class="control-label">Puesto</label>
				<input type="text" class="form-control" id="puesto"  llc="Puesto" value="<?= $datos->Puesto ?>" placeholder="Puesto"> 
			</div>
			<div id="" class="form-group">
				<label for="apellidos"  id="lbapellidos" class="control-label">Correo Electronico</label>
				<input type="email" class="form-control" id="correo" requerid="requerid" llc="Email" value="<?= $datos->Correo ?>" placeholder="Correo Electronico"> 
			</div>
			<div id="" class="form-group">
				<label for="apellidos"  id="lbapellidos" class="control-label">Correo Electronico</label>
				<select name="Visible" class="form-control" requerid="requerid" llc="Visible" id="Visible">
					<?
					if($datos->Visible==1){
						?>
						<option selected value="1">Visible</option>
						<option  value="0">Oculto</option>
						<?
					}else{
						?>
						<option  value="1">Visible</option>
						<option selected value="0">Oculto</option>
						<?
					}
					?>
				</select>
			</div>
			<div id="" class="form-group text-center">
				<div llc="Update-dat-us" class="btn btn-primary aling-center"><i class="fa fa-save" aria-hidden="true"></i> Guradar Cambios</div>
			</div>

		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-top-40 " id="DatContra">
			<div class="tutilos-negros  text-center"><h4><strong>CAMBIO DE CONTRASEÑA</strong><h4></div>
				<div id="" class="form-group">
					<label for="c1"  id="lbapellidos" class="control-label">Contraseña Actual</label>
					<input type="password" class="form-control" requerid="requerid" llc="Contraseña" id="c1" placeholder="Contraseña Actual"> 
				</div>
				<div id="" class="form-group">
					<label for="c2"  id="lbapellidos" class="control-label">Nueva Contraseña</label>
					<input type="password" class="form-control" id="c2" requerid="requerid" llc="Nueva_Contraseña" placeholder="Nueva Contraseña"> 
				</div>
				<div id="" class="form-group">
					<label for="c3"  id="lbapellidos" class="control-label">Confirmar Contraseña</label>
					<input type="password" class="form-control" id="c3" requerid="requerid" llc="Confirmar_Contraseña" placeholder="Confirmar Contraseña"> 
				</div>
				<div id="" class="form-group text-center">
					<div llc="Update_contra" class="btn btn-primary "><i class="fa fa-save" aria-hidden="true"></i> Actualizar Contraseña</div>
				</div>

			</div>
		</div>
	</div>
	<script>

		$(document).on("click",'div[llc="Update-dat-us"]',function(){
			obt={};
			bandera=2;
			$('#datosusuario .form-control').each(function(index){
				if(ayuda.formval(this,'#datosusuario')==true){
					obt[$(this).attr("llc")]=$(this).val();
					bandera=1;
				}else{
					bandera=2;
					return false;
				}
			})
			if(bandera!=2){
				$("#preeload").show()
				ayuda.senddata(obt,"<?= base_URL()?>/perfil/ModDatosUser",function(data){
					lin=JSON.parse(data);
					if(lin.datos==true){
						ayuda.goto("<?= base_URL()?>datosuaurio")
					}else{
						$("#msjerror").iziModal('setSubtitle',lin.datos);
						mserror();
					}

				})

			}
		})
		$(document).on("click",'div[llc="Update_contra"]',function(){
			$("#preeload").show()
			obt={};
			bandera=2;
			$('#DatContra .form-control').each(function(index){
				if(ayuda.formval(this,'#DatContra')==true){
					
					obt[$(this).attr("llc")]=$(this).val();
					bandera=1;
				}else{
					$("#preeload").hide()
					bandera=2;
					return false;
				}
			})
			if(bandera!=2){
				if($("#c2").val()!=$("#c3").val()){
					$("#preeload").hide()
					$("#msjerror").iziModal('setSubtitle',"Las contraseñas deben ser Iguales");
					mserror();
				}else{
					ayuda.senddata(obt,"<?= base_URL()?>/perfil/ModContra",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							$("#preeload").hide()
							$("#msjsucces").iziModal('setSubtitle',"Contraseña Actualizada.");
							mssucces();
							$("#c1").val("")
							$("#c2").val("")
							$("#c3").val("")
						}else{
							$("#preeload").hide()
							$("#msjerror").iziModal('setSubtitle',lin.datos);
							mserror();
						}

					})
				}	
			}
		})

	</script>