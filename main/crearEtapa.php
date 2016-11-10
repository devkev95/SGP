<?php
    require'../services/conn.php';
require '../model/Usuario.php';

session_start();

if (!isset($_SESSION["userData"])){
    session_destroy();
    header("Location: home.php");
    exit();
}
$userData = $_SESSION["userData"];
session_write_close();

error_reporting(0);

     $proyecto = $_GET['id'];
    echo $proyecto;

          require("connect_db.php");

        $query12= mysql_query("SELECT porcentajeCI FROM proyecto WHERE idProyecto=".$proyecto);

        $resultado2 = mysql_fetch_array($query12);
        $porcentajeCI= $resultado2['porcentajeCI'];

        echo $porcentajeCI;

    $nombre = $_POST["nombre"];
    $detalle = $_POST["detalle"];
    $fechaInicioProgramada = $_POST["fechaInicioProgramada"];
    $fechaFinProgramada = $_POST["fechaFinProgramada"];
    $estado = $_POST["estado"];
   
    $conn = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();

   
      $total_etapa = 0;

      if(isset($_POST["subTotal_etapa"])){
        $total_etapa = array_sum($_POST["subTotal_etapa"]);
      }

      if($fechaFinProgramada > $fechaInicioProgramada){
      $query = "INSERT INTO etapa(nombre, detalle, idProyecto, fechaInicioProgramada, fechaFinProgramada, estado, totalEtapa) VALUES ('".$nombre."', '".$detalle."', '".$proyecto."', '".$fechaInicioProgramada."', '".$fechaFinProgramada."', '".$estado."', ".$total_etapa.")";
     // $conn->query($query);
      if($conn->query($query)){
        $id = $conn->insert_id;
        echo $id;



        $n = count($_POST["subTotal_etapa"]);
        echo $n;
        for ($i = 0; $i < $n; $i++){
          $query1 = "INSERT INTO etapapartida(idEtapa, idPartida, versionPartida, cantidad, CD, CI, IVA, PU, subTotal, fechaInicioProgramada, fechaFinProgramada) VALUES('".$id."', ".$_POST["numero"][$i].", ".$_POST["version"][$i].", ".$_POST["cantidad"][$i].", ".$_POST["CDD"][$i].", ".$_POST["CII"][$i].", '".$_POST["IVAA"][$i]."', ".$_POST["PUU"][$i].", ".$_POST["subTotal_etapa"][$i].", ".$_POST["fechaInicioProgramada1"][$i].", ".$_POST["fechaFinProgramada1"][$i].")";
          
          $conn->query($query1);

        }

        header("Location: crearEtapa.php?id=".$proyecto);

        
      }else{
       
      }   

      }elseif ($fechaFinProgramada < $fechaInicioProgramada){
       $str = "error2";
        
  
     // header("Location: crearEtapa.php?".$str);

     header("Location: crearEtapa.php?id=".$proyecto."&".$str);
     }   


    
  

