<?php

require '../model/Usuario.php';

session_start();

if (!isset($_SESSION["userData"])){
    session_destroy();
    header("Location: ../home.php");
    exit();
}
$userData = $_SESSION["userData"];
session_write_close();

error_reporting(0);

$link=mysql_connect("localhost","sgp_user","56p_2016");

if ($link) {
    mysql_select_db("sgp_system", $link);
    # code...
}


?>



  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crear Partida</title>

    <!-- Default Styles (DO NOT TOUCH) -->
    <link rel="stylesheet" href="../lib/CSS/font-awesome.min.css">
    <link rel="stylesheet" href="../lib/CSS/emergente.css">
    <link rel="stylesheet" href="../lib/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/CSS/fonts.css">
    <link type="text/css" rel="stylesheet" href="../lib/CSS/soft-admin.css" />

    <!-- Adjustable Styles -->
    <link type="text/css" rel="stylesheet" href="../lib/CSS/DT_bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="../lib/CSS/icheck.css?v=1.0.1">
    <link rel="stylesheet" href="../lib/css/bootstrapValidator.css" />

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
                      <a href="crear_partida.php" class="sbtn sbtn-default active">Crear Partida</a>
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
              <li class="active">Crear Partida</li>
            </ol>
          </div>
        </div>

        <!-- BEGIN PAGE CONTENT -->
        <div class="content">
          <div class="page-h1">
            <h1>Nueva Partida <small>// Ingrese datos de la partida</small></h1>
          </div>
          <div class="col-md-12">
            <div class="alert alert-warning" style="margin-bottom:0px;margin-top:10px;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <span class="icon icon-exclamation-sign"></span> <strong>Verifique antes de guardar!</strong>
            </div>
          </div>
          <div class="tb1">
            

            <div class="col-md-12">
              <div class="wdgt wdgt-primary" hide-btn="true">
                <div class="wdgt-header">Materiales</div>
                <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Descripcion</th>
                        <th>Unidad</th>
                        <th>Cantidad</th>
                        <th>Valor</th>
                        <th>Sub-Total</th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody>



                      <?php
$sql = mysql_query("select * from linearecurso lr inner join recurso r where lr.codigo=r.codigo and lr.numero=0");
while ($row = mysql_fetch_array($sql)) {
    
    
    echo '<tr>';
    
    echo '<td>'. $row['nombre'] .'</td>';
    echo '<td>'. $row['unidad'] .'</td>';
    echo '<td>'. $row['cantidad'] . '</td>';
    echo '<td>'. $row['costoDirecto'] .'</td>';
    echo '<td>'. $row['subTotal'] .'</td>';
    echo '<td></td>';
    
    echo '</tr>';
    
    
}
?>

                    </tbody>
                  </table>
                  <div>
                    <button data-toggle="modal" data-target="#squarespaceModal" class="btn btn-info btn-sm"><i class="icon icon-plus"></i></button>
                  </div>
                  <br>
                </div>
              </div>

            </div>




            <!-- line modal -->
            <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog" style="width:75%">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Recursos</h3>
                  </div>
                  <div class="modal-body">

                    <!-- content goes here -->

                    <div class="content">

                      <div class="tbl">
                        <div class="col-md-12">
                          <div class="wdgt" hide-btn="true">
                            <div class="wdgt-header">Tabla de recursos</div>
                            <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
                              <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">


                                <!--ENCABEZADO DE LA TABLA RECURSOS -->

                                <thead>
                                  <tr>
                                    <th>Código</th>
                                    <th>Nombre del recurso</th>
                                    <th>Unidad</th>
                                    <th>Costo Directo</th>
                                    <th>Iva</th>
                                    <th>Total</th>
                                    <th>Fecha Modificación</th>
                                    <th>Empresa Proveedora</th>
                                    <th>Tipo de recurso</th>
                                    <th></th>





                                  </tr>
                                </thead>


                                <!--CUERPO DE LA TABLA RECURSOS -->


                                <tbody>


                                  <?php
