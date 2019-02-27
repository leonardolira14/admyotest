 _rfc_pattern_pm = "^(([A-ZÑ&]{3})([0-9]{2})([0][13578]|[1][02])(([0][1-9]|[12][\\d])|[3][01])([A-Z0-9]{3}))|" +
                                             "(([A-ZÑ&]{3})([0-9]{2})([0][13456789]|[1][012])(([0][1-9]|[12][\\d])|[3][0])([A-Z0-9]{3}))|" +
                                             "(([A-ZÑ&]{3})([02468][048]|[13579][26])[0][2]([0][1-9]|[12][\\d])([A-Z0-9]{3}))|" +
                                             "(([A-ZÑ&]{3})([0-9]{2})[0][2]([0][1-9]|[1][0-9]|[2][0-8])([A-Z0-9]{3}))$";
_rfc_pattern_pf = "^(([A-ZÑ&]{4})([0-9]{2})([0][13578]|[1][02])(([0][1-9]|[12][\\d])|[3][01])([A-Z0-9]{3}))|" +
	  		                                 "(([A-ZÑ&]{4})([0-9]{2})([0][13456789]|[1][012])(([0][1-9]|[12][\\d])|[3][0])([A-Z0-9]{3}))|" +
	  		                                 "(([A-ZÑ&]{4})([02468][048]|[13579][26])[0][2]([0][1-9]|[12][\\d])([A-Z0-9]{3}))|" +
	  		                                 "(([A-ZÑ&]{4})([0-9]{2})[0][2]([0][1-9]|[1][0-9]|[2][0-8])([A-Z0-9]{3}))$";
var errors=['syntax error','Parse error','Fatal error','Notice','Warning'];

