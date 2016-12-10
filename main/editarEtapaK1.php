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

$etapa = $_GET['id'];
   // echo $etapa;

    $proyecto = $_GET['idProyecto'];
  //  echo $proyecto;

     require("connect_db.php");

        $query12= mysql_query("SELECT porcentajeCI FROM proyecto WHERE idProyecto=".$proyecto);

        $resultado2 = mysql_fetch_array($query12);
        $porcentajeCI= $resultado2['porcentajeCI'];

       // echo $porcentajeCI;

    $nombre = $_POST["nombre"];
    $detalle = $_POST["detalle"];
    $fechaInicioProgramada = $_POST["fechaInicioProgramada"];
    $fechaFinProgramada = $_POST["fechaFinProgramada"];
    $estado = $_POST["estado"];
   
    $conn = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();

      require("connect_db.php");

        $query12= mysql_query("SELECT totalEtapa FROM etapa WHERE idEtapa=".$etapa);

        $resultado2 = mysql_fetch_array($query12);
       // echo $resultado2['totalEtapa'];
   
      $total_etapa = 0;
      $valid = true;

      if(isset($_POST["subTotal_etapa"])){
        $total_etapa = array_sum($_POST["subTotal_etapa"]);
      }

        if(empty($nombre)) {
        
            $valid = false;
        }

        if(empty($detalle)) {

            $valid = false;
        }

        if(empty($fechaInicioProgramada)) {

            $valid = false;
        }

        if(empty($fechaFinProgramada)) {

            $valid = false;
        }

        if(empty($estado)) {

            $valid = false;
        }
        // update data
        if ($valid) {


      if($fechaFinProgramada > $fechaInicioProgramada){
      //$query = "INSERT INTO etapa(nombre, detalle, idProyecto, fechaInicioProgramada, fechaFinProgramada, estado, totalEtapa) VALUES ('".$nombre."', '".$detalle."', '".$proyecto."', '".$fechaInicioProgramada."', '".$fechaFinProgramada."', '".$estado."', ".$total_etapa.")";
      $query ="UPDATE etapa SET nombre='".$nombre."', detalle='".$detalle."', idProyecto='".$proyecto."', fechaInicioProgramada='".$fechaInicioProgramada."', fechaFinProgramada= '".$fechaFinProgramada."' , estado= '".$estado."', totalEtapa= '".$total_etapa."'   WHERE idEtapa=".$etapa;
     // $conn->query($query);
      if($conn->query($query)){

        $n = count($_POST["idpartida"]);
        echo $n;
        for ($i = 0; $i < $n; $i++){
          $query = "UPDATE etapapartida SET cantidad=".$_POST["cantidad"][$i].", CD=".$_POST["CDD"][$i].", CI=".$_POST["CII"][$i].", IVA=".$_POST["IVAA"][$i].", PU=".$_POST["PUU"][$i].", subTotal=".$_POST["subTotal_etapa"][$i]." WHERE idPartida=".$_POST["idpartida"][$i]." AND versionPartida=".$_POST["version"][$i]."";
          $conn->query($query);
        }
        $offset = $i;

        $n = count($_POST["numero"]);

        for ($i = 0; $i < $n; $i++){
          $query1 = "INSERT INTO etapapartida(idEtapa, idPartida, versionPartida, cantidad, CD, CI, IVA, PU, subTotal, fechaInicioProgramada, fechaFinProgramada) VALUES('".$etapa."', ".$_POST["numero"][$i].", ".$_POST["version"][$i].", ".$_POST["cantidad"][$i+$offset].", ".$_POST["CDD"][$i+$offset].", ".$_POST["CII"][$i+$offset].", '".$_POST["IVAA"][$i+$offset]."', ".$_POST["PUU"][$i+$offset].", ".$_POST["subTotal_etapa"][$i+$offset].", '".$_POST["fechaInicioProgramadaa"][$i+$offset]."', '".$_POST["fechaFinProgramadaa"][$i+$offset]."')";

          echo $etapa.", ".$_POST["numero"][$i].", ".$_POST["version"][$i].",".$_POST["cantidad"][$i+$offset].", ".$_POST["CDD"][$i+$offset].", ".$_POST["CII"][$i+$offset].", '".$_POST["IVAA"][$i+$offset]."', ".$_POST["PUU"][$i+$offset].", ".$_POST["subTotal_etapa"][$i+$offset]."\n";
          $conn->query($query1);
        }
        if ($conn->errno) {
          echo $conn->error;
        } else {
                  header("Location: editarEtapaK1.php?id=".$etapa."&idProyecto=".$proyecto);
        }
        


        
      }else{
       
      }   

      }elseif ($fechaFinProgramada < $fechaInicioProgramada){
       $str = "error2";
        
  
     // header("Location: crearEtapa.php?".$str);

     header("Location: editarEtapaK1.php?id=".$etapa."&idProyecto=".$proyecto."&".$str);
     }   

   }else{
       require("connect_db.php");
        
        $sql1 = mysql_query("SELECT * FROM etapa WHERE idEtapa='".$etapa."'");
        $row = mysql_fetch_array($sql1);
       
        if (empty($row)){
                  header("Location: editarEtapaK1.php?id=".$etapa."&idProyecto=".$proyecto);
        }
          $nombre = $row['nombre'];
          $detalle = $row['detalle'];
          $fechaI = $row['fechaInicioProgramada'];
          $fechaF = $row['fechaFinProgramada'];
          $estado = $row['estado'];
    }
    
  

