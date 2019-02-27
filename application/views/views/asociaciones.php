<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text">
			GESTIÓN DE ASOCIACIONES O CAMARAS
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
			<div class="tab ">
				<i class="fa fa-certificate ibtn bgblue-1 white"></i>
				CERTIFICACIONES
			</div>
		</a>
		<a href="<?= base_URL()?>asociaciones" class="col-12 col-md-2 col-lg-2 col-xl-2  text-center  link"  >
			<div class="tab current">
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
		if($asociaciones!=false){
			foreach ($asociaciones as $key) {
				?>
				<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
					<div class="col-12 "><?= $key->Asociacion ?></div>
					<div class="col-12 "> <?= $key->Web ?></div>
				</div>
				<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
					<div class="row">
						<div class="col-6">
							<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-right centrar-vertical-contend">
								<i class="fa fa-pencil bgblue-1 white iconos_botones " lld="mod-asocia" llc="<?= $key->IDAsocia ?>" ></i>
							</div>
						</div>
						<div class="col-6">
							<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-right centrar-vertical-contend">
								<i class="fa fa-times bgblue-1 white iconos_botones " lld="del-asocia" llc="<?= $key->IDAsocia ?>" ></i>
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
				<div  onclick="$('#add-Asocia').iziModal('open')" class="btn btn-primary aling-center"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Asociación</div>
			</div>
		</div>

	</div>
</div>
<div id="add-Asocia" class="izimodal" width="700" data-title="Agregar Asociación">
<div class="container margin-top-40">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group text-center">
					<label for="nombre"  id="lbnombre" class="control-label">Asociación/Camara</label>
					<input type="text" class="form-control" id="nombre" requerid="requerid" llc="Nombre_Asociacion"  placeholder="Nombre de Asociación"> 
				</div>
		</div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group text-center">
					<label for="nombre"  id="lbnombre" class="control-label">Sitio Web</label>
					<input type="text" class="form-control" id="web" requerid="requerid" llc="Web"  placeholder="Web"> 
				</div>
		</div>
		<div class="col-12 text-right centrar-vertical-contend">
				<div class="form-group text-center margin-bottom-20">
					<div llc="add-asocia"  class="btn btn-primary aling-center"><i class="fa fa-save" aria-hidden="true"></i> Guardar Datos</div>
				</div>
			</div>
	</div>
</div>
</div>
<div id="mod-Asocia" class="izimodal" width="700" data-title="Agregar Asociación">
<div class="container margin-top-40">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group text-center">
					<label for="nombre"  id="lbnombre" class="control-label">Asociación/Camara</label>
					<input type="text" class="form-control" id="nombre" requerid="requerid" llc="Nombre_Asociacion"  placeholder="Nombre de Asociación"> 
				</div>
		</div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group text-center">
					<label for="nombre"  id="lbnombre" class="control-label">Sitio Web</label>
					<input type="text" class="form-control" id="web" requerid="requerid" llc="Web"  placeholder="Web"> 
				</div>
		</div>
		<div class="col-12 text-right centrar-vertical-contend">
				<div class="form-group text-center margin-bottom-20">
					<div llc="mod-asocia"  class="btn btn-primary aling-center"><i class="fa fa-save" aria-hidden="true"></i> Guardar Datos</div>
				</div>
			</div>
	</div>
</div>
</div>
<script>
	$(document).on('click','div[llc="mod-asocia"]',function(){
		obt={};
		obt["num"]=sessionStorage.getItem("numasocia")
				var div="#mod-Asocia";
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
				console.log(obt);
				if(bandera!=3){
					ayuda.senddata(obt,"<?= base_URL() ?>asociaciones/UpdateAsocia",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							ayuda.goto("<?= base_URL() ?>perfil/asociaciones");
						}else{
							$("#add-giro").iziModal("close")
							$("#msjerror").iziModal('setSubtitle',lin.datos);
							mserror();
						}
					})
				}
	})
$(document).on('click','i[lld="mod-asocia"]',function(){
		obt={};
		obt["asocia"]=$(this).attr("llc");
		ayuda.senddata(obt,"<?= base_URL() ?>asociaciones/DatAsocia",function(data){
		lin=JSON.parse(data);
		if(lin.pass==1){
			sessionStorage.setItem("numasocia",lin.datos[0].IDAsocia);
			$("#mod-Asocia #nombre").val(lin.datos[0].Asociacion);
			$("#mod-Asocia #web").val(lin.datos[0].Web);
			$("#mod-Asocia").iziModal('open')
		}else{
			$("#add-giro").iziModal("close")
			$("#msjerror").iziModal('setSubtitle',lin.datos);
			mserror();
		}
	})
})
$(document).on('click','i[lld="del-asocia"]',function(){
		obt={};
		obt["asocia"]=$(this).attr("llc");
		ayuda.senddata(obt,"<?= base_URL() ?>asociaciones/DeleteAsocia",function(data){
		lin=JSON.parse(data);
		if(lin.datos==true){
			ayuda.goto("<?= base_URL() ?>perfil/asociaciones");
		}else{
			$("#add-giro").iziModal("close")
			$("#msjerror").iziModal('setSubtitle',lin.datos);
			mserror();
		}
	})
})
	$(document).on('click','div[llc="add-asocia"]',function(){
		obt={};
				var div="#add-Asocia";
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
					ayuda.senddata(obt,"<?= base_URL() ?>asociaciones/AddAsocia",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							ayuda.goto("<?= base_URL() ?>perfil/asociaciones");
						}else{
							$("#add-giro").iziModal("close")
							$("#msjerror").iziModal('setSubtitle',lin.datos);
							mserror();
						}
					})
				}
	})
</script>
