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
     require("connect_db.php");
       // $codigoError= null;
        $nombreError=null;
        $unidadError=null;
        $costoDirectoError=null;
      // $ivaError=null;
      //  $fechaError=null;
        $empresaError=null;
        $tipoError= null;
        $check1=(is_int($costoDirecto));


        // post values
        //$codigo =$_POST['codigo'];
        $nombre = $_POST['nombre'];
        $unidad = $_POST['unidad'];
        $costoDirecto =$_POST['costoDirecto'];
       // $iva = $_POST['iva'];
       // $fecha = $_POST['fecha'];
        $empresa =$_POST['empresa'];
        $tipo =$_POST['tipo'];
       
        
        // validate input
    if ( !empty($_POST)) {

        $valid = true;
      //  if(empty($codigo)) {
     //       $codigoError = 'Por favor ingrese el codigo del recurso.';
      //      $valid = false;
     //   }

        if(empty($nombre)) {
            $nombreError = 'Por favor ingrese el nombre.';
            $valid = false;
        }

        if(empty($unidad)) {
            $unidadError = 'Por favor ingrese la unidad del recurso.';
            $valid = false;
        }

        if ($check1==true) {
           if(empty($costoDirecto)) {
            $costoDirectoError = 'Por favor ingrese el costo directo';
            $valid = false;
        }
      }else{
        $costoDirectoError = 'Por favor ingrese un valor numero';
      }

       

      // if(empty($fecha)) {
        //    $fechaError = 'Por favor ingrese la fecha de ingreso ';
       //     $valid = false;
       // }

        if(empty($empresa)) {
            $empresaError = 'Por favor ingrese el nombre de la empresa consultada ';
            $valid = false;
        }

        if(empty($tipo)) {
            $tipoError = 'Por favor seleccione el tipo.';
            $valid = false;
        }
        
         if ($valid) { 
            require_once "../services/conn.php";
            $iva = $costoDirecto * 0.13;
            $total = $costoDirecto + $iva;
            $fecha = new DateTime();


           $db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();

            $sql =  $db->query("INSERT INTO recurso (nombre, unidad, costoDirecto, iva, total, fecha, empresaProveedora, tipoRecurso) VALUES ('".$nombre."', '".$unidad."', ".$costoDirecto.", ".$iva.", ".$total.", '".$fecha->format("Y-m-d")."', '".$empresa."', '".$tipo."')");
            if(!$sql){ 
              $str = "error";
            }else{          
                $str = "success";
                 
             }
            header("Location: ingresar.php?".$str);

        //header("Location: ingresar.php");
        }

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
       <li><a href="ingresar.php">Recursos</a></li>
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
      
         <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
          <?php
          if (isset($_GET["error"])) {
            
         ?>

          <div class="alertDiv alert alert-danger alert-round alert-border alert-soft">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <span class="icon icon-remove-sign"></span> 
             Se ha producido un error en la conexión a la base de datos, por favor intente realizar esta operación. 
              
                
          </div>
           <?php
           header("Location: ingresar.php");
          } else if (isset($_GET["success"])){
        ?>
          <div class="alertDiv alert alert-success alert-round alert-border alert-soft">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <span class="icon icon-ok-sign" ></span>
             Se ha ingresado correctamente el nuevo Recurso
            </div>
        <?php
           header("Location: ingresar.php");
          } 
         
        ?>

          <form id="recurso-form" method="POST" action="">
          
          <div class="form-group <?php echo !empty($nombreError)?'has-error':'';?>">
           <label>Nombre de Recurso</label>
           <input type="text" class="form-control" required id="inputFName" placeholder="nombre" name="nombre" value="<?php echo $nombre?$nombre:'';?>" >
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
           <input type="number" step="0.01" min="0.00" class="form-control" required="required" id="inputFName" placeholder="costoDirecto" name="costoDirecto" value="<?php echo $costoDirecto?$costoDirecto:'';?>" >
           <span class="help-block"><?php echo $costoDirectoError?$costoDirectoError:'';?></span>
          </div>
          <!-- FECHA type="number" step="0.01" min="0.00"
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
        <button class="btn btn-primary" type="submit">Guardar</button>
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
  
  <!-- Default JS (DO NOT TOUCH) 
  <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
  <script src="lib/js/bootstrap.min.js"></script>
  <script src="lib/js/hogan.min.js"></script>
  <script src="lib/js/typeahead.min.js"></script>
  <script src="lib/js/typeahead-example.js"></script>-->

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
        $("#recurso-form").bootstrapValidator({
          fields : {
            nombre : {
              validators: {
                notEmpty : {
                  message : "Este campo no puede estar vacio"
                }
              }
            },
            unidad : {
              validators : {
                notEmpty : {
                  message : "Este campo no puede estar vacio"
                }
                
              }
            },
            costoDirecto: {
              validators : {
                notEmpty: {
                  message: 'Este campo no puede estar vacio'
                  },
                numeric:{
                  message: 'Este campo debe ser numerico'
                }
              }
            },
            empresa: {
              validators : {
                notEmpty: {
                  message: 'Este campo no puede estar vacio'
                  },
              }
            },
            tipo: {
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