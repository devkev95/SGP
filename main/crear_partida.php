<?php

require_once '../model/Usuario.php';
require_once '../services/conn.php';

session_start();

if (!isset($_SESSION["userData"])){
    session_destroy();
    header("Location: home.php");
    exit();
}
$db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
$userData = $_SESSION["userData"];
session_write_close();

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
                  <div id="c-tables" class="accordion-body collapse in">
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

                 <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="sbtn btn-default" href="proyectos.php">
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
            
          <form method="POST" action="../services/partida/guardarPartida.php">
            <div class="col-md-12">
              <div class="wdgt wdgt-primary" hide-btn="true">
                <div class="wdgt-header">Materiales</div>
                <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
                  <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped" id="recursos">
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
                    </tbody>
                  </table>
                  <div>
                    <button type="button" id="new-row-recursos" class="btn btn-info btn-sm"><i class="icon icon-plus"></i></button>
                    <strong>Sub-total:<span id="sub-total-recursos">0.00</span></strong>
                  </div>
                  <br>
                </div>
              </div>

            </div>

              <div class="col-md-12">
                <div class="wdgt wdgt-primary" hide-btn="true">
                  <div id="divMano" class="wdgt-header">Mano de Obra</div>
                  <div class="wdgt-body" style="padding-bottom:10px; padding-top:10px;">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped" id="manoObra">
                      <thead>
                        <tr>
                          <th>Descripcion</th>
                          <th>Jorn</th>
                          <th>F.P</th>
                          <th>Jorn. Total</th>
                          <th>Rendimiento</th>
                          <th>Sub-Total</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                  </tbody>
                    </table>
                    <div>
                    <button type="button" id="new-row-mano-obra" class="btn btn-info btn-sm"><i class="icon icon-plus"></i></button>
                    <strong>Sub-total:<span id="sub-total-MO">0.00</span></strong>
                    </div>
                  </div>
                </div>

              </div>

              <div class="col-md-12">
                <div class="wdgt wdgt-primary" hide-btn="true">
                  <div class="wdgt-header">Equipo y Herramientas</div>
                  <div class="wdgt-body" style="padding-bottom:10px; padding-top:10px;" id="herramientas">
                    <table id="herramientas" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped">
                      <thead>
                        <tr>
                          <th>Descripcion</th>
                          <th>Tipo</th>
                          <th>Capacidad</th>
                          <th>Rendimiento</th>
                          <th>Costo por Hora</th>
                          <th>Sub-Total</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <div>
                    <button type="button" id="new-row-herramientas" class="btn btn-info btn-sm"><i class="icon icon-plus"></i></button>
                    <strong>Sub-total:<span id="sub-total-herramientas">0.00</span></strong>
                    </div>
                  </div>
                </div>

              </div>

            <div class="col-md-12">
                <div class="wdgt wdgt-primary" hide-btn="true">
                  <div class="wdgt-header">SubContratos</div>
                  <div class="wdgt-body" style="padding-bottom:10px; padding-top:10px;" id="subcontratos">
                    <table id="subcontratos" cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped">
                      <thead>
                        <tr>
                          <th>Descripcion</th>
                          <th>Unidad</th>
                          <th>Cantidad</th>
                          <th>Valor</th>
                          <th>Sub-Total</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <button type="button" id="new-row-subcontratos" class="btn btn-info btn-sm"><i class="icon icon-plus"></i></button>
                    <strong>Sub-total:<span id="sub-total-subcontratos">0.00</span></strong>

                  </div>
                  
                </div>

              </div>

              <div class="col-md-12">
              <div class="wdgt">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre Partida" required>
                  </div>
                  <div class="form-group">
                    <label>Costo Indirecto</label>
                    <br/>
                    <input type="number" min="0" class="col-md-1" name="CI" class="form-control" placeholder="%" required><span class="col-md-1">%</span>
                  </div>
                  <button id="principal" class="btn btn-success btn-lg" type="submit" name="guardar" value="Guardar" disabled>Guardar</button>
              </div>
            </div>
                </form>

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
                              <table id="recursos-seleccion" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">


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
$sql = $db->query("SELECT codigo, nombre, unidad, costoDirecto, iva, total, fecha, empresaProveedora, tipoRecurso FROM recurso");
while ($row = $sql->fetch_array()) {
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
    $unidad = $row['unidad'];
    $valor = $row['total'];
    
    
    
    echo '<td><button onclick="cantidad(\''.$codigo.'\', \''.$nombre.'\', \''.$unidad.'\', \''.$valor.'\')">Agregar</button></td>';
    
    
    
    
    
    
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
                      <form class="form-horizontal">

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
                          <label class="col-lg-3 control-label">Rendimiento</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="rendimiento" required/>
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
                      <form class="form-horizontal">

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Descripcion</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="descripcion" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Tipo</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="tipo"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Capacidad</label>
                          <div class="col-lg-7">
                            <input type="number" class="form-control" name="capacidad"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Rendimiento</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="rendimiento"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Costo Hora</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="costoHora"/>
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
                            <button type="button" class="btn btn-success" name="agregar2" value="Agregar">Ingresar</button>
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
                      <form class="form-horizontal">

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

                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-success" name="agregar3" value="Agregar">Ingresar</button>
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
       window.cantidad= function (codigo, nombre, unidad, valor) {
        var cant = "";
        valor = +valor;
        cant = +prompt("Indique la cantidad a agregar de " + nombre + ":", "");
        $('#squarespaceModal').modal('hide');
        if (cant != null) {
          var subtotal = valor * cant;
         if (/^([0-9])*$/.test(cant)){
          $("#recursos tr:last td").each(function(index){
            if (index == 0){
              $("input[type='hidden']", this).val(codigo);
              $("span", this).text(nombre);
            }else if(index == 1){
              $("input[type='hidden']", this).val(cant.toFixed(2));
              $("span", this).text(unidad);
            }else if(index == 2){
              $("span", this).text(cant.toFixed(2));
            }
            else if(index == 3){
              $("span", this).text(valor.toFixed(2));
            }
            else if(index == 4){
              $("input[type='hidden']", this).val(subtotal.toFixed(2));
              $("span", this).text(subtotal.toFixed(2));
            }
          });
          var total_recursos = +$("#sub-total-recursos").text() + subtotal;
          $("#sub-total-recursos").text(total_recursos.toFixed(2));
        }
         
        else {
         alert("El valor " + cant + " no es un número");
        }
        
       }
        }


        $('#squarespaceModal').modal({ show: false});
        $("#modal2").modal({show: false});
        $("#modal3").modal({show: false});
        $("#modal4").modal({show: false});
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

          html = "<tr><td><span></span><input type='hidden' name='codigo[]'/></td><td><span></span><input type='hidden' name='cantidad[]'/></td><td><span></span></td><td><span></span></td><td><span class='subtotal'></span><input type='hidden' name='subTotal_recursos[]'/></td><td><button class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button></td></tr>";
          table.append(html);
           $("#principal").prop("disabled", false);
        });

        $("#new-row-mano-obra").click(function() {
          $('#modal2').modal('show');
          var table = $(this).parents(".wdgt-body").children("table");
          var count = table.children("tbody").children("tr").length;

          html = "<tr><td><span></span><input type='hidden' name='descripcion_mano_obra[]'/></td><td><span></span><input type='hidden' name='jornada[]'/></td><td><span></span><input type='hidden' name='FP[]'/></td><td><span></span></td><td><span></span><input type='hidden' name='rendimiento_MO[]'/></td><td><span class='subtotal'></span><input type='hidden' name='subTotal_MO[]'/></td><td><button class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button></td></tr>";
          table.append(html);
          $("#principal").prop("disabled", false);
        });

        $("#modal2 form button[name='agregar']").click(function(){
          var descripcion = $(this).parents("form").find("input[name='descripcion']").val();
          var jornada = + $(this).parents("form").find("input[name='jornada']").val();
          var FP = + $(this).parents("form").find("input[name='FP']").val();
          var rendimiento = + $(this).parents("form").find("input[name='rendimiento']").val();
          var jornada_total = jornada * FP;
          var subtotal = jornada_total / rendimiento;
          $("#manoObra tr:last td").each(function(index){
            if (index == 0) {
              $("span", this).text(descripcion);
              $("input[type='hidden']", this).val(descripcion);
            }else if (index == 1) {
              $("span", this).text(jornada.toFixed(2));
              $("input[type='hidden']", this).val(jornada.toFixed(2));
            }else if (index == 2) {
              $("span", this).text(FP.toFixed(2));
              $("input[type='hidden']", this).val(FP.toFixed(2));
            }else if (index == 3) {
              $("span", this).text(jornada_total.toFixed(2));
            }else if (index == 4) {
              $("span", this).text(rendimiento.toFixed(2));
              $("input[type='hidden']", this).val(rendimiento.toFixed(2));
            }else if(index == 5){
              $("span", this).text(subtotal.toFixed(2));
              $("input[type='hidden']", this).val(subtotal.toFixed(2));
            }
          });
          $("#modal2").modal("hide");
          var total_MO = +$("#sub-total-MO").text() + subtotal;
          $("#sub-total-MO").text(total_MO.toFixed(2));
          $(this).parents("form").find(":input").val("");
        });

         $("#new-row-herramientas").click(function() {
          $('#modal3').modal('show');
          var table = $(this).parents(".wdgt-body").children("table");
          var count = table.children("tbody").children("tr").length;

          html = "<tr><td><span></span><input type='hidden' name='descripcion_herramienta[]'/></td><td><span></span><input type='hidden' name='tipo[]'/></td><td><span></span><input type='hidden' name='capacidad[]'/></td><td><span></span><input type='hidden' name='rendimiento_herramienta[]'/></td><td><span></span><input type='hidden' name='costo_hora[]'/></td><td><span class='subtotal'></span><input type='hidden' name='subTotal_herramienta[]'/></td><td><button class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button></td></tr>";
          table.append(html);
           $("#principal").prop("disabled", false);
        });

         $("#modal3 form button[name='agregar2']").click(function(){
          var descripcion = $(this).parents("form").find("input[name='descripcion']").val();
          var tipo = $(this).parents("form").find("input[name='tipo']").val();
          var capacidad =  $(this).parents("form").find("input[name='capacidad']").val();
          var rendimiento = + $(this).parents("form").find("input[name='rendimiento']").val();
          var costo_hora = + $(this).parents("form").find("input[name='costoHora']").val();
          var subtotal = + $(this).parents("form").find("input[name='subTotal']").val();
          $("#herramientas tr:last td").each(function(index){
            if (index == 0) {
              $("span", this).text(descripcion);
              $("input[type='hidden']", this).val(descripcion);
            }else if (index == 1) {
              if (tipo.length == 0) {
              $("span", this).text("N/E");
              $("input[type='hidden']", this).val(0);
              }else{
              $("span", this).text(tipo);
              $("input[type='hidden']", this).val(tipo)
              }
            }
            else if (index == 2) {
              if (tipo.length == 0) {
              $("span", this).text("N/E");
              $("input[type='hidden']", this).val(0);
              }else{
              $("span", this).text(capacidad);
              $("input[type='hidden']", this).val(capacidad);
              }
             
            }else if (index == 3) {
              $("span", this).text(rendimiento.toFixed(2));
              $("input[type='hidden']", this).val(rendimiento.toFixed(2));
            }else if (index == 4) {
              $("span", this).text(costo_hora.toFixed(2));
              $("input[type='hidden']", this).val(costo_hora.toFixed(2));
            }else if(index == 5){
              $("span", this).text(subtotal.toFixed(2));
              $("input[type='hidden']", this).val(subtotal.toFixed(2));
            }
          });
          $("#modal3").modal("hide");
          var total_herramienta = +$("#sub-total-herramientas").text() + subtotal;
          $("#sub-total-herramientas").text(total_herramienta.toFixed(2));
          $(this).parents("form").find(":input").val("");
        });

         
         $("#new-row-subcontratos").click(function() {
          $('#modal4').modal('show');
          var table = $(this).parents(".wdgt-body").children("table");
          var count = table.children("tbody").children("tr").length;

          html = "<tr><td><span></span><input type='hidden' name='descripcion_subcontrato[]'/></td><td><span></span><input type='hidden' name='unidad[]'/></td><td><span></span><input type='hidden' name='cantidad_subcontrato[]'/></td><td><span></span><input type='hidden' name='valor[]'/></td><td><span class='subtotal'></span><input type='hidden' name='subTotal_subcontrato[]'/></td><td><button class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button></td></tr>";
          table.append(html);
           $("#principal").prop("disabled", false);
        });

         $("#modal4 form button[name='agregar3']").click(function(){
          var descripcion = $(this).parents("form").find("input[name='descripcion']").val();
          var unidad =  $(this).parents("form").find("input[name='unidad']").val();
          var cantidad = + $(this).parents("form").find("input[name='cantidad']").val();
          var valor = + $(this).parents("form").find("input[name='valor']").val();
          var subtotal = cantidad * valor;
          $("#subcontratos tr:last td").each(function(index){
            if (index == 0) {
              $("span", this).text(descripcion);
              $("input[type='hidden']", this).val(descripcion);
            }else if (index == 1) {
              $("span", this).text(unidad);
              $("input[type='hidden']", this).val(unidad);
            }else if (index == 2) {
              $("span", this).text(cantidad.toFixed(2));
              $("input[type='hidden']", this).val(cantidad.toFixed(2));
            }else if (index == 3) {
              $("span", this).text(valor.toFixed(2));
              $("input[type='hidden']", this).val(valor.toFixed(2));
            }else if(index == 4){
              $("span", this).text(subtotal.toFixed(2));
              $("input[type='hidden']", this).val(subtotal.toFixed(2));
            }
          });
          $("#modal4").modal("hide");
          var total_subcontrato = +$("#sub-total-subcontratos").text() + subtotal;
          $("#sub-total-subcontratos").text(total_subcontrato.toFixed(2));
          $(this).parents("form").find(":input").val("");
        });

        $(document).on("click", ".eliminar", function(){
          var total = +$(this).closest("div").find("div span").text();
          var subtotal = +$(this).closest("tr").find("td span.subtotal").text();
          total = total - subtotal;
          $(this).closest("div").find("div span").text(total.toFixed(2));
          $(this).parents("tr").remove();
          countRows = $("#recursos>tr").length + $("#manoObra>tr").length + $("#herramientas>tr").length + $("#subcontratos>tr").length;
          if (countRows <= 0) {
             $("#principal").prop("disabled", true);
          }
        });
      });
    </script>
  </body>
  </html>