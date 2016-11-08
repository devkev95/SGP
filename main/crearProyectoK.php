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
    require'../services/conn.php';
    error_reporting(0);

    $nombre = $_POST['nombre'];
    $descripcion = $_POST["descripcion"];
    $fechaInicio = $_POST["fechaInicio"];
    $fechaFin = $_POST["fechaFin"];
    $porcentaje_indirecto= $_POST["porcentajeCI"];

    $pci = round(($porcentaje_indirecto / 100), 2);

    
    $conn = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();




      $query = "INSERT INTO proyecto(nombre, descripcion, porcentajeCI, fechaInicio, fechaFin) VALUES ('".$nombre."', '".$descripcion."', '".$pci."', '".$fechaInicio."', '".$fechaFin."')";

      if ($conn->query($query)) {
          $id = $conn->insert_id;
          
        header("Location: crearEtapa.php?id=".$id);
      }else{
      
        
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

   <script src="../lib/JS/bootstrap-datepicker.js"></script> 
   <script> $('.datepicker').datepicker({ format : 'yyyy-mm-dd' }); </script>
  

  <!-- link calendar resources -->
  <link rel="stylesheet" type="text/css" href="../lib/CSS/tcal.css" >
  <script type="text/javascript" src="../lib/JS/tcal.js"></script> 
  <!-- Adjustable Styles -->
  
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
        <a href="consultarPartidas.php" class="sbtn sbtn-default">Ver Partidas</a>
        <a href="crear_partida.php" class="sbtn sbtn-default">Crear Partida</a> 
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
        <a href="tabla_recursos.php" class="sbtn sbtn-default">Ver Recursos</a>
        <a href="ingresar.php" class="sbtn sbtn-default active">Agregar Nuevo Recurso</a>
       </div></div>
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
      <li><a href="home.php">Home</a></li>
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
    <input class="form-control form-warning input-sm" type="text">
   </div>
   <!-- END RESPONSIVE NAVIGATION -->
    
   
   <!-- RIGHT NAV, CRUMBS, & CONTENT -->
   <div class="right">
   
    <div class="nav">
     <div class="bar">
      
      <!-- RESPONSIVE SMALL LOGO (HIDDEN BY DEFAULT) -->
      <div class="logo-small visible-xs"><img  style="width:120px; !important; height:32px; !important" src="../Imagenes/logo.png"></div>
      
      <!-- NAV PILLS 
      <ul class="nav nav-pills hidden-xs">
        <li class="active"><a href="princial.html"><span class="fa fa-dashboard"></span>M</a></li>
        <li><a href="consultar.html"><span class="icon icon-cog"></span>C</a></li>
      </ul>-->
      
      <!-- ICON DROPDOWNS -->
      <div class="hov">

       <div class="btn-group">
        <a class="con" href="" data-toggle="dropdown"><span class="icon icon-user"></span></a>
         <ul class="dropdown-menu pull-right dropdown-profile" role="menu">
          <li class="title"><span class="icon icon-user"></span>&nbsp;&nbsp;Bienvenido, <?= $userData->getNombres()?></li>
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
       <li><a href="proyectos.php">Proyectos</a></li>
       <li class="active">Nuevo Proyecto</li>
      </ol>
     </div>
    </div>
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Datos Proyecto  <small>//</small></h1>
     </div>
     <div class="tbl">
      <div class="col-md-11">
       <div class="wdgt">
        <div class="wdgt-header">Proyecto</div>
      
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
           header("Location: crearProyectoK.php");
          } else if (isset($_GET["success"])){
        ?>
          <div class="alertDiv alert alert-success alert-round alert-border alert-soft">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <span class="icon icon-ok-sign" ></span>
             Se ha ingresado correctamente.
            </div>
        <?php
           header("Location: crearProyectoK.php");
          } 
         
        ?>

          <form id="proyecto-form" method="POST" action="">
          <!-- Nombre -->
          <div class="form-group">
           <label>Nombre de Proyecto</label>
           <input type="text" class="form-control" required id="inputFName" placeholder="nombre" name="nombre"  >
           <span class="help-block"></span>
          </div>
          <!-- Descripcion -->
           <div class="form-group">
           <label>Descripcion</label>
           <input type="text" class="form-control" required="required" id="inputFName" placeholder="descripcion" name="descripcion"  >
           <span class="help-block"></span>
          </div>
          <!-- Porcentaje Costo Indirecto -->
           <div class="form-group">
           <label>Porcejate Costo Indirecto</label>
           <input type="number" step="1" min="0.00" class="form-control" required="required" placeholder="Porcentaje"id="inputFName" name="porcentajeCI" >
           <span class="help-block"></span>
          </div>
           <!-- Fecha Inicio -->
          <div class="form-group">
            <label>Fecha Inicio</label>
            <br>
             <input type="date"  required id="inputFName" placeholder="FechaInicio" name="fechaInicio">
            <span class="help-block" ></span>
          </div>
           <!-- Fecha Fin -->
          <div class="form-group">
            <label>Fecha Fin</label>
            <br>
            <input type="date"  required id="inputFName" placeholder="FechaFin" name="fechaFin"  >
            <span class="help-block"></span>
          </div>   
                <div class="form-actions">
        <button id="principal" class="btn btn-success btn-lg" type="submit" name="guardar" value="Guardar">Siguiente >></button>
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
  <script src="../lib/JS/soft-widgets.js"></script>
   <script type="text/javascript" src="../lib/JS/bootstrapValidator.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $("#proyecto-form").bootstrapValidator({
          fields : {
            nombre : {
              validators: {
                notEmpty : {
                  message : "Este campo no puede estar vacio"
                }
              }
            },
            descripcion : {
              validators : {
                notEmpty : {
                  message : "Este campo no puede estar vacio"
                }
                
              }
            },
            porcentajeCI: {
              validators : {
                notEmpty: {
                  message: 'Este campo no puede estar vacio'
                  },
                numeric:{
                  message: 'Este campo debe ser numerico'
                }
              }
            },
            fechaInicio: {
              validators : {
                notEmpty: {
                  message: 'Este campo no puede estar vacio'
                  },
              }
            },
            fechaFin: {
              validators : {
                notEmpty: {
                  message: 'Este campo no puede estar vacio'
                  },
              }
            }
          }
        });
      });
  </script> 
  
 </body>
</html>


?>