function helper(){
	var that=this;
	var config={
		mensajeError:"Hay un error con la consulta",
		mensajeEmail:"El E-Mail no es valido",
		mensajeRFC:"El RFC no es valido"
	};
	that.goto=function(url){
		$("#preeload").show();
		location.href=url;
	}
	//funcion para obtener el estado segun el pais
	that.getestado=function(pais,div){
		$.get('Home/getsstado',{Pais:pais},function(resp){
			var dat=JSON.parse(resp);
			console.log(dat)
			var cade="<option value='NA'>Select</option>";
			if(resp.estados!=false){
				$.each(dat.estados,function(index,estado){
				
				  cade+="<option value='"+estado.id+"'>"+estado.estadonombre+"</option>";
				})
			}
			 cade+="<option value='ot'>Otro</option>";
			$(div+" select[name='estado']").html(cade);
		})
	}
//para revisar los input esten seleccionados
	that.formval=function(a,b){
		input=b+" #"+$(a).attr('id');
		if($(input).val()=="" && $(input).attr("requerid")=="requerid"){
			$("#msjerror").iziModal('setSubtitle',"El Campo: "+$(input).attr("llc")+", es requerido");
				mserror();
			return false;
		}else if($(input).attr('type')=="password" && $(input).val().length<=5 &&  $(input).attr("requerid")=="requerid"){
			$("#msjerror").iziModal('setSubtitle',"Las constraseñas deben ser mjrtyayores a 5 digitos");
				mserror();
			return false;
		}else if($(input).attr('llc')=="RFC" && !helpvalidar_rfc($(input).val()) &&  $(input).attr("requerid")=="requerid"){
			$("#msjerror").iziModal('setSubtitle',"El Campo: "+$(input).attr("llc")+",no es valido");
				mserror();
			
			return false;
		}else if($(input).attr("type")=="email" && !helpvailida_correo($(input).val()) &&  $(input).attr("requerid")=="requerid"){
			$("#msjerror").iziModal('setSubtitle',"El Campo: "+$(input).attr("llc")+",no es valido");
				mserror();
			return false;
		}else if($(input).attr('id')=="targeta" && !Conekta.card.validateNumber($(input).val())){
			$("#msjerror").iziModal('setSubtitle',"El Campo: "+$(input).attr("llc")+",no es valido");
				mserror();
			return false;	
		}else if($(input).attr('id')=="cvv" && !Conekta.card.validateCVC($(input).val())){
			$("#msjerror").iziModal('setSubtitle',"El Campo: "+$(input).attr("llc")+",no es valido");
				mserror();
			return false;
		}else{
			return true;
		}
	}
	that.imprime=function(selector){
		$(selector).printThis({
				    debug: false,               // show the iframe for debugging
				    importCSS: true,            // import page CSS
				    importStyle: true,         // import style tags
				    printContainer: true,       // grab outer container as well as the contents of the selector
				    loadCSS: "/assets/css/bootstrap.css",  // path to additional css file - use an array [] for multiple
				    pageTitle: "",              // add title to print page
				    removeInline: false,        // remove all inline styles from print elements
				    printDelay: 333,            // variable print delay; depending on complexity a higher value may be necessary
				    header: null,               // prefix to html
				    footer: null,               // postfix to html
				    base: true ,               // preserve the BASE tag, or accept a string for the URL
				    formValues: true,           // preserve input/form values
				    canvas: true,              // copy canvas elements (experimental)
				    doctypeString: "...",       // enter a different doctype for older markup
				    removeScripts: false        // remove script tags from print content
				});
	};
	that.gentoks=function(obt){
		Conekta.setPublishableKey('key_EDxZCrdzJsGgsEaqzxutE8A');
		var tokenParams = {
			"card": {
				"number":obt["targeta"],
				"name": obt["nombre"]+" "+obt["apellidos"],
				"exp_year": obt["anio"],
				"exp_month": obt["mes"],
				"cvc": obt["cvv"],
			}
		};
		Conekta.token.create(tokenParams, function(data){
			obt["token"]=data.id;
			obt["targeta"]="";
			obt["cvv"]="";
			that.senddata(obt,"/home/pagartargeta",function(data){
				lin=JSON.parse(data);
				if(lin.pass==1){
					that.removeloc("datospago")
					that.removeloc("tipplan")
					that.goto("/home/gracias");
				}else{
					$("#msjerror").iziModal('setSubtitle',lin.mensaje);
					mserror();
				}
			});
		} ,function(error){
			$("#preeload").hide()
			$("#msjerror").iziModal('setSubtitle',error);
				mserror();
			return false;
		});
	}
	that.validajson=function(a){
		for(key in errors){
			var lims=a.indexOf(errors[key]);
			if(lims==-1){
				return true;				
			}else{
				return false;
				$("#msjerror").iziModal('setSubtitle',a);
				mserror();
				
			}
		}
	}
	that.preload=function(a){
		$("#preeload").fadeOut(1000);
	}
	that.setcookie=function(key,value){
		$.cookie(key, JSON.stringify(value));
	}
	that.getcookie=function(key){
		if($.cookie(key)!=undefined){
			return JSON.parse($.cookie(key));
		}else{
			return false;
		}
		
	}
	that.deletecookie=function(key){
		$.removeCookie(key);
	}
	that.setlocal=function(key, value){
		try { 
		localStorage.setItem(key,JSON.stringify(value));	
		} catch(e) {
			if(e == QUOTA_EXCEEDED_ERR){
				alert("Espacio local lleno.");	
			}	
		}
	}
	that.removeloc=function(key){
		if(localStorage[key]){
			localStorage.removeItem(key);	
		}
	}
	that.getlocal=function(key) {
		if(localStorage[key]){

			return JSON.parse(localStorage[key]);	
		} else return false;
	}
	that.getparams=function(url){
		var extra = url.split("?")[1];	
		var extras = {};
		if(extra){		
			var extraParts = extra.split("&");
			for(var i in extraParts){
				var parts = extraParts[i].split("=");
				extras[parts[0]] = String(parts[1]);
			}	
		}
		return extras;	
	}
	that.ejectclick=function(a,b,callback){
		$(a).on(b,c,function(){
			callback();
		})
	}
	that.senddata=function(a,b,callback){
		p1=JSON.stringify(a);
		$.post(b,{datos:p1},function(data){
			if(that.validajson(data)==true){
				callback(data);
			}
		});

	};	
	that.subirimagen=function(a,f,callback){

		$("#preeload").show();
		var archivos =$( '#'+a );
		var archivo=archivos[0].files;
		var paquete=new FormData();
		paquete.append('file',archivo[0]);
		 //Añadimos cada archivo a el arreglo con un indice direfente
		
		$.ajax({
			url:f,//'includes/subirimagenlogo.php', //Url a donde la enviaremos
			type:'POST', //Metodo que usaremos
			contentType:false, //Debe estar en false para que pase el objeto sin procesar
			data:paquete, //Le pasamos el objeto que creamos con los archivos
			processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
			cache:false ,//Para que el formulario no guarde cache
			beforeSend :function()
			{
				
			},
			success:function(respuesta){
				
				lin=JSON.parse(respuesta);
			if(lin.pass=="0"){
				$("#preeload").hide();
				$("#preeload").fadeOut(1000);
				$("#msjerror").iziModal('setSubtitle',lin.mensaje);
				mserror();
				}else{
					callback(lin.mensaje);
				}
    		}
		});
	};
	//funcion para previsualizar una imgan 
	that.previsualizar=function(a,b){
		
		if(a.files && a.files[0]){
			if(a.files[0].size>2097152){
				$("#msjerror").iziModal('setSubtitle',"La imagen no puede sobrepasar los 2Mb");
				mserror();
			}else{
				var reader = new FileReader();
			 		reader.onload=(function(e) {
				$("#"+b).attr("src",e.target.result);
           		});
          	 reader.readAsDataURL(a.files[0]);
			}
		}
	};
	that.graficarv2=function(series,titulos,div,tipo,titx){
		var data = google.visualization.arrayToDataTable(series);
        console.log(series)
        if(tipo==="c"){
        	var options = {
	          title: titulos,
	          sliceVisibilityThreshold: .10,
	           height:400,
	        };
	        var chart = new google.visualization.PieChart(document.getElementById(div));
	        chart.draw(data, options);
        }
        if(tipo==="l"){
        	
        	
        	var options = {
	          title: '',
	          height: 500,
	          hAxis: {title: titx,  titleTextStyle: {color: '#333'}},
	          vAxis: {minValue: 0},
	         
	        };
	        var chart = new google.visualization.AreaChart(document.getElementById(div));
	        chart.draw(data, options);
        }
        if(tipo==="b"){
        	var options = {
		        title: titulos,
		        isStacked: true,
		        height: 200,
		      	 hAxis: {title: titx,  titleTextStyle: {color: '#333'}},
		        vAxis: {
		          title:""
		        }
		      };
        	var chart = new google.visualization.ColumnChart(document.getElementById(div));
		     chart.draw(data, options);
        }
        if(tipo==="cu"){
      var options = {
		chart: {
		    title: titulos,
		    
		},
		hAxis: {
          title: '',
          minValue: 0,
        },
        vAxis: {
          title: ''
        },
		bars: 'horizontal',
		height: 200,
		colors: ['#005d8f', '#a5a5a5'],
		axes: {
          y: {
            0: {side: 'right'}
          }
        }
    }
		var chart = new google.charts.Bar(document.getElementById(div));
		chart.draw(data, google.charts.Bar.convertOptions(options));
		  }
        
       
        
	}
	that.graficar=function(contenedor,titulo,textizquierda,serie,categorias){
		console.log(serie);
		Highcharts.chart(contenedor, {
		chart: {
			type: 'pie'
		},
		title: {
			text: titulo
		},
		

		tooltip: {
			 pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
			//pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
			shared: true
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
            	cursor: 'pointer',
				stacking: 'number'
			}
		},
		series: serie
	});
	};
	that.solicitud=function(datos){
		this.senddata(datos,"/calificaciones/solicita",function(data){
			lin=JSON.parse(data);
			if(lin.pass=="1"){
				$("#mod-solicitud").iziModal("close");
				$("#msjsucces").iziModal('setSubtitle',"Solicitud exitosa, la pagina se actualizara");
				mssucces();
				setTimeout(function(){
					location.reload()
				},5000)
			}else{
				$("#msjerror").iziModal('setSubtitle',lin.mensaje);
				mserror();
			}
		});
	};
	that.detallescuestion=function(num){
		$("#preeload").show();
		obj={};
		obj["num"]=num;
		that.senddata(obj,"calificaciones/detallescuestinario",function(data){
			lin=JSON.parse(data)
			dat='';
			for(key in lin){
				dat+='<div class="col-10"><span class="minitit">'+lin[key].Pregunta+'</span></div>'
				dat+='<div class="col-2"><span class="minitit">'+lin[key].calificacion+'</span></div>'
				dat+='<div class="col-12 hr"></div>'
			}
			$("#mod-detalles .tables").html(dat);
			$("#mod-detalles").iziModal("open")
			$("#preeload").fadeOut(1000);
		})
		
	};
	that.modificarcal=function($num){
		obj={};
		obj["num"]=$num;
		that.senddata(obj,"/calificaciones/modificarval",function(data){
			that.setlocal("cuestion",data);
		})
	}
	that.recalcular=function(){
		$("#mensaje-confirm").iziModal("close");
			$("#preeload").show();
			that.senddata(that.getlocal('idvalora'),'/calificar/recalcular',function(data){
				window.location.href="/perfil";
				console.log(data);
				
			})
	}
	that.poncuestionario=function(){
		lin=JSON.parse(that.getlocal("cuestion"));
		console.log(lin)
		var cade='<div class=" titulos-blanco  bgazul text-center thead col-12"><h4><strong>Preguntas</strong></h4></div>';
		for(key in lin){
			idvalora=lin[key].IDValora
			num=lin[key].IDPregunta;
			respuesta=lin[key].Valoracion;
			console.log(num)
			cade+='<div class="col-12 col-sm-12 col-xl-12 col-md-12 col-lg-12 tr-table"><div class="row">';
			cade+='<div class="col-12 col-sm-12 col-xl-8 col-md-8 col-lg-8"><span class="preg">¿'+lin[key].Pregunta+'?</span></div>';
			cade+='<div class="col-12 col-sm-12 col-xl-4 col-md-4 col-lg-4"><div class="row">'
			
			if($.trim(lin[key].Forma)=="Si/No"){
				cade+=sino(respuesta,num)
			}else if($.trim(lin[key].Forma)=="Si/No/NA"){
				cade+=na(respuesta,num)
			}else if($.trim(lin[key].Forma)=="'Si/No/NA/NS'"){
				cade+=ns(respuesta,num)
			}else if($.trim(lin[key].Forma)=='No tiene/NA/NS/Si/No'){
				cade+=not(respuesta,num)
			}else{
				cade+=numlop(respuesta,num)
			}
			cade+='</div></div>';
			cade+='</div></div>';
		}
		that.removeloc("idvalora");
		that.setlocal("idvalora",idvalora);
		$(".tables").html(cade);
	}
	that.msj_enviar=function(){
		obt=[];
		dat={};
		console.log(that.getlocal("idvalora"))
		if(that.getlocal("idvalora")){
				dat["num"]=that.getlocal("idvalora");
			$("#Preguntas  input").each(function(index){
				if(($(this).attr("type")=="radio") && (($(this).is(':checked')))){
					obt.push($(this).attr("llc")+"|"+$(this).val())
				}else if($(this).attr("type")=="number"){
					obt.push($(this).attr("llc")+"|"+$(this).val())
				}
			})
			dat["repuestas"]=obt;
			that.removeloc("idvalora");
			that.setlocal("idvalora",dat);
			$("#mensaje-confirm").iziModal("open");
			}else{
				$("#msjerror").iziModal('setSubtitle',"Usted no ha seleccionado alguna empresa para calificar.");
				mserror();
		}
	}
}
var help=new helper();
function numlop(respuesta,num){
	var cade='<form><div class="row"><div class="col-12">'
	cade+='<input type="number" value="'+respuesta+'" llc="'+num+'" class="form-control">'
	cade+='</div></div></form>';
	return cade;
}
function not(respuesta,num){
	var cade='<form><div class="row"><div class="col-12">'
	cade+='<ul>';
	cade+='<li>';
	if(respuesta=="SI"){
		cade+='<input checked type="radio" id="R1si'+num+'" llc="'+num+'" value="SI" name="R">';
		cade+='<label for="R1si'+num+'" llc="'+num+'">SI</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1si'+num+'" llc="'+num+'" value="SI" name="R">';
		cade+='<label for="R1si'+num+'" llc="'+num+'">SI</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='<li>';
	if(respuesta=="NO"){
		cade+='<input checked type="radio" id="R1si'+num+'" llc="'+num+'" value="NO" name="R">';
		cade+='<label for="R1si'+num+'" llc="'+num+'">NO</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1no'+num+'" llc="'+num+'" value="NO" name="R">';
		cade+='<label for="R1no'+num+'" llc="'+num+'">NO</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='<li>';
	if(respuesta=="NA"){
		cade+='<input checked type="radio" id="R1na'+num+'" llc="'+num+'" value="NA" name="R">';
		cade+='<label for="R1na'+num+'" llc="'+num+'">NA</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1na'+num+'" llc="'+num+'" value="NA" name="R">';
		cade+='<label for="R1na'+num+'" llc="'+num+'">NA</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='<li>';
	if(respuesta=="NS"){
		cade+='<input checked  type="radio" id="R1ns'+num+'" llc="'+num+'" value="NS" name="R">';
		cade+='<label for="R1ns'+num+'" llc="'+num+'">NS</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1ns'+num+'" llc="'+num+'" value="NS" name="R">';
		cade+='<label for="R1ns'+num+'" llc="'+num+'">NS</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='<li>';
	if(respuesta=="NT"){
		cade+='<input checked  type="radio" id="R1nt'+num+'" llc="'+num+'" value="NT" name="R">';
		cade+='<label for="R1nt'+num+'" llc="'+num+'">No Tiene</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1nt'+num+'" llc="'+num+'" value="NT" name="R">';
		cade+='<label for="R1nt'+num+'" llc="'+num+'">No Tiene</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='</ul>';
	cade+='</div></div></form>';
	return cade;
}
function ns(respuesta,num){
	var cade='<form><div class="row"><div class="col-12">'
	cade+='<ul>';
	cade+='<li>';
	if(respuesta=="SI"){
		cade+='<input checked type="radio" id="R1si'+num+'" llc="'+num+'" value="SI" name="R">';
		cade+='<label for="R1si'+num+'" llc="'+num+'">SI</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1si'+num+'" llc="'+num+'" value="SI" name="R">';
		cade+='<label for="R1si'+num+'" llc="'+num+'">SI</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='<li>';
	if(respuesta=="NO"){
		cade+='<input checked type="radio" id="R1no'+num+'" llc="'+num+'" value="NO" name="R">';
		cade+='<label for="R1no'+num+'" llc="'+num+'">NO</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1no'+num+'" llc="'+num+'" value="NO" name="R">';
		cade+='<label for="R1no'+num+'" llc="'+num+'">NO</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='<li>';
	if(respuesta=="NA"){
		cade+='<input checked type="radio" id="R1na'+num+'" llc="'+num+'" value="NA" name="R">';
		cade+='<label for="R1na'+num+'" llc="'+num+'">NA</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1na'+num+'" llc="'+num+'" value="NA" name="R">';
		cade+='<label for="R1na'+num+'" llc="'+num+'">NA</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='<li>';
	if(respuesta=="NS"){
		cade+='<input checked type="radio" id="R1ns'+num+'" llc="'+num+'" value="NS" name="R">';
		cade+='<label for="R1ns'+num+'" llc="'+num+'">NS</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1ns'+num+'" llc="'+num+'" value="NS" name="R">';
		cade+='<label for="R1ns'+num+'" llc="'+num+'">NS</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='</ul>';
	cade+='</div></div></form>';
	return cade;
}
function na(respuesta,num){
	var cade='<form><div class="row"><div class="col-12">'
	cade+='<ul>';
	cade+='<li>';
	if(respuesta=="SI"){
		cade+='<input checked type="radio" id="R1si'+num+'" llc="'+num+'" value="SI" name="R">';
		cade+='<label for="R1si'+num+'" llc="'+num+'">SI</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1si'+num+'" llc="'+num+'" value="SI" name="R">';
		cade+='<label for="R1si'+num+'" llc="'+num+'">SI</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='<li>';
	if(respuesta=="NO"){
		cade+='<input checked type="radio" id="R1no'+num+'" llc="'+num+'" value="NO" name="R">';
		cade+='<label for="R1no'+num+'" llc="'+num+'">NO</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1no'+num+'" llc="'+num+'" value="NO" name="R">';
		cade+='<label for="R1no'+num+'" llc="'+num+'">NO</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='<li>';
	if(respuesta=="NA"){
		cade+='<input checked type="radio" id="R1na'+num+'" llc="'+num+'" value="NA" name="R">';
		cade+='<label for="R1na'+num+'" llc="'+num+'">NA</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1na'+num+'" llc="'+num+'" value="NA" name="R">';
		cade+='<label for="R1na'+num+'" llc="'+num+'">NA</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='</ul>';
	cade+='</div></div></form>';
	return cade;
}
function sino(respuesta,num){
	var cade='<form><div class="row"><div class="col-12">'
	cade+='<ul>';
	cade+='<li>';
	if(respuesta=="SI"){
		cade+='<input checked type="radio" id="R1si'+num+'" llc="'+num+'" value="SI" name="R">';
		cade+='<label for="R1si'+num+'" llc="'+num+'">SI</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1si'+num+'" llc="'+num+'" value="SI" name="R">';
		cade+='<label for="R1si'+num+'" llc="'+num+'">SI</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='<li>';
	if(respuesta=="NO"){
		cade+='<input checked type="radio" id="R1no'+num+'" llc="'+num+'" value="NO" name="R">';
		cade+='<label for="R1no'+num+'" llc="'+num+'">NO</label>';
		cade+='<div class="check"></div>';
	}else{
		cade+='<input type="radio" id="R1no'+num+'" llc="'+num+'" value="NO" name="R">';
		cade+='<label for="R1no'+num+'" llc="'+num+'">NO</label>';
		cade+='<div class="check"></div>';
	}
	cade+='</li>';
	cade+='</ul>';
	cade+='</div></div></form>';
	return cade;
}
//funciones para validar correo
function helpvailida_correo(correo){
	  emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
	  if (emailRegex.test(correo)) {
	    return true;
	  }else{
	    return false;
	  }
	}
function helpvalidar_rfc(a){
		if (a.match(_rfc_pattern_pm) || a.match(_rfc_pattern_pf)){
    			return true;
    		}else {
    			return false;
    		
    		}
	}
function mserror(e){
	$("#msjerror").iziModal("open",e);
}
function mssucces(e,error){
	$("#msjsucces").iziModal("open",e);
}
function izziFrame(e){
	$(e).addClass("iziModal").iziModal({
		title:$(e).attr("title") || $(e).data("title") || 'Mensaje de Admyo',
		headerColor: $(e).data("header-color") || '#005d8f',
		width: $(e).data("width") || 600 ,
		fullscreen: $(e).data("fullscreen") || false,
		transitionIn: 'comingIn',
		transitionOut: 'comingOut',
		timeout: $(e).data("timeclose") || false,
		timeoutProgressbar: $(e).data("bar") || false,
		closeOnEscape:$(e).attr("closekey") || $(e).data("closekey")|| true,
		closeButton: $(e).attr("closebtn") ||$(e).data("closebtn") || true,
		overlayClose:$(e).attr("over") || $(e).data("over") || true,
		
		
	})
}
function msplanes(e){
	$("#planes-mini").iziModal("open",e);
	}
function mscalificacion(e){
		$("#mensaje-confirm2").iziModal("open",e);
}
$(document).on("click",".btn-princam",function(){
	var pal="#"+$(this).attr("data-pal");
	$(".palprinc").addClass("d-none");
	$(pal).removeClass("d-none");
	if($(this).attr("data-pal")==="admyo"){
		$("img[data-pal='qval']").attr("src",$(this).attr("data-ruta")+"qval_inactivo.svg");
	}else{
		$("img[data-pal='admyo']").attr("src",$(this).attr("data-ruta")+"admyo_inactivo.svg");
	}
	$(this).attr("src",$(this).attr("data-ruta")+$(this).attr("data-pal")+"_activo.svg")
})
$(function () {
	$('[data-toggle="popover"]').popover({
		trigger:"hover",
		placement:"auto"
	})
})
