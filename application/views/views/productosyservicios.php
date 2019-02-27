<style>
	#divprod .img-fluid{
		max-width: 90px;
	}
</style>
<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text">
			GESTIÓN DE SERVICIOS Y PRODUCTOS
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
			<div class="tab current">
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
<div class="container margin-top-40" id="divprod">
	<div class="row">
		<div class=" col-12 tutilos-negros text-center margin-bottom-30"><h4><strong></strong></h4></div>
		<?
			if ($servicios!=false) {
				foreach ($servicios as $key) {
				?>
					<div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2 text-center">
						<?
						if($key->Foto!=""){
							?>
								<img class="img-fluid" src="<?= base_URL()."/assets/img/logoprod/".$key->Foto ?>" alt="">
							<?
						}else{
							?>
							  <img class="img-fluid" src="<?= base_URL()."/assets/img/foto-no-disponible.jpg" ?>" alt="">
							<?
						}

						?>
					</div>
					<div class="col-8 col-sm-8 col-md-4 col-lg-4 col-xl-4 centrar-vertical-contend">
						<div class="row ">
							<div class="col-12 text-left"><?= $key->Producto ?></div>
							<div class="col-12 text-left"><?= $key->Promocion?></div>
							<div class="col-12 text-left"><?= $key->Descripcion ?></div>
						</div>

					</div>
					
					<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 centrar-vertical-contend">
						<div class="row ">
							<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-right centrar-vertical-contend">
							<i class="fa fa-pencil bgblue-1 white iconos_botones " lld="mod-prod" llc="<?= $key->IDProducto ?>" ></i>
							</div>
							<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-right centrar-vertical-contend">
							<i class="fa fa-times bgblue-1 white iconos_botones " lld="del-prod" llc="<?= $key->IDProducto ?>" ></i>
							</div>
						</div>
					</div>
					<div class="col-12 hr margin-top-10 margin-bottom-10"></div>
				<?
				}
			}
			
		?>
		<div class="col-12 text-right centrar-vertical-contend">
						<div class="form-group text-center margin-bottom-20">
			<div  llc="add-prod" class="btn btn-primary aling-center"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Producto o Servicio</div>
		</div>
		</div>
	</div>
</div>
<div id="add-prod" class="izimodal" width="700" data-title="Agregar Producto o Servicio">
<div class="container margin-top-30">
	<div class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="form-group text-center">
				    
				     <img class="img-fluid aling-center" onclick="document.getElementById('file-img-prod').click(); " src="<?= base_URL()."/assets/img/foto-no-disponible.jpg" ?>" id="img-prod-box" >
				     <input type="file" id="file-img-prod" accept="image/*" style="display: none;">
			  </div>
			
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Producto o Promoción</label>
				     <input type="text" class="form-control" id="producto" requerid="requerid" llc="Producto"  placeholder="Producto"> 
			  </div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Promocion</label>
				     <input type="text" class="form-control" id="nombre" requerid="requerid" llc="promocion"  placeholder="Promoción"> 
			  </div>
			</div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Descripción</label>
				     <textarea col="3" row="20" class="form-control" id="descripcion"  llc="Descripcion"  placeholder="Nombre">
				   </textarea>
			  </div>
		</div>
		<div class="col-12 text-right centrar-vertical-contend">
						<div class="form-group text-center margin-bottom-20">
			<div  llc="add-prod" class="btn btn-primary aling-center"><i class="fa fa-save" aria-hidden="true"></i>  Guardar Datos</div>
		</div>
		</div>
	</div>
</div>

</div>
<div id="mod-prod" class="izimodal" width="700" data-title="Modificar Producto o Servicio">
<div class="container margin-top-30">
	<div class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="form-group text-center">
				    
				     <img class="img-fluid aling-center" onclick="document.getElementById('file-img-prod2').click(); " src="<?= base_URL()."/assets/img/foto-no-disponible.jpg" ?>" id="img-prod-box2" >
				     <input type="file" id="file-img-prod2" accept="image/*" style="display: none;">
			  </div>
			
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Producto o Promoción</label>
				     <input type="text" class="form-control" id="producto" requerid="requerid" llc="Producto"  placeholder="Producto"> 
			  </div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Promocion</label>
				     <input type="text" class="form-control" id="Promocion" requerid="requerid" llc="promocion"  placeholder="Promoción"> 
			  </div>
			</div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Descripción</label>
				     <textarea col="3" row="20" class="form-control" id="Descripcion"  llc="Descripcion"  placeholder="Nombre">
				   </textarea>
			  </div>
		</div>
		<div class="col-12 text-right centrar-vertical-contend">
						<div class="form-group text-center margin-bottom-20">
			<div  llc="mod-prod" class="btn btn-primary aling-center"><i class="fa fa-save" aria-hidden="true"></i>  Guardar Datos</div>
		</div>
		</div>
	</div>
</div>
</div>

