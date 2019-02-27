<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text">
			GESTIÓN DE CERTIFICACIONES
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
			<div class="tab">
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
		<a href="<?= base_URL()?>certificaciones" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link"  >
			<div class="tab current">
				<i class="fa fa-certificate ibtn bgblue-1 white"></i>
				CERTIFICACIONES
			</div>
		</a>
		<a href="<?= base_URL()?>asociaciones" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link"  >
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
<div class="container margin-top-40">
	<div class="row">
		<div class=" col-12 tutilos-negros text-center margin-bottom-30"><h4><strong></strong></h4></div>
		<? 
		if($certificacion!=false){
			foreach ($certificacion as $key) {
				?>
				<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
					<div class="col-12 "><?= $key->Norma ?></div>
					<div class="col-12 ">Fecha: <?= $key->Fecha ?></div>
					<div class="col-12 ">Calificación:<?= $key->Calif ?></div>
					<?if($key->Archivo!=""){
						?>
						<div class="col-12 "><a href="<?= base_URL()."assets/certificaciones/".$key->Archivo?>" target="_blanck">Ver Certificación:<?= $key->Archivo ?></a></div>
						<?
					}?>


				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
					<div class="row">
						<div class="col-6">
							<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-right centrar-vertical-contend">
								<i class="fa fa-pencil bgblue-1 white iconos_botones " lld="mod-cert" llc="<?= $key->IDNorma ?>" ></i>
							</div>
						</div>
						<div class="col-6">
							<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-right centrar-vertical-contend">
								<i class="fa fa-times bgblue-1 white iconos_botones " lld="del-cert" llc="<?= $key->IDNorma ?>" ></i>
							</div>
						</div>
					</div>

				</div>
				<div class="col-12 hr"></div>
				<?
			}
		}
		
		?>
		<div class="col-12 text-right centrar-vertical-contend">
			<div class="form-group text-center margin-bottom-20">
				<div  onclick="$('#add-Certif').iziModal('open')" class="btn btn-primary aling-center"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Certificación</div>
			</div>
		</div>

	</div>