#include 'connect_db.php';
//require("connect_db.php");
$sql = mysql_query("select * from recurso");
while ($row = mysql_fetch_array($sql)) {
    echo '<tr>';
    echo '<td>'. $row['codigo'] . '</td>';
    echo '<td>'. $row['nombre'] .'</td>';
    echo '<td>'. $row['unidad'] .'</td>';
    echo '<td>'. $row['costoDirecto'] . '</td>';
    echo '<td>'. $row['iva'] .'</td>';
    echo '<td>'. $row['total'] .'</td>';
    echo '<td>'. $row['fecha'] . '</td>';
    echo '<td>'. $row['empresaProveedora'] . '</td>';
    echo '<td>'. $row['tipoRecurso'] . '</td>';
    
    $nombre=$row['nombre'];
    $codigo=$row['codigo'];
    
    
    
    echo '<td><button onclick="cantidad(\''.$nombre.'\', \''.$codigo.'\' );">Agregar</button></td>';
    
    
    
    
    
    
    echo '</tr>';
}

?>




                                </tbody>
                              </table>



                            </div>
                          </div>

                        </div>
                      </div>

                    </div>

















                  </div>
                  <div class="modal-footer">
                    <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                      <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                      </div>
                      <div class="btn-group btn-delete hidden" role="group">
                        <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal" role="button">Delete</button>
                      </div>
                      <div class="btn-group" role="group">
                        <button type="button" id="saveImage" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

<?php

// Conectar con el servidor y base de datos
$mysqli = new mysqli('localhost','sgp_user','56p_2016','sgp_system');

if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}


if(isset($_REQUEST['agregar'])) {
    
    $desc = $_REQUEST['descripcion'];
    $jorn = $_REQUEST['jornada'];
    $fp = $_REQUEST['FP'];
    $jornT = $_REQUEST['jornadaTotal'];
    $rend = $_REQUEST['rendimiento'];
    $subT = $_REQUEST['subTotal'];
    
    $sql = "INSERT INTO lineamanoobra (numero, descripcion, jornada, FP, jornadaTotal, rendimiento, subTotal)
    VALUES (0,'".$desc."', '".$jorn."', '".$fp."', '".$jornT."', '".$rend."', '".$subT."')";
    
    $mysqli->query($sql);
}


?>

              <div class="col-md-12">
                <div class="wdgt wdgt-primary" hide-btn="true">
                  <div id="divMano" class="wdgt-header">Mano de Obra</div>
                  <div class="wdgt-body" style="padding-bottom:10px; padding-top:10px;" id="manoObra">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped">
                      <thead>
                        <tr>
                          <th>Descripcion</th>
                          <th>Jorn</th>
                          <th>F.P</th>
                          <th>Jorn. Total</th>
                          <th>Rendimiento</th>
                          <th>Sub-Total</th>
                        </tr>
                      </thead>
                      <tbody>

<?php

  if(isset($_REQUEST['guardar'])) {
        print '<tr>';
        print '<td></td>';
        print '<td></td>';
        print '<td></td>';
        print '<td></td>';
        print '<td></td>';
        print '<td></td>';
        print '</tr>';
    
  } else{

    $results = $mysqli->query("SELECT * FROM lineamanoobra WHERE numero=0");

    while($row = $results->fetch_array()) {
        print '<tr>';
        print '<td>'.$row["descripcion"].'</td>';
        print '<td>'.$row["jornada"].'</td>';
        print '<td>'.$row["FP"].'</td>';
        print '<td>'.$row['jornadaTotal'].'</td>';
        print '<td>'.$row['rendimiento'].'</td>';
        print '<td>'.$row['subTotal'].'</td>';
        print '</tr>';
    }
  }

?>

                  </tbody>
                    </table>
                    <button data-toggle="modal" data-target="#modal2" class="btn btn-info"><i class="icon icon-plus"></i></button>

                  </div>
                </div>

              </div>


              <!-- line modal -->
              <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header modal-primary">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Ingresar Mano de Obra</h4>
                    </div>
                    <div class="modal-body">

                      <!-- content goes here -->
                      <form onsubmit="setFormSubmitting()" id="defaultForm" method="post" action="crear_partida.php" class="form-horizontal">

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Descripcion</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="descripcion" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Jornada</label>
                          <div class="col-lg-7">
                            <input type="number" class="form-control" name="jornada" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">FP</label>
                          <div class="col-lg-7">
                            <input type="number" class="form-control" name="FP" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Jornada Total</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.1" class="form-control" name="jornadaTotal" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Rendimiento</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="rendimiento" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Sub-Total</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="subTotal" required/>
                          </div>
                        </div>

                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-success" name="agregar" value="Agregar">Ingresar</button>
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


<?php

