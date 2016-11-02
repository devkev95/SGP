<?php 

require'../services/conn.php';
require_once '../model/Usuario.php';

  session_start();

  if(isset($_SESSION["userData"]) and $_SESSION["userData"]->getPerfil() == "Administrador"){
    $userData = $_SESSION["userData"];
  session_write_close();}
  $db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();

		$queryProyecto="SELECT id, codigo, nombre, descripcion,  estado,  fechaInicio,  fechaFin FROM  proyecto WHERE  codigo='HM13002'";
		$resultProyecto=mysqli_query($db,$queryProyecto);
?>

<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Modificar proyecto</title>
  
  <!-- Default Styles (DO NOT TOUCH) -->
  <link rel="stylesheet" href="../lib/css/font-awesome.min.css">
  <link rel="stylesheet" href="../lib/css/bootstrap.min.css">
  <link rel="stylesheet" href="../lib/css/fonts.css">
  <link type="text/css" rel="stylesheet" href="../lib/css/soft-admin.css"/>
  
  <!-- Adjustable Styles -->
  <link type="text/css" rel="stylesheet" href="../lib/css/select2.css"/>
  <link type="text/css" rel="stylesheet" href="../lib/css/bootstrap-colorpicker.css"/>
  <link type="text/css" rel="stylesheet" href="../lib/css/bootstrap-datepicker.css"/>
  <link type="text/css" rel="stylesheet" href="../lib/css/bootstrap-sliders.css"/>
  <link type="text/css" rel="stylesheet" href=../"lib/css/icheck.css?v=1.0.1">
  <link type="text/css" rel="stylesheet" href="../lib/css/jquery.switchButton.css">
  
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
        <a class="sbtn btn-default" href="../main/home.php">
         <span class="fa fa-home"></span>
         &nbsp;&nbsp;Home
        </a>
       </div>
      </div>
      <?php if ($userData->getPerfil() == "Administrador"){ ?>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default active" href="admin/users.php">
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
        <a href="../main/consultarPartidas.php" class="sbtn sbtn-default">Ver Partidas</a>
        <a href="../main/crear_partida.php" class="sbtn sbtn-default">Crear Partida</a> 
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
        <a href="../main/tabla_recursos.php" class="sbtn sbtn-default active">Ver Recursos</a>
        <a href="../main/ingresar.php" class="sbtn sbtn-default">Agregar Nuevo Recurso</a>
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

   <!-- RESPONSIVE NAVIGATION -->
 <div id="secondary" class="btn-group visible-xs">
    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><span class="icon icon-th-large"></span>&nbsp;&nbsp;Menu&nbsp;&nbsp;<span class="caret"></span></button>
    <ul class="dropdown-menu dropdown-info pull-right" role="menu">
      <li><a href="../main/home.php">Home</a></li>
      <li class="dropdown-header">Recursos</li>
      <li><a href="tabla_recursos.php">Ver Recursos</a></li>
      <li><a href="ingresar.php">Agregar Recurso</a></li>
      <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
      <li class="dropdown-header">Partidas</li>
      <li><a href="../main/consultarPartidas.php">Ver Partidas</a></li>
      <li><a href="../main/crear_partida.php">Crear Partida</a></li>
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
       <li><a href="consultarPartidas.php">Partidas</a></li>
       <li class="active">Modificar Partida</li>
      </ol>
     </div>
    </div>
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Proyecto</h1>
     </div>
     <div class="tbl">
      <div class="col-md-12">
       <div class="wdgt">
        <div class="wdgt-header">Codigo:</div>
        <div class="wdgt-body" style="padding-bottom:10px;">
        <?php  
          $num_rows = mysqli_num_rows($resultProyecto);
          if($num_rows > 0){
        		while ($row= mysqli_fetch_array($resultProyecto )) {
        			$fechaInicio="$row[fechaInicio]";
        			$fechaFin="$row[fechaFin]";
        			$date = date('m/d/Y', strtotime($fechaInicio));
        			$date2= date('m/d/Y', strtotime($fechaFin));
        			?>

         <form role="form" action="modProyecto_exe.php" method="POST">
          <div class="form-group">
           <label>Nombre</label>
           <input type="text" name="nombre" value="<?php echo "$row[nombre]"; ?>" class="form-control" >
          </div>
           <div class="form-group">
           <label>Descripcion</label>
           <textarea class="form-control form-dark" rows="3" name="descripcion" ><?php echo "$row[descripcion]";?></textarea>
          </div>
           <div class="form-group">
           <label for="disabledSelect">Estado</label>
           <select id="disabledSelect" class="form-control form-primary">
            <option>Sin iniciar</option>
            <option>En proceso</option>
            <option>Finalizado</option>		
          </select>
          </div>
          <div class="form-group">
           <label>Fecha Inicio</label>
           <input type="text" class="form-control demo3" name="fInicio" value="<?php echo "$date";?>">
          </div>

          <div class="form-group">
           <label>Fecha Fin</label>
           <input type="text" class="form-control demo3" name="fFin" value="<?php echo "$date2";?>">
          </div>
           <button type="submit" class="btn btn-primary" name="agregar2" >Guardar Cambios</button>
         </form> 
         <?php }?>
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
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
  <script src="../lib/js/bootstrap.min.js"></script>
  <script src="../lib/js/hogan.min.js"></script>
  <script src="../lib/js/typeahead.min.js"></script>
  <script src="../lib/js/typeahead-example.js"></script>
  
  <!-- Adjustable JS -->
  <script src="../lib/js/bootstrap-colorpicker.js"></script>
  <script src="../lib/js/bootstrap-datepicker.js"></script>
  <script src="../lib/js/jquery.jgrowl.min.js"></script>
  <script src="../lib/js/select2.min.js"></script>
  <script src="../lib/js/icheck.js"></script>
  <script src="../lib/js/jquery.knob.js"></script>
  <script src="../lib/js/jquery.switchButton.js"></script>
  <script>
    $(document).ready(function() { 
    $("#e1").select2(); 
    $("#e2").select2(); 
    $('.demo1').colorpicker(); 
    $('.demo2').colorpicker(); 
    $('.demo3').datepicker(); $('.demo4').datepicker({minViewMode: 1});
    $('.flat-checkbox').iCheck({
     checkboxClass: 'icheckbox_flat-purple',
     radioClass: 'iradio_flat-purple'
    });
    $( ".ui-slider-range" ).slider({
     range: true,
     values: [ 17, 67 ]
    });
    $( ".ui-slider2" ).slider({
     range: "min",
     max: 255,
     value: 67
    });
    
    $('.switch1').switchButton();
    $(".switch2").switchButton({
      on_label: 'YES',
      off_label: 'NO'
    });
    $(".switch3").switchButton({
      show_labels: false
    });
    $(".switch4").switchButton({
      width: 100,
      height: 40,
      button_width: 50,
      show_labels: false
    });
    
   });

  $(function() {

            $(".knob").knob({
                draw : function () {

                    if(this.$.data('skin') == 'tron') {

                        var a = this.angle(this.cv)  // Angle
                            , sa = this.startAngle          // Previous start angle
                            , sat = this.startAngle         // Start angle
                            , ea                            // Previous end angle
                            , eat = sat + a                 // End angle
                            , r = true;

                        this.g.lineWidth = this.lineWidth;

                        this.o.cursor
                            && (sat = eat - 0.3)
                            && (eat = eat + 0.3);

                        if (this.o.displayPrevious) {
                            ea = this.startAngle + this.angle(this.value);
                            this.o.cursor
                                && (sa = ea - 0.3)
                                && (ea = ea + 0.3);
                            this.g.beginPath();
                            this.g.strokeStyle = this.previousColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                            this.g.stroke();
                        }

                        this.g.beginPath();
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                        this.g.stroke();

                        this.g.lineWidth = 2;
                        this.g.beginPath();
                        this.g.strokeStyle = this.o.fgColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                        this.g.stroke();

                        return false;
                    }
                }
            });
        });


  </script>

  
 </body>
</html>

<?php
}
else{
 header("Location: ../home.php");
    session_destroy();
    exit(); 
}
?>