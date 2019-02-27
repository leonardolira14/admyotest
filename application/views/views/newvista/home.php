
<script type="text/javascript">
  $(document).ready(function($){
    $(".izimodal").each(function(i,e){
            izziFrame(e);
        });
    home.pnlogin();
    })

  $(function () {
    $('[data-toggle="popover"]').popover({ 
      container: 'body'
    })

  })  
</script>
<div class="container-fluid gr-login">
  <div class="row d-flex justify-content-end">
    <div class="col-6 text-right">
    <div class="btn-group" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-primary bnt-login">
        <img src="<?= base_url()?>assets/img/iconos/user-plus-solid.svg" class="icos"> REGISTRO
     </button>
       <div class="btn btn-primary bnt-login" onclick="$('#mfrm-login').iziModal('open')">
        <img src="<?= base_url()?>assets/img/iconos/sign-in-alt-solid.svg" class="icos">
        INCIAR SESIÓN
      </div>
    </div>
     
    </div>
  </div>
</div>
<div id="c1" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="<?= base_URL()?>assets/img/new-img/slider/slide01.jpg" >
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?= base_URL()?>assets/img/new-img/slider/slide02.jpg" >
    </div>
  </div>
  <a class="carousel-control-prev" href="#c1" role="button" data-slide="prev">
    <img class="icos" src="<?= base_URL()?>/assets/img/new-img/iconos/flYL_izq_gris.svg">
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#c1" role="button" data-slide="next">
    <img class="dericos icos" src="<?= base_URL()?>/assets/img/new-img/iconos/flYL_izq_gris.svg">
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-6">
      <img data-pal="admyo" data-ruta="<?= base_URL()?>/assets/img/new-img/iconos/" src="<?= base_URL()?>/assets/img/new-img/iconos/admyo_activo.svg" class="img-fluid  btn-princam">
    </div>
    <div class="col-6 ">
      <img data-pal="qval" data-ruta="<?= base_URL()?>/assets/img/new-img/iconos/"  src="<?= base_URL()?>/assets/img/new-img/iconos/qval_inactivo.svg" class="img-fluid  btn-princam">
    </div>
  </div>