?>



  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crear Etapa</title>

    <!-- Default Styles (DO NOT TOUCH) -->
    <link rel="stylesheet" href="../lib/CSS/font-awesome.min.css">
    <link rel="stylesheet" href="../lib/CSS/emergente.css">
    <link rel="stylesheet" href="../lib/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/CSS/fonts.css">
    <link type="text/css" rel="stylesheet" href="../lib/CSS/soft-admin.css" />
    <!-- link calendar resources -->
  <link rel="stylesheet" type="text/css" href="../lib/CSS/tcal.css" >
  <script type="text/javascript" src="../lib/JS/tcal.js"></script> 

    <!-- Adjustable Styles -->
    <link type="text/css" rel="stylesheet" href="../lib/CSS/DT_bootstrap.css" />
     <link type="text/css" rel="stylesheet" href="lib/css/DT_bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="../lib/CSS/icheck.css?v=1.0.1">
   


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="lib/js/html5shiv.js"></script>
<script src="lib/js/respond.min.js"></script>
<![endif]-->

  </head>

  <body>

    <div class="cntnr">

      <!-- RESPONSIVE LEFT SIDEBAR & LOGO -->
      <div class="left hidden-xs">
        <div class="logo"> <img id="logo" src="../Imagenes/logo.png" style="width:159px !important; height:52px; !important"> </div>
        <div class="sidebar">
          <div class="accordion">
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="sbtn btn-default" href="home.php">
                  <span class="fa fa-home"></span> &nbsp;&nbsp;Home
                </a>
              </div>
            </div>
            <?php if ($userData->getPerfil() == "Administrador"){ ?>
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="sbtn btn-default" href="admin/users.php">
                    <span class="fa fa-users"></span> &nbsp;&nbsp;Usuarios
                  </a>
                </div>
              </div>
              <?php } ?>

                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="sbtn btn-default" data-toggle="collapse" href="#c-tables">
                      <span class="fa fa-table"></span> &nbsp;&nbsp;Partidas
                      <span class="caret"></span>
                    </a>
                  </div>
                  <div id="c-tables" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <a href="consultarPartidas.php" class="sbtn sbtn-default">Ver Partidas</a>
                      <a href="crear_partida.php" class="sbtn sbtn-default">Crear Partida</a>
                    </div>
                  </div>
                </div>

                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="sbtn sbtn-default" data-toggle="collapse" href="#c-forms">
                      <span class="fa fa-pencil-square-o"></span> &nbsp;&nbsp;Recursos
                      <span class="caret"></span>
                    </a>
                  </div>
                  <div id="c-forms" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <a href="tabla_recursos.php" class="sbtn sbtn-default">Ver Recursos</a>
                      <a href="ingresar.php" class="sbtn sbtn-default">Agregar Nuevo Recurso</a>
                    </div>
                  </div>
                </div>

                 <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="sbtn btn-default active" href="proyectos.php">
                    <span class="fa fa-list-alt"></span>
                      &nbsp;&nbsp;Proyectos
                    </a>
                  </div>
                </div>

                 

          </div>
        </div>
      </div>
      <!-- END LEFT SIDEBAR & LOGO -->


      <!-- RESPONSIVE NAVIGATION -->
      <div id="secondary" class="btn-group visible-xs">
        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><span class="icon icon-th-large"></span>&nbsp;&nbsp;Menu&nbsp;&nbsp;<span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-info pull-right" role="menu">
          <li><a href="../home.php">Home</a></li>
          <li class="dropdown-header">Recursos</li>
          <li><a href="tabla_recursos.php">Ver Recursos</a></li>
          <li><a href="ingresar.php">Agregar Recurso</a></li>
          <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
          <li class="dropdown-header">Partidas</li>
          <li><a href="consultarPartidas.php">Ver Partidas</a></li>
          <li><a href="crear_partida.php">Crear Partida</a></li>
          <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
        </ul>
      </div>

      <div id="secondary-search" class="input-icon visible-xs">
        <i class="icon icon-search"></i>
        <input class="form-control form-info input-sm" type="text">
      </div>
      <!-- END RESPONSIVE NAVIGATION -->

      <!-- RIGHT NAV, CRUMBS, & CONTENT -->
      <div class="right">

        <div class="nav">
          <div class="bar">

            <div class="logo-small visible-xs"><img style="width:120px; !important; height:32px; !important" src="../Imagenes/logo.png"></div>

            <div class="hov">
              <div class="btn-group">
                <a class="con" href="" data-toggle="dropdown"><span class="icon icon-user"></span></a>
                <ul class="dropdown-menu pull-right dropdown-profile" role="menu">
                  <li class="title"><span class="icon icon-user"></span>&nbsp;&nbsp;Bienvenido,
                    <?= $userData->getNombres()?>
                  </li>
                  <li><a href="changePassword.php">Cambiar contraseña</a></li>
                  <li><a href="../services/user/logout.php"><span class="fa fa-power-off"></span>Desconectar</a></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- BREADCRUMBS -->
          <div class="crumbs">
            <ol class="breadcrumb hidden-xs">
              <li><i class="fa fa-home"></i> <a href="home.php">Home</a></li>
              <li class="active">Crear Etapa</li>
            </ol>
          </div>
        </div>

        <!-- BEGIN PAGE CONTENT -->
        <div class="content">
          <div class="page-h1">
            <h1>Nueva Etapa <small>// Ingrese datos de la Etapa</small></h1>
          </div>
          <div class="col-md-12">
            <div class="alert alert-warning" style="margin-bottom:0px;margin-top:10px;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <span class="icon icon-exclamation-sign"></span> <strong>Verifique antes de guardar!</strong>
            </div>
          </div>




          <div class="tb1">

         <form method="POST" action="">
            <div class="col-md-12">
              <div class="wdgt wdgt-primary" hide-btn="true">
                <div class="wdgt-header">Etapas Proyecto</div>

              <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">


                  <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered" id="etaps">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>C.D.</th>
                        <th>C.I.</th>
                        <th>IVA 13%</th>
                        <th>Sub-Total</th>
                        
                         
                      </tr>
                    </thead>
                    <tbody>
 <?php
    //include 'connect_db.php';
    require("connect_db.php");
     $sql1 = mysql_query("CALL sp_select_etapas('1','".$proyecto."')");
    while ($row = mysql_fetch_array($sql1)) {
        echo '<tr>';
        echo '<td>'. $row['nombre'] .'</td>';
        echo '<td>'. $row['CD'] .'</td>';
        echo '<td>'. $row['CI'] . '</td>';
        echo '<td>'. $row['IVA'] .'</td>';
        echo '<td>'. $row['totalEtapa'] .'</td>';
        
        echo '</tr>';


    
    }


    
    ?>



                    </tbody>
                  </table>
                  <div>
                    <strong>Sub-total:<span id="sub-total-etaa"><?php echo $total_proyecto1; ?></span></strong>
                  </div>
                  <br>
                </div>
              </div>

            </div>

   
                </form>


              <div class="col-md-12">

              <div class="wdgt">
           <button id="principal1" class="btn btn-success btn-lg"   onclick="window.location.href='proyectos.php'" >Terminar</button>

                             
                      </div>
            </div>
            