?>



  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Etapa</title>

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
              <li class="active">Editar Etapa</li>
            </ol>
          </div>
        </div>

        <!-- BEGIN PAGE CONTENT -->
        <div class="content">
          <div class="page-h1">
            <h1>Editar Etapa <small>// Ingrese datos de la Etapa</small></h1>
          </div>
          <div class="col-md-12">
            <div class="alert alert-warning" style="margin-bottom:0px;margin-top:10px;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <span class="icon icon-exclamation-sign"></span> <strong>Verifique antes de guardar!</strong>
            </div>
          </div>




          <div class="tb1">
            
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
               <input type="text" class="form-control" required id="inputFName" placeholder="nombre" name="nombre" value="<?php echo $nombre;?>" >
              <span class="help-block"></span>
               </div>

               <div class="form-group">
              <label>Detalle de Etapa</label>
               <input type="text" class="form-control" required id="inputFName" placeholder="detalle" name="detalle" value="<?php echo $detalle;?>"  >
              <span class="help-block"></span>
               </div>

              <div class="form-group">
              <label>Fecha Inicio Programada</label>
              <br>
               <input type="date" class="tcal" required id="inputFName" placeholder="FechaInicioProgramada" name="fechaInicioProgramada" value="<?php echo $fechaI;?>" >
              <span class="help-block"></span>
               </div>

              <div class="form-group">
              <label>Fecha Fin programada</label>
              <br>
               <input type="date" class="tcal" required id="inputFName" placeholder="FechaFinProgramada" name="fechaFinProgramada" value="<?php echo $fechaF;?>" >
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

                  <table class="table" id="table-mat-prima">
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
           <?php  
           require("connect_db.php");

        $query11= mysql_query("CALL select_etapapartidas('".$etapa."')");
       // $resultado1 = mysql_fetch_array($query11);




        
        while ( $resultado1 = mysql_fetch_array($query11)) { ?>
            <tr id="<?php echo  $resultado1['idPartida']; ?>" version="<?php echo  $resultado1['versionPartida']; ?>" >
           <input type="hidden" class="id" name="idpartida[]" value="<?php echo  $resultado1['idPartida']; ?>"/>
           <input type="hidden"  name="version[]" value="<?php echo  $resultado1['versionPartida']; ?>"/>
           <td><span><?php echo $resultado1['detalle'] ; ?></span></td>
           <td><input type="hidden" name="cantidad[]" value="<?php echo $resultado1['cantidad']; ?>"/><span><?php echo $resultado1['cantidad'];?></span></td>
           <td><span></span></td>
           <td><span><?php echo $resultado1['totalMateriales']; ?></span></td>
           <td><span><?php echo $resultado1['totalManoObra'];?></span></td>
           <td><span><?php echo $resultado1['otros']; ?></span></td>
           <td><input type="hidden" name="CDD[]" value="<?php echo $resultado1['CDD']; ?>"/><span><?php echo $resultado1['CDD']; ?></span></td>
           <td><input type="hidden" name="CII[]" value="<?php echo $resultado1['CII']; ?>"/><span><?php echo $resultado1['CII']; ?></span></td>
           <td><input type="hidden" name="IVAA[]" value="<?php echo $resultado1['IVAA']; ?>"/><span><?php echo $resultado1['IVAA']; ?></span></td>
           <td><input type="hidden" name="PUU[]" value="<?php echo $resultado1['PUU']; ?>"/><span><?php echo $resultado1['PUU']; ?></span></td>   
           <td><input type="hidden" name="fechaInicioProgramadaa[]" value="<?php echo $resultado1['fechaInicioProgramad']; ?>"/><span><?php echo $resultado1['fechaInicioProgramada']; ?></span></td>
           <td><input type="hidden" name="fechaFinProgramadaa[]" value="<?php echo $resultado1['fechaFinProgramada']; ?>"/><span><?php echo $resultado1['fechaFinProgramada']; ?></span></td>       
           <td><input type="hidden" name="subTotal_etapa[]" value="<?php echo $resultado1['subTotal']; ?>"/><span class="subtotal"><?php echo $resultado1['subTotal']; ?></span></td>       
           <td>
            <button type="button"  class="detele" id="delete<?php echo  $resultado1['idPartida']; ?><?php echo  $resultado1['versionPartida']; ?>" ><i class='icon icon-trash'></i></button>
           <button type="button" class="editar btn btn-info btn-sm"><i class="icon icon-edit" ></i></button></td>
          

            </tr>
            <?php }  ?>
             </tbody>
                  </table>
                  
                  <table>
              <tr>
            <td></td>
              <td></td>
           <td></td>
            <td> <strong>SUBTOTAL:</strong></td>
            <td class="subtotal" id="sub-total-etapa">&nbsp;<?php echo $resultado2['totalEtapa']; ?></td>
            </tr>
          </table>

          <table>
          <tr>
            <td><button type="button" id="new-row-recursos" class="btn btn-primary btn-tooltip"><i class="icon icon-plus"></i></button></td>
          </tr>

        </table>


                  <br>               


                </div>
                </div>
              </div>
            

              <div class="col-md-12">
              <div class="wdgt">
                  <button id="principal" class="btn btn-success btn-lg" type="submit" name="enviarCambios" value="Guardar" >Guardar Cambios</button>
              </div>
            </div>

         </form>