if(isset($_REQUEST['agregar2'])) {
    
    $desc = $_REQUEST['descripcion'];
    $tipo = $_REQUEST['tipo'];
    $cap = $_REQUEST['capacidad'];
    $rend = $_REQUEST['rendimiento'];
    $cost = $_REQUEST['costoHora'];
    $subT = $_REQUEST['subTotal'];
    
    $sql = "INSERT INTO lineaequipoherramienta (numero,descripcion, tipo, capacidad, rendimiento, costoHora, subTotal)
    VALUES (0,'".$desc."', '".$tipo."', '".$cap."', '".$rend."', '".$cost."', '".$subT."')";
    
    $mysqli->query($sql);
}


?>


              <div class="col-md-12">
                <div class="wdgt wdgt-primary" hide-btn="true">
                  <div class="wdgt-header">Equipo y Herramientas</div>
                  <div class="wdgt-body" style="padding-bottom:10px; padding-top:10px;" id="manoObra">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped">
                      <thead>
                        <tr>
                          <th>Descripcion</th>
                          <th>Tipo</th>
                          <th>Capacidad</th>
                          <th>Rendimiento</th>
                          <th>Costo por Hora</th>
                          <th>Sub-Total</th>
                        </tr>
                      </thead>
                      <tbody>

<?php

   if(isset($_REQUEST['guardar'])) {
        print '<tr>';
        print '<td></td>';
        print '<td></td>';
        print '<td></td>';
        print '<td></td>';
        print '<td></td>';
        print '<td></td>';
        print '</tr>';
    
  } else{

    $results = $mysqli->query("SELECT * FROM lineaequipoherramienta WHERE numero=0");

    while($row = $results->fetch_array()) {
        print '<tr>';
        print '<td>'.$row["descripcion"].'</td>';
        print '<td>'.$row["tipo"].'</td>';
        print '<td>'.$row['capacidad'].'</td>';
        print '<td>'.$row['rendimiento'].'</td>';
        print '<td>'.$row['costoHora'].'</td>';
        print '<td>'.$row['subTotal'].'</td>';
        print '</tr>';
    }
  }

?>

                      </tbody>
                    </table>
                    <button data-toggle="modal" data-target="#modal3" class="btn btn-info"><i class="icon icon-plus"></i></button>

                  </div>
                </div>

              </div>

              <!-- line modal -->
              <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header modal-primary">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Ingresar Equipo y Herramientas</h4>
                    </div>
                    <div class="modal-body">

                      <!-- content goes here -->
                      <form onsubmit="setFormSubmitting()" id="defaultForm" method="post" action="crear_partida.php" class="form-horizontal">

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Descripcion</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="descripcion" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Tipo</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="tipo" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Capacidad</label>
                          <div class="col-lg-7">
                            <input type="number" class="form-control" name="capacidad" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Rendimiento</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="rendimiento" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Costo Hora</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="costoHora" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Sub-Total</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="subTotal" required/>
                          </div>
                        </div>

                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-success" name="agregar2" value="Agregar">Ingresar</button>
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


<?php

if(isset($_REQUEST['agregar3'])) {
    
    $part = $_REQUEST['numero'];
    $desc = $_REQUEST['descripcion'];
    $uni = $_REQUEST['unidad'];
    $cant = $_REQUEST['cantidad'];
    $val = $_REQUEST['valor'];
    $subT = $_REQUEST['subTotal'];
    
    $sql = "INSERT INTO lineasubcontrato (numero, descripcion, unidad, cantidad, valor, subTotal)
    VALUES (0,'".$desc."','".$uni."', '".$cant."', '".$val."', '".$subT."')";
    
    $mysqli->query($sql);
}


?>


              <div class="col-md-12">
                <div class="wdgt wdgt-primary" hide-btn="true">
                  <div class="wdgt-header">SubContratos</div>
                  <div class="wdgt-body" style="padding-bottom:10px; padding-top:10px;" id="subcontratos">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped">
                      <thead>
                        <tr>
                          <th>Descripcion</th>
                          <th>Unidad</th>
                          <th>Cantidad</th>
                          <th>Valor</th>
                          <th>Sub-Total</th>
                        </tr>
                      </thead>
                      <tbody>

<?php

  if(isset($_REQUEST['guardar'])) {
        print '<tr>';
        print '<td></td>';
        print '<td></td>';
        print '<td></td>';
        print '<td></td>';
        print '<td></td>';
        print '</tr>';
    
  } else{
    $results = $mysqli->query("SELECT * FROM lineasubcontrato WHERE numero=0");

    while($row = $results->fetch_array()) {
        print '<tr>';
        print '<td>'.$row["descripcion"].'</td>';
        print '<td>'.$row["unidad"].'</td>';
        print '<td>'.$row['cantidad'].'</td>';
        print '<td>'.$row['valor'].'</td>';
        print '<td>'.$row['subTotal'].'</td>';
        print '</tr>';
    }
  }

