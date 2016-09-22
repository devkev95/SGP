<?php
  require_once '../../model/Usuario.php';

  session_start();

  if(isset($_SESSION["userData"]) and $_SESSION["userData"]->getPerfil() == "Administrador"){
    $userData = $_SESSION["userData"];
  session_write_close();
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
  
  <!-- Adjustable Styles -->
  <link type="text/css" rel="stylesheet" href="../../lib/CSS/DT_bootstrap.css"/>
  
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
       <li class="active">Usuarios</li>
      </ol>
     </div>
    </div>
     
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Usuarios <small>// Lista de Usuarios Registrados</small></h1>
     </div>
     <div class="tbl">
      <div class="col-md-12">
       <div class="wdgt">
        <div class="wdgt-header">Usuarios</div>
        <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
         <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
     <thead>
      <tr>
       <th>Nombres</th>
       <th>Apellidos</th>
       <th>Email</th>
       <th>Estado</th>
       <th>Perfil</th>
       <th>Acciones</th>
      </tr>
     </thead>
     
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
  <script src="../../lib/JS/jquery-3.1.0.min.js"></script>
  <script src="../../lib/JS/bootstrap.min.js"></script>
  <script src="../../lib/JS/hogan.min.js"></script>
  <script src="../../lib/JS/typeahead.min.js"></script>
  <script src="../../lib/JS/typeahead-example.js"></script>
  
  <!-- Adjustable JS -->
  <script src="../../lib/JS/jquery.dataTables.js"></script>
  <script src="../../lib/JS/DT_bootstrap.js"></script>
  <script src="../../lib/JS/soft-widgets.js"></script>
  <script>
   $(document).ready(function() {
    var dataTable = $('.datatable').dataTable({
     "sDom" : "frtip",
     "sAjaxSource" : "../../services/admin/users_table.php",
     "sAjaxDataProp" : "data",
     "bLengthChange" : false,
     "sPaginationType" : "bs_full",
     "iDisplayLegth" : 15,
     "bProcessing" : true,
     "fnServerData" : function ( sSource, aoData, fnCallback ) {
      $.ajax({
        "dataType" : "json",
        "type" : "POST",
        "url" : sSource,
        "success" : fnCallback
      })
    },
    "aoColumns" : [
      {"mData" : "nombres"},
      {"mData" : "apellidos"},
      {"mData" : "email"},
      {"mData" : "estado"},
      {"mData" : "perfil"},
      {"mData" : null}
    ],
    "aaSorting" : [],
    "aoColumnDefs": [
      { "bSearchable": false, "aTargets": [ 4, 5 ] },
      {"aTargets":[5], "mRender" : function(data, type, full){
        return "<a href='editPermisos.php?email="+full.email+"' class = 'btn btn-soft btn-sm'><i class='icon icon-edit'></i></a>"
      }}
    ],
    "oLanguage": {
      "oPaginate": {
        "sFirst": "Primera",
        "sLast" : "Última",
        "sNext" : "Siguiente",
        "sPrevious" : "Anterior"
      },
      "sInfo" : "Mostrando registros desde el _START_ al _END_ de un total de _TOTAL_",
      "sInfoFiltered" : "(filtrado de _MAX_ registros)"
    }
    }); 

    $('.datatable').each(function(){
     var datatable = $(this);
     // SEARCH - Add the placeholder for Search and Turn this into in-line form control
     var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
     search_input.attr('placeholder', 'Search');
     search_input.addClass('form-control input-sm');    
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