<!--*************************************** FORM de la parte CREAR ETAPA  *************************************** -->


          <form method="POST" action="">
            <div class="col-md-12">
              <div class="wdgt wdgt-primary" hide-btn="true">
                <div class="wdgt-header">Etapas</div>
                <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">

                          <?php
          if (isset($_GET["error1"])) {
            
         ?>

          <div class="alertDiv alert alert-danger alert-round alert-border alert-soft">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <span class="icon icon-remove-sign"></span> 
             Se ha producido un error en la conexión a la base de datos, por favor intente realizar esta operación. 
              
                
          </div>
           <?php
           header("Location: crearEtapa.php");
          } else if (isset($_GET["error2"])){
        ?>
           <div class="alertDiv alert alert-danger alert-round alert-border alert-soft">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <span class="icon icon-remove-sign"></span> 
             La fecha de finalizacion debe ser mayor a la fecha de inicio.
            </div>
        <?php
           header("Location: crearEtapa.php?id=".$proyecto);
          } 
         
        ?>

              <div class="form-group">
              <label>Nombre de Etapa</label>
               <input type="text" class="form-control" required id="inputFName" placeholder="nombre" name="nombre"  >
              <span class="help-block"></span>
               </div>

               <div class="form-group">
              <label>Detalle de Etapa</label>
               <input type="text" class="form-control" required id="inputFName" placeholder="detalle" name="detalle"  >
              <span class="help-block"></span>
               </div>

              <div class="form-group">
              <label>Fecha Inicio Programada</label>
              <br>
               <input type="date" class="tcal" required id="inputFName" placeholder="FechaInicioProgramada" name="fechaInicioProgramada"  >
              <span class="help-block"></span>
               </div>

              <div class="form-group">
              <label>Fecha Fin programada</label>
              <br>
               <input type="date" class="tcal" required id="inputFName" placeholder="FechaFinProgramada" name="fechaFinProgramada"  >
              <span class="help-block"></span>
               </div>   

          
             <div class="form-group">
               <label for="disabledSelect">Seleccionar el estado</label>
               <select id="disabledSelect" class="form-control form-primary" name="estado" required="required" id="inputFName">
                  <option value="Espera" <?php echo $estado == 'Espera'?'selected':'';?>>Espera</option>
                  <option value="Iniciado" <?php echo $estado == 'Iniciado'?'selected':'';?>>Iniciado</option>
                  <option value="Terminado" <?php echo $estado == 'Terminado'?'selected':'';?>>Terminado</option>

               </select>
                <span class="help-block"></span>
             </div>
             <br>
             <br>
             <br>
             <br>
             </div>

              <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">


                  <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped" id="partidas">
                    <thead>
                      <tr>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Material</th>
                        <th>M.O</th>
                        <th>Otros</th>
                        <th>C.D.</th>
                        <th>C.I.</th>
                        <th>IVA 13%</th>
                        <th>P.U.</th>
                        <th>Fecha Inicio Programada</th>
                        <th>Fecha Fin Programada</th>
                        <th>Sub-Total</th>
                        <th></th>
                         
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <div>
                    <button type="button" id="new-row-recursos" class="btn btn-info btn-sm"><i class="icon icon-plus"></i></button>
                    <strong>Sub-total:<span id="sub-total-etapa">0.00</span></strong>
                  </div>
                  <br>
                </div>
              </div>

            </div>

              


            

              <div class="col-md-12">
              <div class="wdgt">
                  <button id="principal" class="btn btn-success btn-lg" type="submit" name="guardar" value="Guardar" disabled>Agregar Etapa</button>
              </div>
            </div>
                </form>

                <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog" style="width:75%">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Partidas</h3>
                  </div>
                  <div class="modal-body">

                    <!-- content goes here -->

                    <div class="content">

                      <div class="tbl">
                        <div class="col-md-12">
                          <div class="wdgt" hide-btn="true">
                            <div class="wdgt-header">Tabla de partidas</div>
                            <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
                              <table id="recursos-seleccion" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">


                                <!--ENCABEZADO DE LA TABLA PARTIDAS -->

                                <thead>
                                  <tr>
                                    <th>Numero</th>
                                    <th>Version</th>
                                    <th>Nombre</th>
                                    <th>Total Materiales</th>
                                    <th>Total Mano de Obra</th>
                                    <th>Total Equipo y Herramientas</th>
                                    <th>Total Sub Contratos</th>
                                    <th></th>
                                  </tr>
                                </thead>


                                <!--CUERPO DE LA TABLA PARTIDAS -->


                                <tbody>


                                  <?php
