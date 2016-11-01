<?php

  require_once '../model/Usuario.php';
  session_start();

 if(isset($_SESSION["userData"])){
  $userData = $_SESSION["userData"];
  session_write_close();
?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cambiar contraseña</title>
  
  <!-- Default Styles (DO NOT TOUCH) -->
  <link rel="stylesheet" href="../lib/CSS/font-awesome.min.css">
  <link rel="stylesheet" href="../lib/CSS/bootstrap.min.css">
  <link rel="stylesheet" href="../lib/CSS/fonts.css">
  <link type="text/css" rel="stylesheet" href="../lib/CSS/soft-admin.css"/>
  <link type="text/css" rel="stylesheet" href="../lib/CSS/jquery.switchButton.css">
  
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
    <div class="logo"><img id="logo" src="../Imagenes/logo.png" style="width:159px !important; height:52px; !important"></div>
    <div class="sidebar">
     <div class="accordion">
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="../home.php">
         <span class="fa fa-home"></span>
         &nbsp;&nbsp;Home
        </a>
       </div>
      </div>
      <?php if ($userData->getPerfil() == "Administrador"){ ?>
      <div class="accordion-group">
       <div class="accordion-heading">
        <a class="sbtn btn-default" href="#">
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
        <a href="tabla_recursos.php" class="sbtn sbtn-default active">Ver Recursos</a>
        <a href="ingresar.php" class="sbtn sbtn-default">Agregar Nuevo Recurso</a>
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
            <li><a href="">Cambiar contraseña</a></li>
            <li><a href="../services/user/logout.php"><span class="fa fa-power-off"></span>Desconectar</a></li>
         </ul>
        </div>
      </div>
    </div>
     
     <!-- BREADCRUMBS -->
     <div class="crumbs">
      <ol class="breadcrumb hidden-xs">
       <li><i class="fa fa-home"></i> <a href="../home.php">Home</a></li>
       <li class="active">Cambiar contraseña</li>
      </ol>
     </div>
    </div>
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Cambiar contraseña</h1>
     </div>
     <div class="tbl">
      <div class="col-md-12">
       <div class="wdgt">
        <div class="wdgt-header">Cambiar contraseña</div>
        <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
        <?php
          if (isset($_GET["error"])) {
            
        ?>
        <div class="alertDiv alert alert-danger alert-round alert-border alert-soft">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <span class="icon icon-remove-sign">
              
             </span> <strong>Error:</strong><?php
             if ($_GET["error"] == 1) {
                
              echo  ' Se ha producido un error en la conexión a la base de datos, por favor intente realizar esta operación más tarde'; 
              }else if ($_GET["error"] == 2) {
                echo  ' Contraseña actual incorrecta';
                } 
                ?>
          </div>
         <?php
          } else if (isset($_GET["success"])){
        ?>
          <div class="alertDiv alert alert-success alert-round alert-border alert-soft">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <span class="icon icon-ok-sign" ></span>
             La contraseña ha sido cambiada exitosamente
            </div>
        <?php
          } 
        ?>
        <form id="change-passwd-form" class="form-horizontal" action="../services/user/changePasswd.php" method="POST">
       
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for="actualPasswd">Contraseña actual</label>
                    <div class="col-lg-7">
                      <input class="form-control form-soft input-sm" type="password" name="actualPasswd">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for="newPasswd">Nueva contraseña</label>
                    <div class="col-lg-7">
                      <input class="form-control form-soft input-sm" type="password" name="newPasswd">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-3 control-label" for="confirmNewPasswd">Confirmar nueva contraseña</label>
                    <div class="col-lg-7">
                      <input class="form-control form-soft input-sm" type="password" name="confirmNewPasswd">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                      <button class="btn btn-primary" type="submit">Cambiar contraseña</button>
                    </div>
                  </div>
        </form>
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
  <script src="../lib/JS/jquery-ui.min.js"></script>
  <script src="../lib/JS/bootstrap.min.js"></script>
  <script src="../lib/JS/hogan.min.js"></script>
  <script src="../lib/JS/typeahead.min.js"></script>
  <script src="../lib/JS/typeahead-example.js"></script>
  <script src="../lib/JS/soft-widgets.js"></script>
  <script src="../lib/JS/jquery.switchButton.js"></script>
  <script type="text/javascript" src="../lib/JS/bootstrapValidator.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $("#change-passwd-form").bootstrapValidator({
          fields : {
            actualPasswd : {
              validators: {
                notEmpty : {
                  message : "Este campo no puede estar vacio"
                }
              }
            },
            newPasswd : {
              validators : {
                notEmpty : {
                  message : "Este campo no puede estar vacio"
                },
                stringLength: {
                  min: 8,
                  max: 40,
                  message: 'La contraseña debe contener entre 8 y 40 carácteres'
                },
                identical: {
                  field: 'confirmNewPasswd',
                  message: 'Las contraseñas no son iguales'
                }
              }
            },
            confirmNewPasswd : {
              validators : {
                notEmpty: {
                  message: 'Este campo no puede estar vacio'
                  },
                identical: {
                  field: 'newPasswd',
                  message: 'Las contraseñas no son iguales'
                }
              }
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