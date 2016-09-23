<?php
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
  <link rel="stylesheet" href="lib/css/font-awesome.min.css">
    <link rel="stylesheet" href="emergente.css">
  <link rel="stylesheet" href="lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="lib/css/fonts.css">
  <link type="text/css" rel="stylesheet" href="lib/css/soft-admin.css" />

  <!-- Adjustable Styles -->
  <link type="text/css" rel="stylesheet" href="lib/css/DT_bootstrap.css" />
  <link type="text/css" rel="stylesheet" href="lib/css/icheck.css?v=1.0.1">

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
      <div class="logo"><img id="logo" src="lib/img/logo3.png" style="width:159px !important; height:52px; !important"></div>
      <div class="sidebar">
        <div>
          <input class="typeahead" type="text" placeholder="Search">
          <span id="search-icon" class="glyphicon glyphicon-search"></span>
        </div>
        <div class="accordion">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="sbtn btn-default" href="index.html">
                <span class="fa fa-dashboard"></span> &nbsp;&nbsp;Dashboard
              </a>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="sbtn btn-default" href="typography.html">
                <span class="icon icon-text-width"></span> &nbsp;&nbsp;Typography
              </a>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="sbtn btn-default" href="charts.html">
                <span class="fa fa-bar-chart-o"></span> &nbsp;&nbsp;Charts
              </a>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="sbtn btn-default" href="widgets.html">
                <span class="fa fa-list-alt"></span> &nbsp;&nbsp;Widgets
              </a>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="sbtn btn-default" data-toggle="collapse" href="#c-ui">
                <span class="icon icon-credit-card"></span> &nbsp;&nbsp;UI Elements
                <span class="caret"></span>
              </a>
            </div>
            <div id="c-ui" class="accordion-body collapse">
              <div class="accordion-inner">
                <a href="alerts_notifications.html" class="sbtn sbtn-default">Alerts & Notifications <span class="label label-primary">9</span></a>
                <a href="tabs_accordion.html" class="sbtn sbtn-default">Tabs & Accordions</a>
                <a href="buttons.html" class="sbtn sbtn-default">Buttons & Icons</a>
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="sbtn btn-default" href="gallery.html">
                <span class="fa fa-picture-o"></span> &nbsp;&nbsp;Gallery
              </a>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="sbtn btn-default" data-toggle="collapse" href="#c-tables">
                <span class="fa fa-pencil-square-o"></span> &nbsp;&nbsp;Partidas
                <span class="caret"></span>
              </a>
            </div>
            <div id="c-tables" class="accordion-body collapse in">
              <div class="accordion-inner">
                <a href="crear_partida.html" class="sbtn sbtn-default active">Crear Partida</a>
                <a href="table_datatables.html" class="sbtn sbtn-default">Ver Partida</a>
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="sbtn btn-default" data-toggle="collapse" href="#c-tables">
                <span class="fa fa-table"></span> &nbsp;&nbsp;Tables
                <span class="caret"></span>
              </a>
            </div>
            <div id="c-tables" class="accordion-body collapse">
              <div class="accordion-inner">
                <a href="table_static.html" class="sbtn sbtn-default">Static Tables <span class="label label-soft">2</span></a>
                <a href="table_datatables.html" class="sbtn sbtn-default">jQuery Datatables</a>
              </div>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="sbtn btn-default" href="storyboard.html">
                <span class="fa fa-tasks"></span> &nbsp;&nbsp;Storyboard
              </a>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="sbtn btn-default" href="calendar.html">
                <span class="fa fa-calendar"></span> &nbsp;&nbsp;Calendar
              </a>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="sbtn btn-default" href="maps.html">
                <span class="fa fa-map-marker"></span> &nbsp;&nbsp;Maps
              </a>
            </div>
          </div>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="sbtn btn-default" data-toggle="collapse" href="#c-pages">
                <span class="fa fa-file-o"></span> &nbsp;&nbsp;Pages
                <span class="caret"></span>
              </a>
            </div>
            <div id="c-pages" class="accordion-body collapse">
              <div class="accordion-inner">
                <a href="login_register.html" class="sbtn sbtn-default">Login</a>
                <a href="FAQ.html" class="sbtn sbtn-default">F.A.Q.</a>
                <a href="grid.html" class="sbtn sbtn-default">Grid</a>
                <a href="404.html" class="sbtn sbtn-default">404 Error</a>
                <a href="invoice.html" class="sbtn sbtn-default">Invoice</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END LEFT SIDEBAR & LOGO -->

    <!-- RESPONSIVE NAVIGATION -->
    <div id="secondary" class="btn-group visible-xs">
      <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><span class="icon icon-th-large"></span>&nbsp;&nbsp;Navigation&nbsp;&nbsp;<span class="caret"></span></button>
      <ul class="dropdown-menu dropdown-info pull-right" role="menu">
        <li><a href="index.html">Dashboard</a></li>
        <li><a href="#">Labels</a></li>
        <li><a href="#">Admin</a></li>
        <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
        <li><a href="typography.html">Typography</a></li>
        <li><a href="charts.html">Charts</a></li>
        <li><a href="widgets.html">Widgets</a></li>
        <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
        <li class="dropdown-header">UI Elements</li>
        <li><a href="alerts_notifications.html">Alerts & Notifications</a></li>
        <li><a href="tabs_accordion.html">Tabs & Accordions</a></li>
        <li><a href="buttons.html">Buttons & Icons</a></li>
        <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
        <li class="dropdown-header">Forms</li>
        <li><a href="form_basic.html">Basic Form Elements</a></li>
        <li><a href="form_advanced.html">Advanced Form Elements</a></li>
        <li><a href="form_wysiwyg.html">WYSIWYG</a></li>
        <li><a href="form_validation.html">Form Validation</a></li>
        <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
        <li class="dropdown-header">Tables</li>
        <li><a href="form_basic.html">Static Tables</a></li>
        <li><a href="form_advanced.html">jQuery Datatables</a></li>
        <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
        <li><a href="storyboard.html">Storyboard</a></li>
        <li><a href="calendar.html">Calendar</a></li>
        <li><a href="maps.html">Maps</a></li>
        <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
        <li class="dropdown-header">Pages</li>
        <li><a href="login.html">Login</a></li>
        <li><a href="FAQ.html">F.A.Q.</a></li>
        <li><a href="grid.html">Grid</a></li>
        <li><a href="grid.html">404 Error Template</a></li>
        <li><a href="invoice.html">Invoice</a></li>
      </ul>
    </div>

    <div id="secondary-search" class="input-icon visible-xs">
      <i class="icon icon-search"></i>
      <input class="form-control form-warning input-sm" type="text">
    </div>
    <!-- END RESPONSIVE NAVIGATION -->

    <!-- RIGHT NAV, CRUMBS, & CONTENT -->
    <div class="right">

      <div class="nav">
        <div class="bar">

          <!-- RESPONSIVE SMALL LOGO (HIDDEN BY DEFAULT) -->
          <div class="logo-small visible-xs"><img src="lib/img/logo3.png"></div>

          <!-- NAV PILLS -->
          <ul class="nav nav-pills hidden-xs">
            <li class="active"><a href="index.html"><span class="fa fa-dashboard"></span>Dashboard</a></li>
            <li><a href="#"><span class="icon icon-barcode"></span>Labels <span class="label label-primary">1,078</span></a></li>
            <li><a href="#"><span class="icon icon-cog"></span>Admin</a></li>
          </ul>

          <!-- ICON DROPDOWNS -->
          <div class="hov">
            <div class="btn-group">
              <a class="con" href="" data-toggle="dropdown"><span class="icon icon-bell"></span><span class="label label-danger">55</span></a>
              <ul class="dropdown-menu pull-right dropdown-alerts" role="menu">
                <li class="title"><span class="icon icon-bell"></span>&nbsp;&nbsp;There are 5 new alerts in the system...</li>
                <li class="alert">
                  <div class="alert-icon alt-default"><span class="fa fa-check-square"></span></div>
                  <div class="alert-content">Quality check was successful</div>
                  <div class="alert-time">32 sec ago</div>
                </li>
                <li class="alert">
                  <div class="alert-icon alt-primary"><span class="fa fa-plus-square"></span></div>
                  <div class="alert-content">New user added (Bob Grassle)</div>
                  <div class="alert-time">11 min ago</div>
                </li>
                <li class="alert">
                  <div class="alert-icon alt-warning"><span class="fa fa-pencil-square"></span></div>
                  <div class="alert-content">User profile updated (Steve Jones)</div>
                  <div class="alert-time">3 hours ago</div>
                </li>
                <li class="alert">
                  <div class="alert-icon alt-danger"><span class="fa fa-warning"></span></div>
                  <div class="alert-content">System failure reported</div>
                  <div class="alert-time">2 days ago</div>
                </li>
                <li class="divider"></li>
                <li><a href="#">View all recent alerts</a></li>
              </ul>
            </div>
            <div class="btn-group">
              <a class="con" href="" data-toggle="dropdown"><span class="icon icon-envelope"></span><span class="label label-success">5</span></a>
              <ul class="dropdown-menu pull-right dropdown-messages" role="menu">
                <li class="title"><span class="icon icon-envelope"></span>&nbsp;&nbsp;You have 13 new messages to read...</li>
                <li class="message">
                  <div class="message-icon"><img src="lib/img/users/1.png"></div>
                  <div class="message-content"><a href="#">Steve</a> Lorem ipsum dolor sit amet...</div>
                  <div class="message-time">32 sec ago</div>
                </li>
                <li class="message">
                  <div class="message-icon"><img src="lib/img/users/2.png"></div>
                  <div class="message-content"><a href="#">John</a> Quisque commodo sed ipsum...</div>
                  <div class="message-time">11 min ago</div>
                </li>
                <li class="message">
                  <div class="message-icon"><img src="lib/img/users/3.png"></div>
                  <div class="message-content"><a href="#">Susan</a> Consectetur adipiscing elit...</div>
                  <div class="message-time">3 hours ago</div>
                </li>
                <li class="message">
                  <div class="message-icon"><img src="lib/img/users/4.png"></div>
                  <div class="message-content"><a href="#">Barbara</a> Quisque commodo sed ipsum...</div>
                  <div class="message-time">2 days ago</div>
                </li>
                <li class="divider"></li>
                <li><a href="#">View all new messages...</a></li>
              </ul>
            </div>
            <div class="btn-group">
              <a class="con" href="" data-toggle="dropdown"><span class="icon icon-user"></span><span class="label label-primary">+5</span></a>
              <ul class="dropdown-menu pull-right dropdown-profile" role="menu">
                <li class="title"><span class="icon icon-user"></span>&nbsp;&nbsp;Welcome, Joseph!</li>
                <li><a href="#"><span class="fa fa-gears"></span>Settings</a></li>
                <li><a href="#"><span class="fa fa-user"></span>Profile</a></li>
                <li><a href="#"><span class="icon icon-envelope"></span>Messages</a></li>
                <li class="divider"></li>
                <li><a href="#"><span class="fa fa-power-off"></span>Logout</a></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- BREADCRUMBS -->
        <div class="crumbs">
          <ol class="breadcrumb hidden-xs">
            <li><i class="fa fa-home"></i> <a href="index.html">Home</a></li>
            <li class="active">Cotizaciones</li>
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
            <span class="icon icon-exclamation-sign"></span> <strong>Verifique antes de aceptar!</strong>
          </div>
        </div>
        <div class="tb1">
          <div class="col-md-12">
            <div class="wdgt">
              <form role="form">
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre Cotización">
                </div>
              </form>
            </div>
          </div>

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
        $sql = mysql_query("select * from linearecurso lr inner join recurso r where lr.codigo=r.codigo ");
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
                  
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      
                      <td><div class="center" ><button data-toggle="modal" data-target="#squarespaceModal" class="btn btn-primary center-block btn-sm"><i class="icon icon-plus sm"></i></button></div></td>
                    </tr>
                    
                  </tbody>
                </table>

              </div>
            </div>

          </div>

      