#include 'connect_db.php';
//require("connect_db.php");
$sql = $conn->query(" SELECT numero, version, nombre, totalMateriales, ROUND (totalManoObra,2) AS totalManoObra, ROUND (totalEquipoHerramientas,2) AS totalEquipoHerramientas, ROUND (totalSubContratos,2) AS totalSubContratos  FROM partida;");
while ($row = $sql->fetch_array()) {
    echo '<tr>';
    echo '<td>'. $row['numero'] . '</td>';
    echo '<td>'. $row['version'] . '</td>';
    echo '<td>'. $row['nombre'] .'</td>';
    echo '<td>'. $row['totalMateriales'] .'</td>';
    echo '<td>'. $row['totalManoObra'] . '</td>';
    echo '<td>'. $row['totalEquipoHerramientas'] .'</td>';
    echo '<td>'. $row['totalSubContratos'] .'</td>';
    $numero = $row['numero'];
    $version = $row['version'];
    $nombre=$row['nombre'];
    $totalMateriales=$row['totalMateriales'];
    $totalManoObra = $row['totalManoObra'];
    $totalEquipoHerramientas = $row['totalEquipoHerramientas'];
    $totalSubContratos =  $row['totalSubContratos'];
    
    
    
    echo '<td><button onclick="cantidad(\''.$numero.'\',\''.$version.'\',\''.$nombre.'\', \''.$totalMateriales.'\', \''.$totalManoObra.'\', \''.$totalEquipoHerramientas.'\', \''.$totalSubContratos.'\')">Agregar</button></td>';
    
    
    
    
    
    
    echo '</tr>';
}

