
<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text">
			DATOS DE CONTACTO DE MI EMPRESA
		</div>
		<div class="banner-imgdats"></div>
	</div>
</div>
<div class="container-fluid margin-top-40 menu-tab" id="Dats-Genral">
	<div class="row">
		<a  href="<?= base_URL()?>datosempresa" class="col-12  col-md-2 col-lg-2 col-xl-2  text-center link" >
			<div class="tab ">
				<i class="fa fa-home ibtn bgblue-1  white"></i>
				DATOS GENERALES
			</div>
		</a>
		<a href="<?= base_URL()?>datoscontacto" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link"  >
			<div class="tab current">
				<i class="fa fa-phone-square ibtn bgblue-1 white"></i>
				DATOS DE CONTACTO
			</div>
		</a>
		<a href="<?= base_URL()?>productosyservicios" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link"  >
			<div class="tab ">
				<i class="fa fa-archive ibtn bgblue-1 white "></i>
				PRODUCTOS Y SERVICIOS
			</div>
		</a>
		<a href="<?= base_URL()?>certificaciones" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link" l >
			<div class="tab">
				<i class="fa fa-certificate ibtn bgblue-1 white"></i>
				CERTIFICACIONES
			</div>
		</a>
		<a href="<?= base_URL()?>asociaciones" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link" l >
			<div class="tab">
				<i class="fa fa-handshake-o ibtn bgblue-1 white"></i>
				ASOCIACIONES
			</div>
		</a>
		<a href="<?= base_URL()?>notificaciones" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link" l >
			<div class="tab">
				<i class="fa fa-bell ibtn bgblue-1 white"></i>
				NOTIFICACIONES
			</div>
		</a>
	</div>
