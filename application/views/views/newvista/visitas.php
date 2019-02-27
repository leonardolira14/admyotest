
<?

$re=json_decode($recc);
//vdebug($re);
?>
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  var tp=<?= $rec; ?>;
  $(function(){
   console.log(tp.Total);
   $("div#num").text(tp.Total)
 })


  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(function(){
   help.graficarv2(tp.series,"","piechart","c","");
   <?
   if($tip==="M"){
    ?>
    help.graficarv2(tp.evo,"","chart_div","l","Dias");
    <?
  }else if($tip==="A"){
    ?>
    help.graficarv2(tp.evo,"","chart_div","l","Meses");
    <?
  }
  ?>
  ;
});
</script>
<div class="container-fluid">
  <div class="row banner ">
    <div class="bg"></div>
    <div class="text">
      visitas recibidas
    </div>
    <div class="banner-imgclie"></div>
  </div>
</div>

<div class="container-fluid margin-top-30 menu-tab menu-visitas">
  <div class="row">
    <div  class="col-12  col-md-3 col-lg-3 col-xl-3  text-center ">
      <div class="tab current" data-get="#resumen">
        <i class="fa fa-line-chart ibtn bgblue-1 white"></i>
        RESUMEN
      </div>
    </div>
    <div class="col-12 col-md-3 col-lg-3 col-xl-3  text-center ">
      <div class="tab " data-get="#clientes" >
        <i class="fa fa-users ibtn bgblue-1 white"></i>
        Clientes
      </div>
    </div>
    <div  class="col-12 col-md-3 col-lg-3 col-xl-3  text-center ">
      <div class="tab " data-get="#proveedores">
        <i class="fa fa-puzzle-piece ibtn bgblue-1 white"></i>
        Proveedores
      </div>
    </div>
    <div   class="col-12 col-md-3 col-lg-3 col-xl-3  text-center ">
      <div class="tab " data-get="#otros">
        <i class="fa fa-puzzle-piece ibtn bgblue-1 white"></i>
        Otros
      </div>
    </div>
  </div>
</div>
<div class="container-fluid tabs-item " id="resumen">
  <div class="container ">
    <div class="row d-flex justify-content-end m-b-30 m-t-30">
      <div class="col-6 text-right">
        <div class="btn-group" role="group" aria-label="Basic example">
          <?
          if($tip==="M"){
            ?>

            <a href="<?=base_URL()?>visitas/M"  class="btn btn-primary active">MES</a>
            <a href="<?=base_URL()?>visitas/A" class="btn btn-secondary ">12 MESES</a>
            <?
          }else{
            ?>

            <a href="<?=base_URL()?>visitas/M"  class="btn btn-secondary ">MES</a>
            <a href="<?=base_URL()?>visitas/A" class="btn btn-primary active">12 MESES</a>
            <?
          }
          ?>
          
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
       <div class="col-6 text-center" >
        <div class="row">
         <div class="col-12 text-center titulos">
          <span><h5>Visitas a tu Perfil</h5></span>
         </div>
        </div>
        <div class="conat-graf piechart d-flex justify-content-center "  id="">
          <div id="piechart">

          </div>
        </div>
      </div>
      <div class="col-6" >
        <div class="row d-flex justify-content-center">
         <div class="col-12 text-center titulos">
            <span><h5>No de Visitas </h5></span>
         </div>
         <div class="col-6  d-flex justify-content-center num-vis w-100" id="num">

         </div>
        </div>
      </div>
      <div class="col-12 text-center titulos m-t-30">
        <span><h5>Evolución de Visitas </h5></span>
      </div>
      <div class="col-12" style="height: 500px;" id="chart_div">
      </div>
    </div>
  </div>