</div>
<!--inicia Admyo-->
<div class="container-fluid palprinc" id="admyo">
  <div class="row m-t-20">
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="row m-t-20">
        <div class="col-12">
          <img src="<?= base_URL()?>/assets/img/new-img/ADMYO/pantalla_admyo.jpg" class="img-fluid">
        </div>
        <div class="col-12 titulo">
          <div class="row m-t-20 ">         
            <div class="col-12 d-flex align-items-center">
              <label> <img src="<?= base_URL()?>/assets/img/new-img/iconos/flYL_izq.svg" class="img-fluid"></label>  <h4>BENEFICIOS DE SUSCRIBIRTE EN ADMYO</h4>
            </div>
          </div>

        </div>
        <div class="col-12 beneficios">
          <div class="row">
            <div class="col-12 d-flex align-items-center">
              <label>
                <img src="<?= base_URL()?>/assets/img/new-img/beneficiosAD_01.png" class="d-block w-100">
              </label>
              <span>
                ¡Genera una reputación y posiciónate entre un gran número de clientes y proveedores!
              </span>
            </div>
            <div class="col-12 d-flex align-items-center">
              <label>
                <img src="<?= base_URL()?>/assets/img/new-img/beneficiosAD_02.png" class="d-block w-100">
              </label>
              <span>
                ¡Disminuye los riesgos para tu empresa y aumenta tus ventas!
              </span>
            </div>
            <div class="col-12 d-flex align-items-center">
              <label>
                <img src="<?= base_URL()?>/assets/img/new-img/beneficiosAD_03.png" class="d-block w-100">
              </label>
              <span>
                Gestiona tu imagen corporativa en internet y redes sociales.
              </span>
            </div>
            <div class="col-12 d-flex align-items-center">
              <label>
                <img src="<?= base_URL()?>/assets/img/new-img/beneficiosAD_04.png" class="d-block w-100">
              </label>
              <span>
                Controla la calidad y saneamiento económico en la cadena de valor de tus productos y servicios.
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="row frm-susc">
        <div class="col-12 text-white text-center">
           <h3>REGISTRO</h3> 
        </div>
        <div class="col-12">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show " id="la" role="tabpanel" aria-labelledby="la-tab">
             <div class="container-fluid">
               <div class="row">
                 <div class="col-12 m-t-20 text-center">
                  INICIO DE SESIÓN
                </div> 
              </div>
              <form class="row m-t-20"> 
                <div class="form-group col-12">
                  <label for="">DIRECCIÓN DE EMAIL:</label>
                    <input type="text" class="form-control" name="razon"  >
                </div>
                <div class="form-group col-12">
                  <label for="">CONTRASEÑA:</label>
                  <input type="text" class="form-control" name="razon"  >
                  <small class="col-ama">¿Olvidaste tu contraseña?</small>
                </div>
               <div class="form-group form-check col-12 text-center">
                  <input type="checkbox" class="form-check-input" id="RCA">
                  <label class="form-check-label" for="RCA">RECORDAR MIS DATOS EN ESTE EQUIPO</label>
                </div>
              </form>
              <div class="row">
                <div class="col-12 btn btn-primary">
                 ACCEDER
                </div>
              
              </div>
            </div> 

          </div>
          <div class="tab-pane fade show active m-t-20" id="rga" role="tabpanel" aria-labelledby="rga-tab">
            <div class="col-12">
              <h6>Completa este formulario y empieza a disfrutar los beneficios de contar con
              una buena reputación en Admyo.</h6>
            </div>
            <div class="col-12">
              SELECCIONE SU RÉGIMEN FISCAL
            </div>
            <div class="col-12 m-t-20">
              <small class="col-ama">*Persona Física con actividad empresarial.</small>
            </div>
            <div class="col-12 m-t-20">
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">PERSONA MORAL</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">PERSONA FISICA*</a>
                </li>

              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                  <!--inicio persona moral-->
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12 col-ama">
                        DATOS DE LA EMPRESA
                      </div>
                    </div>
                    <form class="row m-t-20" id="frmadmyoPM"> 
                      <div class="form-group col-12 d-none">
                        <label for="">IDIOMA:</label>
                        <select  class="form-control" name="idioma"  >
                          <?php

                             foreach ($Idiomas as $idioma) {
                                
                                  ?>
                                  <option  value="<?= $idioma->Codigo ?>"><?= $idioma->Nombre ?></option>
                                  
                                
                                  <?php
                                }
                              ?>
                        </select>
                      </div>
                       <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">PAIS:</label>
                        <select  class="form-control"  onchange="help.getestado(this.value,'#admyo #pills-home')" name="pais"  >
                          <?php

                             foreach ($Paises as $pais) {
                                if($pais->id=="42"){
                                  ?>
                                  <option selected value="<?= $pais->id ?>"><?= $pais->paisnombre ?></option>
                                  <?php
                                }else{
                                  ?>
                                  <option value="<?= $pais->id ?>"><?= $pais->paisnombre ?></option>
                                  <?php
                                }
                              ?>
                            
                          <?php }     
                        ?>
                        </select>
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">Estado:</label>
                       <select  class="form-control" name="estado"  >
                           <option value="NA">SELECCIONE</option>
                          <?php

                             foreach ($Estados as $estado) {
                                   
                                ?>
                                                              
                                  <option value="<?= $estado->id ?>"><?= $estado->estadonombre ?></option>
                                  <?php
                                }
                              ?>
                            
                        

                        </select>
                      </div>
                       
                      <div class="form-group col-12">
                        <label for="">RAZON SOCIAL:</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="razon"  >
                          <div class="input-group-prepend">
                            <div class="input-group-text" data-toggle="popover" title="Razón Social" data-content="La razón social es la denominación por la cual se conoce colectivamente a una empresa" ><img src="<?= base_URL()?>/assets/img/new-img/iconos/btn_info.svg" class="icos" ></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <label for="">NOMBRE COMERCIAL:</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="comercial"  >
                          <div class="input-group-prepend">
                            <div class="input-group-text" data-toggle="popover" title="Nombre Comercial" data-content="Un nombre comercial es un seudónimo usado por empresas para desempeñar su negocio bajo un nombre que difiere del nombre legal registrado del negocio."><img src="<?= base_URL()?>/assets/img/new-img/iconos/btn_info.svg" class="icos" ></div>
                          </div>
                        </div>

                      </div>
                      <div class="form-group col-12">
                        <label for="">R.F.C.(REGISTRO FEDERAL DE CONTRIBUYENTES):</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="rfc" >
                          <div class="input-group-prepend"  data-toggle="popover" title="R.F.C." data-content="El Registro Federal de Contribuyentes (RFC) es una clave alfanumérica que se compone de 13 caracteres." >
                            <div class="input-group-text"><img src="<?= base_URL()?>/assets/img/new-img/iconos/btn_info.svg" class="icos" ></div>
                          </div>
                        </div>

                      </div>
                      <div class="form-group col-12">
                        <label for="">SECTOR:</label>
                        <select  class="form-control" name="sector" onchange="home.Getsubsec(this.value,'#admyo #pills-home')" >
                           <option value="">SELECCIONE</option>
                          <?php
                    foreach ($sector->result() as $sectorh) {?>
                      <option value="<?= $sectorh->IDNivel1 ?>"><?= $sectorh->Giro ?></option>
                  <?php }     ?>
                        </select>
                      </div>
                      <div class="form-group col-12">
                        <label for="">SUB-SECTOR:</label>
                        <select  class="form-control" name="subsector" onchange="home.GetRama(this.value,'#admyo #pills-home')"  ></select>
                      </div>
                      <div class="form-group col-12">
                        <label for="">RAMA:</label>
                        <select  class="form-control" name="rama"  ></select>
                      </div>
                      
                      <div class="col-12 m-t-20 col-ama">
                        DATOS PERSONALES
                      </div>
                     <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">NOMBRE:</label>
                        <input type="text" class="form-control" name="nombre"  >
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">APELLIDOS:</label>
                        <input type="text" class="form-control" name="apellidos"  >
                      </div>
                      <div class="form-group col-12">
                        <label for="">CORREO ELECTRÓNICO:</label>
                        <input type="email" class="form-control" name="email"  >
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">CONTRASEÑA:</label>
                        <input type="password" class="form-control" name="p1"  >
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">CONFIRMAR CONTRASEÑA:</label>
                        <input type="password" class="form-control" name="p2"  >
                      </div>
                      <div class="form-group form-check col-12 ">
                        <input type="checkbox" name="termininos" class="form-check-input" id="c3">
                        <label class="form-check-label " for="c3"><small>Deseo recibir infomación de ADMYO en mi correo electrónico y acepto los <a class="col-ama" href="<?= base_URL()?>terminosycondiciones">TERMINOS Y CONDICIONES</a>, asi como el <a href="<?= base_URL()?>terminosycondiciones" class="col-ama">AVISO DE PRIVACIDAD</a></small></label>
                      </div>
                    </form>
                    <div class="row">
                      <btn onclick="home.AdmyoSendfrmPM()" class="col-12 btn btn-primary">
                        REGISTRARME
                      </btn>
                    </div>
                  </div>
                  <!--fin persona moral-->
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  <!--inicio persona fisica-->
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12 col-ama">
                        DATOS DE LA EMPRESA
                      </div>
                    </div>
                    <form class="row m-t-20" id="frmadmyoPF"> 
                      <div class="form-group col-12 d-none">
                        <label for="">IDIOMA:</label>
                        <select  class="form-control" name="idioma"  >
                          <?php

                             foreach ($Idiomas as $idioma) {
                                
                                  ?>
                                  <option  value="<?= $idioma->Codigo ?>"><?= $idioma->Nombre ?></option>
                                  
                                
                                  <?php
                                }
                              ?>
                        </select>
                      </div>
                         <div class="form-group col-6">
                        <label for="">PAIS:</label>
                        <select  class="form-control" name="pais"   onchange="help.getestado(this.value,'#admyo #pills-profile')" >
                          <?php

                             foreach ($Paises as $pais) {
                                if($pais->id=="42"){
                                  ?>
                                  <option selected value="<?= $pais->id ?>"><?= $pais->paisnombre ?></option>
                                  <?php
                                }else{
                                  ?>
                                  <option value="<?= $pais->id ?>"><?= $pais->paisnombre ?></option>
                                  <?php
                                }
                              ?>
                            
                          <?php }     
                        ?>
                        </select>
                      </div>
                      <div class="form-group col-6">
                        <label for="">Estado:</label>
                       <select  class="form-control" name="estado"  >
                           <option value="NA">SELECCIONE</option>
                          <?php

                             foreach ($Estados as $estado) {
                                   
                                ?>
                                                              
                                  <option value="<?= $estado->id ?>"><?= $estado->estadonombre ?></option>
                                  <?php
                                }
                              ?>
                            
                        

                        </select>
                      </div>
                    
                      <div class="form-group col-12">
                        <label for="">NOMBRE COMERCIAL:</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="comercial"  >
                          <div class="input-group-prepend" data-toggle="popover" title="Nombre Comercial" data-content="Un nombre comercial es un seudónimo usado por empresas para desempeñar su negocio bajo un nombre que difiere del nombre legal registrado del negocio.">
                            <div class="input-group-text"><img src="<?= base_URL()?>/assets/img/new-img/iconos/btn_info.svg" class="icos" ></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <label for="">R.F.C.(REGISTRO FEDERAL DE CONTRIBUYENTES):</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="rfc"  >
                          <div class="input-group-prepend" data-toggle="popover" title="R.F.C." data-content="El Registro Federal de Contribuyentes (RFC) es una clave alfanumérica que se compone de 13 caracteres.">
                            <div class="input-group-text"><img src="<?= base_URL()?>/assets/img/new-img/iconos/btn_info.svg" class="icos" ></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <label for="">SECTOR:</label>
                        <select  class="form-control" name="sector" onchange="home.Getsubsec(this.value,'#admyo #pills-profile')"  >
                            <option value="NA">SELECCIONE</option>
                           <?php
                            foreach ($sector->result() as $sectorh) {?>
                              <option value="<?= $sectorh->IDNivel1 ?>" ><?= $sectorh->Giro ?></option>
                            <?php 
                                }    
                             ?>
                        </select>
                      </div>
                      <div class="form-group col-12">
                        <label for="">SUB-SECTOR:</label>
                        <select  class="form-control" name="subsector" onchange="home.GetRama(this.value,'#admyo #pills-profile')" ></select>
                      </div>
                      <div class="form-group col-12">
                        <label for="">RAMA:</label>
                        <select  class="form-control" name="rama"   ></select>
                      </div>
                     
                      <div class="col-12 m-t-20 col-ama">
                        DATOS PERSONALES
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">NOMBRE:</label>
                        <input type="text" class="form-control" name="nombre"  >
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">APELLIDOS:</label>
                        <input type="text" class="form-control" name="apellidos"  >
                      </div>
                      <div class="form-group col-12">
                        <label for="">CORREO ELECTRÓNICO:</label>
                        <input type="email" class="form-control" name="email"  >
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">CONTRASEÑA:</label>
                        <input type="password" class="form-control" name="p1"  >
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">CONFIRMAR CONTRASEÑA:</label>
                        <input type="password" class="form-control" name="p2"  >
                      </div>
                      <div class="form-group form-check col-12 ">
                        <input type="checkbox" name="termininos" class="form-check-input" id="c4">
                        <label class="form-check-label " for="c4"><small>Deseo recibir infomación de ADMYO en mi correo electrónico y acepto los <a class="col-ama" href="">TERMINOS Y CONDICIONES</a>, asi como el <a href="" class="col-ama">AVISO DE PRIVACIDAD</a></small></label>
                      </div>
                    </form>
                    <div class="row">
                      <btn class="col-12 btn btn-primary" onclick="home.AdmyoSendfrmPF()">
                        REGISTRARME
                      </btn>
                    </div>
                  </div>
                  <!--fin persona fisica-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-lg-6 col-xl-6">
    <div class="col-12 titulo">
      <div class="row m-t-20 ">         
        <div class="col-12 d-flex">
          <label> <img src="<?= base_URL()?>/assets/img/new-img/iconos/flYL_izq.svg" class="img-fluid"></label>  <h4>¿QUÉ ES ADMYO?</h4>
        </div>
        <div class="col-12">
          <div class="cont-ques">
            <div class="cont-img">
              <img src="<?= base_URL()?>/assets/img/new-img/ADMYO/admyo-que-es.png" class="img-fluid">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6 col-lg-6 col-xl-6">
    <div class="col-12 titulo">
      <div class="row m-t-20 ">         
        <div class="col-12 d-flex">
          <label > <img src="<?= base_URL()?>/assets/img/new-img/iconos/flYL_der_doble.svg" class="dericos"></label>  <h4>Nuestros clientes hablan por nosotros</h4>
        </div>
        <div class="col-12">
          <div id="C3" class="row carousel slide" data-ride="carousel">
            <div class="col-2">
              <a class=" carousel-control-prev" href="#C3" role="button" data-slide="prev">
                <img class="icos" src="<?= base_URL()?>/assets/img/new-img/iconos/flAZ_izq.svg">
                <span class="sr-only">Previous</span>
              </a>
            </div>
            <div class="col-8">
              <div class="carousel-inner">
                <div class="carousel-item active text-center">
                  <img class="img-fluid" src="<?= base_URL()?>/assets/img/new-img/testimoniales/admyo-testimonial-texto.png" >
                </div>
                <div class="carousel-item  text-center">
                  <img class="img-fluid" src="<?= base_URL()?>/assets/img/new-img/testimoniales/admyo-testimonial-texto.png" >
                </div>
              </div>
            </div>
            <div class="col-2 text-left">
              <a class=" carousel-control-next" href="#C3" role="button" data-slide="next">
                <img class="icos dericos" src="<?= base_URL()?>/assets/img/new-img/iconos/flAZ_izq.svg">
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!--fin Admyo-->
<!--inicio qval-->
<div class="container-fluid d-none  palprinc" id="qval">
  <div class="row m-t-20">
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="row m-t-20">
        <div class="col-12">
          <img src="<?= base_URL()?>/assets/img/new-img/QVAL/pantalla_qval.png" class="img-fluid">
        </div>
        <div class="col-12 titulo">
          <div class="row m-t-20 ">         
            <div class="col-12 d-flex">
              <label> <img src="<?= base_URL()?>/assets/img/new-img/iconos/flYL_izq.svg" class="img-fluid"></label>  <h4>BENEFICIOS DE SUSCRIBIRTE EN QVAL</h4>
            </div>
          </div>
        </div>
        <div class="col-12 beneficios">
          <div class="row">
            <div class="col-12 d-flex align-items-center">
              <label>
                <img src="<?= base_URL()?>/assets/img/new-img/beneficiosQV_01.png" class="d-block w-100">
              </label>
              <span>
                ¡Podrás medir cualquier KPI en tiempo real desde cualquier lugar!
              </span>
            </div>
            <div class="col-12 d-flex align-items-center">
              <label>
                <img src="<?= base_URL()?>/assets/img/new-img/beneficiosQV_02.png" class="d-block w-100">
              </label>
              <span>
                ¡Incentiva el logor de objetivos integrando otros datos!
              </span>
            </div>
            <div class="col-12 d-flex align-items-center">
              <label>
                <img src="<?= base_URL()?>/assets/img/new-img/beneficiosQV_03.png" class="d-block w-100">
              </label>
              <span>
                GeQval enviará alertas a tus responsables de área si existen desviaciones o respuestas negativas.
              </span>
            </div>
            <div class="col-12 d-flex align-items-center">
              <label>
                <img src="<?= base_URL()?>/assets/img/new-img/beneficiosQV_04.png" class="d-block w-100">
              </label>
              <span>
                Qval se integra con el portal de reputación en indicadores de Admyo.
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
       <div class="row frm-susc">
        <div class="col-12 text-white text-center">
           <h3>REGISTRO</h3> 
        </div
        <div class="col-12">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show " id="rgq" role="tabpanel" aria-labelledby="rgq-tab">
             <div class="container-fluid">
               <div class="row">
                 <div class="col-12 m-t-20 text-center">
                  INICIO DE SESIÓN
                </div> 
              </div>
              <form class="row m-t-20"> 
                <div class="form-group col-12">
                  <label for="">DIRECCIÓN DE EMAIL:</label>
                    <input type="text" class="form-control" name="razon"  >
                </div>
                <div class="form-group col-12">
                  <label for="">CONTRASEÑA:</label>
                  <input type="text" class="form-control" name="razon"  >
                  <small class="col-ama">¿Olvidaste tu contraseña?</small>
                </div>
               <div class="form-group form-check col-12 text-center">
                  <input type="checkbox" class="form-check-input" id="RCA">
                  <label class="form-check-label" for="RCA">RECORDAR MIS DATOS EN ESTE EQUIPO</label>
                </div>
              </form>
              <div class="row">
                <div class="col-12 btn btn-primary">
                 ACCEDER
                </div>
              
              </div>
            </div> 

          </div>
          <div class="tab-pane fade show active m-t-20" id="lq" role="tabpanel" aria-labelledby="lq-tab">
            <div class="col-12">
              <h6>Completa este formulario y empieza a disfrutar los beneficios de contar con
              una buena reputación en Admyo.</h6>
            </div>
            <div class="col-12">
              SELECCIONE SU RÉGIMEN FISCAL
            </div>
            <div class="col-12 m-t-20">
              <small class="col-ama">*Persona Física con actividad empresarial.</small>
            </div>
            <div class="col-12 m-t-20">
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="qval-home-tab" data-toggle="pill" href="#qval-home" role="tab" aria-controls="qval-home" aria-selected="true">PERSONA MORAL</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="qval-profile-tab" data-toggle="pill" href="#qval-profile" role="tab" aria-controls="qval-profile" aria-selected="false">PERSONA FISICA*</a>
                </li>

              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="qval-home" role="tabpanel" aria-labelledby="qval-home-tab">
                  <!--inicio persona moral-->
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12 col-ama">
                        DATOS DE LA EMPRESA
                      </div>
                    </div>
                    <form class="row m-t-20" id="frmqvaloPM"> 
                      <div class="form-group col-12 d-none">
                        <label for="">IDIOMA:</label>
                        <select  class="form-control" name="idioma"  >
                          <?php

                             foreach ($Idiomas as $idioma) {
                                
                                  ?>
                                  <option  value="<?= $idioma->Codigo ?>"><?= $idioma->Nombre ?></option>
                                  
                                
                                  <?php
                                }
                              ?>
                        </select>
                      </div>
                        <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">PAIS:</label>
                        <select  class="form-control" name="pais" onchange="help.getestado(this.value,'#qval #qval-home')"  >
                          <?php

                             foreach ($Paises as $pais) {
                                if($pais->id=="42"){
                                  ?>
                                  <option selected value="<?= $pais->id ?>"><?= $pais->paisnombre ?></option>
                                  <?php
                                }else{
                                  ?>
                                  <option value="<?= $pais->id ?>"><?= $pais->paisnombre ?></option>
                                  <?php
                                }
                              ?>
                            
                          <?php }     
                        ?>
                        </select>
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">Estado:</label>
                        <select  class="form-control" name="estado"  >
                           <option value="NA">SELECCIONE</option>
                          <?php

                             foreach ($Estados as $estado) {
                                   
                                ?>
                                                              
                                  <option value="<?= $estado->id ?>"><?= $estado->estadonombre ?></option>
                                  <?php
                                }
                              ?>
                            
                        

                        </select>
                      </div>
                   
                      <div class="form-group col-12">
                        <label for="">RAZON SOCIAL:</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="razon"  >
                          <div class="input-group-prepend">
                            <div class="input-group-text" data-toggle="popover" title="Razón Social" data-content="La razón social es la denominación por la cual se conoce colectivamente a una empresa" ><img src="<?= base_URL()?>/assets/img/new-img/iconos/btn_info.svg" class="icos" ></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <label for="">NOMBRE COMERCIAL:</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="comercial"  >
                          <div class="input-group-prepend">
                            <div class="input-group-text" data-toggle="popover" title="Nombre Comercial" data-content="Un nombre comercial es un seudónimo usado por empresas para desempeñar su negocio bajo un nombre que difiere del nombre legal registrado del negocio."><img src="<?= base_URL()?>/assets/img/new-img/iconos/btn_info.svg" class="icos" ></div>
                          </div>
                        </div>

                      </div>
                      <div class="form-group col-12">
                        <label for="">R.F.C.(REGISTRO FEDERAL DE CONTRIBUYENTES):</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="rfc" >
                          <div class="input-group-prepend"  data-toggle="popover" title="R.F.C." data-content="El Registro Federal de Contribuyentes (RFC) es una clave alfanumérica que se compone de 13 caracteres." >
                            <div class="input-group-text"><img src="<?= base_URL()?>/assets/img/new-img/iconos/btn_info.svg" class="icos" ></div>
                          </div>
                        </div>

                      </div>
                      <div class="form-group col-12">
                        <label for="">SECTOR:</label>
                        <select  class="form-control" name="sector" onchange="home.Getsubsec(this.value,'#qval #qval-home')"  >
                            <option value="NA">SELECCIONE</option>
                           <?php
                            foreach ($sector->result() as $sectorh) {?>
                              <option value="<?= $sectorh->IDNivel1 ?>" ><?= $sectorh->Giro ?></option>
                            <?php 
                                }    
                             ?>
                        </select>
                      </div>
                      <div class="form-group col-12">
                        <label for="">SUB-SECTOR:</label>
                        <select  class="form-control" name="subsector" onchange="home.GetRama(this.value,'#qval #qval-home')" ></select>
                      </div>
                      <div class="form-group col-12">
                        <label for="">RAMA:</label>
                        <select  class="form-control" name="rama"  ></select>
                      </div>
                    
                      <div class="col-12 m-t-20 col-ama">
                        DATOS PERSONALES
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">NOMBRE:</label>
                        <input type="text" class="form-control" name="nombre"  >
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">APELLIDOS:</label>
                        <input type="text" class="form-control" name="apellidos"  >
                      </div>
                      <div class="form-group col-12">
                        <label for="">CORREO ELECTRÓNICO:</label>
                        <input type="email" class="form-control" name="email"  >
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">CONTRASEÑA:</label>
                        <input type="password" class="form-control" name="p1"  >
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">CONFIRMAR CONTRASEÑA:</label>
                        <input type="password" class="form-control" name="p2"  >
                      </div>
                      <div class="form-group form-check col-12 ">
                        <input type="checkbox" name="termininos" class="form-check-input" id="c3">
                        <label class="form-check-label " for="c3"><small>Deseo recibir infomación de ADMYO en mi correo electrónico y acepto los <a class="col-ama" href="">TERMINOS Y CONDICIONES</a>, asi como el <a href="" class="col-ama">AVISO DE PRIVACIDAD</a></small></label>
                      </div>
                    </form>
                    <div class="row">
                      <btn class="col-12 btn btn-primary" onclick="home.QvalSendfrmPM()">
                        REGISTRARME
                      </btn>
                    </div>
                  </div>
                  <!--fin persona moral-->
                </div>
                <div class="tab-pane fade" id="qval-profile" role="tabpanel" aria-labelledby="qval-profile-tab">
                  <!--inicio persona fisica-->
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12 col-ama">
                        DATOS DE LA EMPRESA
                      </div>
                    </div>
                    <form class="row m-t-20" id="frmqvaloPF"> 
                      <div class="form-group col-12 d-none">
                        <label for="">IDIOMA:</label>
                        <select  class="form-control" name="idioma"  >
                          <?php

                             foreach ($Idiomas as $idioma) {
                                
                                  ?>
                                  <option  value="<?= $idioma->Codigo ?>"><?= $idioma->Nombre ?></option>
                                  
                                
                                  <?php
                                }
                              ?>
                        </select>
                      </div>
                        <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">PAIS:</label>
                        <select  class="form-control" name="pais" onchange="help.getestado(this.value,'#qval #qval-profile')"  >
                          <?php

                             foreach ($Paises as $pais) {
                                if($pais->id=="42"){
                                  ?>
                                  <option selected value="<?= $pais->id ?>"><?= $pais->paisnombre ?></option>
                                  <?php
                                }else{
                                  ?>
                                  <option value="<?= $pais->id ?>"><?= $pais->paisnombre ?></option>
                                  <?php
                                }
                              ?>
                            
                          <?php }     
                        ?>
                        </select>
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">Estado:</label>
                        <select  class="form-control" name="estado"  >
                           <option value="NA">SELECCIONE</option>
                          <?php

                             foreach ($Estados as $estado) {
                                   
                                ?>
                                                              
                                  <option value="<?= $estado->id ?>"><?= $estado->estadonombre ?></option>
                                  <?php
                                }
                              ?>
                            
                        

                        </select>
                      </div>
                   
                      <div class="form-group col-12">
                        <label for="">NOMBRE COMERCIAL:</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="comercial"  >
                          <div class="input-group-prepend" data-toggle="popover" title="Nombre Comercial" data-content="Un nombre comercial es un seudónimo usado por empresas para desempeñar su negocio bajo un nombre que difiere del nombre legal registrado del negocio.">
                            <div class="input-group-text"><img src="<?= base_URL()?>/assets/img/new-img/iconos/btn_info.svg" class="icos" ></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <label for="">R.F.C.(REGISTRO FEDERAL DE CONTRIBUYENTES):</label>
                        <div class="input-group">
                          <input type="text" class="form-control" name="rfc"  >
                          <div class="input-group-prepend" data-toggle="popover" title="R.F.C." data-content="El Registro Federal de Contribuyentes (RFC) es una clave alfanumérica que se compone de 13 caracteres.">
                            <div class="input-group-text"><img src="<?= base_URL()?>/assets/img/new-img/iconos/btn_info.svg" class="icos" ></div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <label for="">SECTOR:</label>
                        <select  class="form-control" name="sector" onchange="home.Getsubsec(this.value,'#qval #qval-profile')"  >
                          <option value="NA">SELECCIONE</option>
                           <?php
                            foreach ($sector->result() as $sectorh) {?>
                              <option value="<?= $sectorh->IDNivel1 ?>" ><?= $sectorh->Giro ?></option>
                            <?php 
                                }    
                             ?>
                        </select>
                      </div>
                      <div class="form-group col-12">
                        <label for="">SUB-SECTOR:</label>
                        <select  class="form-control" name="subsector" onchange="home.GetRama(this.value,'#qval #qval-profile')" ></select>
                      </div>
                      <div class="form-group col-12">
                        <label for="">RAMA:</label>
                        <select  class="form-control" name="rama"  ></select>
                      </div>
                     
                      <div class="col-12 m-t-20 col-ama">
                        DATOS PERSONALES
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">NOMBRE:</label>
                        <input type="text" class="form-control" name="nombre"  >
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">APELLIDOS:</label>
                        <input type="text" class="form-control" name="apellidos"  >
                      </div>
                      <div class="form-group col-12">
                        <label for="">CORREO ELECTRÓNICO:</label>
                        <input type="email" class="form-control" name="email"  >
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-6">
                        <label for="">CONTRASEÑA:</label>
                        <input type="password" class="form-control" name="p1"  >
                      </div>
                      <div class="form-group col-12  col-md-6 col-xl-6 col-lg-66">
                        <label for="">CONFIRMAR CONTRASEÑA:</label>
                        <input type="password" class="form-control" name="p2"  >
                      </div>
                      <div class="form-group form-check col-12 ">
                        <input type="checkbox" name="termininos" class="form-check-input" id="c4">
                        <label class="form-check-label " for="c4"><small>Deseo recibir infomación de ADMYO en mi correo electrónico y acepto los <a class="col-ama" href="">TERMINOS Y CONDICIONES</a>, asi como el <a href="" class="col-ama">AVISO DE PRIVACIDAD</a></small></label>
                      </div>
                    </form>
                    <div class="row">
                      <btn class="col-12 btn btn-primary" onclick="home.QvalSendfrmPF()">
                        REGISTRARME
                      </btn>
                    </div>
                  </div>
                  <!--fin persona fisica-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="col-12 titulo">
        <div class="row m-t-20 ">         
          <div class="col-12 d-flex">
            <label> <img src="<?= base_URL()?>/assets/img/new-img/iconos/flYL_izq.svg" class="img-fluid"></label>  <h4>¿QUÉ ES QVAL?</h4>
          </div>
          <div class="col-12">
            <div class="cont-ques">

              <div class="cont-img">
                <img src="<?= base_URL()?>/assets/img/new-img/QVAL/qval-que-es.png" class="img-fluid">
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="col-12 titulo">
        <div class="row m-t-20 ">         
          <div class="col-12 d-flex">
            <label > <img src="<?= base_URL()?>/assets/img/new-img/iconos/flYL_der_doble.svg" class="dericos"></label>  <h4>Nuestros clientes hablan por nosotros</h4>
          </div>
          <div class="col-12">
            <div id="C3" class="row carousel slide" data-ride="carousel">
              <div class="col-2">
                <a class=" carousel-control-prev" href="#C3" role="button" data-slide="prev">
                  <img class="icos" src="<?= base_URL()?>/assets/img/new-img/iconos/flAZ_izq.svg">
                  <span class="sr-only">Previous</span>
                </a>
              </div>
              <div class="col-8">
                <div class="carousel-inner">
                  <div class="carousel-item active text-center">
                    <img class="img-fluid" src="<?= base_URL()?>/assets/img/new-img/testimoniales/admyo-testimonial-texto.png" >
                  </div>
                  <div class="carousel-item  text-center">
                    <img class="img-fluid" src="<?= base_URL()?>/assets/img/new-img/testimoniales/admyo-testimonial-texto.png" >
                  </div>

                </div>
              </div>
              <div class="col-2 text-left">
                <a class=" carousel-control-next" href="#C3" role="button" data-slide="next">
                  <img class="icos dericos" src="<?= base_URL()?>/assets/img/new-img/iconos/flAZ_izq.svg">
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
                        <!--fin qval-->
