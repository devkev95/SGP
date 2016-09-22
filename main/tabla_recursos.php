<?php
  
  require '../model/Usuario.php';

  session_start();

  if (!isset($_SESSION["userData"])){
    session_destroy();
    header("Location: ../index.php");
    exit();
  }
  $userData = $_SESSION["userData"];
  session_write_close();
?>


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
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DIAZA, S.A DE C.V</title>
  
  <!-- Default Styles (DO NOT TOUCH) -->
  <link rel="stylesheet" href="../lib/CSS/font-awesome.min.css">
  <link rel="stylesheet" href="../lib/CSS/bootstrap.min.css">
  <link rel="stylesheet" href="../lib/CSS/fonts.css">
  <link type="text/css" rel="stylesheet" href="../lib/CSS/soft-admin.css"/>
  
  <!-- Adjustable Styles -->
  <link type="text/css" rel="stylesheet" href="lib/css/DT_bootstrap.css"/>
  
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
     <div>
      <input class="typeahead" type="text" placeholder="Search">
      <span id="search-icon" class="glyphicon glyphicon-search"></span>
     </div>
      <div class="accordion">
      
        <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default active" href="home.php">
         <span class="fa fa-home"></span>
         &nbsp;&nbsp;Home
        </a>
       </div>
      </div>
      <?php if ($userData->getPerfil() == "Administrador"){ ?>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="admin/users.php">
         <span class="fa fa-users"></span>
         &nbsp;&nbsp;Usuarios
        </a>
       </div>
      </div>
      <?php } ?>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" data-toggle="collapse" href="#c-tables">
         <span class="fa fa-table"></span>
         &nbsp;&nbsp;Partidas
         <span class="caret"></span>
        </a>
       </div>
       <div id="c-tables" class="accordion-body collapse"><div class="accordion-inner">
        <a href="table_static.html" class="sbtn sbtn-default">Ver Partidas<span class="label label-soft">2</span></a>
        <a href="table_datatables.html" class="sbtn sbtn-default">Crear Partida</a> 
       </div></div>
      </div>

      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn sbtn-default" data-toggle="collapse" href="#c-forms">
         <span class="fa fa-pencil-square-o"></span>
         &nbsp;&nbsp;Recursos
         <span class="caret"></span>
        </a>
       </div>
       <div id="c-forms" class="accordion-body collapse in"><div class="accordion-inner">
        <a href="tabla_recursos.php" class="sbtn sbtn-default active">Ver Recursos</a>
        <a href="ingresar.php" class="sbtn sbtn-default">Agregar Nuevo Recurso</a>
       </div></div>
      </div>
      
     </div>
    </div>
   </div>
   
<!-- RESPONSIVE NAVIGATION -->
   <div id="secondary" class="btn-group visible-xs">
    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><span class="icon icon-th-large"></span>&nbsp;&nbsp;Menu&nbsp;&nbsp;<span class="caret"></span></button>
    <ul class="dropdown-menu dropdown-info pull-right" role="menu">
      <li><a href="home.php">Home</a></li>
      <li class="dropdown-header">Recursos</li>
      <li><a href="tabla_recursos.php">Ver Recursos</a></li>
      <li><a href="ingresar.php">Agregar Recurso</a></li>
      <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
      <li class="dropdown-header">Partidas</li>
      <li><a href="">Ver Partidas</a></li>
      <li><a href="form_advanced.html">Crear Partida</a></li>
      <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
    </ul>
   </div>
   
   <div id="secondary-search" class="input-icon visible-xs">
    <i class="icon icon-search"></i>
    <input class="form-control form-warning input-sm" type="text">
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
      <div class="logo-small visible-xs"><img  style="width:120px; !important; height:32px; !important" src="../Imagenes/logo.png"></div>
      
  
       <!-- ICON DROPDOWNS -->
      <div class="hov">
     
       
       <div class="btn-group">
        <a class="con" href="" data-toggle="dropdown"><span class="icon icon-user"></span></a>
         <ul class="dropdown-menu pull-right dropdown-profile" role="menu">
          <li class="title"><span class="icon icon-user"></span>&nbsp;&nbsp;Bienvenido, <?= $userData->getNombres()?></li>
            <li><a href="../services/user/logout.php"><span class="fa fa-power-off"></span>Desconectar</a></li>
         </ul>
        </div>
      </div>
     </div>
     
     
     <!-- BREADCRUMBS -->
     <div class="crumbs">
      <ol class="breadcrumb hidden-xs">
       <li><i class="fa fa-home"></i> <a href="home.php">Home</a></li>
       <li><a href="tabla_recursos.php">Recursos</a></li>
       <li class="active">Ver Recursos</li>
      </ol>
     </div>
    </div>
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Recursos <small></small></h1>
     </div>
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


        echo "

          <td class='center'>

          
          
          <input style='max-width: 5%;' onClick=\"window.location.href='editarRecursos.php?codigo=$row[codigo]';\" type='image' src='../Imagenes/editar.png'>
          &nbsp;&nbsp;&nbsp;
          <input style='max-width: 5%;' onClick=\"if(confirm('Se eliminará este registro')) window.location.href='eliminarRecurso.php?cod=$row[codigo]';\" type='image' src='../Imagenes/eliminar.png'> 

           </td>";


      


        
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
  
 </body>
</html>