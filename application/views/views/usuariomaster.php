<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text">
		  	LISTADO DE USUARIOS
		</div>
		<div class="banner-user"></div>
	</div>
</div>
<div class="container-fluid m-t-50">
	<div class="row menu-tab">
		
		<a href="<?= base_URL()?>datosuaurio" class="col-12 col-md-6 col-lg-6 col-xl-6  text-center  link "  >
			<div class="tab ">
				<i class="fa fa-user ibtn bgblue-1 white "></i>
				USUARIO
			</div>
		</a>
		<a href="<?= base_URL()?>listausuarios" class="col-12 col-md-6 col-lg-6 col-xl-6  text-center  link" l >
			<div class="tab current">
				<i class="fa fa-user-secret ibtn bgblue-1 white text-uppercase"></i>
			listado de usuarios
			</div>
		</a>
	</div>
</div>
<div class="container margin-top-40">
	<div class="row tables">
		<div class=" titulos-blanco  bgazul text-center thead col-12"><h4><strong>GESTIÓN DE USUARIOS</strong></h4></div>
		<?
			foreach ($usuarios as $key) {
			
		?>
		<div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 margin-top-40"><?= $key->Nombre." ".$key->Apellidos ?></div>
		<div class="col-12 col-sm-12 col-md-2 col-lg-3 col-xl-3 margin-top-40"><?= $key->Correo ?></div>
		<div class="col-12 col-sm-12 col-md-2 col-lg-1 col-xl-1 margin-top-40"><?= $key->Puesto ?></div>
		<div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2 text-right centrar-vertical-contend">
							<i class="fa fa-pencil bgblue-1 white iconos_botones " lld="mod-user" llc="<?= $key->IDUsuario ?>"></i>
		</div>
		<div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2 text-right centrar-vertical-contend">
							<i class="fa fa-times bgblue-1 white iconos_botones " lld="del-user" llc="<?= $key->IDUsuario ?>"></i>
		</div>
		<?
			if($key->Tipo_Usuario=="Master"){

			
		?>
		<div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2 text-right centrar-vertical-contend">
				<strong>Master</strong>
		</div>
		<?
	}else{	
		?>
		<div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2 text-right centrar-vertical-contend">
							<i class="fa fa-star bgblue-1 white iconos_botones " lld="master-user" llc="<?= $key->IDUsuario ?>" ></i>
		</div>
		<?
		}
		?>
		<div class="col-12 hr "></div>
		<?
		}
		?>
		<div class="col-12 text-right centrar-vertical-contend">
						<div class="form-group text-center margin-bottom-20">
			<div onclick="$('#add-user').iziModal('open')" llc="Update-dat-us" class="btn btn-primary aling-center"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Usuario</div>
		</div>
		</div>
	
	</div>
</div>
<div id="add-user" class="izimodal" width="700" data-title="Usuarios">
	<div class="container margin-top-40">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Nombre</label>
				     <input type="text" class="form-control" id="nombre" requerid="requerid" llc="Nombre"  placeholder="Nombre"> 
			  </div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Apellidos</label>
				     <input type="text" class="form-control" id="Apellidos" requerid="requerid" llc="Apellidos" placeholder="Apellidos"> 
			  </div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Puesto</label>
				     <input type="text" class="form-control" id="Puesto" requerid="requerid" llc="Puesto"  placeholder="Puesto"> 
			  </div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Correo Electronico</label>
				     <input type="email" class="form-control" id="Email" requerid="requerid" llc="Email"  placeholder="Correo Electronico"> 
			  </div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" id="div-1">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Contraseña</label>
				     <input type="password" class="form-control" id="c1" requerid="requerid" llc="Contraseña"  placeholder="Contraseña"> 
			  </div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" id="div-2">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Confirmar Contraseña</label>
				     <input type="password" class="form-control" id="c2" requerid="requerid" llc="Confirmar_Contraseña"  placeholder="Confirmar Contraseña"> 
			  </div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Visible</label>
				     <select name="" id="Visible" llc="Visible" class="form-control">
				     	<option value="1">Visible</option>
				     	<option value="0">Oculto</option>
				     </select>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-top-20 margin-bottom-40">
				<div class="row text-center">
					<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 btn btn-primary aling-center" llc="btn-add-usuario" style="margin: 0 auto;">
						Agregar Usuario
		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="mod-user" class="izimodal" width="700" data-title="Usuarios">
	<div class="container margin-top-40">
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Nombre</label>
				     <input type="text" class="form-control" id="nombre" requerid="requerid" llc="Nombre"  placeholder="Nombre"> 
			  </div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Apellidos</label>
				     <input type="text" class="form-control" id="Apellidos" requerid="requerid" llc="Apellidos" placeholder="Apellidos"> 
			  </div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Puesto</label>
				     <input type="text" class="form-control" id="Puesto" requerid="requerid" llc="Puesto"  placeholder="Puesto"> 
			  </div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Correo Electronico</label>
				     <input type="email" class="form-control" id="Email" requerid="requerid" llc="Email"  placeholder="Correo Electronico"> 
			  </div>
			</div>
		
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
				<div class="form-group">
				     <label for="nombre"  id="lbnombre" class="control-label">Visible</label>
				     <select name="" id="Visible" llc="Visible" class="form-control">
				     	<option value="1">Visible</option>
				     	<option value="0">Oculto</option>
				     </select>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-top-20 margin-bottom-40">
				<div class="row text-center">
					<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 btn btn-primary aling-center" llc="btn-mod-usuario" style="margin: 0 auto;">
						Actualizar Usuario
		
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).on("click",'i[lld="master-user"]',function(){
	obt={};
	obt["user"]=$(this).attr("llc");
	ayuda.senddata(obt,"<?=base_URL()?>/perfil/MoDMaster",function(data){
		lin=JSON.parse(data);
		if(lin.datos==true){
			ayuda.goto("<?=base_URL()?>listausuarios");
		}else{
			$('#mod-user').iziModal('close')
			$("#msjerror").iziModal('setSubtitle',lin.datos);
			mserror();
		}
	})
})
$(document).on("click",'i[lld="del-user"]',function(){
	obt={};
	obt["user"]=$(this).attr("llc");
	ayuda.senddata(obt,"<?=base_URL()?>perfil/DelUser",function(data){
		lin=JSON.parse(data);
		if(lin.datos==true){
			ayuda.goto("<?=base_URL()?>listausuarios");
		}else{
			$('#mod-user').iziModal('close')
			$("#msjerror").iziModal('setSubtitle',lin.datos);
			mserror();
		}
	})

})
	$(document).on("click",'div[llc="btn-add-usuario"]',function(){
		obt={};
		bandera=2;
		$('#add-user .form-control').each(function(index){
				if(ayuda.formval(this,'#add-user')==true){
					obt[$(this).attr("llc")]=$(this).val();
					bandera=1;
				}else{
					bandera=2;
					return false;
				}
		})
		if(bandera!=2){
			if($("#c1").val()!=$("#c2").val()){
				$("#msjerror").iziModal('setSubtitle',"Las contraseñas deben ser Iguales");
				mserror();
			}else{
				ayuda.senddata(obt,"<?=base_URL()?>perfil/AddUsuario",function(data){
				lin=JSON.parse(data);
				if(lin.datos==true){
					ayuda.goto("<?=base_URL()?>listausuarios")
				}else{
					$("#preeload").hide()
					$("#msjerror").iziModal('setSubtitle',lin.datos);
					mserror();
				}
				
				})
			}
			
		}
	})
