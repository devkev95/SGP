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
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Datatables // Soft Admin</title>
  
  <!-- Default Styles (DO NOT TOUCH) -->
  <link rel="stylesheet" href="../lib/CSS/font-awesome.min.css">
  <link rel="stylesheet" href="../lib/CSS/bootstrap.min.css">
  <link rel="stylesheet" href="../lib/CSS/fonts.css">
  <link type="text/css" rel="stylesheet" href="../lib/CSS/soft-admin.css"/>
  
  <!-- Adjustable Styles -->
  <link type="text/css" rel="stylesheet" href="../lib/CSS/DT_bootstrap.css"/>
  
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
   <script src="../lib/JS/html5shiv.js"></script>
   <script src="../lib/JS/respond.min.js"></script>
  <![endif]-->

 </head>
 <body onLoad="borrar_registros()">
 
  <div class="cntnr">
   
   <!-- RESPONSIVE LEFT SIDEBAR & LOGO -->
   <div class="left hidden-xs">
    <div class="logo"> <img id="logo" src="../Imagenes/logo.png" style="width:159px !important; height:52px; !important"> </div>
    <div class="sidebar">
     <div class="accordion">
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="home.php">
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
       <div id="c-forms" class="accordion-body collapse"><div class="accordion-inner">
        <a href="tabla_recursos.php" class="sbtn sbtn-default">Ver Recursos</a>
        <a href="ingresar.php" class="sbtn sbtn-default">Agregar Nuevo Recurso</a>
       </div></div>
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
    <input class="form-control form-warning input-sm" type="text">
   </div>
   <!-- END RESPONSIVE NAVIGATION -->   
   
   <!-- RIGHT NAV, CRUMBS, & CONTENT -->
   <div class="right">
   
    <div class="nav">
    <div class="bar">

      <div class="logo-small visible-xs"><img  style="width:120px; !important; height:32px; !important" src="../Imagenes/logo.png"></div>
      
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
       <li><i class="fa fa-home"></i> <a href="../home.php">Home</a></li>
       <li class="active">Proyectos</li>
      </ol>
     </div>
    </div>
    
    <!-- BEGIN PAGE CONTENT -->

    <div class="content">
     <div class="page-h1">
      <h1>Proyectos <small>// Proyectos en General</small></h1>
     </div>
     <div class="tbl">
      <div class="col-md-12">
         
                <a href="crearProyectoK.php" class="btn btn-success btn-lg" >Crear Proyecto</a>

       <div class="wdgt" hide-btn="true">
         
        <div class="wdgt-header">Base de Datos de Proyectos</div>
        <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
         <table class="datatable table table-hover table-striped">
          <thead>
            <tr>
           <th>Nombre</th>
           <th>Estado</th>
           <th></th>
            </tr>
          </thead>
          <tbody>
            <tr> 

           <td>Jim Stevens</td>
           <td>
            <span class="label label-success">Premium User</span>
            <span class="label label-warning">CC Out of Date</span>
           </td>
           <td>
            <button type="button" class="btn btn-primary btn-xs"><i class="icon icon-camera"></i></button>
            <button type="button" class="btn btn-info btn-xs"><i class="icon icon-bookmark"></i></button>
            <button type="button" class="btn btn-soft btn-xs"><i class="icon icon-edit"></i></button>
           </td>
            </tr>
            <tr>
 
           <td>Mark Matthew</td> 
           <td>
            <span class="label label-success">Premium User</span>
           </td>
           <td>
            <button type="button" class="btn btn-primary btn-xs"><i class="icon icon-camera"></i></button>
            <button type="button" class="btn btn-info btn-xs"><i class="icon icon-bookmark"></i></button>
            <button type="button" class="btn btn-soft btn-xs"><i class="icon icon-edit"></i></button>
           </td>
            </tr>
            <tr>
            
           <td>Gus Johanson</td> 
           <td>
            <span class="label label-info">Basic User</span>
           </td>
           <td>
            <button type="button" class="btn btn-primary btn-xs"><i class="icon icon-camera"></i></button>
            <button type="button" class="btn btn-info btn-xs"><i class="icon icon-bookmark"></i></button>
            <button type="button" class="btn btn-soft btn-xs"><i class="icon icon-edit"></i></button>
           </td>
            </tr>
            <tr>   
           <td>Greg McGinty</td>
           
           <td>
            <span class="label label-info">Basic User</span>
           </td>
           <td>
            <button type="button" class="btn btn-primary btn-xs"><i class="icon icon-camera"></i></button>
            <button type="button" class="btn btn-info btn-xs"><i class="icon icon-bookmark"></i></button>
            <button type="button" class="btn btn-soft btn-xs"><i class="icon icon-edit"></i></button>
           </td>
            </tr>
            <tr>
            
           <td>Art Fredericks</td>  
           <td>
            <span class="label label-success">Premium User</span>
           </td>
           <td>
            <button type="button" class="btn btn-primary btn-xs"><i class="icon icon-camera"></i></button>
            <button type="button" class="btn btn-info btn-xs"><i class="icon icon-bookmark"></i></button>
            <button type="button" class="btn btn-soft btn-xs"><i class="icon icon-edit"></i></button>
           </td>
            </tr>
            <tr>
            
           <td>Frank Bellamy</td>
           <td>
            <span class="label label-success">Premium User</span>
            <span class="label label-warning">CC Out of Date</span>
           </td>
           <td>
            <button type="button" class="btn btn-primary btn-xs"><i class="icon icon-camera"></i></button>
            <button type="button" class="btn btn-info btn-xs"><i class="icon icon-bookmark"></i></button>
            <button type="button" class="btn btn-soft btn-xs"><i class="icon icon-edit"></i></button>
           </td>
            </tr>
            <tr>
            
           <td>Freddy Mason</td>
           <td>
            <span class="label label-info">Basic User</span>
           </td>
           <td>
            <button type="button" class="btn btn-primary btn-xs"><i class="icon icon-camera"></i></button>
            <button type="button" class="btn btn-info btn-xs"><i class="icon icon-bookmark"></i></button>
            <button type="button" class="btn btn-soft btn-xs"><i class="icon icon-edit"></i></button>
           </td>
            </tr>
          </tbody>
         </table>

        </div>
       </div>

      </div>
     </div>

     <div class="tbl">
      <div class="col-md-6">
       <div class="wdgt">
        <div class="wdgt-header">Avance Proyectos</div>
        <div class="wdgt-body" style="padding-bottom:10px;">
         <div id="hero-bar" class="graph"></div>
        </div>
       </div>
      </div>
      <div class="col-md-6">
       <div class="wdgt">
        <div class="wdgt-header">Estado Proyectos</div>
        <div class="wdgt-body" style="padding-bottom:10px;">
         <div id="hero-donut" class="graph"></div>
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
     search_input.attr('placeholder', 'Buscar');
     search_input.addClass('form-control input-sm');
     // LENGTH - Inline-Form control
     var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
     length_sel.addClass('form-control input-sm');
    });
   });
  </script>
  
 </body>
</html>