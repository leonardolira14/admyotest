<?php 
var_dump($datos[0]);

 ?>
<style type="text/css">
body{
	background:#f8f9fa;
}
</style>                        
<script type="text/javascript">
	$(document).ready(function($){
		$(".izimodal").each(function(i,e){
			izziFrame(e);
		});
	})

	$(function () {
		$('[data-toggle="popover"]').popover({ 
			container: 'body'
		})

	})  
</script>
<div id="c1" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="<?= base_URL()?>assets/img/new img/slider/slide01.jpg" >
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="<?= base_URL()?>assets/img/new img/slider/slide02.jpg" >
		</div>
	</div>
	<a class="carousel-control-prev" href="#c1" role="button" data-slide="prev">
		<img class="icos" src="<?= base_URL()?>/assets/img/new img/iconos/flYL_izq_gris.svg">
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#c1" role="button" data-slide="next">
		<img class="dericos icos" src="<?= base_URL()?>/assets/img/new img/iconos/flYL_izq_gris.svg">
		<span class="sr-only">Next</span>
	</a>
</div>
<div class="container">
	<div class="row">
		<div class="col-12 titulo">
			<div class="row m-t-20 ">         
				<div class="col-12 d-flex align-items-center">
					<label> <img src="http://localhost/admyo//assets/img/new img/iconos/flYL_izq.svg" class="img-fluid"></label>  <h4>TE DAMOS LA BIENVENIDA A LA FAMILIA ADMYO, PARA CONTINUAR SOLO LLENA LOS DATOS FALTANTES DE TU EMPRESA.</h4>
				</div>
			</div>

		</div>
	</div>
</div>
<form class="container bg-white p-t-30 p-b-30">
	<div class="row">
		<div class="form-group col-4">
			<label for="">IDIOMA:</label>
			<select  class="form-control" name="idioma"  >
				<?php

				foreach ($Idiomas as $idioma) {
					if($pais->id===$datos[0]->Idioma){
						?>
						<option selected  value="<?= $idioma->Codigo ?>"><?= $idioma->Nombre ?></option>
						<?php
					}else{
					?>
						<option  value="<?= $idioma->Codigo ?>"><?= $idioma->Nombre ?></option>
					<?php
				}}
				?>
			</select>
		</div>
		<div class="form-group col-12  col-md-4 col-xl-4 col-lg-4">
			<label for="">PAÍS:</label>
			<select  class="form-control"  onchange="help.getestado(this.value,'#admyo #pills-home')" name="pais"  >
				<?php

				foreach ($Paises as $pais) {
					if($pais->id===$datos[0]->Pais){
						?>
							<option selected value="<?= $pais->id ?>"><?= $pais->paisnombre ?></option>
						<?php
					}else{
						?>
							<option  value="<?= $estado->id ?>"><?= $pais->paisnombre ?></option>
						<?php
					}
					?>

				<?php }     
				?>
			</select>
		</div> 
		<div class="form-group col-12  col-md-4 col-xl-4 col-lg-4">
			<label for="">ESTADO:</label>
			<select  class="form-control" name="estado"  >
				<option value="NA">SELECCIONE</option>
				<?php

				foreach ($Estados as $estado) {
						if($datos[0]->Estado=== $estado->id){
						?>

					<option selected value="<?= $estado->id ?>"><?= $estado->estadonombre ?></option>
					<?php
						}else{


					?>

					<option value="<?= $estado->id ?>"><?= $estado->estadonombre ?></option>
					<?php
				}}
				?>
			</select>
		</div>
		<div class="form-group col-12">
			<label for="">RAZÓN SOCIAL:</label>
			<input type="text" value="<?= $datos[0]->Razon_Social ?>" class="form-control" name="razon"  >
		</div>
		<div class="form-group col-6">
			<label for="">NOMBRE COMERCIAL:</label>
			<input type="text" value="<?= $datos[0]->Nombre_Comer ?>" class="form-control" name="comercial"  >
		</div>
		<div class="form-group col-6">
			<label for="">R.F.C.(REGISTRO FEDERAL DE CONTRIBUYENTES):</label>
			<input type="text" value="<?= $datos[0]->RFC ?>" class="form-control" name="razon"  >
		</div>
		<div class="form-group col-12">
			<label for="">PÁGINA WEB:</label>
			<input type="text" value="<?= $datos[0]->Sitio_Web ?>"  class="form-control" name="pagina"  >
		</div>
		<div class="form-group col-12  col-md-4 col-xl-4 col-lg-4">
			<label for="">TIPO DE EMPRESA:</label>
			<select  class="form-control" name="te"  >
				<option value="NA">SELECCIONE</option>
				<?php

				foreach ($tiposempresa as $estado) {

					?>

					<option value="<?= $estado->Tipo ?>"><?= $estado->Tipo ?></option>
					<?php
				}
				?>
			</select>
		</div>
		<div class="form-group col-12  col-md-4 col-xl-4 col-lg-4">
			<label for="">NO DE EMPLEADOS:</label>
			<select  class="form-control" name="nemp"  >
				<option value="NA">SELECCIONE</option>
				<?php

				foreach ($noempleados as $estado) {

					?>

					<option value="<?= $estado->Num ?>"><?= $estado->Num ?></option>
					<?php
				}
				?>
			</select>
		</div>
		<div class="form-group col-12  col-md-4 col-xl-4 col-lg-4">
			<label for="">FACTURACIÓN ANUAL:</label>
			<select  class="form-control" name="fac"  >
				<option value="NA">SELECCIONE</option>
				<?php

				foreach ($fac as $estado) {
						
						?>

					<option value="<?= $estado->FacAnual ?>"><?= $estado->FacAnual ?></option>
					<?php
				}
				?>
			</select>
		</div>
		<div class="form-group col-12 ">
			<label for="">DESCRIPCIÓN DE LA EMPRESA:</label>
			<textarea class="form-control " name="perfil"> value="<?= $datos[0]->Perfil ?>" rows="5"  ></textarea>
		</div>
		<div class="col-6 text-left ">
			<div class="btn btn-primary "><img src="<?=base_URL()?>assets/img/iconos/arrow-alt-circle-right.svg" class="btnicons"> Omitir </div>

		</div>
		<div class="col-6 text-right">
			<div class="btn btn-primary ">
				<img src="<?=base_URL()?>assets/img/iconos/save.svg" class="btnicons">  Guardar 
			</div>
		</div>
		<input type="hidden" name="empresa" value="<?= $num?>">	
		<input type="hidden" name="persona" value="<?= $datos[0]->Persona?>">	
	</div>
</form>
