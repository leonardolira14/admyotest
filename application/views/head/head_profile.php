<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admyo | Reputación Empresarial</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/general.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/new/general.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/iziModal.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/responsive.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/menu.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/js/date/themes/default.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/js/date/themes/default.date.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Prosto+One" rel="stylesheet">
	

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="<?=  base_url(); ?>/assets/js/iziModal.min.js"></script>
	<script src="<?=  base_url(); ?>/assets/js/helper.js"></script>
	<script src="<?=  base_url(); ?>/assets/js/class-dist.js"></script>
	<script src="<?=  base_url(); ?>/assets/js/calificaciones.js"></script>
	<script src="<?=  base_url(); ?>/assets/js/date/picker.js"></script>
	<script src="<?=  base_url(); ?>/assets/js/date/picker.date.js"></script>
	<script src="<?=  base_url(); ?>/assets/js/date/es_ES.js"></script>
	<script src="<?=  base_url(); ?>/assets/js/date/qunit.js"></script>
	<script src="<?=  base_url(); ?>/assets/js/date/base.js"></script>
	<script src="<?=  base_url(); ?>/assets/js/date/date.js"></script>
	<script src="<?=  base_url(); ?>/assets/js/jquery.cookie.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<script>
	var ayuda=new helper();
	$(document).ready(function($){
		$(".izimodal").each(function(i,e){
			izziFrame(e);
		});
		if(ayuda.getlocal("pbn")==false){
			$("#pbd").hide();
		}else{
			$("#pbd").show();
		}
	})
	

	$(document).on('click','.link',function(){
	 if($(this).attr('llc')=="pb"){
			if(ayuda.getlocal("pbn")==false){
				$("#msjerror").iziModal('setSubtitle',"No existen busquedas");
				mserror()
			}else{
				ayuda.goto($(this).attr('lld')+ayuda.getlocal("pbn"));
			}
			
		}else{
			ayuda.goto($(this).attr("llc"));
		}

	})
	$(window).on('load',function(){
		ayuda.preload();
	})
