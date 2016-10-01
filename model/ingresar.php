<?php 
error_reporting(0);
     require("connect_db.php");
        $codigoError= null;
        $nombreError=null;
        $unidadError=null;
        $costoDirectoError=null;
      // $ivaError=null;
        $fechaError=null;
        $empresaError=null;
        $tipoError= null;


        // post values
        $codigo =$_POST['codigo'];
        $nombre = $_POST['nombre'];
        $unidad = $_POST['unidad'];
        $costoDirecto =$_POST['costoDirecto'];
       // $iva = $_POST['iva'];
        $fecha = $_POST['fecha'];
        $empresa =$_POST['empresa'];
        $tipo =$_POST['tipo'];
       
        
        // validate input
    if ( !empty($_POST)) {

        $valid = true;
        if(empty($codigo)) {
            $codigoError = 'Por favor ingrese el codigo del recurso.';
            $valid = false;
        }

        if(empty($nombre)) {
            $nombreError = 'Por favor ingrese el nombre.';
            $valid = false;
        }

        if(empty($unidad)) {
            $unidadError = 'Por favor ingrese la unidad del recurso.';
            $valid = false;
        }

        if(empty($costoDirecto)) {
            $costoDirectoError = 'Por favor ingrese el costo directo';
            $valid = false;
        }

        if(empty($fecha)) {
            $fechaError = 'Por favor ingrese la fecha de ingreso ';
            $valid = false;
        }

        if(empty($empresa)) {
            $empresaError = 'Por favor ingrese el nombre de la empresa consultada ';
            $valid = false;
        }

        if(empty($tipo)) {
            $tipoError = 'Por favor seleccione el tipo.';
            $valid = false;
        }
        
         if ($valid) { 
            require("connect_db.php");
            $sql =  mysql_query("INSERT INTO recurso (codigo, nombre, unidad, costoDirecto, fecha, empresa, tipo)  values('".$codigo."','".$nombre."','".$unidad."','".$costoDirecto."','".$fecha."','".$empresa."','".$tipo."')");
            $stmt = mysql_fetch_array($sql);
            header("Location: ingresar.php");
        }
    }
    
?>



