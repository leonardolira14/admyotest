

<div class="container div-invisible-sm margin-top-40 margin-bottom-40">
	<div class="row">
		<div class="col-4 ">
			<div class="col-12 text-center">
				<?php

			if($datos['Logo']!==""){
				
				?>
				<img  class="img-fluid logo-perfil align-center" src="<?= base_url()?>/assets/img/logosEmpresas/<?= $datos['Logo'];?>" ></div>
				
				<?php
			}else{
				?>
					<img  class="img-fluid logo-perfil align-center" src="<?= base_url()?>/assets/img/foto-no-disponible.jpg?>" ></div>
				<?php
			}

?>
				
			<div class="col-12 text-left tit-perfil margin-top-40 ">Descripción de la Empresa</div>
			<div class="col-12 text-center margin-top-40 "><span><?= $datos['Perfil'];?></span></div>
			<div class="col-12 text-left margin-top-20 margin-top-40 "><span class="tit-perfil">Giros</span></div>
			<?php foreach ($datos["giros"] as $giros) {?>
					<div class="col-12"><?= $giros["Giro"]; ?></div>
					<hr>
			<?php } ?>

		</div>
		<div class="col-8">
		<div class="textnumcalif"><?= $datos["textNumcalif"]?></div>
			<span class="actulizada"><?= $datos["DiasActualizados"]?></span>
			<div class="tb-ranking row float-rigth">
				<div class="col-6 text-center link" llc="/PerfilBuscado/calificacionesclientes/<?=$num?>">
					<div class="col-12">RANKING C/ CLIENTE</div>
					<div class="col-12">1</div>
					<div class="col-12">CALIFICACIÓN</div>
					<div class="col-12"><?= $datos['CalifcCliente'];?>/10.00</div>
					<div class="col-12">TOTAL DE CALIFICACIONES</div>
					<div class="col-12"><?= $datos['NumCalifcCliente'];?></div>
				</div>
				<div class="col-6 text-center link" llc="/PerfilBuscado/calificacionesproveedores/<?=$num?>">
					<div class="col-12">RANKING C/ PROVEEDOR</div>
					<div class="col-12">1</div>
					<div class="col-12">CALIFICACIÓN</div>
					<div class="col-12"><?= $datos['CalifcProveedor'];?>/10.00</div>
					<div class="col-12">TOTAL DE CALIFICACIONES</div>
					<div class="col-12"><?= $datos['NumCalifcProveedor'];?></div>
				</div>
			</div>

			<img src="<?= base_url()?>/assets/img/sellos-admio/<?= $datos["imgen"]?>" class="img-fluid" >
			<div class="row justify-content-around margin-top-20">
				<div class="col-10 align-self-center " >
					<table style=" width: 100%;" cellspacing="10">
						<tr style="border-bottom:20px solid #fff; ">
							<td> <a style="width:90%; "  class="btn btn-primary link" href="<?= base_url()?>PerfilBuscado/datosempresa/<?=$num?>">DATOS DE EMPRESA</a> </td>
							<td>  <a style="width:90%; "  class="btn btn-primary  link" href="<?= base_url()?>PerfilBuscado/asociaciones/<?=$num?>">ASOCIACIONES</a></td>
						</tr>
						<tr >
							<td><a style="width:90%; "  href="<?= base_url()?>PerfilBuscado/productosyservicios/<?=$num?>" class="link btn btn-primary">PRODUCTOS Y SERVICIOS</a></td>
							<td><a style="width:90%; " href="<?= base_url()?>PerfilBuscado/certificaciones/<?=$num?>"  class="link btn btn-primary">CERTIFICACIONES DE CALIDAD</a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		
	</div>
</div>

<div class="container-fluid div-visible-sm p-sm margin-top-20">
	<div class="row">
		<div class="col-4 text-center align-middle ">
		<?php

			if($datos['Logo']!==""){
				
				?>
				<img src="<?= base_url()?>/assets/img/foto-no-disponible.jpg" class="img-prefil  img-fluid" alt="">
				
				<?php
			}else{
				?>
					<img src="<?= base_url()?>/assets/img/logosEmpresas/<?= $datos['Logo'];?>" class="img-prefil  img-fluid" alt="">
				<?php
			}

?>
		</div>
		<div class="col-8 titulos ">
			<?= $datos['titulo'];?>
		</div>
		<div class="col-12 margin-top-20">
			<div class="textnumcalif"><?= $datos["textNumcalif"]?></div>
			<img src="<?= base_url()?>/assets/img/sellos-admio/movil/<?= $datos["imgen"]?>"  class="img-fluid" alt="">
		</div>
		
	</div>
</div>
<div class="container container-fluid div-visible-sm p-sm c-ranx <?= $datos["class"]?>">
	<div>
		<div class="col-12">
			<?= $datos["DiasActualizados"]?>
		</div>
	</div>
</div>

<div class="container-fluid div-visible-sm p-sm c-ran <?= $datos["class"]?>">

	<div class="row ">
		<div class="col-6 text-center link" llc="/PerfilBuscado/calificacionesclientes/<?=$num?>">
			<div class="col-12">RANKING C/ CLIENTE</div>
					<div class="col-12">1</div>
					<div class="col-12">CALIFICACIÓN</div>
					<div class="col-12"><?= $datos['CalifcCliente'];?>/10.00</div>
					<div class="col-12">TOTAL DE CALIFICACIONES</div>
					<div class="col-12"><?= $datos['NumCalifcCliente'];?></div>
		</div>
		<div class="col-6 text-center link" llc="perfil/calificacionesproveedores/<?=$num?>">
			<div class="col-12">RANKING C/ PROVEEDOR</div>
					<div class="col-12">1</div>
					<div class="col-12">CALIFICACIÓN</div>
					<div class="col-12"><?= $datos['CalifcProveedor'];?>/10.00</div>
					<div class="col-12">TOTAL DE CALIFICACIONES</div>
					<div class="col-12"><?= $datos['NumCalifcProveedor'];?></div>
		</div>
	</div>
</div>
<script>
	$(function(){
		utl=window.location.href;
		t=utl.split("/");
		ayuda.setlocal("pbn",t[t.length-1]);
	})
</script>



