
<script>	
	$(document).on('change','#add-giro select[llc="sector"]',function(){
		var obj={};
		obj["sector"]=$(this).val();
		var dim=$(this).attr("lld")
		ayuda.senddata(obj,"<?=base_URL()?>registro/getSubsector",function(data){
			var cade="<option value='0'>Selecciona</option>";
			var lin=JSON.parse(data);
			for(key in lin.subnivel ){
				cade+="<option value='"+lin.subnivel[key].numero+"'>"+lin.subnivel[key].nombre+"</option>";		
			}
			$("#add-giro #subsector").html(cade);
		})
	})
	$(document).on('change','#add-giro select[llc="Subsector"]',function(){
		var obj={};
		obj["rama"]=$(this).val();
		var dim=$(this).attr("lld")
		ayuda.senddata(obj,"<?=base_URL()?>registro/getrama",function(data){
			var cade="<option value='0'>Selecciona</option>";
			var lin=JSON.parse(data);
			for(key in lin.rama ){
				cade+="<option value='"+lin.rama[key].numero+"'>"+lin.rama[key].nombre+"</option>";	
			}
			$("#add-giro #rama").html(cade);
		});
	})
	$(document).on("click","div[llc='gurdar-dat']",function(){
		obt={};
		var div="#Dats-Genral";
		bandera=0;
		$(div+" .form-control").each(function(index){
			if(ayuda.formval(this,div)==true){
				bandera=1;
				obt[$(this).attr("llc")]=$(this).val();
			}else{
				bandera=3;
				return false;
			}
		})
		console.log(bandera)
		if(bandera==1){
			ayuda.senddata(obt,"<?=base_URL()?>perfil/UpdateEmpresaGen",function(data){
				lin=JSON.parse(data);
				if(lin.datos==true){
					$("#msjsucces").iziModal('setSubtitle',"Exito,se actualizara esta pagina en 5 seg.");
					mssucces();
					setTimeout(function(){
						ayuda.goto("<?=base_URL()?>perfil/datosempresa")
					},5000)		
				}else{
					$("#msjerror").iziModal('setSubtitle',lin.datos);
					mserror();
				}


			});
		}
	});
	$(document).on('click','div[llc="btn-add-giro"]',function(){
		obt={};
		obt['sector']=$('select[llc="sector"]').val();
		obt['Subsector']=$('select[llc="Subsector"]').val();
		obt['Rama']=$('select[llc="Rama"]').val();
		ayuda.senddata(obt,"<?=base_URL()?>perfil/AddGiroEmpresa",function(data){
			lin=JSON.parse(data);
			if(lin.datos==true){
				$("#add-giro").iziModal("close")
				$("#msjsucces").iziModal('setSubtitle',"Exito,se actualizara esta pagina en 5 seg.");
				mssucces();
				setTimeout(function(){
					ayuda.goto("<?=base_URL()?>perfil/datosempresa")
				},5000)		
			}else{
				$("#add-giro").iziModal("close")
				$("#msjerror").iziModal('setSubtitle',lin.datos);
				mserror();
			}
			
		})
	})
	$(document).on('click','i[lld="delete-giros"]',function(){
		obt={};
		obt['giro']=$(this).attr("llc");
		ayuda.senddata(obt,"<?=base_URL()?>perfil/DeleteGri",function(data){
			lin=JSON.parse(data);
			if(lin.datos==true){
				ayuda.goto("<?=base_URL()?>perfil/datosempresa");
			}else{
				$("#add-giro").iziModal("close")
				$("#msjerror").iziModal('setSubtitle',lin.datos);
				mserror();
			}
		})
	})
	$(document).on('click',"i[lld='principal-giros']",function(){
		obt={};
		obt['giro']=$(this).attr("llc");
		ayuda.senddata(obt,"<?=base_URL()?>perfil/PrincipalGiro",function(data){
			lin=JSON.parse(data);
			if(lin.datos==true){
				ayuda.goto("<?=base_URL()?>perfil/datosempresa");
			}else{
				$("#add-giro").iziModal("close")
				$("#msjerror").iziModal('setSubtitle',lin.datos);
				mserror();
			}
		})
	})
	$(document).on('click',"i[lld='del-marca']",function(){
		obt={};
		obt['marca']=$(this).attr("llc");
		ayuda.senddata(obt,"<?=base_URL()?>perfil/DelMarca",function(data){
			lin=JSON.parse(data);
			if(lin.datos==true){
				ayuda.goto("<?=base_URL()?>perfil/datosempresa");
			}else{
				$("#add-giro").iziModal("close")
				$("#msjerror").iziModal('setSubtitle',lin.datos);
				mserror();
			}
		})
	})
	$(document).on('click','div[llc="addmarca"]',function(){
		ayuda.subirimagen('file-input-mrca-logo',"<?=base_URL()?>perfil/AddLogoMarca",function(data){
			obt={};
			obt['marca']=$("#add-marca #text-marca").val();
			obt['imagen']=data;
			console.log(obt)
			ayuda.senddata(obt,"<?=base_URL()?>perfil/AddMarca",function(data){
				lin=JSON.parse(data);
				if(lin.datos==true){
					ayuda.goto("<?=base_URL()?>perfil/datosempresa");
				}else{
					$("#add-giro").iziModal("close")
					$("#msjerror").iziModal('setSubtitle',lin.datos);
					mserror();
				}
			});
		})
	})
	$(document).on('click',"i[lld='mod-marca']",function(){
		obt={};
		obt['marca']=$(this).attr("llc");
		ayuda.senddata(obt,"<?=base_URL()?>perfil/DatosMarca",function(data){
			li=JSON.parse(data);
			if(li.pass==1){
				$("#add-marca #text-marca").val(li.marca[0]["Marca"]);
				if(li.marca[0]["logo"]!=""){
					$("#add-marca #img-marca").attr("src","<?= base_URL()?>/assets/img/logosmarcas/"+li.marca[0]["logo"]);
				}
				sessionStorage.setItem("logoMarca",li.marca[0]["logo"])
				sessionStorage.setItem("IDMarca",li.marca[0]["IDMarca"])
				$('#add-marca div[llc="addmarca"]').attr("llc","UpdateMarca");
				$("#add-marca").iziModal('open');
			}else{
				$("#msjerror").iziModal('setSubtitle',li.mensaje);
				mserror();
			}
		})
	})
	$(document).on('click','div[llc="UpdateMarca"]',function(){
		if($("#file-input-mrca-logo")[0].files.length==0){
			obt={};
			obt["IDMarca"]=sessionStorage.getItem("IDMarca")
			obt["logo"]=sessionStorage.getItem("logoMarca")
			obt["Marca"]=$("#add-marca #text-marca").val();
			ayuda.senddata(obt,"<?=base_URL()?>perfil/UpdateMarca",function(data){
				lin=JSON.parse(data);
				if(lin.datos==true){
					ayuda.goto("<?=base_URL()?>perfil/datosempresa");
				}else{
					$("#add-giro").iziModal("close")
					$("#msjerror").iziModal('setSubtitle',lin.datos);
					mserror();
				}
			});
		}else{
			ayuda.subirimagen('file-input-mrca-logo',"<?=base_URL()?>perfil/AddLogoMarca",function(data){
				obt={};
				obt["IDMarca"]=sessionStorage.getItem("IDMarca")
				obt['Marca']=$("#add-marca #text-marca").val();
				obt['logo']=data;
				console.log(obt)
				ayuda.senddata(obt,"<?=base_URL()?>perfil/UpdateMarca",function(data){
					lin=JSON.parse(data);
					if(lin.datos==true){
						ayuda.goto("<?=base_URL()?>perfil/datosempresa");
					}else{
						$("#add-giro").iziModal("close")
						$("#msjerror").iziModal('setSubtitle',lin.datos);
						mserror();
					}
				});
			})
		}
	})
	$(document).on('click','div[llc="subirlogoempre"]',function(){
		ayuda.subirimagen('file-input-logo',"<?=base_URL()?>perfil/AddLogoEmpresa",function(data){
			if(data==true){
				ayuda.goto("<?=base_URL()?>perfil/datosempresa");
			}else{
				$("#add-giro").iziModal("close")
				$("#msjerror").iziModal('setSubtitle',data);
				mserror();
			}
		})
	})
	$(document).on("change","#file-input-mrca-logo",function(){
		ayuda.previsualizar(this,"img-marca");
	})
	$(document).on("change","#file-input-logo",function(){
		ayuda.previsualizar(this,"Logo-Empresa-img");
	})