<div id="msjerror" class="izimodal" data-icon="fa fa-exclamation-triangle" data-header-color='rgb(189, 91, 91)' data-title="Mensaje de Admyo" data-width="600" data-timeclose='6000' data-bar="rgb(255,255,255)">
  <div class="container-fluid bgrojo">
    <div class="row">
      <div class="col-12 text p-l-40 text-white">
        
      </div>
    </div>
  </div>
</div>
<div id="mfrm-login" class="izimodal" data-header-color='rgb(247,172,67)' data-title="Inciar Sesión en Admyo" data-width="500">
  <div class="container p-b-20">
    <form id="frm-login" class="row d-flex justify-content-center">
      <div class="col-5 text-center m-t-20 centrar">
        <div class="cir">
            <img src="<?= base_url()?>assets/img/iconos/user-solid.svg" class="img-fluid" alt="">
        </div>
      </div>
      <div class="col-12 m-t-20 d-none lin-alert">
        <div class="alert alert-danger bgrojo text-white" role="alert">
           A simple danger alert—check it out!
        </div>
      </div>
      <div class="col-10 m-t-20">
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text bgorange"><img src="<?= base_url()?>assets/img/iconos/envelope-open-regular.svg" class="icos" alt=""></div>
          </div>
          <input type="mail" name="correo" required class="form-control bg-light" id="inlineFormInputGroup" placeholder="Correo Eletrónico">
        </div>
      </div>
      <div class="col-10 m-t-20">
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text bgorange"><img src="<?= base_url()?>assets/img/iconos/unlock-alt-solid.svg" class="icos" alt=""></div>
          </div>
          <input type="password" name="clave" required class="form-control bg-light" id="inlineFormInputGroup" placeholder="Contraseña">
        </div>
      </div>
       <div class="col-5 m-t-20">
        <div class="form-group form-check">
          <input type="checkbox" llc="cherecurda" class="form-check-input">
          <label class="form-check-label text-muted" for="exampleCheck1" >Recuérdame</label>
        </div>
      </div>
       <div class="col-6 m-t-20 text-right">
        <span class="text-muted" onclick="home.openmfrmpass()">¿Has olvidado tu contraseña?</span>
      </div>
      <div onclick="home.login()" class="col-6 btn btn-primary bgblue text-uppercase">
        Ingresar
      </div>
      <div class="col-12 m-t-30 text-muted text-center" >
        ¿No tienes una cuenta?<strong>Registrarse </strong> 
      </div>
    </form>
  </div>