<!--********************************** MODAL ELIMINAR ***********************************-->

            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
           <div class="modal-content">
            
            <div class="modal-body">

      <div class="alert alert-warning"><span class="icon icon-warning-sign"></span> 
      <strong>Cuidado</strong> <span id="confirmMessage"></span></div>
             
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-dark" id="cancel">Cancelar</button>
             <button type="button" class="btn btn-warning"  id="accept">Aceptar</button>
            </div>
           </div>
          </div>
         </div> 

<!-- MODAL EDITAR MATERIALES -->
    <div class="modal fade" id="modalEditarPartidaEtapa" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header modal-primary">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Editar Partidad de etapa</h4>
                    </div>
                    <div class="modal-body">

                      <!-- content goes here -->
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Cantidad</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="cantidad" required/>
                          </div>
                        </div>
                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary" name="agregar4">Ingresar</button>
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

      <!--MODAL ELIMINAR-->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
           <div class="modal-content">
            
            <div class="modal-body">

      <div class="alert alert-warning"><span class="icon icon-warning-sign"></span> 
      <strong>Cuidado</strong> <span id="confirmMessage"></span></div>
             
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-dark" id="cancel">Cancelar</button>
             <button type="button" class="btn btn-warning"  id="accept">Aceptar</button>
            </div>
           </div>
          </div>
         </div> 


