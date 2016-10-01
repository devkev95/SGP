<?php 
  require'../services/conn.php';
  $db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
  $numeroMO=0;
$numeroPartida = $_GET['numero'];

$query= "SELECT numero,nombre FROM partida WHERE numero=".$numeroPartida;
                $resultado= mysqli_query($db,$query);
            
$query1="SELECT a.nombre, a.unidad, b.cantidad, a.total, b.subTotal FROM recurso a INNER JOIN linearecurso b ON a.codigo = b.codigo WHERE numero =".$numeroPartida;
          $resultado1=mysqli_query($db,$query1);
$query2="SELECT descripcion, jornada, FP, jornadaTotal, rendimiento, subTotal FROM lineamanoobra WHERE numero =".$numeroPartida;
          $resultado2=mysqli_query($db,$query2);
$query3="SELECT descripcion, tipo, capacidad, rendimiento, costoHora, subTotal FROM  `lineaequipoherramienta` WHERE numero =".$numeroPartida;
           $resultado3=mysqli_query($db,$query3);
$query4="SELECT descripcion, unidad, cantidad, valor, subTotal FROM lineasubcontrato WHERE numero =".$numeroPartida;
$resultado4=mysqli_query($db,$query4);


?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Static Tables // Soft Admin</title>
  
  <!-- Default Styles (DO NOT TOUCH) -->
 <link rel="stylesheet" href="../lib/CSS/font-awesome.min.css">
  <link rel="stylesheet" href="../lib/CSS/bootstrap.min.css">
  <link rel="stylesheet" href="../lib/CSS/fonts.css">
  <link type="text/css" rel="stylesheet" href="../lib/CSS/soft-admin.css"/>
  
  <!-- Adjustable Styles -->
  <link type="text/css" rel="stylesheet" href="lib/css/icheck.css?v=1.0.1">
  
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
       <div id="c-forms" class="accordion-body collapse"><div class="accordion-inner">
        <a href="form_basic.html" class="sbtn sbtn-default">Basic Form Elements</a>
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
       <div id="c-tables" class="accordion-body collapse in"><div class="accordion-inner">
        <a href="table_static.html" class="sbtn sbtn-default active">Static Tables <span class="label label-soft">2</span></a>
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
        <li class="active"><a href="index.html"><span class="fa fa-dashboard"></span>Dashboard</a></li>
        <li><a href="#"><span class="icon icon-barcode"></span>Labels <span class="label label-primary">1,078</span></a></li>
        <li><a href="#"><span class="icon icon-cog"></span>Admin</a></li>
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
       <li><i class="fa fa-home"></i> <a href="#">Home</a></li>
       <li><a href="#">Tables</a></li>
       <li class="active">Static Tables</li>
      </ol>
     </div>
    </div>
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>ACTUALIZAR PARTIDA </h1>
     </div>

     <div class="tbl">

      <div class="col-md-12">
      <!-- ENCABEZADO-->
       <div class="wdgt wdgt-primary" hide-btn="true">
       <div class="wdgt-body wdgt-table"></div>
        <div class="wdgt-body wdgt-table" align="center">
        ANALISIS DE PRECIOS UNITARIOS<br>
        SIN IVA<br>
        PROYECTO:
        <br>
       </div>

          <div class="wdgt-body wdgt-table" align="center">
        
        <?php  
        while ($fila = mysqli_fetch_array($resultado)) {?>
          Partida N°  <?php echo "$fila[numero] ";?>  UNIDAD: <br>
          <?php
          echo "$fila[nombre]<br>";
        }

        ?><br></div>
       
       </div>
       <!--PRIMERA TABLA-->
          <div class="wdgt wdgt-primary" hide-btn="true">
        <div class="wdgt-header" align="center">
       A- MATERIALES
       </div>
         
        <div class="wdgt-body wdgt-table">
        <form  action="modPartida_exe.php?numero= <?php echo "$numeroPartida";?>" method="POST">
         <table class="table">
          <thead >
            <tr >
           
           <th align="center">Descripcion</th>
           <th>U</th>
           <th>Cantidad</th>
           <th>Valor</th>
           <th>Subtotal</th>
            </tr>
          </thead>
          <?php  
          $num_rows = mysqli_num_rows($resultado);
          $numero=0;
          if($num_rows > 0){

        
        while ($fila1 = mysqli_fetch_array($resultado1)) {?>
         
          <tbody>
            <tr>
           
           <td><?php echo "$fila1[nombre]";?></td>
           <td><?php echo "$fila1[unidad]";?></td>
           
           <td><input type="text" name="cantidadMaterial[<?php echo "$numero"; ?>]" style="border:none" value="<?php echo "$fila1[cantidad]";?>"></td>
           <td><?php echo "$fila1[total]";?></td>
           <?php $subT="$fila1[subTotal]";?>
           

           <td><?php echo "$subT";?></td>

            </tr>
            <?php $numero=$numero+1;} }?>
          </tbody>


         </table>
      
        </div>
       </div>
       
         
       <!-- SEGUNDA TABLA-->
        <div class="wdgt wdgt-primary" hide-btn="true">
        <div class="wdgt-header" align="center">
       B- MANO DE OBRA
       </div>
         
        <div class="wdgt-body wdgt-table">

         <table class="table">
          <thead >
            <tr >
           
           <th>Descripcion</th>
           <th>Jorn.</th>
           <th>F.P.</th>
           <th>Jorn. Total</th>
           <th>Rendimiento</th>
           <th>Subtotal</th>
            </tr>
          </thead>
          <?php  
          
           $num_rowsMO = mysqli_num_rows($resultado2);
           
          if($num_rowsMO > 0){
         
        while ($fila2 = mysqli_fetch_array($resultado2)) { ?>
          
          <tbody>
            <tr>
           
           <td><input type="text" style="border:none"  name="descripcionMO[<?php echo "$numeroMO"; ?>]"      value="<?php echo "$fila2[descripcion]";?>"  ></td>
           <td><input type="text" style="border:none"  name="jornadaMO[<?php echo "$numeroMO"; ?>]"      value="<?php echo "$fila2[jornada]";?>"      ></td>
           <td><input type="text" style="border:none"  name="FPMO[<?php echo "$numeroMO"; ?>]"      value="<?php echo "$fila2[FP]";?>"           ></td>
           <td><input type="text" style="border:none"  name="jornadaTotalMO[<?php echo "$numeroMO"; ?>]"      value="<?php echo "$fila2[jornadaTotal]";?>" ></td>
           <td><input type="text" style="border:none"  name="rendimientoMO[<?php echo "$numeroMO"; ?>]"      value="<?php echo "$fila2[rendimiento]";?>"  ></td>
           <td><input type="text" style="border:none"  name="subTotalMO[<?php echo "$numeroMO"; ?>]"      value="<?php echo "$fila2[subTotal]";?>"     ></td>
            </tr>
          
            <?php $numeroMO=$numeroMO+1;}  } ?>
          </tbody>
          

         </table>
        
        </div>
       </div>

       <!-- TERCER TABLA -->
         <div class="wdgt wdgt-primary" hide-btn="true">
        <div class="wdgt-header" align="center">
       C- EQUIPO Y HERRAMIENTAS
       </div>
         
        <div class="wdgt-body wdgt-table">

         <table class="table">
          <thead >
            <tr >
           
           <th>Descripcion</th>
           <th>Tipo</th>
           <th>Capac.</th>
           <th>Rendimiento</th>
           <th>Costo por hora</th>
           <th>Subtotal</th>
            </tr>
          </thead>
            <?php  

          $num_rowsEH = mysqli_num_rows($resultado3);
          
          $numEH=0;

          if( $num_rowsEH > 0){
                while ($fila3 = mysqli_fetch_array($resultado3)) {?>
          <tbody>
            <tr>
           
           <td><input type="text" style="border:none"  value="<?php echo "$fila3[descripcion]";?>" name="descripcionEH[<?php echo "$numEH"; ?>]"></td>
           <td><input type="text" style="border:none"  value="<?php echo "$fila3[tipo]";?>"        name="tipoEH[<?php echo "$numEH"; ?>]"></td>
           <td><input type="text" style="border:none"  value="<?php echo "$fila3[capacidad]";?>"   name="capacidadEH[<?php echo "$numEH"; ?>]"></td>
           <td><input type="text" style="border:none"  value="<?php echo "$fila3[rendimiento]";?>" name="rendimientoEH[<?php echo "$numEH"; ?>]"></td>
           <td><input type="text" style="border:none"  value="<?php echo "$fila3[costoHora]";?>"   name="costoHoraEH[<?php echo "$numEH"; ?>]"></td>
           <td><input type="text" style="border:none"  value="<?php echo "$fila3[subTotal]";?>"    name="subTotalEH[<?php echo "$numEH"; ?>]"></td>
            </tr>
            <?php $numEH=$numEH+1; } } ?>
          </tbody>


         </table>
        
        </div>
       </div>
       <!--CUARTA TABLA-->
              <div class="wdgt wdgt-primary" hide-btn="true">
        <div class="wdgt-header" align="center">
       D- SUBCONTRATOS
       </div>
         
        <div class="wdgt-body wdgt-table">

         <table class="table">
          <thead >
            <tr >
           
           <th>Descripcion</th>
           <th>U</th>
           <th>Cantidad</th>
           <th>Valor</th>
           <th>Subtotal</th>
            </tr>
          </thead>
          <?php  
          $num_rowsSC = mysqli_num_rows($resultado4);
          $numSC=0;
          if( $num_rowsEH > 0){
          while ($fila4 = mysqli_fetch_array($resultado4)) {?>
          <tbody>
            <tr>
           
           <td><input type="text" style="border:none"  value="<?php echo "$fila4[descripcion]";?>" name="descripcionSC[<?php echo "$numSC"; ?>]"   ></td>
           <td><input type="text" style="border:none"  value="<?php echo "$fila4[unidad]";?>"      name="unidadSC[<?php echo "$numSC"; ?>]"   ></td>
           <td><input type="text" style="border:none"  value="<?php echo "$fila4[cantidad]";?>"    name="cantidadSC[<?php echo "$numSC"; ?>]"   ></td>
           <td><input type="text" style="border:none"  value="<?php echo "$fila4[valor]";?>"       name="valorSC[<?php echo "$numSC"; ?>]"   ></td>
           <td><input type="text" style="border:none"  value="<?php echo "$fila4[subTotal]";?>"    name="subTotalSC[<?php echo "$numSC"; ?>]"   ></td>
            </tr>
            <?php $numSC=$numSC+1; } }?>
            
          </tbody>


         </table>
        
        </div>
       </div>
       <!-- QUINTA TABLA -->
       <table class="table" align="center">
         
          <tbody>
            <tr>
           
           <td>COSTO DIRECTO</td>
           <td></td>
            </tr>
            <tr>
              
              <td>COSTO INDIRECTO</td>
              <td></td>
            </tr>
            <tr>
              <td>COSTO UNITARIO</td>
              <td></td>
            </tr>

            
          </tbody>


         </table>
        
        </div>
       </div>

       <!-- FIN DE TABLAS-->

      </div>
     
      <div class="modal fade" id="confirmacion" tabindex="-1" role=dialog aria-labelledby="MyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
           <div class="alert alert-success"><span class="icon icon-ok-sign"></span> <strong>GUARDADO</strong> Partida modificada correctamente </div>
            
            </div>
          </div>
        </div>
      </div>

     <div align="right">  

        	<button  type="submit" class="btn btn-primary btn-round" name="enviarCambios"data-toggle="modal" data-target="#confirmacion">Relizar cambios</button>
          <br>    <br>   <br>              
          
               
        </div>
 </form><br> 
      </div><br> 

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
  <script src="lib/js/icheck.js"></script>
  <script src="lib/js/soft-widgets.js"></script>
  <script>
   $(document).ready(function() { 
    $('.flat-checkbox').iCheck({
     checkboxClass: 'icheckbox_flat-purple',
     radioClass: 'iradio_flat-purple'
    });
   });
  </script>
  
 </body>
</html>