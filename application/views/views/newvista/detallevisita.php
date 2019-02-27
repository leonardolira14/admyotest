<?
$re=json_decode($rec); 
?>
<script type="text/javascript">
  var tp=<?= $rec; ?>;	

  google.charts.load('current', {'packages':['corechart','bar']});
  google.charts.setOnLoadCallback(function(){
   help.graficarv2(tp.serieclietes,"","grf-c","cu","");
   help.graficarv2(tp.serieproveedor,"","grf-p","cu","");
   help.graficarv2(tp.serieotras,"","grf-o","cu","");
   $(".tab-pane").removeClass("show fade");
   $("#nav-home").addClass("show fade")

 });

</script>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Proveedores</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Clientes</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Otros</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  	<div class="container-fluid margin-top-30 margin-bottom-30 " >
      <div class="row tables ">
        <div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>PROVEEDORES </strong></h4></div>
        <div class="col-12 margin-top-10">
          <div class="row" id="abss">
            <?
            if($re->proveedores!=false){
              foreach ($re->proveedores as $proveedor) {
                ?>
                <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 centrar-vertical-contend" id="image-cal">
                  <? if($proveedor->Logo==""){
                    ?>
                    <img src="<?= base_URL()?>/assets/img/foto-no-disponible.jpg" class="img-fluid" alt="<?= $proveedor->Razon_Social?>">
                    <?

                  }else{
                    ?>
                    <img src="<?= base_URL()?>/assets/img/logosEmpresas/<?= $proveedor->Logo?>" class="img-fluid" alt="<?= $proveedor->Razon_Social?>">
                    <?
                  }
                  ?>
                </div>
                <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7" id="Texto-cal">
                  <div class="col-12">Razón Socaial:<span class="minitit"> <?= $proveedor->Razon_Social?></span></div>
                  <div class="col-12">Nombre Comercial:<span class="spantb"> <?= $proveedor->Nombre_Comer?></span></div>
                  <div class="col-12">RFC:<span class="spantb"> <?= $proveedor->RFC ?></span></div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 centrar-vertical-contend" id="acciones-cal">
                  <div class="row">

                    <i class="fa fa-search bgblue-1 white iconos_botones" lld="detalleva" llc="<?= $proveedor->num?>" data-toggle="popover" title="" data-original-title="Ver Perfil" aria-describedby="popover618033"></i>
                  </div>
                </div>
                <div class="col-12 hr"></div>
                <?
              }
            }
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade show fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  	<div class="container-fluid margin-top-30 margin-bottom-30 " >
      <div class="row tables ">
        <div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>CLIENTES </strong></h4></div>
        <div class="col-12 margin-top-10">
          <div class="row" id="abss">
            <?
            if($re->clientes!=false){
              foreach ($re->clientes as $proveedor) {
                ?>
                <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 centrar-vertical-contend" id="image-cal">
                  <? if($proveedor->Logo==""){
                    ?>
                    <img src="<?= base_URL()?>/assets/img/foto-no-disponible.jpg" class="img-fluid" alt="<?= $proveedor->Razon_Social?>">
                    <?

                  }else{
                    ?>
                    <img src="<?= base_URL()?>/assets/img/logosEmpresas/<?= $proveedor->Logo?>" class="img-fluid" alt="<?= $proveedor->Razon_Social?>">
                    <?
                  }
                  ?>
                </div>
                <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7" id="Texto-cal">
                  <div class="col-12">Razón Socaial:<span class="minitit"> <?= $proveedor->Razon_Social?></span></div>
                  <div class="col-12">Nombre Comercial:<span class="spantb"> <?= $proveedor->Nombre_Comer?></span></div>
                  <div class="col-12">RFC:<span class="spantb"> <?= $proveedor->RFC ?></span></div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 centrar-vertical-contend" id="acciones-cal">
                  <div class="row">

                    <i class="fa fa-search bgblue-1 white iconos_botones" lld="detalleva" llc="<?= $proveedor->num?>" data-toggle="popover" title="" data-original-title="Ver Perfil" aria-describedby="popover618033"></i>
                  </div>
                </div>
                <div class="col-12 hr"></div>
                <?
              }
            }
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade show fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  	<div class="container-fluid margin-top-30 margin-bottom-30 " >
      <div class="row tables ">
        <div class=" col-12 titulos-blanco  bgazul text-center thead"><h4><strong>OTRAS EMPRESAS </strong></h4></div>
        <div class="col-12 margin-top-10">
          <div class="row" id="abss">
            <?
            if($re->otras!=false){
              foreach ($re->otras as $proveedor) {
                ?>
                <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 centrar-vertical-contend" id="image-cal">
                  <? if($proveedor->Logo==""){
                    ?>
                    <img src="<?= base_URL()?>/assets/img/foto-no-disponible.jpg" class="img-fluid" alt="<?= $proveedor->Razon_Social?>">
                    <?

                  }else{
                    ?>
                    <img src="<?= base_URL()?>/assets/img/logosEmpresas/<?= $proveedor->Logo?>" class="img-fluid" alt="<?= $proveedor->Razon_Social?>">
                    <?
                  }
                  ?>
                </div>
                <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7" id="Texto-cal">
                  <div class="col-12">Razón Socaial:<span class="minitit"> <?= $proveedor->Razon_Social?></span></div>
                  <div class="col-12">Nombre Comercial:<span class="spantb"> <?= $proveedor->Nombre_Comer?></span></div>
                  <div class="col-12">RFC:<span class="spantb"> <?= $proveedor->RFC ?></span></div>
                </div>
                <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 centrar-vertical-contend" id="acciones-cal">
                  <div class="row">

                    <i class="fa fa-search bgblue-1 white iconos_botones" lld="detalleva" llc="<?= $proveedor->num?>" data-toggle="popover" title="" data-original-title="Ver Perfil" aria-describedby="popover618033"></i>
                  </div>
                </div>
                <div class="col-12 hr"></div>
                <?
              }
            }
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>