<script>
$(document).on("click",'div[llc="mod-prod"]',function(){
	if($("#file-img-prod2")[0].files.length>0){
			ayuda.subirimagen('file-img-prod2',"<?= base_URL() ?>perfil/AddLogoProd",function(data){
				obt={};
				obt["Foto"]=data;
				obt["acc"]=3;
				obt["num"]=sessionStorage.getItem("numProd");
				bandera=2;
				$('#mod-prod .form-control').each(function(index){
					if(ayuda.formval(this,'#mod-prod')==true){
						obt[$(this).attr("llc")]=$(this).val();
						bandera=1;
					}else{
						bandera=2;
						return false;
					}
				})
				if(bandera!=2){
					ayuda.senddata(obt,"<?= base_URL() ?>/perfil/AccProd",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							ayuda.goto("<?= base_URL() ?>/perfil/productosyservicios");
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
			bandera=2;
			$('#mod-prod .form-control').each(function(index){
					if(ayuda.formval(this,'#mod-prod')==true){
						obt[$(this).attr("llc")]=$(this).val();
						bandera=1;
					}else{
						bandera=2;
						return false;
					}
		})
		if(bandera!=2){
			obt["Foto"]=sessionStorage.getItem("FoProd");
			obt["acc"]=3;
			obt["num"]=sessionStorage.getItem("numProd");
			ayuda.senddata(obt,"<?= base_URL() ?>/perfil/AccProd",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							ayuda.goto("<?= base_URL() ?>/perfil/productosyservicios");
						}else{
							$("#add-giro").iziModal("close")
							$("#msjerror").iziModal('setSubtitle',lin.datos);
							mserror();
						}
					})
		}

		}
})
	$(document).on("click",'i[lld="mod-prod"]',function(){
		obt={};
		obt["prod"]=$(this).attr("llc");
		obt["acc"]=2;
		ayuda.senddata(obt,"<?= base_URL() ?>/perfil/AccProd",function(data){
			lin=JSON.parse(data);
			if(lin.pass1==1){
				$("#mod-prod #producto").val(lin.datos[0].Producto)
				$("#mod-prod #Promocion").val(lin.datos[0].Promocion)
				$("#mod-prod #Descripcion").val(lin.datos[0].Descripcion)
				sessionStorage.setItem("numProd",lin.datos[0].IDProducto);
				sessionStorage.setItem("FoProd",lin.datos[0].Foto);
				if(lin.datos[0].Foto!=""){
					$("#img-prod-box2").attr("src","<?= base_URL() ?>/assets/img/logoprod/"+lin.datos[0].Foto)
				}
				$("#mod-prod").iziModal('open')
			}else{
				$('#mod-user').iziModal('close')
				$("#msjerror").iziModal('setSubtitle',lin.datos);
				mserror();
			}
		})
	})
	$(document).on("click",'i[lld="del-prod"]',function(){
		obt={};
		obt["prod"]=$(this).attr("llc");
		obt["acc"]=1;
		ayuda.senddata(obt,"<?= base_URL() ?>/perfil/AccProd",function(data){
			lin=JSON.parse(data);
			if(lin.datos==true){
				ayuda.goto("<?= base_URL() ?>/perfil/productosyservicios");
			}else{
				$('#mod-user').iziModal('close')
				$("#msjerror").iziModal('setSubtitle',lin.datos);
				mserror();
			}
		})

	})
	$(document).on("click",'div[llc="add-prod"]',function(){
		$("#add-prod").iziModal("open")
	})
	$(document).on("click",'#add-prod div[llc="add-prod"]',function(){
		if($("#file-img-prod")[0].files.length>0){
			ayuda.subirimagen('file-img-prod',"<?= base_URL() ?>/perfil/AddLogoProd",function(data){
				obt={};
				obt["Foto"]=data;
				bandera=2;
				$('#add-prod .form-control').each(function(index){
					if(ayuda.formval(this,'#add-prod')==true){
						obt[$(this).attr("llc")]=$(this).val();
						bandera=1;
					}else{
						bandera=2;
						return false;
					}
				})
				if(bandera!=2){
					ayuda.senddata(obt,"<?= base_URL() ?>/perfil/AddProd",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							ayuda.goto("<?= base_URL() ?>/perfil/productosyservicios");
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
			bandera=2;
			$('#add-prod .form-control').each(function(index){
					if(ayuda.formval(this,'#add-prod')==true){
						obt[$(this).attr("llc")]=$(this).val();
						bandera=1;
					}else{
						bandera=2;
						return false;
					}
		})
		if(bandera!=2){
			obt["Foto"]="";
			ayuda.senddata(obt,"<?= base_URL() ?>perfil/AddProd",function(data){
						lin=JSON.parse(data);
						if(lin.datos==true){
							ayuda.goto("<?= base_URL() ?>perfil/productosyservicios");
						}else{
							$("#add-giro").iziModal("close")
							$("#msjerror").iziModal('setSubtitle',lin.datos);
							mserror();
						}
					})
		}

		}
	})
	$(document).on("change","#file-img-prod",function(){
	ayuda.previsualizar(this,"img-prod-box");
})
	$(document).on("change","#file-img-prod2",function(){
	ayuda.previsualizar(this,"img-prod-box2");
})
</script>
