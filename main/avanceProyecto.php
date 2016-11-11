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


$id=$_GET["id"];


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
<script type="text/javascript" src="canvasjs.min.js"></script>
  
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
       <li><a href="tabla_recursos.php">Proyectos</a></li>
       
      </ol>
     </div>
    </div>
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Proyectos <small></small></h1>

     </div>



     <div class="tbl">





<div class="col-md-12">



       <div class="wdgt wdgt-primary">







<?php
    #include 'connect_db.php';
    //require("connect_db.php");
     $sql = mysql_query("SELECT * FROM proyecto where idProyecto='".$id."'");
    while ($row = mysql_fetch_array($sql)) {
     
        echo '<div class="wdgt-header" style="text-align:center; color:black;"><h4>CONTROL DE PROYECTO <br></h4> <b><h3>'. $row['nombre'] . '</h3></b><h5>Fecha: '. $row['fecha_creacion'] . '</h5></div>';

      }



?>



        





        <div class="wdgt-body wdgt-table">

         <table class="table">
          <thead>
            <tr>
           
          
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Estado</th>
            <th>Monto</th>
             <th>Fecha de inicio</th>
              <th>Fecha de finalización</th>
                 <th>Observacion</th>
         
           </tr>
          </thead>
          <tbody>


            <?php
    #include 'connect_db.php';
    //require("connect_db.php");
     $sql2 = mysql_query("SELECT * FROM etapa where idProyecto='".$id."'");
    while ($row2 = mysql_fetch_array($sql2)) {
     
        echo '<tr>';
        echo '<td><h5><b>'. $row2['nombre'] . '<b></h5></td> 
        <td>'. $row2['detalle'] . '</td>
        <td>'. $row2['estado'] . '</td>
        <td>'. $row2['totalEtapa'] . '</td>
        <td>'. $row2['fechaInicioProgramada'] . '</td>
        <td>'. $row2['fechaFinProgramada'] . '</td>';


      

   





       $datetime1 = date_create(date("Y-m-d"));
      $datetime2 = date_create($row2['fechaFinProgramada']);
      $interval = date_diff($datetime1, $datetime2);

      if ($interval->format('%R%a')<0)

              echo "<td bgcolor='#ff8a8a'>Atrasado ".$interval->format('%a dias')."</td></tr>";


      if ($interval->format('%R%a')>=0)

              echo "<td>A tiempo. Quedan ".$interval->format('%a dias')."</td></tr>";



      

    }








?>



    



        
        
            
           
          </tbody>
         </table>
        

 
      
        



        </div>
       </div>


<?php


 $sql3 = mysql_query("select count(estado) as iniciadas from etapa where idProyecto='".$id."' and estado='Iniciado'");
    while ($row3 = mysql_fetch_array($sql3)) {


 $cantInicio=$row3['iniciadas'];

}


 $sql4 = mysql_query("select count(estado) as espera from etapa where idProyecto='".$id."' and estado='Espera'");
    while ($row4 = mysql_fetch_array($sql4)) {


 $cantEspera=$row4['espera'];

}



 $sql5 = mysql_query("select count(estado) as terminadas from etapa where idProyecto='".$id."' and estado='Terminado'");
    while ($row5 = mysql_fetch_array($sql5)) {


 $cantTerminado=$row5['terminadas'];

}



echo ' <script type="text/javascript">
window.onload = function () {
  var chart = new CanvasJS.Chart("chartContainer",
  {
    title:{
      text: "Etapas"
    },
    legend: {
      maxWidth: 350,
      itemWidth: 120
    },
    data: [
    {
      type: "pie",
      showInLegend: true,
      legendText: "{indexLabel}",
      dataPoints: [
        { y:'.$cantInicio. ', indexLabel: "Iniciadas" },
       
        { y:'.$cantTerminado.', indexLabel: "Terminadas" },
       
        { y: '.$cantEspera.', indexLabel: "Finalizadas"}
      ]
    }
    ]
  });
  chart.render();
}
</script>
';


















?>

<br>
 <div id="chartContainer" style="height: 300px; width: 100%;"></div>
  

      </div>



   

   





    </div>
    <!-- END PAGE CONTENT -->


     <div id="chartContainer" style="height: 300px; width: 100%;"></div>


     </div>


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