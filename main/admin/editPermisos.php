<?php
  require_once '../../model/Usuario.php';
  require_once '../../DAO/UsuarioDAO.php';
  require_once '../../model/Perfil.php';
  require_once '../../DAO/PerfilDAO.php';

  session_start();

 if(isset($_SESSION["userData"], $_GET["email"]) and $_SESSION["userData"]->getPerfil() == "Administrador"){
  $userData = $_SESSION["userData"];
  session_write_close();
  $userDAO = new UsuarioDAO();
  $perfilDAO = new PerfilDAO();
?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Usuarios-Administración</title>
  
  <!-- Default Styles (DO NOT TOUCH) -->
  <link rel="stylesheet" href="../../lib/CSS/font-awesome.min.css">
  <link rel="stylesheet" href="../../lib/CSS/bootstrap.min.css">
  <link rel="stylesheet" href="../../lib/CSS/fonts.css">
  <link type="text/css" rel="stylesheet" href="../../lib/CSS/soft-admin.css"/>
  <link type="text/css" rel="stylesheet" href="../../lib/CSS/jquery.switchButton.css">
  
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
    <div class="logo"><img id="logo" src="../../lib/img/logo3.png" style="width:159px !important; height:52px; !important"></div>
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
        <a class="sbtn btn-default active" href="#">
         <span class="fa fa-users"></span>
         &nbsp;&nbsp;Usuarios
        </a>
       </div>
      </div>
      <?php } ?>
      </div>
      </div>
    </div>

   <!-- RIGHT NAV, CRUMBS, & CONTENT -->
   <div class="right">
   
    <div class="nav">
    <div class="bar">
      <div class="hov">
        <div class="btn-group">
        <a class="con" href="" data-toggle="dropdown"><span class="icon icon-user"></span></a>
         <ul class="dropdown-menu pull-right dropdown-profile" role="menu">
          <li class="title"><span class="icon icon-user"></span>&nbsp;&nbsp;Bienvenido, <?= $userData->getNombres()?></li>
            <li><a href="../../services/user/logout.php"><span class="fa fa-power-off"></span>Desconectar</a></li>
         </ul>
        </div>
      </div>
    </div>
     
     <!-- BREADCRUMBS -->
     <div class="crumbs">
      <ol class="breadcrumb hidden-xs">
       <li><i class="fa fa-home"></i> <a href="../home.php">Home</a></li>
       <li><a href = "users.php">Usuarios</a></li>
       <li class="active">Edición de Permisos de Usuario</li>
      </ol>
     </div>
    </div>
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Usuarios <small>// Edición de Permisos de Usuario</small></h1>
     </div>
     <div class="tbl">
      <div class="col-md-12">
       <div class="wdgt">
        <div class="wdgt-header">Editar Permisos de Usuario</div>
        <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
        <?php
          $user = $userDAO->getUserByIdAll($_GET["email"]);
          $perfiles = $perfilDAO->getPerfiles();
          if (!is_null($userDAO->getError()) or  !is_null($perfilDAO->getError()) or is_numeric($user) or is_numeric($perfiles)) {
            
        ?>
        <div class="alertDiv alert alert-danger alert-round alert-border alert-soft">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <span class="icon icon-remove-sign">
              
             </span> <strong>Error:</strong><?php echo  'Se ha producido un error en la conexión a la base de datos, por favor intente realizar esta operación más tarde'; ?>
          </div>
         <?php
          }
          else{
        ?>
        <form id="edit-permisos-form" class="form-horizontal" action="../../services/admin/usuarioPermisos.php" method="POST">
       
          <div class="form-group">
            <label class="col-lg-3 control-label">Nombres</label>
            <div class="col-lg-7">
              <h5><?php echo $user->getNombres(); ?></h5>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Apellidos</label>
            <div class="col-lg-7">
              <h5><?php echo $user->getApellidos(); ?></h5>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email</label>
            <div class="col-lg-7">
              <h5><?php echo $user->getEmail(); ?></h5>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Estado</label>
            <div class="col-lg-7">
              <span class="wdgt-switch"><input id="switch" class="switch4" type="checkbox" name="estado" value="1" 
              <?php if($user->getEstado()) 
              {
                echo "checked";
                } ?>></span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Perfil</label>
            <div class="col-lg-7">
              <select class="form-control" name="perfil" id="cbx-perfiles">
              <?php if (is_null($user->getPerfil())) {
              
               echo '<option value="">--Seleccione una opción---</option>';
               }else{
                 echo '<option value="" selected>--Seleccione una opción---</option>';
               }
               foreach ($perfiles as $perfil) {
                  if ($perfil->getIdPerfil() == $user->getPerfil()) {
                    echo '<option value="'.$perfil->getIdPerfil().'" selected>'.$perfil->getNombrePerfil().'</option>';
                }
                else{
                echo  '<option value="'.$perfil->getIdPerfil().'">'.$perfil->getNombrePerfil().'</option>';
                  }
                } 
               ?> 
                
              </select>
            </div>
          </div>
          <input type="hidden" name="email" value="<?php echo $_GET["email"]; ?>" />
          <div class="form-group">
            <div class="col-lg-9 col-lg-offset-3">
              <button class="btn btn-primary" type="submit">Ingresar cambios</button>
            </div>
          </div>
        </form>
        <?php 
          }
        ?>
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
  <script src="../../lib/JS/jquery-3.1.0.min.js"></script>
  <script src="../../lib/JS/jquery-ui.min.js"></script>
  <script src="../../lib/JS/bootstrap.min.js"></script>
  <script src="../../lib/JS/hogan.min.js"></script>
  <script src="../../lib/JS/typeahead.min.js"></script>
  <script src="../../lib/JS/typeahead-example.js"></script>
  <script src="../../lib/JS/soft-widgets.js"></script>
  <script src="../../lib/JS/jquery.switchButton.js"></script>
  <script type="text/javascript" src="../../lib/JS/bootstrapValidator.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {

      if (!$("#switch").is(":checked")) {
        $(this).prop("disabled", "disabled");
      }
      
      $("#switch").change(function(){
        if(!$(this).is(":checked")){
          $("#cbx-perfiles").val("");
          $("#cbx-perfiles").prop("disabled", "disabled");
        }else{
          $("#cbx-perfiles").prop("disabled", false);
        }
      });

      $(".switch4").switchButton({
        on_label : 'Activado',
        off_label : 'Desactivado'
      });

      $("#edit-permisos-form").bootstrapValidator({
        fields:{
          perfil : {
            validators: {
              callback : {
                message : "Por favor escoga un perfil de la lista",
                callback : function (value, validator) {
                   return !$("#switch").is(":checked") || value !== "";

                  }
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