</div>
<div id="add-Certif" class="izimodal" width="700" data-title="Agregar Certificación">
	<div class="container margin-top-40">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group text-center">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
							<label for="nombre"  id="lbnombre" class="control-label">PDF/JPG/JPEG/PNG/GIF</label>
							<input type="text" class="form-control" disabled="disabled" id="nombrearchivo"  llc="Nombre_Archivo"  placeholder=""> 
						</div>
						<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 centrar-vertical-contend">
							<div class="btn btn-primary" onclick="document.getElementById('file-archivo').click(); ">Seleccionar</div>
							<input type="file" id="file-archivo" accept="application/pdf,image/*" style="display: none;">
						</div>
					</div>
					

				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group text-center">
					<label for="nombre"  id="lbnombre" class="control-label">Nombre de Certificación</label>
					<input type="text" class="form-control" id="nombre" requerid="requerid" llc="Nombre_Certificacion"  placeholder="Nombre de Certificación"> 
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group text-center">
					<label for="nombre"  id="lbnombre" class="control-label">Fecha de Calificación</label>
					<input type="date" class="form-control" id="fecha" requerid="requerid" llc="Fecha_Certificacion"  placeholder="YYYY-mm-dd"> 
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group text-center">
					<label for="nombre"  id="lbnombre" class="control-label">Calificación</label>
					<input type="text" class="form-control" id="Calificacion" requerid="requerid" llc="Calificacion"  placeholder="Calificacion"> 
				</div>
			</div>
			<div class="col-12 text-right centrar-vertical-contend">
				<div class="form-group text-center margin-bottom-20">
					<div llc="add-Certif"  class="btn btn-primary aling-center"><i class="fa fa-save" aria-hidden="true"></i> Guardar Datos</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="mod-Certif" class="izimodal" width="700" data-title="Agregar Certificación">
	<div class="container margin-top-40">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group text-center">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
							<label for="nombre"  id="lbnombre" class="control-label">PDF/JPG/JPEG/PNG/GIF</label>
							<input type="text" class="form-control" disabled="disabled" id="nombrearchivo"  llc="Nombre_Archivo"  placeholder=""> 
						</div>
						<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 centrar-vertical-contend">
							<div class="btn btn-primary" onclick="document.getElementById('file-archivo').click(); ">Seleccionar</div>
							<input type="file" id="file-archivo" accept="application/pdf,image/*" style="display: none;">
						</div>
					</div>
					

				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group text-center">
					<label for="nombre"  id="lbnombre" class="control-label">Nombre de Certificación</label>
					<input type="text" class="form-control" id="nombre" requerid="requerid" llc="Nombre_Certificacion"  placeholder="Nombre de Certificación"> 
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group text-center">
					<label for="nombre"  id="lbnombre" class="control-label">Fecha de Calificación</label>
					<input type="date" class="form-control" id="fecha" requerid="requerid" llc="Fecha_Certificacion"  placeholder="YYYY-mm-dd"> 
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group text-center">
					<label for="nombre"  id="lbnombre" class="control-label">Calificación</label>
					<input type="text" class="form-control" id="Calificacion" requerid="requerid" llc="Calificacion"  placeholder="Calificacion"> 
				</div>
			</div>
			<div class="col-12 text-right centrar-vertical-contend">
				<div class="form-group text-center margin-bottom-20">
					<div llc="mod-Certif"  class="btn btn-primary aling-center"><i class="fa fa-save" aria-hidden="true"></i> Guardar Datos</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).on("click",'div[llc="mod-Certif"]',function(){
	if($("#file-archivo")[0].files.length>0){
			ayuda.subirimagen("file-archivo","<?= base_URL() ?>certificaciones/subirarcvhivo",function(data){
				obt={};
				obt["num"]=sessionStorage.getItem("Numcert");
				var div="#mod-Certif";
				bandera=3;
				$(div+" .form-control").each(function(index){
					if(ayuda.formval(this,div)==true){
						bandera=1;
						obt[$(this).attr("llc")]=$(this).val();
					}else{
						bandera=3;
						return false;
					}
				})
				console.log
				if(bandera!=3){
					ayuda.senddata(obt,"<?= base_URL() ?>certificaciones/UpdateCertif",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							ayuda.goto("<?= base_URL() ?>perfil/certificaciones");
						}else{
							$("#add-giro").iziModal("close")
							$("#msjerror").iziModal('setSubtitle',lin.datos);
							mserror();
						}
					})
				}
				})
		}else{
			obt={};
				var div="#mod-Certif";
			obt["num"]=sessionStorage.getItem("Numcert");
				bandera=3;
				$(div+" .form-control").each(function(index){
					if(ayuda.formval(this,div)==true){
						bandera=1;
						obt[$(this).attr("llc")]=$(this).val();
					}else{
						bandera=3;
						return false;
					}
				})
				console.log
				if(bandera!=3){
					ayuda.senddata(obt,"<?= base_URL() ?>certificaciones/UpdateCertif",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							ayuda.goto("<?= base_URL() ?>perfil/certificaciones");
						}else{
							$("#add-giro").iziModal("close")
							$("#msjerror").iziModal('setSubtitle',lin.datos);
							mserror();
						}
					})
				}
			
		}
})
$(document).on("click",'i[lld="mod-cert"]',function(){
	$("#preddloader").show()
	obt={}
	obt["certif"]=$(this).attr("llc");
	ayuda.senddata(obt,"<?= base_URL() ?>certificaciones/DatCert",function(data){
		lin=JSON.parse(data);
		if(lin.pass==1){
			$("#mod-Certif #nombrearchivo").val(lin.datos[0].Archivo)
			$("#mod-Certif #fecha").val(lin.datos[0].Fecha)
			$("#mod-Certif #Calificacion").val(lin.datos[0].Calif)
			$("#mod-Certif #nombre").val(lin.datos[0].Norma)
			sessionStorage.setItem("Numcert",lin.datos[0].IDNorma)
			$("#mod-Certif").iziModal("open");
				$("#preddloader").hide()
		}else{
			$("#preddloader").hide()
			$("#msjerror").iziModal('setSubtitle',lin.datos);
			mserror();
		}
	})
})
$(document).on("click",'i[lld="del-cert"]',function(){
	obt={}
	obt["certif"]=$(this).attr("llc");
	ayuda.senddata(obt,"<?= base_URL() ?>certificaciones/DelCert",function(data){
		lin=JSON.parse(data);
		if(lin.datos==true){
			ayuda.goto("<?= base_URL() ?>perfil/certificaciones");
		}else{
			$("#add-giro").iziModal("close")
			$("#msjerror").iziModal('setSubtitle',lin.datos);
			mserror();
		}
	})
})
	$(document).on("change","#file-archivo",function(){
		console.log($(this)[0].files[0]);
		if($(this)[0].files[0].size>20971520){
			$("#msjerror").iziModal('setSubtitle',"El Archivo no puede sobrepasar los 20 MB");
			mserror();
		}else{
			$("#nombrearchivo").val($(this)[0].files[0].name)
		}
		
	})
	$(document).on("click",'div[llc="add-Certif"]',function(){
		if($("#file-archivo")[0].files.length>0){
			ayuda.subirimagen("file-archivo","<?= base_URL() ?>certificaciones/subirarcvhivo",function(data){
				obt={};
				var div="#add-Certif";
				bandera=3;
				$(div+" .form-control").each(function(index){
					if(ayuda.formval(this,div)==true){
						bandera=1;
						obt[$(this).attr("llc")]=$(this).val();
					}else{
						bandera=3;
						return false;
					}
				})
				console.log
				if(bandera!=3){
					ayuda.senddata(obt,"<?= base_URL() ?>certificaciones/AddCertif",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							ayuda.goto("<?= base_URL() ?>perfil/certificaciones");
						}else{
							$("#add-giro").iziModal("close")
							$("#msjerror").iziModal('setSubtitle',lin.datos);
							mserror();
						}
					})
				}
				})
		}else{
			obt={};
				var div="#add-Certif";
				bandera=3;
				$(div+" .form-control").each(function(index){
					if(ayuda.formval(this,div)==true){
						bandera=1;
						obt[$(this).attr("llc")]=$(this).val();
					}else{
						bandera=3;
						return false;
					}
				})
				console.log
				if(bandera!=3){
					ayuda.senddata(obt,"<?= base_URL() ?>certificaciones/AddCertif",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							ayuda.goto("<?= base_URL() ?>perfil/certificaciones");
						}else{
							$("#add-giro").iziModal("close")
							$("#msjerror").iziModal('setSubtitle',lin.datos);
							mserror();
						}
					})
				}
			
		}
	})
</script>