<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Basic Form Elements // Soft Admin</title>
  
  <!-- Default Styles (DO NOT TOUCH) -->
  <link rel="stylesheet" href="lib/css/font-awesome.min.css">
  <link rel="stylesheet" href="lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="lib/css/fonts.css">
  <link type="text/css" rel="stylesheet" href="lib/css/soft-admin.css"/>
  
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
         <span class="fa fa-dashboard"></span>
         &nbsp;&nbsp;Dashboard
        </a>
       </div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="typography.html">
         <span class="icon icon-text-width"></span>
         &nbsp;&nbsp;Typography
        </a>
       </div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="charts.html">
         <span class="fa fa-bar-chart-o"></span>
         &nbsp;&nbsp;Charts
        </a>
       </div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="widgets.html">
         <span class="fa fa-list-alt"></span>
         &nbsp;&nbsp;Widgets
        </a>
       </div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" data-toggle="collapse" href="#c-ui">
         <span class="icon icon-credit-card"></span>
         &nbsp;&nbsp;UI Elements
         <span class="caret"></span>
        </a>
       </div>
       <div id="c-ui" class="accordion-body collapse"><div class="accordion-inner">
        <a href="alerts_notifications.html" class="sbtn sbtn-default">Alerts & Notifications <span class="label label-primary">9</span></a>
        <a href="tabs_accordion.html" class="sbtn sbtn-default">Tabs & Accordions</a> 
        <a href="buttons.html" class="sbtn sbtn-default">Buttons & Icons</a> 
       </div></div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="gallery.html">
         <span class="fa fa-picture-o"></span>
         &nbsp;&nbsp;Gallery
        </a>
       </div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn sbtn-default" data-toggle="collapse" href="#c-forms">
         <span class="fa fa-pencil-square-o"></span>
         &nbsp;&nbsp;Forms
         <span class="caret"></span>
        </a>
       </div>
       <div id="c-forms" class="accordion-body collapse in"><div class="accordion-inner">
        <a href="form_basic.html" class="sbtn sbtn-default active">Basic Form Elements</a>
        <a href="form_advanced.html" class="sbtn sbtn-default">Advanced Form Elements</a>
        <a href="form_wysiwyg.html" class="sbtn sbtn-default">WYSIWYG</a>
        <a href="form_validation.html" class="sbtn sbtn-default">Form Validation</a>
       </div></div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" data-toggle="collapse" href="#c-tables">
         <span class="fa fa-table"></span>
         &nbsp;&nbsp;Tables
         <span class="caret"></span>
        </a>
       </div>
       <div id="c-tables" class="accordion-body collapse"><div class="accordion-inner">
        <a href="table_static.html" class="sbtn sbtn-default">Static Tables <span class="label label-soft">2</span></a>
        <a href="table_datatables.html" class="sbtn sbtn-default">jQuery Datatables</a> 
       </div></div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="storyboard.html">
         <span class="fa fa-tasks"></span>
         &nbsp;&nbsp;Storyboard
        </a>
       </div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="calendar.html">
         <span class="fa fa-calendar"></span>
         &nbsp;&nbsp;Calendar
        </a>
       </div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="maps.html">
         <span class="fa fa-map-marker"></span>
         &nbsp;&nbsp;Maps
        </a>
       </div>
      </div>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" data-toggle="collapse" href="#c-pages">
         <span class="fa fa-file-o"></span>
         &nbsp;&nbsp;Pages
         <span class="caret"></span>
        </a>
       </div>
       <div id="c-pages" class="accordion-body collapse"><div class="accordion-inner">
        <a href="login_register.html" class="sbtn sbtn-default">Login</a>
        <a href="FAQ.html" class="sbtn sbtn-default">F.A.Q.</a>
        <a href="grid.html" class="sbtn sbtn-default">Grid</a>
        <a href="404.html" class="sbtn sbtn-default">404 Error</a> 
        <a href="invoice.html" class="sbtn sbtn-default">Invoice</a>
       </div></div>
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
      <div class="logo-small visible-xs"><img src="lib/img/logo.png"></div>
      
      <!-- NAV PILLS -->
      <ul class="nav nav-pills hidden-xs">
        <li class="active"><a href="princial.html"><span class="fa fa-dashboard"></span>M</a></li>
        <li><a href="consultar.html"><span class="icon icon-cog"></span>C</a></li>
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
       <li><i class="fa fa-home"></i> <a href="#">Inicio</a></li>
       <li><a href="menu_recursos.html">Recursos</a></li>
       <li class="active">Ingresar Recurso</li>
      </ol>
     </div>
    </div>
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Ingresar Recurso <small>//</small></h1>
     </div>
     <div class="tbl">
      <div class="col-md-11">
       <div class="wdgt">
        <div class="wdgt-header">Recurso</div>
        <div class="wdgt-body" style="padding-bottom:10px;">

          <form method="POST" action="">
          <!-- CODIGO -->
          <div class="form-group <?php echo !empty($codigoError)?'has-error':'';?>">
           <label>Codigo de Recurso</label>
           <input type="text" class="form-control" required="required" id="inputFName" placeholder="codigo" name="codigo" value="<?php echo $codigo?$codigo:'';?>" >
           <span class="help-block"><?php echo $codigoError?$codigoError:'';?></span>
          </div>
          <!-- NOMBRE -->
          <div class="form-group <?php echo !empty($nombreError)?'has-error':'';?>">
           <label>Nombre de Recurso</label>
           <input type="text" class="form-control" required="required" id="inputFName" placeholder="nombre" name="nombre" value="<?php echo $nombre?$nombre:'';?>" >
           <span class="help-block"><?php echo $nombreError?$nombreError:'';?></span>
          </div>
          <!-- UNIDAD -->
           <div class="form-group <?php echo !empty($unidadError)?'has-error':'';?>">
           <label>Unidad del Recurso</label>
           <input type="text" class="form-control" required="required" id="inputFName" placeholder="unidad" name="unidad" value="<?php echo $unidad?$unidad:'';?>" >
           <span class="help-block"><?php echo $unidadError?$unidadError:'';?></span>
          </div>
          <!-- COSTO DIRECTO -->
           <div class="form-group <?php echo !empty($costoDirectoError)?'has-error':'';?>">
           <label>Costo Directo del Recurso</label>
           <input type="text" class="form-control" required="required" id="inputFName" placeholder="costoDirecto" name="costoDirecto" value="<?php echo $costoDirecto?$costoDirecto:'';?>" >
           <span class="help-block"><?php echo $costoDirectoError?$costoDirectoError:'';?></span>
          </div>
          <!-- FECHA -->
           <div class="form-group <?php echo !empty($fechaError)?'has-error':'';?>">
           <label>Fecha de modificación</label>
           <input type="text" class="form-control" required="required" id="inputFName" placeholder="fecha" name="fecha" value="<?php echo $fecha?$fecha:'';?>" >
           <span class="help-block"><?php echo $fechaError?$fechaError:'';?></span>
          </div>
          <!-- EMPRESA -->
           <div class="form-group <?php echo !empty($empresaError)?'has-error':'';?>">
           <label>Empresa proveedora</label>
           <input type="text" class="form-control" required="required" id="inputFName" placeholder="empresa" name="empresa" value="<?php echo $empresa?$empresa:'';?>" >
           <span class="help-block"><?php echo $empresaError?$empresaError:'';?></span>
          </div>

          <div class="form-group <?php echo !empty($tipoError)?'has-error':'';?>">
           <label for="disabledSelect">Seleccionar tipo de recurso</label>
           <select id="disabledSelect" class="form-control form-primary" name="tipo" required="required" id="inputFName">
            <option value="Materiales" <?php echo $tipo == 'Materiales'?'selected':'';?>>Materiales</option>
            <option value="Herramientas" <?php echo $tipo == 'Herramientas'?'selected':'';?>>Herramientas</option>
            <option value="Ladrillo y block" <?php echo $tipo == 'Ladrillo y block'?'selected':'';?>>Ladrillo y block</option>
            <option value="Copresa" <?php echo $tipo == 'Copresa'?'selected':'';?>>Copresa</option>
            <option value="Caños" <?php echo $tipo == 'Caños'?'selected':'';?>>Caños</option>
            <option value="Tubos" <?php echo $tipo == 'Tubos'?'selected':'';?>>Tubos</option>
            <option value="Angulo" <?php echo $tipo == 'Angulo'?'selected':'';?>>Angulo</option>
            <option value="Madera" <?php echo $tipo == 'Madera'?'selected':'';?>>Madera</option>
            <option value="Clavos" <?php echo $tipo == 'Clavos'?'selected':'';?>>Clavos</option>
            <option value="Hierros" <?php echo $tipo == 'Hierros'?'selected':'';?>>Hierros</option>
            <option value="Canchas de futbol" <?php echo $tipo == 'Canchas de futbol'?'selected':'';?>>Canchas de futbol</option>
            <option value="Luminarias" <?php echo $tipo == 'Luminarias'?'selected':'';?>>Luminarias</option>
            <option value="Cable electrico" <?php echo $tipo == 'Cable electrico'?'selected':'';?>>Cable electrico</option>
            <option value="Gastos Oficina" <?php echo $tipo == 'Gastos Oficina'?'selected':'';?>>Gastos Oficina</option>
            <option value="Juegos infantiles" <?php echo $tipo == 'Juegos infantiles'?'selected':'';?>>Juegos infantiles</option>
            <option value="Maquinaria y Equipo" <?php echo $tipo == 'Maquinaria y Equipo'?'selected':'';?>>Maquinaria y Equipo</option>
            <option value="EMCO" <?php echo $tipo == 'EMCO'?'selected':'';?>>EMCO</option>
            <option value="K-TECHAR" <?php echo $tipo == 'K-TECHAR'?'selected':'';?>>K-TECHAR</option>
           </select>
           <span class="help-block"><?php echo $tipoError?$tipoError:'';?></span>
          </div>

          <div class="form-actions">
        <button type="submit" class="btn btn-success">Guardar</button>
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
  <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
  <script src="lib/js/bootstrap.min.js"></script>
  <script src="lib/js/hogan.min.js"></script>
  <script src="lib/js/typeahead.min.js"></script>
  <script src="lib/js/typeahead-example.js"></script>
  
  <!-- Adjustable JS -->
  
 </body>
</html>

?>