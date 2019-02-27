class Help{
	Constructor(){

	}
	senddata(url,data,callback){
		var rpt=JSON.stringify(data);
		$.post(url,{datos:rpt},function(resp){
			callback(JSON.parse(resp));
		})
	}
	sendform(url,form,callback){
		var datos=help.getcookie('dating');		
		$.post(url,$(form).serialize()+"&usuario_cambio="+datos.usuario,function(resp){
			callback(JSON.parse(resp));
		})
	}
}
//clase para el home

class Home extends Help {
	Constructor(){
		super.constructor();
		
	}
	//funcion para buscar empresas
	busqueda(){
		console.log($("#search-bussines"))
	}
	//funcion para poner los usuarios las cajas de texto de login
	pnlogin(){
		if(help.getcookie('datlog')){
			var dat=help.getcookie('datlog');
			$("#mfrm-login #frm-login input[name='correo']").val(dat.correo);
			$("#mfrm-login #frm-login input[name='clave']").val(dat.pass);
			$("#mfrm-login #frm-login input[llc='cherecurda']").attr("checked","checked");

		}
	}
	//funcion para el login
	login(){
		$("#mfrm-login .lin-alert").addClass("d-none");
		super.sendform("registro/login","#mfrm-login #frm-login",function(resp){
			if(resp.pass===0){
				$("#mfrm-login .lin-alert").removeClass("d-none");
				$("#mfrm-login .lin-alert .alert").html(resp.mensaje)
			}else{
				if($('input[llc="cherecurda"]').prop('checked') ) {
					var dt={"correo":$("#mfrm-login #frm-login input[name='correo']").val(),"pass":$("#mfrm-login #frm-login input[name='clave']").val()};
					help.setcookie("datlog",dt);
				}else{
					help.deletecookie("datlog");
				}
				var datos={
					"empresa":resp.empresa,"usuario":resp.usuario,"token":resp.token
				}
				help.setcookie("dating",datos);
				location.href="ImgCliente/A";
			}
		})
	}
	//funcion para abrir el cador de recuperar contraseña
	openmfrmpass(){
		$("#mfrm-login").iziModal("close");
		$("#mfrm-recpas").iziModal("open");
	}
	//funcion para obtner el subsector
	Getsubsec(sec,div){
		if(sec!="")
		{
			var rpt={sector:sec};
			super.senddata("registro/getSubsector",rpt,function(rec){
				var cade="<option value=''>SELECCIONE</option>";
				rec.subnivel.forEach(elem=>{
			         cade+="<option value='"+elem.numero+"'>"+elem.nombre+"</option>";
			     });
				$(div+" select[name='subsector']").html(cade);
			});
		}
	}
	//funcion para obtener la rama
	GetRama(sec,div)
	{
		if(sec!="NA"){
			var rpt={rama:sec};
			super.senddata("registro/getrama",rpt,function(rec){
				var cade="<option value=''>SELECCIONE</option>";
				rec.rama.forEach(elem=>{
			         cade+="<option value='"+elem.numero+"'>"+elem.nombre+"</option>";
			     });
				$(div+" select[name='rama']").html(cade);
			});
		}
	}
	//funcion para enviar form pm
	AdmyoSendfrmPM(){
		super.sendform("registro/addpm","#admyo #frmadmyoPM",function(resp){
			if(resp.pass===0){
				$("#msjerror").iziModal('setSubtitle',"");
				$("#msjerror .text").html(resp.mensaje);
				mserror();
			}else{
				location.href="gracias/"
			}
			console.log(resp);
		})
	}
	//funcion para registrar pf
	AdmyoSendfrmPF(){
		super.sendform("registro/addpf","#admyo #frmadmyoPF",function(resp){
			if(resp.pass===0){
				$("#msjerror").iziModal('setSubtitle',"");
				$("#msjerror .text").html(resp.mensaje);
				mserror();
			}else{
				location.href="gracias/"
			}
		})
	}
	//funcion para registrar pf
	QvalSendfrmPM(){
		super.sendform("registro/addpm","#qval #frmqvaloPM",function(resp){
			if(resp.pass===0){
				$("#msjerror").iziModal('setSubtitle',"");
				$("#msjerror .text").html(resp.mensaje);
				mserror();
			}else{
				location.href="gracias/"
			}
		})
	}
	//funcion para registrar pf
	QvalSendfrmPF(){
		super.sendform("registro/addpf","#qval #frmqvaloPF",function(resp){
			if(resp.pass===0){
				$("#msjerror").iziModal('setSubtitle',"");
				$("#msjerror .text").html(resp.mensaje);
				mserror();
			}else{
				location.href="gracias/"
			}
		})
	}
}
class Visitas extends Help{
	Constructor(){
		super.constructor();
		
	}
	//funcion para traer los detalles de las visitas
	detalles(){
		$("#ver-datalle").iziModal("open",e);
		 
	}
}
class Empresa extends Help{
	Constructor(){
		super.constructor();
		
	}
	addfollow(url,datos){
		super.senddata(url,{datos:datos},function(resp){
			if(resp.pass==="1"){
				$("#msj-palanes").iziModal("open");
				$("#msj-palanes .pymes").removeClass("d-none");
			}else if(resp.pass==="2"){
				$("#msj-palanes").iziModal("open");
				$("#msj-palanes .empresarial").removeClass("d-none");
			}else if(resp.pass==="3"){
				$("#msjsucces").iziModal('setSubtitle',"Ahora sigues a esta empresa.");
				mssucces();
			}
			console.log(resp)
		})

	}
	updatedatos(){
		var url = $("#frmdatosempresa").attr("data-send");
		super.sendform(url,"#frmdatosempresa",function(resp){
			console.log(resp)
			if(resp.pass===0){
				$("#msjerror").iziModal('setSubtitle',resp.mensaje);
				mserror();
			}else if(resp.pass===2){
				$("#msjerror").iziModal('setSubtitle',"");
				$("#msjerror .text").html(resp.mensaje);
				mserror();
			}else{
				$("#msjsucces").iziModal('setSubtitle',resp.mensaje);
				mssucces();
			}
		})
	}
}
class Calificar extends Help{
	Constructor(){
		super.constructor();
	}
	listadependencias(lista){
		this.lista=lista;
	}
	checdependecia(num,val){
		console.log(this.lista);
		console.log(val,num);
		this.lista.forEach(elem=>{
	    	if(elem.ID_Pregunta===num){
	    		if(elem.Respuesta=== val){
	    			console.log("entra",val,num,elem.Respuesta)
	    			$("#Preguntas .tr-table[data-desc='"+elem.S_ID_Pregunta+"']").removeClass("d-none");
	    		}else if(elem.Respuesta==="<0"){
	    			if(val<0){
	    				console.log("entra",val,num,elem.Respuesta)
	    			$("#Preguntas .tr-table[data-desc='"+elem.S_ID_Pregunta+"']").removeClass("d-none");	
	    			}
	    		}else if(elem.Respuesta===">0"){
	    			if(val>0){
	    				console.log("entra",val,num,elem.Respuesta)
	    				$("#Preguntas .tr-table[data-desc='"+elem.S_ID_Pregunta+"']").removeClass("d-none");	
	    			}
	    		}else if(!$("#Preguntas .tr-table[data-desc='"+elem.S_ID_Pregunta+"']").hasClass('d-none')){
	    			$("#Preguntas .tr-table[data-desc='"+elem.S_ID_Pregunta+"']").addClass("d-none");
	    		}
	    	}
		})

	}
}
let home= new Home();
let visita=new Visitas();
let empresa= new Empresa();
let calificar=new Calificar();
$(document).on("click","#frmdatosempresa div[data-acc='updateempresa']",function(){
	empresa.updatedatos();
})
$(document).on("click","#Preguntas  input[type=radio]",function(){
	calificar.checdependecia($(this).attr("llc"),$(this).val());
})
$(document).on("blur","#Preguntas  input[type=number]",function(){
	console.log("entra")
	calificar.checdependecia($(this).attr("llc"),$(this).val());
})
$(document).on("click","div.menu-visitas .tab",function(e){
		 $(".tabs-item").addClass("d-none");
		 $(".tabs-item"+$(this).attr("data-get")).removeClass("d-none");
		 $(".tab").removeClass("current");
		 $(this).addClass("current");
})
$(document).on("click","a.addofllow",function(e){
	var  url = $(this).attr("data-url");
	var  datos={num:$(this).attr("data-follow")}
	empresa.addfollow(url,datos);
	e.preventDefault();
})