</div>
<div id="mfrm-recpas" class="izimodal" data-header-color='rgb(247,172,67)' data-title="Recuperar contraseña de Admyo" data-width="500">
  <div class="container p-b-20">
    <div class="row d-flex justify-content-center">
      <div class="col-5 text-center m-t-20 centrar">
        <div class="cir">
            <img src="<?= base_url()?>assets/img/iconos/unlock-alt-solid.svg" class="img-fluid" alt="">
        </div>
      </div>
      <div class="col-12 m-t-20 d-none">
        <div class="alert alert-danger bgrojo text-white" role="alert">
           A simple danger alert—check it out!
        </div>
      </div>
      <div class="col-10 m-t-20">
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text bgorange"><img src="<?= base_url()?>assets/img/iconos/envelope-open-regular.svg" class="icos" alt=""></div>
          </div>
          <input type="text" class="form-control bg-light" id="inlineFormInputGroup" placeholder="Correo Eletrónico">
        </div>
      </div>
      
       <div class="col-12 m-t-20 text-left">
        <span class="text-muted">Ingresa tu correo electrónico aquí y te enviaremos instrucciones sobre cómo restablecerla.</span>
      </div>
      <div class="col-5 btn btn-primary bgblue text-uppercase m-t-20">
        Enviar instrucciones
      </div>
      <div class="col-1"></div>
      <div class="col-5 btn btn-primary bgblue text-uppercase m-t-20">
        Cancelar
      </div>
    </div>
  </div>
</div>