$(document).on("click",'div[llc="btn-mod-usuario"]',function(){
		obt={};
		bandera=2;
		$('#mod-user .form-control').each(function(index){
				if(ayuda.formval(this,'#mod-user')==true){
					obt[$(this).attr("llc")]=$(this).val();
					bandera=1;
				}else{
					bandera=2;
					return false;
				}
		})
		if(bandera!=2){
				obt["num"]=sessionStorage.getItem("num")
				ayuda.senddata(obt,"<?= base_URL()?>/perfil/UpdateUser",function(data){
				lin=JSON.parse(data);
				if(lin.datos==true){
					ayuda.goto("<?= base_URL()?>listausuarios")
				}else{
					$("#preeload").hide()
					$("#msjerror").iziModal('setSubtitle',lin.datos);
					mserror();
				}
			})
		}
	})
$(document).on("click",'i[lld="mod-user"]',function(){
	$("#preeload").show()
	obt={};
	obt['user']=$(this).attr("llc");
	ayuda.senddata(obt,"<?= base_URL()?>/perfil/DaTUser",function(data){
		lin=JSON.parse(data);
		if(lin.pass==true){
			console.log(lin);
			$('#mod-user #nombre').val(lin.datos.Nombre);
			$('#mod-user #Apellidos').val(lin.datos.Apellidos);
			$('#mod-user #Puesto').val(lin.datos.Puesto);
			$('#mod-user #Email').val(lin.datos.Correo);
			sessionStorage.setItem("num",lin.datos.IDUsuario)
			if(lin.datos.Visible==1){
				cade="<option selected Value='1'>Visible</option><option  Value='0'>Oculto</option>"
			}else{
				cade="<option  Value='1'>Visible</option><option selected  Value='0'>Oculto</option>"
			}
			$('#mod-user #Visible').html(cade);
			$('#mod-user').iziModal('open')
			$("#preeload").hide()
		}else{
			$("#preeload").hide()
			$('#mod-user').iziModal('close')
			$("#msjerror").iziModal('setSubtitle',lin.datos);
			mserror();
		}
	})
})
$(document).on("click",'div[llc="btn-add-usuario"]',function(){
	obt={};
		bandera=2;
		$('#add-user .form-control').each(function(index){
				if(ayuda.formval(this,'#add-user')==true){
					obt[$(this).attr("llc")]=$(this).val();
					bandera=1;
				}else{
					bandera=2;
					return false;
				}
		})
		if(bandera!=2){
			if($("#c1").val()!=$("#c2").val()){
				$("#msjerror").iziModal('setSubtitle',"Las contraseñas deben ser Iguales");
				mserror();
			}else{
				ayuda.senddata(obt,"<?=base_URL()?>/perfil/AddUsuario",function(data){
				lin=JSON.parse(data);
				if(lin.datos==true){
					ayuda.goto("<?= base_URL()?>listausuarios")
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
