<div class="container div-invisible-sm margin-top-40">
	<div class="row">
		<div class="col-4 ">
			<div class="col-12 text-right  margin-top-20"><i  llc="perfil/datosempresa"  class=" link fa fa-map-marker iconos_botones bgblue-1 white"></i> </div>
			<div class="col-12 text-center">
				<?php
				if($datos['Logo']!==""){
					?>
					<img  class="img-fluid logo-perfil align-center" src="<?= base_url()?>/assets/img/logosEmpresas/<?= $datos['Logo'];?>" >
					<?php
				}else{
					?>
					<img  class="img-fluid logo-perfil align-center" src="<?= base_url()?>/assets/img/foto-no-disponible.jpg" >
					<?php

				}
				?>
				
			</div>
			<div class="col-12 text-right  margin-top-20"><i llc="perfil/datosempresa"  class=" link fa fa-map-marker iconos_botones bgblue-1 white"></i> </div>
			<div class="col-12 text-left tit-perfil">Descripción de la Empresa</div>
			<div class="col-12 text-center"><span><?= $datos['Perfil'];?></span></div>
			<div class="col-12 text-right  margin-top-20"><i  llc="perfil/datosempresa"  class=" link fa fa-map-marker iconos_botones bgblue-1 white"></i> </div>
			<div class="col-12 text-left margin-top-20"><span class="tit-perfil">Giros</span></div>
			<?php foreach ($datos["giros"] as $giros) {?>
			<div class="col-12"><?= $giros["Giro"]; ?></div>
			<hr>
			<?php } ?>

		</div>
		<div class="col-8">
			<div class="textnumcalif"><?= $datos["textNumcalif"]?></div>
			<span class="actulizada"><?= $datos["DiasActualizados"]?></span>
			<div class="tb-ranking row float-rigth">
				<div class="col-6 text-center link" llc=perfil/calificacionesrecibidasp>
					<div class="col-12">RANKING C/ CLIENTE</div>
					<div class="col-12">1</div>
					<div class="col-12">CALIFICACIÓN</div>
					<div class="col-12"><?= $datos['CalifcCliente'];?>/10.00</div>
					<div class="col-12">TOTAL DE CALIFICACIONES</div>
					<div class="col-12"><?= $datos['NumCalifcCliente'];?></div>
				</div>
				<div class="col-6 text-center link" llc=perfil/calificacionesrecibidasc>
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
							<td> <div style="width:90%; "  class="btn btn-primary">Mi CÓDIGO QR</div> </td>
							<td>  <div style="width:90%; "  class="btn btn-primary">Mi CÓDIGO API</div></td>
						</tr>
						<tr >
							<td><div style="width:90%; "  llc="perfil/productosyservicios" class="link btn btn-primary">PRODUCTOS Y SERVICIOS</div></td>
							<td><div style="width:90%; " llc="perfil/certificaciones"  class="link btn btn-primary">CERTIFICACIONES DE CALIDAD</div></td>
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
					<img src="<?= base_url()?>/assets/img/logosEmpresas/<?= $datos['Logo'];?>" class="img-prefil  img-fluid" alt="">
					<?php
				}else{
					?>
					<img  class="img-prefil  img-fluid" src="<?= base_url()?>/assets/img/foto-no-disponible.jpg" >
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
		<div class="col-6 text-center link" llc=perfil/calificacionesrecibidasp>
			<div class="col-12">RANKING C/ CLIENTE</div>
			<div class="col-12">1</div>
			<div class="col-12">CALIFICACIÓN</div>
			<div class="col-12"><?= $datos['CalifcCliente'];?>/10.00</div>
			<div class="col-12">TOTAL DE CALIFICACIONES</div>
			<div class="col-12"><?= $datos['NumCalifcCliente'];?></div>
		</div>
		<div class="col-6 text-center link" llc=perfil/calificacionesrecibidasc>
			<div class="col-12">RANKING C/ PROVEEDOR</div>
			<div class="col-12">1</div>
			<div class="col-12">CALIFICACIÓN</div>
			<div class="col-12"><?= $datos['CalifcProveedor'];?>/10.00</div>
			<div class="col-12">TOTAL DE CALIFICACIONES</div>
			<div class="col-12"><?= $datos['NumCalifcProveedor'];?></div>
		</div>
	</div>
</div>

<div class="container-fluid margin-top-30 funorange">
	<div class="row">
		<div class="col-12 tutilos-blanco">
			ESTADÍSTICAS DE DESEMPEÑO DE MIS CLIENTES
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 cbluex link"  llc="perfil/reputacionc">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title mejorado" id="nmejorado"><?= $datos["MejoradoClientes"];?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado"><?= $datos["PMejoradoClientes"];?> % Mejorado</p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 cbluex link"  llc="perfil/reputacionc">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title mejorado" id="nmejorado"><?= $datos["EmpeoradoClientes"]; ?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado"><?= $datos["PEmpeoradoClientes"] ;?> % Empeorado</p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 cbluex link"  llc="perfil/reputacionc">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title mejorado" id="nmejorado"><?= $datos["MantendioClientes"] ;?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado"><?= $datos["PMantendioClientes"] ;?> % Mantenido</p></div>
				</div>
			</div>
		</div>
		<div class="col-12 tutilos-blanco margin-top-30">
			ESTADÍSTICAS DE DESEMPEÑO DE MIS PROVEEDORES
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 cbluex link"  llc="perfil/reputacionp">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title mejorado" id="nmejorado"><?= $datos["MejoradoProve"] ;?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado"><?= $datos["PMejoradoProve"] ;?> % Mejorado</p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 cbluex link"  llc="perfil/reputacionp"">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title mejorado" id="nmejorado"><?= $datos["EmpeoradoProve"] ;?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado"><?= $datos["PEmpeoradoProve"] ;?> % Empeorado</p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 cbluex link"  llc="perfil/reputacionp">
			<div class="cblue">
				<div class="fun-wrap">
					<div class="count  count-title mejorado" id="nmejorado"><?= $datos["MantendioProve"] ;?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado"><?= $datos["PMantendioProve"] ;?> % Mantenido</p></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid margin-top-30 funvlue">
	<div class="row">
		<div class="col-12 tutilos-blanco">
			VISITAS RECIBIDAS
		</div>
		<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 cbluex link"  llc="perfil/visitas">
			<div class="corange">
				<div class="fun-wrap">
					<div class="count  count-title mejorado" id="nmejorado"><?= $datos["visitasClientes"]?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado">CLIENTES</p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 cbluex link"  llc="perfil/visitas">
			<div class="corange">
				<div class="fun-wrap">
					<div class="count  count-title mejorado" id="nmejorado"><?= $datos["visitasProveedores"]?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado">PROVEEDORES</p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 cbluex link"  llc="perfil/visitas">
			<div class="corange">
				<div class="fun-wrap">
					<div class="count  count-title mejorado" id="nmejorado"><?= $datos["visitasOtras"]?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado">OTROS</p></div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 cbluex link"  llc="perfil/visitas">
			<div class="corange">
				<div class="fun-wrap">
					<div class="count  count-title mejorado" id="nmejorado"><?= $datos["visitasAnonimas"]?></div>
					<div class="funfact-divider"></div>
					<div class="funfact"><p id="mejorado">ANONIMAS</p></div>
				</div>
			</div>
		</div>
	</div>
</div>


