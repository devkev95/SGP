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

error_reporting(0);
    require("connect_db.php");
     // $codigo = null;

        $codigoError= null;
        $nombreError=null;
        $unidadError=null;
        $costoDirectoError=null;
      // $ivaError=null;
      //  $fechaError=null;
        $empresaError=null;
        $tipoError= null;


       
        
    
    if(!empty($_GET['codigo']))
    {
        $codigo = $_GET['codigo'];
       // echo $codigo;
    }
    if($codigo == null)
    {
        header("Location: tabla_recursos.php");
    } 
    if ( !empty($_POST))
    {
        //require("connect_db.php");
        // validation errors
       
        $codigoError= null;
        $nombreError=null;
        $unidadError=null;
        $costoDirectoError=null;
        $empresaError=null;
        $tipoError= null;
        
        // post values
        $nombre = $_POST['nombre'];
        $unidad = $_POST['unidad'];
        $costoDirecto =$_POST['costoDirecto'];
        $empresa =$_POST['empresa'];
        $tipo =$_POST['tipo'];
        
        
        // validate input
        $valid = true;

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

        if(empty($empresa)) {
            $empresaError = 'Por favor ingrese el nombre de la empresa consultada ';
            $valid = false;
        }

        if(empty($tipo)) {
            $tipoError = 'Por favor seleccione el tipo.';
            $valid = false;
        }
        // update data
        if ($valid) {
       
            $sql = mysql_query("CALL sp_updateRecurso('".$codigo."','".$nombre."','".$unidad."','".$costoDirecto."','".$empresa."','".$tipo."')");
            $stmt = mysql_fetch_array($sql);
            header("Location: tabla_recursos.php");
        }
    }
    else{
       //require("connect_db.php");
        
        $sql1 = mysql_query("CALL sp_select('1','".$codigo."')");
        $data = mysql_fetch_array($sql1);
       
        if (empty($data)){
            header("Location: editarRecursos.php");
        }
        $nombre  = $data['nombre'];
        $unidad =$data['unidad'];
        $costoDirecto = $data['costoDirecto'];   
        $empresa = $data['empresaProveedora'];
        $tipo = $data['tipoRecurso'];
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
       <li class="active">Editar Recurso</li>
      </ol>
     </div>
    </div>
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Editar Recurso <small>//</small></h1>
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
          <!-- FECHA 
           <div class="form-group <?php //echo !empty($fechaError)?'has-error':'';?>">
           <label>Fecha de modificación</label>
           <input type="text" class="form-control" required="required" id="inputFName" placeholder="fecha" name="fecha" value="<?php echo $fecha?$fecha:'';?>" >
           <span class="help-block"><?php echo $fechaError?$fechaError:'';?></span>
          </div>-->
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
  <script src="../lib/JS/jquery-3.1.0.min.js"></script>
  <script src="../lib/JS/bootstrap.min.js"></script>
  <script src="../lib/JS/hogan.min.js"></script>
  <script src="../lib/JS/typeahead.min.js"></script>
  <script src="../lib/JS/typeahead-example.js"></script>
  <!-- Adjustable JS -->
  <script src="../lib/JS/soft-widgets.js"></script>
  
 </body>
</html>

?>