<!--*********** MODAL PARA AGREGAR PARTIDAS A LA ETAPA *****************-->
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
                            <input type="date" class="form-control" name="fechaInicioProgramadaa"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Fecha Fin</label>
                          <div class="col-lg-7">
                            <input type="date" class="form-control" name="fechaFinProgramadaa"/>
                          </div>
                        </div>

                        

                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary" name="agregar4">Ingresar</button>
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

          $("#table-mat-prima tr:last td").each(function(index){
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
             $("input[type='hidden']", this).val(CD.toFixed(2));
              $("span", this).text(CD.toFixed(2));
            }
            else if(index == 7){
             $("input[type='hidden']", this).val(CI.toFixed(2));
              $("span", this).text(CI.toFixed(2));
            }
            else if(index == 8){
             $("input[type='hidden']", this).val(IVA1.toFixed(2));
              $("span", this).text(IVA1.toFixed(2));
            }
            else if(index == 9){
             $("input[type='hidden']", this).val(precioUnitario.toFixed(2));
              $("span", this).text(precioUnitario.toFixed(2));
            }
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
          var table = $("#table-mat-prima");

          html = "<tr><td><span></span><input type='hidden' name='numero[]'/></td><td><span></span><input type='hidden' name='version[]'/></td><td><span></span><input type='hidden' name='cantidad[]'/></td><td><span></span></td><td><span></span></td><td><span></span></td><td><span></span><input type='hidden' name='CDD[]'/></td><td><span></span><input type='hidden' name='CII[]'/></td><td><span></span><input type='hidden' name='IVAA[]'/></td><td><span></span><input type='hidden' name='PUU[]'/></td><td><span></span><input type='hidden' name='fechaInicioProgramadaa[]'/></td><td><span></span><input type='hidden' name='fechaFinProgramadaa[]'/></td><td><span class='subtotal'></span><input type='hidden' name='subTotal_etapa[]'/></td><td><button class='delete'><i class='icon icon-trash'></i></button><button type='button' class='editar btn btn-info btn-sm'><i class='icon icon-edit'></i></button></td></tr>";
          table.append(html);
           $("#principal").prop("disabled", false);
        });



        $("#modalIngresarEtapaPartida form button[name='agregar4']").click(function(){
          var cantidad = +$(this).parents("form").find("input[name='cantidad']").val();
          var fechaInicioProgramadaa =  $(this).parents("form").find("input[name='fechaInicioProgramadaa']").val();
          var fechaFinProgramadaa =  $(this).parents("form").find("input[name='fechaFinProgramadaa']").val();
          var precioUnitario = "";
          var subtotal = "";
          $("#table-mat-prima tr:last td").each(function(index){
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
              $("span", this).text(fechaInicioProgramadaa);
              $("input[type='hidden']", this).val(fechaInicioProgramadaa);
            }else if (index == 11) {
              $("span", this).text(fechaFinProgramadaa);
              $("input[type='hidden']", this).val(fechaFinProgramadaa);
            }
             else if(index == 12){
              $("input[type='hidden']", this).val(subtotal.toFixed(2));
              $("span", this).text(subtotal.toFixed(2));
            }
          });
          $('#modalIngresarEtapaPartida').modal('hide');
          var total_etapa = +$("#sub-total-etapa").text() + subtotal;
          $("#sub-total-etapa").text(total_etapa.toFixed(2));
        });

   $("#modalEditarPartidaEtapa form button[name='agregar4']").click(function(){
      cantidad = + $(this).parents("form").find("input[name='cantidad']").val();
       var selector = '';
          if ($("#table-mat-prima tbody tr").length > 0) {
            selector = $("#table-mat-prima tr.selected td");
          }else{
            selector = $("#table-mat-prima tr:last td");
          }
          var valor = + selector.eq(9).find("span").text();
          var cantidadAnterior = +selector.eq(2).find("span").text();
          var subTotalAnterior = valor * cantidadAnterior;

          subTotal = valor * cantidad;
       selector.each(function(index){
            if (index == 1) {
              $("span", this).text(cantidad);
              $("input[type='hidden']", this).val(cantidad);
            } else if (index == 12){
              $("input[type='hidden']", this).val(subTotal.toFixed(4));
              $("span", this).text(subTotal.toFixed(4));
            }
          });
          $("#table-mat-prima tr").removeClass("selected");
          $("#modalEditarPartidaEtapa").modal("hide");
          var total_etapa = +$("#sub-total-etapa").text() + (subTotal - subTotalAnterior);
          $("#sub-total-etapa").text(total_etapa.toFixed(2));
          $(this).parents("form").find(":input").val("");
    });
        
 
  
    $('.detele').click(function(){
        $('#alertaExito').hide();
        $('#AlertaError').hide();
      var row = $(this).closest("tr");
      var total1 = +$(this).parents("div.wdgt-primary").find("table tr td.subtotal").text();
      var subtotal = +$(this).closest("tr").find("td span.subtotal").text();
      confirmDialog("Esta seguro que desea eliminar el registro", function(){
          $("button[name='enviarCambios']").prop("disabled", false);
          total1 = total1 - subtotal;
         // row.parents("div.wdgt-primary").find("table tr td.subtotal").text(total1.toFixed(2));
          $("#sub-total-etapa").text(total1.toFixed(2));
         
          var identificador =  $("input[name='idpartida[]']").val();
          var identificador1 = $("input[name='version[]']").val();

      // var idPartida=$(this).parent().parent().attr('id');
      // var identificador=parseInt(idPartida);
      // var versionPartida=$(this).parent().parent().attr('version');
       //var identificador1=parseInt(versionPartida);       
       var id3 = <?php echo $etapa; ?>;
      $.ajax({

            url: "eliminarElementosEtapaPartida.php",
            method: "POST",
            data: { "id1" : identificador , "id3" : id3, "versionPartida" : identificador1} 

   //   type: "POST",
     //  url: "eliminarElementosEtapaPartida.php?id1="+identificador+"&id3="+id3+"&versionPartida="+identificador1,
     //  data: identificador

      }).done(function(info){
       
        var json_info=JSON.parse(info);
       
          if((json_info.deleteAnswer)=="ERROR"){
              
              $('#AlertaError').show();
              
          }else{
            $('#alertaExito').show();
            
          }


      }); 

     row.remove();
     });
   });
      
 function confirmDialog(message, onConfirm){
    var fClose = function(){
        modal.modal("hide");
    };
    var modal = $("#modalEliminar");
    modal.modal("show");
    $("#confirmMessage").empty().append(message);
    $("#accept").one('click', onConfirm);
    $("#accept").one('click', fClose);
    $("#cancel").one("click", fClose);
  }



    $(document).on("click", ".editar", function(){
      var row = $(this).closest("tr");
      row.addClass("selected");
      $("button[name='enviarCambios']").prop("disabled", false);
      var id = $(this).closest("table").attr('id');
        if (id == "table-mat-prima") {
          var modalForm = $("#modalEditarPartidaEtapa form");
          var val = row.find("td input[name='cantidad[]']").val();
          modalForm.find("input[name='cantidad']").val(val);
          $("#modalEditarPartidaEtapa").modal("show");
        } 

    });


      });
    </script>
  </body>
  </html>