?>                            </tbody>
                              </table>



                            </div>
                          </div>

                        </div>
                      </div>

                    </div>
                    </div>
                </div>
              </div>
            </div>


<!---->

 <div class="modal fade" id="modalIngresarEtapaPartida" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header modal-primary">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Fechas</h4>
                    </div>
                    <div class="modal-body">

                      <!-- content goes here -->
                      <form class="form-horizontal">

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Cantidad</label>
                          <div class="col-lg-7">
                            <input type="number" class="form-control" name="cantidad" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Fecha Inicio</label>
                          <div class="col-lg-7">
                            <input type="date" class="form-control" name="fechaInicioProgramada"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Fecha Fin</label>
                          <div class="col-lg-7">
                            <input type="date" class="form-control" name="fechaFinProgramada"/>
                          </div>
                        </div>

                        

                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-success" name="agregar" value="Agregar">Ingresar</button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="reset" class="btn btn-info">Limpiar</button>
                          </div>
                        </div>

                      </form>

                    </div>
                    
                  </div>
                </div>
              </div>






       

          </div>
                      

        </div>

        <!-- END PAGE CONTENT -->

      </div>
      <!-- END NAV, CRUMBS, & CONTENT -->

    </div>

    <!-- Default JS (DO NOT TOUCH) -->
    <script src="../lib/JS/jquery-3.1.0.min.js"></script>
    <script src="../lib/JS/bootstrap.min.js"></script>
    <script src="../lib/JS/hogan.min.js"></script>
    <script src="../lib/JS/typeahead.min.js"></script>
    <script src="../lib/JS/typeahead-example.js"></script>

    <!-- Adjustable JS -->
    <script src="../lib/JS/jquery.dataTables.js"></script>
    <script src="../lib/JS/DT_bootstrap.js"></script>
    <script src="../lib/JS/soft-widgets.js"></script>
    <script src="../lib/js/bootstrapValidator.js"></script>
    <script>
      $(document).ready(function() {
       window.cantidad= function (numero, version, nombre, totalMateriales, totalManoObra, totalEquipoHerramientas, totalSubContratos) {
        totalMateriales= +totalMateriales;
        totalManoObra = +totalManoObra;
        totalEquipoHerramientas = +totalEquipoHerramientas;
        totalSubContratos = +totalSubContratos;
        $('#squarespaceModal').modal('hide');
        var totalOtros = (totalEquipoHerramientas + totalSubContratos);
          var CD = (totalMateriales + totalManoObra + totalEquipoHerramientas + totalSubContratos);
          var CI = CD * <?php echo $porcentajeCI; ?>;
          var IVA1 = (CD + CI) * 0.13;
          var precioUnitario = (CD + CI + IVA1);

          $("#partidas tr:last td").each(function(index){
            if (index == 0){
              $("input[type='hidden']", this).val(numero);
              $("span", this).text(nombre);
            }else if(index == 1){
              $("input[type='hidden']", this).val(version);
            } 
            else if(index == 3){
              $("span", this).text(totalMateriales.toFixed(2));
            }
            else if(index == 4){
              $("span", this).text(totalManoObra.toFixed(2));
            }
            else if(index == 5){
             $("input[type='hidden']", this).val(totalOtros.toFixed(2));
              $("span", this).text(totalOtros.toFixed(2));
            }
            else if(index == 6){
             $("input[type='hidden']", this).val(CD.toFixed(4));
              $("span", this).text(CD.toFixed(4));
            }
            else if(index == 7){
             $("input[type='hidden']", this).val(CI.toFixed(4));
              $("span", this).text(CI.toFixed(4));
            }
            else if(index == 8){
             $("input[type='hidden']", this).val(IVA1.toFixed(4));
              $("span", this).text(IVA1.toFixed(4));
            }
            else if(index == 9){
             $("input[type='hidden']", this).val(precioUnitario.toFixed(4));
              $("span", this).text(precioUnitario.toFixed(4));
            }
            /* else if(index == 10){
              $("input[type='hidden']", this).val(subtotal.toFixed(4));
              $("span", this).text(subtotal.toFixed(4));
            }*/
          });
        $('#modalIngresarEtapaPartida').modal("show");
          
          
          /*  */
         
        
       }


        $('#squarespaceModal').modal({ show: false});
        $("#modal2").modal({show: false});
        $("#modal3").modal({show: false});
        $("#modal4").modal({show: false});
        $("#modalIngresarEtapaPartida").modal({show: false});
        $('.datatable').dataTable({
          "sPaginationType": "bs_full"
        });
        $('.datatable').each(function() {
          var datatable = $(this);
          // SEARCH - Add the placeholder for Search and Turn this into in-line form control
          var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
          search_input.attr('placeholder', 'Search');
          search_input.addClass('form-control input-sm');
          // LENGTH - Inline-Form control
          var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
          length_sel.addClass('form-control input-sm');
        });

        $("#new-row-recursos").click(function() {
          $('#squarespaceModal').modal('show');
          var table = $(this).parents(".wdgt-body").children("table");
          var count = table.children("tbody").children("tr").length;

          html = "<tr><td><span></span><input type='hidden' name='numero[]'/></td><td><span></span><input type='hidden' name='version[]'/></td><td><span></span><input type='hidden' name='cantidad[]'/></td><td><span></span></td><td><span></span></td><td><span></span></td><td><span></span><input type='hidden' name='CDD[]'/></td><td><span></span><input type='hidden' name='CII[]'/></td><td><span></span><input type='hidden' name='IVAA[]'/></td><td><span></span><input type='hidden' name='PUU[]'/></td><td><span></span><input type='hidden' name='fechaInicioProgramada1[]'/></td><td><span></span><input type='hidden' name='fechaFinProgramada1[]'/></td><td><span class='subtotal'></span><input type='hidden' name='subTotal_etapa[]'/></td><td><button class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button></td></tr>";
          table.append(html);
           $("#principal").prop("disabled", false);
        });

         $(document).on("click", ".eliminar", function(){
          var total = +$(this).closest("div").find("div span").text();
          var subtotal = +$(this).closest("tr").find("td span.subtotal").text();
          total = total - subtotal;
          $(this).closest("div").find("div span").text(total.toFixed(2));
          $(this).parents("tr").remove();
          countRows = $("#partidas tbody tr").length;
          if (countRows <= 0) {
             $("#principal").prop("disabled", true);
          }
        });

        $("#modalIngresarEtapaPartida form button[name='agregar']").click(function(){
          var cantidad = +$(this).parents("form").find("input[name='cantidad']").val();
          var fechaInicioProgramada =  $(this).parents("form").find("input[name='fechaInicioProgramada1']").val();
          var fechaFinProgramada =  $(this).parents("form").find("input[name='fechaFinProgramada1']").val();
          var precioUnitario = "";
          var subtotal = "";
          $("#partidas tr:last td").each(function(index){
            if(index == 1){
              $("span", this).text(cantidad.toFixed(2));
            } 
            else if(index == 2){
             $("input[type='hidden']", this).val(cantidad.toFixed(2));
             $("span", this).text(cantidad.toFixed(2));
            }
            else if(index == 9){
             precioUnitario = $("input[type='hidden']", this).val();
             subtotal = precioUnitario * cantidad;
            }
            else if (index == 10) {
              $("span", this).text(fechaInicioProgramada);
              $("input[type='hidden']", this).val(fechaInicioProgramada);
            }else if (index == 11) {
              $("span", this).text(fechaFinProgramada);
              $("input[type='hidden']", this).val(fechaFinProgramada);
            }
             else if(index == 12){
              $("input[type='hidden']", this).val(subtotal.toFixed(4));
              $("span", this).text(subtotal.toFixed(4));
            }
          });
          $("#modalIngresarEtapaPartida").modal("hide");
          var total_etapa = +$("#sub-total-etapa").text() + subtotal;
          $("#sub-total-etapa").text(total_etapa.toFixed(2));
        });

      });
    </script>
  </body>
  </html>