<!-- line modal -->
<div class="modal fade"  id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:75%">
  <div class="modal-content" >
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
          <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
        </div>
        <div class="btn-group btn-delete hidden" role="group">
          <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
        </div>
        <div class="btn-group" role="group">
          <button type="button" id="saveImage" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>









          <div class="col-md-12">
            <div class="wdgt wdgt-primary" hide-btn="true">
              <div class="wdgt-header">Mano de Obra</div>
              <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>Descripcion</th>
                      <th>J orn</th>
                      <th>F.P</th>
                      <th>J orn. Total</th>
                      <th>Rendimiento</th>
                      <th>Sub-Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><a href="#agregar1" class="btn btn-success btn-sm" data-toogle="modal"><i class="icon icon-plus"></i></a></td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div>

          </div>

          <div class="col-md-12">
            <div class="wdgt wdgt-primary" hide-btn="true">
              <div class="wdgt-header">Equipo y Herramientas</div>
              <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped">
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

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><a href="#agregar1" class="btn btn-success btn-sm" data-toogle="modal"><i class="icon icon-plus"></i></a></td>
                    </tr>
                  </tbody>
                </table>

              </div>
            </div>

          </div>

          <div class="col-md-12">
            <div class="wdgt wdgt-primary" hide-btn="true">
              <div class="wdgt-header">SubContratos</div>
              <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped">
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
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><a href="#agregar1" class="btn btn-success btn-sm" data-toogle="modal"><i class="icon icon-plus"></i></a></td>
                    </tr>
                  </tbody>
                </table>

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
 <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
  <script src="lib/js/bootstrap.min.js"></script>
  <script src="lib/js/hogan.min.js"></script>
  <script src="lib/js/typeahead.min.js"></script>
  <script src="lib/js/typeahead-example.js"></script>
  
  <!-- Adjustable JS -->
  <script src="lib/js/jquery.dataTables.js"></script>
  <script src="lib/js/DT_bootstrap.js"></script>
  <script src="lib/js/soft-widgets.js"></script>
  <script>
   $(document).ready(function() {
    $('.datatable').dataTable({
     "sPaginationType": "bs_full"
    }); 
    $('.datatable').each(function(){
     var datatable = $(this);
     // SEARCH - Add the placeholder for Search and Turn this into in-line form control
     var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
     search_input.attr('placeholder', 'Search');
     search_input.addClass('form-control input-sm');
     // LENGTH - Inline-Form control
     var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
     length_sel.addClass('form-control input-sm');
    });
   });
  </script>








<script>
function cantidad(nombre, codigo) {

  var cant="";


  
    cant = prompt("Indique la cantidad a agregar de "+nombre+":", "");
    
    if (cant != null) {

      window.location.replace("../sgp/insertarLR.php?cod="+codigo+"&cantidad="+cant+"");


}

}


</script> 




  
</body>

</html>