</script>
<body>
	<div id="preeload">
		<div class="col-12"><img src="<?= base_url(); ?>/assets/img/ajax-loader.gif" class="img-fluid align-center"></div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 plecaazul">
			</div>
		</div>
	</div>

	<div class="container margin-top-10">
		<div class="row d-flex align-items-center">
			<div class="col-3 float-left">
					<img src="<?= base_url(); ?>/assets/img/logo-admyo2.png" class="img-fluid float-left link " llc='/' alt="ADMYO">
				</div>
			<div class="col-9 dec">
				<table class="float-right">
					<tr>
						
						<td >
							<a href="<?= base_URL('notificaciones')?>" class="text-blue d-flex justify-content-between align-items-center">
								<i class="fa fa-bell" aria-hidden="true"></i>
								<span class="badge badge-primary badge-pill"><?= $notif ?></span>
							</a>
							
						</td>
						
						
						<td>
							<div llc="cerrarsession" class="btn btn-primary link"><i class="fa fa-times" aria-hidden="true"></i> Cerrar sessión</div>
						</td>
					</tr>
				</table>
			</div>
			<nav class="container-fluid menu-pc div-invisible-sm wsmenu clearfix  margin-top-20">
				<div class="row">
				<div class="col-12 text-center wsmenulist">
					<ul class="mobile-sub wsmenu-list float-right">
						<li>
							<a href="#">Tu Imagen</a>
							<ul class="wsmenu-submenu">
								<li><a href="<?= base_url()?>ImgCliente/A">Como Cliente</a>
								</li>
								<li><a href="<?= base_url()?>ImgProveedor/A">Como Proveedor</a></li>
								<li><a href="<?= base_url()?>visitas/A">Visitas a tu Perfil</a></li>
							</ul>
						<li>
						<li>
							<a href="#">Tu Riesgo</a>
							<ul class="wsmenu-submenu">
								<li><a href="<?= base_url()?>riesgocliente/A">De Clientes</a></li>
								<li><a href="<?= base_url()?>riesgoproveedor/A">De Proveedores</a></li>
								
							</ul>
						<li>
						<li>
							<a href="#">Clientes</a>
							<ul class="wsmenu-submenu">
								<li><a href="<?= base_url()?>resumencliente">Resumen</a></li>
								<li><a href="<?= base_url()?>listaclientes">Mis Clientes</a></li>
								<li><a href="<?= base_url()?>realizadasclientes">Calificaciones Realizadas</a></li>
								
								
							</ul>
						<li>
							<li>
							<a href="#">Proveedores</a>
							<ul class="wsmenu-submenu">
								<li><a href="<?= base_url()?>resumenproveedor">Resumen</a></li>
								<li><a href="<?= base_url()?>listaproveedores">Mis Proveedores</a></li>
								<li><a href="<?= base_url()?>realizadasproveedores">Calificaciones Realizadas</a></li>
								
								
							</ul>
						<li>

						<li><a href="">Empresa</a>
							<ul class="wsmenu-submenu">
								<li><a ui-sref="perfil" href="<?= base_url()?>datosempresa">Datos de Empresa</a>
									</li>
								<li><a ui-sref="perfil" href="<?= base_url()?>contacto">Datos de Contacto</a>
									</li>
								<li>
										<a ui-sref="perfil" href="<?= base_url()?>productosyservicios">Productos Y servicios</a>
									</li>
								<li><a ui-sref="perfil" href="<?= base_url()?>certificaciones">Certificaciones </a>
									</li>
									<li>
										<a ui-sref="perfil" href="<?= base_url()?>asociaciones">Asociaciones </a>
									</li>
								<li>
									<a  href="<?= base_url()?>notificaciones">Notificaciones</a>
								</li>
								<li>
									<a ui-sref="perfil" href="<?= base_url()?>followbussines">Empresas Seguidas</a>
								</li>
								<li>
								</ul>
							</li>
							<li><a href="">Usuarios</a>
								<ul class="wsmenu-submenu">
									<li>
										<a href="<?= base_url()?>datosuaurio">Mi datos de usuario</a>
									</li>
									
									
									<li>
										<a href="<?= base_url()?>listausuarios">Lista de Usuarios</a>
									</li>
									
									
								</ul>
							</li>
							<li id="pbd"><a href="">Perfil Buscado</a>
								<ul class="wsmenu-submenu" >
									<li>
										<div class="link" llc="pb" lld="<?= base_url('perfilimgcliente/A/')?>">Imagen como cliente</div>
									</li>
									<li>
										<div class="link" llc="pb" lld="<?= base_url('perfilimgproveedor/A/')?>">Imagen como Proveedor</div>
									</li>
									<li>
										<div class="link" llc="pb" lld="<?= base_url('perfilriesgoclientes/A/')?>">Riesgo como Cliente</div>
									</li>
									<li>
										<div class="link" llc="pb" lld="<?= base_url('perfilriesgoproveedores/A/')?>">Riesgo como Proveedor</div>
									</li>
									<li>
										<div class="link" llc="pb" lld="<?= base_url()?>PerfilBuscado/datosempresa/">datos de empresa</div>
									</li>
									<li>
										<div   class="link" llc="pb" lld="<?= base_url()?>PerfilBuscado/contacto/">Contacto</div>
									</li>
									<li>
										<div class="link" llc="pb" lld="<?= base_url()?>PerfilBuscado/usuarios/">Usuarios</div>
									</li>
									<li>
										<div class="link" llc="pb" lld="<?= base_url()?>PerfilBuscado/certificaciones/">certificaciones</div>
									</li>
									<li>
										<div class="link" llc="pb" lld="<?= base_url()?>PerfilBuscado/asociaciones/">asociaciones</div>
									</li>
								
									<li>
										<div  class="link" llc="pb" lld="<?= base_url()?>PerfilBuscado/productosyservicios/" >Productos y Servicios </div>
									</li>
									
								</ul>
							</li>
							<li><a href="<?= base_url()?>calificar">Calificar</a>
							</li>
						</ul>
					</div>
					</div>
				</nav>
				<div class="menu-sm div-visible-sm">
					<div class="col-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 ">
						<img src="<?= base_url(); ?>/assets/img/logo-admyo2.png" class="img-fluid" alt="ADMYO">
					</div>
					<div class="col-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 ">

					</div>
				</div>

			</div>
		</div>
		<div class="container-fluid">
			<div  class="row barraazul align-middle">
				<div class="col-10 align-center">
					<form class="input-group mb-2 mb-sm-0" method="POST" action="<?=base_URL("resultados") ?>" id="search-bussines">
						<input type="text" class="form-control" name="inputsearch" id="inputsearch" placeholder="Buscar empresas, productos o servicios">
						<button type="submit" class="input-group-addon btn-buscar" data-opt='search'>BUSCAR</button>
					</form>
				</div>
			</div>
		</div>