</div>
<div class="container tabs-item d-none" id="clientes">
  <div class="row  m-t-30">
    <?
    foreach ($re->clientes as $cliente) {
      $logo=($cliente->Logo==='') ? '/foto-no-disponible.jpg' : '/logosEmpresas/$cliente->Logo';
      ?>
      <div class="col-12 card list-vista p-t-20 p-b-20 m-b-30  Small shadow">
        <div class="row d-flex align-items-center">
          <div class="col-3 text-center">
            <img src="<?= base_URL('assets/img').$logo;   ?> " class="logo rounded" alt="">
          </div>
          <div class="col-7">
           <ul class="list-group">
              <li class="list-group-item text-uppercase">
                <small class="text-muted">Razon Social:</small>
                <p><strong class="text-blue"><?= $cliente->Razon_Social?></strong></p>
              </li>
               <li class="list-group-item text-uppercase">
                <small class="text-muted">Nombre Comercial:</small>
                <p><strong class="text-blue"><?= $cliente->Nombre_Comer?></strong></p>
              </li>
               <li class="list-group-item text-uppercase">
                <small class="text-muted">R.F.C:</small>
                <p><strong class="text-blue"><?=$cliente->RFC?></strong></p>
              </li>
            </ul>
          </div>
          <div class="col-2">
            <div class="row">
              <div class="col-12">
                <i class="fa fa-search bgblue-1 white iconos_botones link"  data-toggle="tooltip" data-placement="top" title="Visitar Perfil" lld="<?=$cliente->num?>"  llc="<?=base_URL()?>PerfilBuscado/perfil/A/<?=$cliente->num?>"></i>

              </div>
            </div>
          </div>
        </div>
      </div>
      <?
    }
    ?>
    
  </div>
</div>
<div class="container tabs-item d-none" id="proveedores">
  <div class="row ">
    <?
    foreach ($re->proveedores as $cliente) {
      $logo=($cliente->Logo==='') ? '/foto-no-disponible.jpg' : '/logosEmpresas/$cliente->Logo';
      ?>
      <div class="col-12 card list-vista p-t-20 p-b-20 m-b-30  Small shadow">
        <div class="row d-flex align-items-center">
          <div class="col-3 text-center">
            <img src="<?= base_URL('assets/img').$logo;   ?> " class="logo rounded" alt="">
          </div>
          <div class="col-7">
           <ul class="list-group">
              <li class="list-group-item text-uppercase">
                <small class="text-muted">Razon Social:</small>
                <p><strong class="text-blue"><?= $cliente->Razon_Social?></strong></p>
              </li>
               <li class="list-group-item text-uppercase">
                <small class="text-muted">Nombre Comercial:</small>
                <p><strong class="text-blue"><?= $cliente->Nombre_Comer?></strong></p>
              </li>
               <li class="list-group-item text-uppercase">
                <small class="text-muted">R.F.C:</small>
                <p><strong class="text-blue"><?=$cliente->RFC?></strong></p>
              </li>
            </ul>
          </div>
          <div class="col-2">
            <div class="row">
              <div class="col-12">
                 <i class="fa fa-search bgblue-1 white iconos_botones link"  data-toggle="tooltip" data-placement="top" title="Visitar Perfil" lld="<?=$cliente->num?>"  llc="<?=base_URL()?>PerfilBuscado/perfil/A/<?=$cliente->num?>"></i>

              </div>
            </div>
          </div>
        </div>
      </div>
      <?
    }
    ?>
    
  </div>
</div>
<div class="container tabs-item d-none" id="otros">
  <div class="row m-t-30">
    <?
    foreach ($re->otras as $cliente) {
      $logo=($cliente->Logo==='') ? '/foto-no-disponible.jpg' : '/logosEmpresas/'.$cliente->Logo;
      ?>
      <div class="col-12 card list-vista p-t-20 p-b-20 m-b-30  Small shadow">
        <div class="row d-flex align-items-center">
          <div class="col-3 text-center">
            <img src="<?= base_URL('assets/img').$logo;   ?> " class="logo rounded" alt="">
          </div>
          <div class="col-7">
           <ul class="list-group">
              <li class="list-group-item text-uppercase">
                <small class="text-muted">Razon Social:</small>
                <p><strong class="text-blue"><?= $cliente->Razon_Social?></strong></p>
              </li>
               <li class="list-group-item text-uppercase">
                <small class="text-muted">Nombre Comercial:</small>
                <p><strong class="text-blue"><?= $cliente->Nombre_Comer?></strong></p>
              </li>
               <li class="list-group-item text-uppercase">
                <small class="text-muted">R.F.C:</small>
                <p><strong class="text-blue"><?=$cliente->RFC?></strong></p>
              </li>
            </ul>
          </div>
          <div class="col-2">
            <div class="row">
              <div class="col-12">
                <i class="fa fa-search bgblue-1 white iconos_botones link"  data-toggle="tooltip" data-placement="top" title="Visitar Perfil" lld="<?=$cliente->num?>"  llc="<?=base_URL()?>PerfilBuscado/perfil/<?=$cliente->num?>"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?
    }
    ?>
    
  </div>
</div>

