
<div class="container-fluid">
	<div class="row banner ">
		<div class="bg"></div>
		<div class="text">
			CALIFICAR A UNA EMPRESA
		</div>
		<div class="banner-user"></div>
	</div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="container margin-top-40" id="Dats-Genral">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6  text-center" >
			<div class="tab current" lld="cliente">
				<i class="fa fa-user ibtn bgblue-1  white"></i>
				CALIFICAR A UN CLIENTE
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6  text-center"  >
			<div class="tab" lld="proveedor" >
				<i class="fa fa-user ibtn bgblue-1 white"></i>
				CALIFICAR A UN PROVEEDOR
			</div>
		</div>
		
	</div>
</div>
<div class="container" id="clie">
	<form id="form-calif" method="POST" action="<?= base_URL('cuestionario')?>"  class="row tables ">
		<div class=" col-12 titulos-blanco  bgazul text-center thead text-uppercase"><h4><strong>DATOS DEL CLIENTE </strong></h4></div>
		<div class="col-6"><span class="span-calif">NOMBRE O RAZÓN SOCIAL</span></div>
		<div class="col-6">
			<div id="" class="form-group">
				<input type="text" name="razon_social" id="razon" llc="Razon_Social" placeholder="Razon Social" requerid="requerid" class="form-control razon">
			</div>
		</div>
		<div class="col-6"><span class="span-calif">RFC</span></div>
		<div class="col-6">
			<div id="" class="form-group">
				<input type="text" name="rfc"  id="RFC" llc="RFC" placeholder="RFC" requerid="requerid" class="form-control">
			</div>
		</div>
		<div class="col-6"><span class="span-calif">EMAIL</span></div>
		<div class="col-6">
			<div id="" class="form-group">
				<input type="text" name="correo_electronico" id="email" placeholder="EMAIL" llc="EMAIL" requerid="requerid" class="form-control">
			</div>
		</div>
		<div class="col-6"><span class="span-calif">SELECCIONE GIRO</span></div>
		<div class="col-6">
			<div id="" class="form-group">
			<input type="text" name="giroc" id="sector" placeholder="Preguntas Generales, Otros giros" class="form-control">
			<input type="hidden" name="giro">
			</div>
		</div>
		<div class="col-6"><span class="span-calif">SELECCIONE SUBGIRO</span></div>
		<div class="col-6">
			<div id="" class="form-group">
				<select llc="Subsector" requerid="requerid" name="sub_giro" id="subsector"  class="form-control" name="" id="">

				</select>
			</div>
		</div>
		<div class="col-6"><span class="span-calif">SELECCIONE RAMA</span></div>
		<div class="col-6">
			<div id="" class="form-group">
				<select llc="Rama" class="form-control"  name="rama" id="rama">
				</select>
			</div>
		</div>
		<input type="hidden" value="cliente" name="realizapara">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12  margin-bottom-40">
			<div class="row text-center">
				<button type="submit" class="col-12 col-sm-12 col-md-4 col-lg-6 col-xl-6 btn btn-primary aling-center" data-s="btn-calificar" style="margin: 0 auto;">
					<i class="fa fa-save" aria-hidden="true"></i> CALIFICAR
				</button>
			</div>
		</div>
	</form>