?>

                      </tbody>
                    </table>
                    <button data-toggle="modal" data-target="#modal4" class="btn btn-info"><i class="icon icon-plus"></i></button>

                  </div>
                  
                </div>

              </div>

              <!-- line modal -->
              <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header modal-primary">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Ingresar Sub-Contratos</h4>
                    </div>
                    <div class="modal-body">

                      <!-- content goes here -->
                      <form onsubmit="setFormSubmitting()" id="defaultForm" method="post" action="crear_partida.php" class="form-horizontal">

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Descripcion</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="descripcion" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Unidad</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="unidad"  maxlength="3" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Cantidad</label>
                          <div class="col-lg-7">
                            <input type="number" class="form-control" name="cantidad" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Valor</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="valor" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Sub-Total</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="subTotal" required/>
                          </div>
                        </div>

                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-success" name="agregar3" value="Agregar">Ingresar</button>
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

<?php
            if(isset($_REQUEST['guardar'])) {

              $nam = $_REQUEST['nombre'];  

              $db = mysqli_connect('localhost','sgp_user', '56p_2016', 'sgp_system');   

              $query = "CALL llenar_partida('".$nam."');";
              $query .= "CALL actualizar_lineas();";
  
              mysqli_multi_query($db, $query);  
              
            }  
              
              mysqli_close($db);

?>

            <div class="col-md-12">
              <div class="wdgt">
                <form onsubmit="setFormSubmitting(); notifyMe();" method="post" action="crear_partida.php">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre Partida" required>
                  </div>
                  <button onClick="window.location.href='crear_partida.php'" class="btn btn-success btn-lg" type="submit" name="guardar" value="Guardar" >Guardar</button>
                </form>
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
              // request permission on page load
        document.addEventListener('DOMContentLoaded', function () {
          if (!Notification) {
            alert('Notificaciones de Escritorio no disponibles. Intentalo en Chrome'); 
            return;
          }

          if (Notification.permission !== "granted")
            Notification.requestPermission();
        });

        function notifyMe() {
          if (Notification.permission !== "granted")
            Notification.requestPermission();
          else {
            var notification = new Notification('Nueva Partida Creada!', {
              icon: '../Imagenes/logo.png',
              body: "Se ha creado una nueva partida!",
            });

            notification.onclick = function () {
              window.open("consultarPartidas.php");      
            };

          }

        }
    </script>

    <script>
      var formSubmitting = false;
      var setFormSubmitting = function() { formSubmitting = true; };

      window.onload = function() {
          window.addEventListener("beforeunload", function (e) {
              if (formSubmitting) {
                  return undefined;
              }

              var confirmationMessage = 'parece que has hecho algunos cambios. '
                                      + 'si te sales perderas todo!.';

              (e || window.event).returnValue = confirmationMessage; //Gecko + IE
              return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
          });
      };
    </script>

    <script>
      $(document).ready(function() {
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

        $(".new-row").click(function() {
          var table = $(this).parent().children("table");
          var count = table.children("tbody").children("tr").length;

          html = "<tr><td><input type='text' class='" + (count + 1) + " form-control input-sm'/></td><td><input type='text' class='" + (count + 1) + " form-control input-sm'/></td><td><input type='text' class='" + (count + 1) + " form-control input-sm'/></td><td><input type='text' class='" + (count + 1) + " form-control input-sm'/></td><td><input type='text' class='" + (count + 1) + " form-control input-sm'/></td>";
          table.children("tbody").children("tr").filter(":last").children("td").each(function(index) {
            var val = $(this).children("input[type='text']").val();
            $(this).children("input[type='text']").hide();
            $(this).text(val);
          });
          if (table.attr('id') != 'subcontratos') {
            html += "<td><input type='text' class='" + (count + 1) + " form-control input-sm'/></td>";
          }
          html += "</tr>";
          table.append(html);
        });
      });
    </script>

    <script>
      function cantidad(nombre, codigo) {

        var cant = "";



        cant = prompt("Indique la cantidad a agregar de " + nombre + ":", "");

        if (cant != null) {

          window.location.replace("insertarLR.php?cod=" + codigo + "&cantidad=" + cant + "");


        }

      }
    </script>





  </body>

  </html>