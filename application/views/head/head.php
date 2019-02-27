<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admyo | Reputación Empresarial</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/general.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/iziModal.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/responsive.css">

	<link href="https://fonts.googleapis.com/css?family=Montserrat|Prosto+One" rel="stylesheet">
	<script src="<?=  base_url(); ?>/assets/js/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
	<script src="<?=  base_url(); ?>/assets/js/iziModal.min.js"></script>
	<script src="<?=  base_url(); ?>/assets/js/helper.js"></script>


</head>
<script>
var ayuda=new helper();

$(document).on('click','.link',function(){
		if($(this).attr("llc")=="login"){
			$("#mod-login").iziModal('open');
			$(".list-menus").toggle('fast')
			if(ayuda.getlocal("dats")){
				var lin=ayuda.getlocal("dats");
				console.log(lin);
				d=lin.split("|");
				$("#mod-login #email").val(d[0]);
				$("#mod-login #clave").val(d[1]);
			}
		}else if($(this).attr("llc")=="olvide"){
			$("#mod-login").iziModal('close');
			$("#mod-olvide").iziModal('open')
		}else if($(this).attr('llc')=="cerrarsession"){
			ayuda.senddata('','/registro/cerrar_session',function(data){
				var lin=JSON.parse(data);
				if(lin.pass==1){
					location.reload();
				}
			})
		}else if($(this).attr('llc')=="Buscar"){
			if($("#inputsearch").val()==""){
				$("#msjerror").iziModal('setSubtitle',"Ingresa plabras clave para realizar una busqueda.");
				mserror()
			}else{
				obt={};
				obt["palabra"]=$("#inputsearch").val();
				ayuda.senddata(obt,"/busquedas/buscar",function(data){
					if(data=="x"){
						$("#msjerror").iziModal('setSubtitle',"Sin resultados");
						mserror()
					}else{
						sessionStorage.setItem("res",data);
						ayuda.goto("/perfil/resultados");
					}

				})
			}
		}else if($(this).attr('llc')=="pb"){
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
function log(){
	p1={};
	$("#mod-login .alert").addClass("d-none")
	if($("#mod-login #email").val()==""){
			$("#mod-login .alert-warning").html("Ingrese su E-MAIL")
			$("#mod-login .alert").removeClass('d-none')
	}else if($("#mod-login #clave").val()==""){
			$("#mod-login .alert-warning").html("Ingrese una contraseña")
			$("#mod-login .alert").removeClass('d-none')
	}else{
		if($("#recudat").is(":checked")){
				ayuda.setlocal("dats",$("#mod-login #email").val()+"|"+$("#mod-login #clave").val());
		}
		p1["a"]=$("#mod-login #email").val();
		p1["b"]=$("#mod-login #clave").val()
			ayuda.senddata(p1,'/registro/login',function(data){
				 var lin=JSON.parse(data);
				 if(lin.pass==1){
				 	location.href="/perfil";
				 }else{
				 	$("#mod-login .alert-warning").html(lin.datos)
			$("#mod-login .alert").removeClass('d-none')
				 }
		})
	}
}
$(document).on('click','#mod-login .btn',function(){
	log()
})
$(document).on("keyup",'#mod-login input',function(event){
	if ( event.which == 13 ) {
    log()
  }
	
	
})
$(document).ready(function($){
$(".izimodal").each(function(i,e){
        izziFrame(e);
    });
})
$(window).on('load',function(){

ayuda.preload();
})
$(document).on('click','div[llc="recupera"]',function(){
		obt={};
		obt["email"]=$("#correo-reg").val();
		ayuda.senddata(obt,"/registro/obtener_clave",function(data){
			lin=JSON.parse(data);
			if(lin.pass==1){
				$("#mod-olvide").iziModal('close')
				$("#msjsucces").iziModal('setSubtitle',"Mensaje enviado");
				 mssucces();
			}else{
				$("#msjerror").iziModal('setSubtitle',lin.mensaje);
				mserror()
			}
		})
	})
$(document).on('keypress','#inputsearch',function(e){
		tecla = (document.all) ? e.keyCode : e.which;
		if(tecla==13){
			if($("#inputsearch").val()==""){
				$("#msjerror").iziModal('setSubtitle',"Ingresa plabras clave para realizar una busqueda.");
				mserror()
			}else{
				obt={};
				obt["palabra"]=$("#inputsearch").val();
				ayuda.senddata(obt,"/busquedas/buscar",function(data){
					if(data=="x"){
						$("#msjerror").iziModal('setSubtitle',"Sin resultados");
						mserror()
					}else{
						sessionStorage.setItem("res",data);
						ayuda.goto("/perfil/resultados");
					}

				})
			}
		}
	})

</script>
<style>
	.barraazul .input-group{
			border: 2px solid #003559;
    		border-radius: 5px;
    		height: 34px;
	}
	.barraazul input{
		font-size: 15px;
			padding: 2px 2px;
			border-bottom: 0px transparent !important;
	}
	.barraazul input:hover,.barraazul input:focus{
			border-bottom: 0px transparent !important;
	}
</style>
<body>
<div id="preeload">
	<div class="col-12"><img src="<?= base_url(); ?>/assets/img/ajax-loader.gif" class="img-fluid align-center"></div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-12 text-center margin-bottom-20">
			<div class="center-block grega"></div>
		</div>
		<div class="col-12 text-center margin-bottom-20 margin-top-20 text-center">
			<img class="img-fluid align-center  d-none   d-sm-none d-md-block d-lg-block d-xl-block link" llc="/" src="<?= base_url(); ?>/assets/img/logotipo-admyo3.png" alt="Admyo">
			<img class="img-fluid align-center d-block d-sm-block d-md-none d-lg-none d-xl-none link" llc="/" style="width: 260px;" src="<?= base_url(); ?>/assets/img/logo-admyo2.png" >
		</div>
	</div>
	
</div>
<div class="container-fluid barraazul">
	<div  class="row  align-middle">
		<div class="container">
			<div class="row">
				<div class="col-3 text-left">
				<i class="fa fa-bars btn-menu" onclick='$(".list-menus").slideToggle("fast");' id="brn-mn" aria-hidden="true"></i>
			</div>
			<div class="col-9">
			      <div class="input-group mb-2 mb-sm-0 text-center">
			        <input type="text" class="form-control" id="inputsearch" placeholder="Buscar empresas, productos o servicios">
			        <div llc="Buscar" class="input-group-addon  btn-buscar link">BUSCAR</div>
			      </div>
			</div>
			</div>
		</div>
	</div>
</div>
<div class="list-menus">
	<ul>
		<li class="link"><a href="<?=base_url()?>">Home</a></li>
		<li class="link" ><a href="<?=base_url()?>terminosycondiciones">Términos y Condiciones</a></li>
		<li class="link" ><a href="<?=base_url()?>puntosydescuentos">Puntos y Descuentos</a></li>
		<li class="link" ><a href="<?=base_url()?>saladeprensa">Sala de Prensa</a></li>
		<li class="link" ><a href="<?=base_url()?>contacto">Contáctanos</a></li>
	</ul>
</div>
<div id="mod-login" class="mod-ling izimodal"   data-title="Login Admyo" data-width="400">
  <div class="container">
  	<div class="row">
  		<div class="col-12 margin-top-20">
	      <div class="input-group mb-2 mb-sm-0">
	        <input type="email" required="required" name="email" class="form-control" llc="E-Mail" id="email" placeholder="E-MAIL">
	        <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
	      </div>
    </div>
    <div class="col-12 margin-top-20">
	      <div class="input-group mb-2 mb-sm-0">
	        
	        <input type="password"  required="required" name="clave" class="form-control" llc="Password" id="clave" placeholder="CONTRASEÑA">
	        <div class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></div>
	      </div>
    </div>
    
    <div class="col-6 margin-top-20 text-center">
   		<span llc="registro" class="link">Crear una Cuenta</span>
   	</div>
       <div class="col-6 margin-top-20 text-center">
    		<span llc="olvide" class="link" >Olvido su contraseña</span>
    </div>
   	<div class="col-12 margin-top-20 text-center">
   			 <div class="col-11  align-center btn btn-primary  ">
    	ACEPTAR
    </div>
   	</div>
   	<div class="col-5 margin-top-20 margin-bottom-20 centrar">
    	<div class="custom-control custom-checkbox">
        <input type="checkbox" id="recudat" class="custom-control-input">
        <label class="custom-control-label" for="recudat">Recuerdame</label>
      </div>
    </div>
   	<div class="col-12 margin-top-20 text-center alert d-none">	
		<div class="alert alert-warning " role="alert">
		  
		</div>
		</div>
  	</div>
  </div>
  
</div>	


<div id="mod-olvide" class="izimodal"   data-title="Recuperar Contraseña" data-width="600" >
  <div class="container margin-bottom-20">
  	<div class="row">
  		<div class="col-12 margin-top-20">
  			<label for="">Ingrese su Correo Electronico que tiene registrado con nosostros, le mandaremos un mensaje con las indicaciones para restablecer su contraseña</label>
	      <div class="input-group mb-2 mb-sm-0">
	        <input type="text" class="form-control" id="correo-reg" placeholder="E-MAIL">
	        <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
	      </div>
    </div>
    
    
   	<div class="col-12 margin-top-20 text-center">
   			 <div class="col-11  align-center btn btn-primary  " llc="recupera">
    	ACEPTAR
    </div>
   	</div>
   		<div class="col-12 margin-top-20 text-center">
   			 <div class="col-11  align-center btn btn-primary link" llc="/registro">
    	Registrarse: Crear Una Cuenta
    </div>
   	</div>
  	</div>
  </div>
  
</div>	