</div>
<div class="container margin-top-40" id="div-contacto">
	<div class="row">
	
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Página Web</label>
				<?$data=array('name'=>"Pagina_Web","id"=>"paginaweb","llc"=>"Pagina_Web","requerid"=>"requerid","value"=>$datos->Sitio_Web,"class"=>"form-control","type"=>"text");
				echo form_input($data);?>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Dirección (Calle y Numero)</label>
				<?$data=array('name'=>"Direccion","id"=>"direccion","llc"=>"Direccion","value"=>$datos->Direc_Fiscal,"requerid"=>"requerid","class"=>"form-control","type"=>"text");
				echo form_input($data);?>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Colonia</label>
				<?$data=array('name'=>"Colonia","id"=>"Colonia","llc"=>"Colonia","value"=>$datos->Colonia,"requerid"=>"requerid","class"=>"form-control","type"=>"text");
				echo form_input($data);?>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Municipio/Delegación</label>
				<?$data=array('name'=>"nombre_comercial","id"=>"Municipio","llc"=>"Municipio","value"=>$datos->Deleg_Mpo,"requerid"=>"requerid","class"=>"form-control","type"=>"text");
				echo form_input($data);?>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Código Postal</label>
				<?$data=array('name'=>"Codigo_Postal","id"=>"cp","llc"=>"Codigo_Postal","value"=>$datos->Codigo_Postal,"requerid"=>"requerid","class"=>"form-control","type"=>"number");
				echo form_input($data);?>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Estado</label>
				<select name="estado" llc="Estado" required="required" id="estado" class="form-control">
					<option value="">Selecciona</option>
					<?
					foreach ($estados as $key) {
						if($key->nom_ent===$datos->Estado){
							?>
						<option value="<?= $key->nom_ent ?>" selected><?= $key->nom_ent ?></option>

						<?
						}else{
							?>
						<option value="<?= $key->nom_ent ?>" ><?= $key->nom_ent ?></option>
						<?
						}

					}
					?>
				</select>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-top-40  margin-bottom-40">
			<div class="row text-center">
				<div class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-6 btn btn-primary aling-center" llc="Update-Datos" style="margin: 0 auto;">
					<i class="fa fa-save" aria-hidden="true"></i> Guardar Datos
					
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 margin-bottom-40">
			<div class="row">
				<div class="col-6 tutilos-negros margin-bottom-40"><h4><strong>Telefonos</strong></h4></div>
				<div class="col-6  text-right">
					<i class="fa fa-plus bgblue-1 white iconos_botones" onclick="$('#add-tel').iziModal('open')"></i>
				</div>
					<?
						if($telefonos!=false){
							foreach ($telefonos as $key) {
								?>
								<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">(+52)<?=$key->Numero?></div>
								<div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2"><?=$key->Tipo_Numero?></div>
								<div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 text-right centrar-vertical-contend">
									<i class="fa fa-pencil bgblue-1 white iconos_botones " lld="mod-tel" llc="<?=$key->IDTel?>"></i>
								</div>
								<div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 text-right centrar-vertical-contend">
									<i class="fa fa-times bgblue-1 white iconos_botones " lld="del-tel" llc="<?=$key->IDTel?>"></i>
								</div>
								<div class=" col-12 hr"></div>
								<?
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="add-tel" class="izimodal" width="600" data-title="Telefonos">
<div class="container margin-top-40">
	<div class="row">
		<div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Lada Internacional</label>
				<label for="nombre"  id="lbnombre" class="control-label"><strong>+52</strong></label>
			</div>
		</div>
		<div class="col-8 col-sm-8 col-md-3 col-lg-3 col-xl-3">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Lada Internacional</label>
				<?$data=array('name'=>"ladaNac","id"=>"ln","llc"=>"Lada_Nacional","requerid"=>"requerid","class"=>"form-control","type"=>"number","onKeyDown"=>"if(this.value.length==3 && event.keyCode!=8) return false;");
				echo form_input($data);?>
			</div>
		</div>
		<div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Télefono</label>
				<?$data=array('name'=>"Telefono","id"=>"tel","llc"=>"Telefono","requerid"=>"requerid","class"=>"form-control margin-top-20","type"=>"number","onKeyDown"=>"if(this.value.length==8 && event.keyCode!=8) return false;");
				echo form_input($data);?>
			</div>
		</div>
		<div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Tipo</label>
				<select name="Tipo" llc="Tipo" requerid="requerid" class="form-control margin-top-20" id="tipo">
				<option value="Fijo">Fijo</option>
				<option value="Móvil">Móvil</option></select>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-top-40  margin-bottom-40">
			<div class="row text-center">
				<div class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-6 btn btn-primary aling-center" llc="add-tel" style="margin: 0 auto;">
					<i class="fa fa-save" aria-hidden="true"></i> Guardar Datos
					
				</div>
			</div>
		</div>
	</div>
</div>

</div>
<script type="text/javascript">
$(document).on("click",'div[llc="Update-Datos"]',function(){
	obt={};
		bandera=2;
		$('#div-contacto .form-control').each(function(index){
				if(ayuda.formval(this,'#div-contacto')==true){
					obt[$(this).attr("llc")]=$(this).val();
					bandera=1;
				}else{
					bandera=2;
					return false;
				}
		})
		if(bandera!=2){
			$("#preeload").show()
			ayuda.senddata(obt,"<?=base_URL()?>perfil/ModDatosEmpresa",function(data){
			lin=JSON.parse(data);
			console.log(lin)
			if(lin.datos==true){
						ayuda.goto("<?=base_URL()?>datoscontacto")
			}else{
				$("#preeload").hide()
				$('#add-tel').iziModal('close')
				$("#msjerror").iziModal('setSubtitle',lin.datos);
				mserror();
			}
			
			})
		}
})
	$(document).on('click','#add-tel div[llc="add-tel"]',function(){
		obt={};
		bandera=2;
		$('#add-tel .form-control').each(function(index){
				if(ayuda.formval(this,'#add-tel')==true){
					obt[$(this).attr("llc")]=$(this).val();
					bandera=1;
				}else{
					bandera=2;
					return false;
				}
		})
		if(bandera!=2){
			ayuda.senddata(obt,"<?=base_URL()?>/perfil/AddTel",function(data){
			lin=JSON.parse(data);
			if(lin.datos==true){
				$('#add-tel').iziModal('close')
				$("#msjsucces").iziModal('setSubtitle',"Exito,se actualizara esta pagina en 5 seg.");
				mssucces();
					setTimeout(function(){
						ayuda.goto("<?=base_URL()?>datoscontacto")
					},5000)		
			}else{
				$('#add-tel').iziModal('close')
				$("#msjerror").iziModal('setSubtitle',lin.datos);
				mserror();
			}
			
			})
		}
	})
$(document).on("click","i[lld='del-tel']",function(){
	$("#preeload").show()
	obt={};
	obt['tel']=$(this).attr("llc");
	ayuda.senddata(obt,"/perfil/DelTel",function(data){
		lin=JSON.parse(data);
			if(lin.datos==true){
				$("#preeload").hide()
				$("#msjsucces").iziModal('setSubtitle',"Exito,se actualizara esta pagina en 5 seg.");
				mssucces();
					setTimeout(function(){
						ayuda.goto("<?=base_URL()?>datoscontacto")
					},5000)		
			}else{
				$("#preeload").hide()
				$("#add-giro").iziModal("close")
				$("#msjerror").iziModal('setSubtitle',lin.datos);
				mserror();
			}	
	})
})
$(document).on("click",'i[lld="mod-tel"]',function(){
	$("#preeload").show()
	obt={};
	obt['tel']=$(this).attr("llc");
	ayuda.senddata(obt,"<?=base_URL()?>perfil/DatTel",function(data){
		lin=JSON.parse(data);
		if(lin!=false){
			console.log(lin);
			$("#preeload").hide()
			numero=lin.datos[0].Numero;
			lada=numero.substr(0,3);
			sessionStorage.setItem("idtel",lin.datos[0].IDTel);
			numero=numero.substr(2,numero.length-1);
			$("#add-tel #ln").val(lada);
			$("#add-tel #tel").val(numero);
			if(lin.datos[0].Tipo_Numero=="Movil"){
				cade='<option value="Fijo">Fijo</option><option value="Móvil" selected>Móvil</option>'
			}else{
				cade='<option  value="Fijo">Fijo</option><option value="Móvil" >Móvil</option>'
			}

			$("#add-tel #tipo").html(cade);
			$("#add-tel div[llc='add-tel']").attr("llc","mod-tel");
			$("#add-tel").iziModal("open")
		}else{
			$("#preeload").hide()
			$("#add-giro").iziModal("close")
			$("#msjerror").iziModal('setSubtitle',"Datos no encontrados");
			mserror();
		}
	})
})
$(document).on("click",'div[llc="mod-tel"]',function(){
		obt={};
		bandera=2;
		$('#add-tel .form-control').each(function(index){
				if(ayuda.formval(this,'#add-tel')==true){
					obt[$(this).attr("llc")]=$(this).val();
					bandera=1;
				}else{
					bandera=2;
					return false;
				}
		})
		if(bandera!=2){
			obt["idtel"]=sessionStorage.getItem("idtel");
			ayuda.senddata(obt,"<?=base_URL()?>perfil/ModiTel",function(data){
			lin=JSON.parse(data);
			if(lin.datos==true){
				$('#add-tel').iziModal('close')
				$("#msjsucces").iziModal('setSubtitle',"Exito,se actualizara esta pagina en 5 seg.");
				mssucces();
					setTimeout(function(){
						ayuda.goto("<?=base_URL()?>datoscontacto")
					},5000)		
			}else{
				$('#add-tel').iziModal('close')
				$("#msjerror").iziModal('setSubtitle',lin.datos);
				mserror();
			}
			
			})
		}
})
</script>