</div>
<?
if(isset($errors))
{
	?>
	<div class="container">
		<div class="row">
			<div class="col-10 centrar">
				<div class="alert alert-danger text-center" role="alert">
				  <h4 class="alert-heading">Mensaje de Admyo</h4>
				  <p><?= $errors["mensaje"]?></p>
				  
				</div>	
			</div>
		</div>
	</div>
		
	<?
}
?>
<style>
.span-calif{
	color: #444;
	font-family: 'Montserrat',sans-serif;
	font-weight: 700;
	font-size: 18px;
	margin: 0;
	text-align: center;
	line-height: 1.4;
	letter-spacing: 0.6px;
	text-transform: uppercase;
	letter-spacing: 0;
}
.ui-autocomplete {
	height: 200px;
	overflow-y: scroll;
	overflow-x: hidden;
	width: 40%;
}
</style>
<script>
	$(function(){
		obt={};
		listgiros=<?= json_encode($giros->result())?>;
		var tag2=[];
		$.each(listgiros,function(index,giro){
				tag2.push(giro.Giro);
		})
		$("input[name='giroc']").autocomplete({
			source:tag2,
			select:function(event,ui){
					$.each(listgiros,function(index,giro){
						if(giro.Giro==ui.item.value){
							sub(giro.IDNivel1)
						}
					})	
				}
			})
		ayuda.senddata(obt,'<?= base_URL()?>Calificar/empresas',function(data){
			tag=[];
			tag2=[];
			lin=JSON.parse(data);
			ayuda.setlocal("empresas",data);
			for(key in lin){
				tag.push(lin[key]["value"]);
			}
			$(".razon").autocomplete({
				source:tag,
				select:function(event,ui){
					console.log(ui.item.value);
					lin=JSON.parse(ayuda.getlocal("empresas"));
					for(key in lin){
						if(lin[key]["value"]==ui.item.value){
							$("input[llc='RFC']").val(lin[key]["RFC"])
							ob={};
							ob["num"]=lin[key]["num"];
							ayuda.setlocal("numEmpresac",lin[key]["num"]);
							ayuda.senddata(ob,"<?= base_URL()?>Calificar/usuariomaster",function(data){
								lin=JSON.parse(data);
								$("input[llc='EMAIL']").val(lin.Correo);
							})
						}
					}
				}
			})
		})

	})
	$(document).on('click','.tab',function(){
		$(".tab").removeClass('current');
		$(this).addClass('current');
		$("input[name='realizapara']").val($(this).attr("lld"));
		$("#clie .thead").html('<h4><strong>DATOS DEL '+$(this).attr("lld")+'</strong></h4>');
	})
	function sub(value){
		var obj={};
		obj["sector"]=value;
		ayuda.senddata(obj,"<?= base_URL()?>registro/getSubsector",function(data){
			var lin=JSON.parse(data);
			if(lin.subnivel.length!=0){
				var cade="<option value=''>Selecciona</option>";
				for(key in lin.subnivel ){
					cade+="<option value='"+lin.subnivel[key].numero+"'>"+lin.subnivel[key].nombre+"</option>";		
				}	
			}else{
				var cade="<option value='0'></option>";
			}
			$("select[llc='Subsector']").html(cade);
			$('select[llc="Rama"]').html("")
			$('input[name="giro"]').val(value)
		});
	}
	$(document).on('change','select[llc="Subsector"]',function(){
		var obj={};
		obj["rama"]=$(this).val();

		ayuda.senddata(obj,"<?= base_URL()?>registro/getrama",function(data){

			var lin=JSON.parse(data);
			if(lin.rama.length!=0){
				var cade="<option value=''>Selecciona</option>";
				for(key in lin.rama ){
					cade+="<option value='"+lin.rama[key].numero+"'>"+lin.rama[key].nombre+"</option>";	
				}
				$("select[llc='Rama']").html(cade).attr("requerid","requerid");
			}else{
				var cade="<option value='0'></option>";
				$("select[llc='Rama']").html(cade);
			}
			
			
		});
	})
	$(document).on('click','div[llc="btn-calificar"]',function(){
		obt={};
		var div="#clie";
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
		console.log
		if(bandera==1){
			obt["num"]=ayuda.getlocal("numEmpresac");
			obt["tipo"]=$(".current").attr("lld");
			if(obt["num"]==false){
				ayuda.senddata(obt,"<?= base_URL()?>registro/preempresa",function(data){
					lin=JSON.parse(data);
					obt["num"]=lin.num;
					ayuda.removeloc("numEmpresac");
					ayuda.setlocal("numEmpresac",obt);
					ayuda.goto("<?= base_URL()?>calificar/cuestionario/"+$(".current").attr("lld"));
				})

			}else{
				ayuda.removeloc("numEmpresac");
				ayuda.setlocal("numEmpresac",obt);
				ayuda.goto("<?= base_URL()?>calificar/cuestionario/"+$(".current").attr("lld"));
			}


		}else{
			$("#msjerror").iziModal('setSubtitle',lin.datos);
			mserror();
		}

	})
</script>