</script>
<style>

#Logo-Empresa-img{
	max-width: 300px;
}
</style>
<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text">
			DATOS DE GENERALES DE MI EMPRESA
		</div>
		<div class="banner-imgdats"></div>
	</div>
</div>
<div class="container-fluid margin-top-40 menu-tab" id="Dats-Genral">
	<div class="row">
		<a  href="<?= base_URL()?>datosempresa" class="col-12  col-md-2 col-lg-2 col-xl-2  text-center link" >
			<div class="tab current">
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
<div class="container margin-top-40">
	<form id="frmdatosempresa" method="post" data-send="<?= base_URL('empresa/updateempresa')?>" class="row datosempresa margin-top-40">
		<? 
			
		$data=array('name'=>"num","value"=>$datos->IDEmpresa,"type"=>"hidden");
				echo form_input($data);?>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Razon Social</label>
				<? $data=array('name'=>"razon_social","id"=>"rz","llc"=>"Razon_Social","requerid"=>"requerid","value"=>$datos->Razon_Social,"class"=>"form-control","type"=>"text");
				echo form_input($data);?>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Nombre Comercial</label>
				<?$data=array('name'=>"nombre_comercial","id"=>"nc","llc"=>"Nombre_Comercial","requerid"=>"requerid","value"=>$datos->Nombre_Comer,"class"=>"form-control","type"=>"text");
				echo form_input($data);?>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">RFC</label>
				<?$data=array('name'=>"rfc","id"=>"rfc","value"=>$datos->RFC,"llc"=>"RFC","requerid"=>"requerid","class"=>"form-control","type"=>"text");
				echo form_input($data);?>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Tipo de Empresa</label>
				<select name="tipo_empresa" llc="tipo_Empresa" requerid="requerid" class="form-control">
					<option selected value="">Selecciona</option>
					<?php
					foreach ($TipoEmpresa as $key ) {
						if($datos->TipoEmpresa==$key->Tipo){
							?>
							<option selected value="<?=$key->Tipo?>"> <?=$key->Tipo?></option>
							<?php
						}else{
							?>
							<option value="<?=$key->Tipo?>"> <?=$key->Tipo?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">No. empleados</label>
				<select name="no_empleados" llc="no_Empleados" requerid="requerid" class="form-control">
					<option selected value="">Selecciona</option>
					<?php

					foreach ($NoEmplado as $key ) {
						if($datos->NoEmpleados==$key->Num){
							?>
							<option selected value="<?=$key->Num?>"> <?=$key->Num?></option>
							<?php
						}else{
							?>
							<option value="<?=$key->Num?>"> <?=$key->Num?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Facturación Anual</label>
				<select name="facturacion_anual" llc="facturacion_Anual" requerid="requerid" class="form-control">
					<option selected value="">Selecciona</option>
					<?php
					foreach ($factAnual as $key ) {
						if($datos->FacAnual==$key->FacAnual){
							?>
							<option selected value="<?=$key->FacAnual?>"> <?=$key->FacAnual?></option>
							<?php
						}else{
							?>
							<option value="<?=$key->FacAnual?>"> <?=$key->FacAnual?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Días de Pago de su plan /Mes</label>
				<?$data=array('name'=>"diaspago","id"=>"doaspago","value"=>$datos->DiasPago,"disabled"=>"disabled","class"=>"form-control","type"=>"text");
				echo form_input($data);?>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div id="" class="form-group">
				<label for="nombre"  id="lbnombre" class="control-label">Descripción de la Empresa</label>
				<?$data=array('name'=>"descripcion_empresa","id"=>"perfil","llc"=>"Perfil","requerid"=>"requerid","value"=>$datos->Perfil,"cols"=>"30","rows"=>"10","class"=>"form-control","type"=>"text");
				echo form_textarea($data);?>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div id="" class="form-group text-center">
				<div class="btn btn-primary aling-center" data-acc="updateempresa"><i class="fa fa-save" aria-hidden="true"></i> Guardar Cambios</div>
			</div>
		</div>
	</form>
	
</div>
<div class="container margin-top-40" id="div-Giros">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="padding: 0px 30px;">
			<div class="row">
				<div class="col-6 tutilos-negros margin-bottom-40"><h4><strong>Giros</strong></h4></div>
				<div class="col-6  text-right">
					<i class="fa fa-plus bgblue-1 white iconos_botones" onclick="$('#add-giro').iziModal('open')"></i>

				</div>
				<? foreach ($GirosEmpresa as $key) {
					?>

					<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 text-center centrar-vertical-contend"><span><h5><?=$key["Giro"]?></h5></span></div>
					<div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 text-center centrar-vertical-contend">
						<i class="fa fa-times bgblue-1 white iconos_botones" lld="delete-giros"  llc="<?=$key["Num"]?>"></i>
					</div>

					<?
					if($key["Principal"]=="1"){
						?>
						<div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 text-right centrar-vertical-contend">
							<span>Principal</span>
						</div>
						
						<?
					}else{
						?>
						<div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 text-right centrar-vertical-contend">
							<i class="fa fa-star bgblue-1 white iconos_botones" lld="principal-giros"  llc="<?=$key["Num"]?>"></i>
						</div>
						<?
					}
					?>

					<div class=" col-12 hr"></div>
					<?
				}
				?>
			</div>
			
			
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"  style="padding: 0px 30px;">
			<div class="row">
				<div class="col-6 tutilos-negros margin-bottom-40"><h4><strong>Marcas</strong></h4></div>
				<div class="col-6 tutilos-negros text-right">
					<i class="fa fa-plus bgblue-1 white iconos_botones" onclick="$('#add-marca').iziModal('open')"></i></div>
					<? 
					if($marcas!=false){


						foreach ($marcas as $key) {
							?>
							<div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 text-center centrar-vertical-contend">
								<?php
								if($key->logo!==""){
									?>
									<img style="min-width: 100px;" class="img-fluid" src="<?= base_URL(); ?>/assets/img/logosmarcas/<?=$key->logo?>" alt=""></div>
									<?php
								}else{
									?>
									<img style="min-width: 100px;" class="img-fluid" src="<?= base_URL(); ?>/assets/img/foto-no-disponible.jpg" alt=""></div>
									<?php
								}
								?>

								<div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-6 text-center centrar-vertical-contend"><span><h5><?=$key->Marca?></h5></span></div>

								<div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 text-right centrar-vertical-contend">
									<i class="fa fa-pencil bgblue-1 white iconos_botones " lld="mod-marca" llc=<?=$key->IDMarca?> ></i>
								</div>
								<div class="col-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 text-right centrar-vertical-contend">
									<i class="fa fa-times bgblue-1 white iconos_botones "  lld="del-marca" llc=<?=$key->IDMarca?>></i>
								</div>

								<div class=" col-12 hr"></div>
								<?
							}}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container margin-top-40">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center titulos">SUBIR LOGOTIPO </div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
					<div class="row text-center">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 barrita" style="margin: 0 auto;">PESO MÁXIMO 2 MB, FORMATOS JPG,PNG.</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center margin-top-20 margin-bottom-20">
					<div class="row text-center">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 " style="margin: 0 auto;">
							<?php
							if($datos->Logo!==""){
								?>
								<img src="<?= base_URL(); ?>/assets/img/logosEmpresas//<?= $datos->Logo ?>" onclick="document.getElementById('file-input-logo').click();" class="img-fluid" id="Logo-Empresa-img">
								<?php
							}else{
								?>
								<img src="<?= base_URL(); ?>/assets/img/foto-no-disponible.jpg " onclick="document.getElementById('file-input-logo').click();" class="img-fluid" id="Logo-Empresa-img">
								<?php
							}
							?>

							<input type="file" style="display: none;" accept="image/*" id="file-input-logo">
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12  margin-bottom-40">
					<div class="row text-center">
						<div class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-6 btn btn-primary aling-center" llc="subirlogoempre"  style="margin: 0 auto;">
							<i class="fa fa-save" aria-hidden="true"></i> Subir Logo

						</div>
					</div>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-top-10  margin-bottom-40">
					<label for="	">Nota: Para subir algún logotipo solo da "click" en la imagen. </label>
				</div>
			</div>
		</div>
		<div id="add-giro" class="izimodal" width="600">
			<div class="container">
				<div class="row">
					<div class="col-12 margin-top-40">
						<div id="" class="form-group">
							<label for="nombre"  id="lbnombre" class="control-label"><strong>Sector</strong></label>
							<select name="" id="" llc="sector" class="form-control">
								<option selected value="m">Selecciona</option>
								<?php 


								foreach ($sector->result() as $key) {
									?>
									<option value="<?= $key->IDNivel1?>"><?= $key->Giro?></option>
									<?
								}
								?>

							</select>
						</div>
					</div>
					<div class="col-12 ">
						<div id="" class="form-group">
							<label for="nombre"  id="lbnombre" class="control-label"><strong>Subsector	</strong></label>
							<select name="" id="subsector" llc="Subsector" class="form-control">
								<option selected value="m">Selecciona</option>

							</select>
						</div>
					</div>
					<div class="col-12 ">
						<div id="" class="form-group">
							<label for="nombre"  id="lbnombre" class="control-label"><strong>Rama</strong></label>
							<select name="" id="rama" llc="Rama" class="form-control">
								<option selected value="m">Selecciona</option>

							</select>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-top-20 margin-bottom-40">
						<div class="row text-center">
							<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 btn btn-primary aling-center" llc="btn-add-giro" style="margin: 0 auto;">
								Agregar Giro

							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div id="add-marca" class="izimodal" width="200">
			<div class="container">
				<?= form_open_multipart(base_url()."perfil/AddMarca")?>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-top-40">
						<div id="" class="form-group">
							<label for="nombre"  id="lbnombre" class="control-label"><strong>Marca</strong></label>
							<?$data=array('name'=>"text-marca","id"=>"text-marca","value"=>"","class"=>"form-control","type"=>"text");
							echo form_input($data);?>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
						<div class="row text-center">
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 " style="margin: 0 auto;">
								<img src="<?= base_URL(); ?>/assets/img/foto-no-disponible.jpg"onclick="document.getElementById('file-input-mrca-logo').click();" id="img-marca" class="img-fluid" alt="">
								<input type="file" name="file-img" style="display: none;" accept="image/*" id="file-input-mrca-logo">
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-top-40 ">
						<div class="row text-center">
							<div llc="addmarca" class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 btn btn-primary aling-center"  style="margin: 0 auto;">
								Guardar
							</div>

						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 margin-top-10  margin-bottom-40">
						<label for="	">Nota: Para subir algún logotipo de una marca o producto solo da "click" en la imagen. </label>
					</div>
				</div>
			</div>
		</div>