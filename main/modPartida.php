<?php 

  require'../services/conn.php';
  require_once '../model/Usuario.php';

  session_start();

  if(isset($_SESSION["userData"]) and $_SESSION["userData"]->getPerfil() == "Administrador"){
    $userData = $_SESSION["userData"];
  session_write_close();
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

$queryC="SELECT totalCD, totalCF,precioUnitario from partida WHERE numero=".$numeroPartida;
$resultadoC=mysqli_query($db,$queryC);

$queryTotales="SELECT totalMateriales, totalManoObra, totalEquipoHerramientas, totalSubContratos from partida WHERE numero=".$numeroPartida;
$resultadoTotales=mysqli_query($db,$queryTotales);
$filaTotales = mysqli_fetch_array($resultadoTotales);


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

  <style> 
  .selected{
    cursor: pointer;
  }

  .selected:hover{
    background-color: #BDBDBD;
    input {
      background-color:  #BDBDBD;
    }
   
  }



  .seleccionada{
    background-color: #BDBDBD;
 

  }
  </style>
  
  <!-- Adjustable Styles -->
  <link type="text/css" rel="stylesheet" href="../lib/css/icheck.css?v=1.0.1">
  
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
      <h1>Actualizar Partida </h1>
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
           <tbody>
           <?php  
          $num_rows = mysqli_num_rows($resultado);
          $numeroM=0;
          if($num_rows > 0){

        
        while ($fila1 = mysqli_fetch_array($resultado1)) {?>
         
         
            <tr id="material<?php echo "$numeroM"; ?>" class="selected" onclick="seleccionarMaterial(this.id)">
           
           <td><?php echo "$fila1[nombre]";?></td>
           <td><?php echo "$fila1[unidad]";?></td>
           
           <td><input type="number" name="cantidadMaterial[<?php echo "$numeroM"; ?>]" style="border:none" value="<?php echo "$fila1[cantidad]";?>"></td>
           <td><?php echo "$fila1[total]";?></td>
           <?php $subT="$fila1[subTotal]";?>
           

           <td><?php echo "$subT";?></td>

            </tr>
            <?php $numeroM=$numeroM+1;} }?>
             </tbody>


         </table>
          </div>
      
       
<table>
              <tr>
            <td></td>
              <td></td>
                <td></td>
            <td> SUBTOTAL</td>
            <td><input type="text" value="<?php echo "$filaTotales[totalMateriales]"; ?>" name="totalM" style="border:none" disabled>  </td>
            </tr>
</table>

 <table>
          <tr>
            <td><button type="button" id="new-row-material" class="btn btn-primary btn-tooltip" data-placement="bottom" title="" data-original-title="Agregar nueva mano de obra"  data-target="#"  data-toggle="modal"><i class="icon icon-plus"></i></button></td>
            <td> <button type="button"  id="deleteMaterial"  class="btn btn-danger btn-tooltip" data-placement="bottom" data-original-title="Eliminar mano de obra" data-target="#modalMaterial"  data-toggle="modal" disabled=true><i class="icon icon-remove" ></i></button></td>
          </tr>

        </table>
         
 </div>
         
        
       
         
       <!-- SEGUNDA TABLA-->
        <div class="wdgt wdgt-primary" hide-btn="true">
        <div class="wdgt-header" align="center">
       B- MANO DE OBRA
       </div>
         
        <div class="wdgt-body wdgt-table">

         <table class="table" id="table_mano-obra">
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
           <tbody>
         <?php  
          
           $num_rowsMO = mysqli_num_rows($resultado2);
           
          if($num_rowsMO > 0){
         
        while ($fila2 = mysqli_fetch_array($resultado2)) { ?>
          
         
            <tr id="mano-obra<?php echo "$numeroMO"; ?>" class="selected" onclick="seleccionarMO(this.id)">
           
           <td><input type="text"   style="border:none"   name="descripcionMO[<?php echo "$numeroMO"; ?>]"      value="<?php echo "$fila2[descripcion]";?>"  ></td>
           <td><input type="number" style="border:none"   name="jornadaMO[<?php echo "$numeroMO"; ?>]"      value="<?php echo "$fila2[jornada]";?>"      ></td>
           <td><input type="number" style="border:none"   name="FPMO[<?php echo "$numeroMO"; ?>]"      value="<?php echo "$fila2[FP]";?>"           ></td>
           <td><input type="number" style="border:none"   name="jornadaTotalMO[<?php echo "$numeroMO"; ?>]"      value="<?php echo "$fila2[jornadaTotal]";?>" ></td>
           <td><input type="number" style="border:none"   name="rendimientoMO[<?php echo "$numeroMO"; ?>]"      value="<?php echo "$fila2[rendimiento]";?>"  ></td>
           <td><input type="number" style="border:none"   name="subTotalMO[<?php echo "$numeroMO"; ?>]"      value="<?php echo "$fila2[subTotal]";?>"     ></td>
            </tr>
          
            <?php $numeroMO=$numeroMO+1;}  } ?>

             </tbody>
          

         </table>
        
       </div>

        <table>
              <tr>
            <td></td>
              <td></td>
                <td></td>
                <td></td>
            <td> SUBTOTAL</td>
            <td><input type="text" value="<?php echo "$filaTotales[totalManoObra]"; ?>" name="totalMO" style="border:none" disabled ></td>
            </tr></table>

         
        <table>
          <tr>
            <td><button type="button" id="new-row-manoObra" class="btn btn-primary btn-tooltip" data-placement="bottom" title="" data-original-title="Agregar nueva mano de obra"  data-target="#modal-manoObra"  data-toggle="modal"><i class="icon icon-plus"></i></button></td>
            <td> <button type="button"  id="deleteMO"  class="btn btn-danger btn-tooltip" data-placement="bottom" data-original-title="Eliminar mano de obra" data-target="#modalManoObra"  data-toggle="modal" disabled=true><i class="icon icon-remove" ></i></button></td>
          </tr>

        </table>
         
         
        </div>
         
       

       <!-- TERCER TABLA -->
         <div class="wdgt wdgt-primary" hide-btn="true">
        <div class="wdgt-header" align="center">
       C- EQUIPO Y HERRAMIENTAS
       </div>
         
        <div class="wdgt-body wdgt-table">
         <table class="table" id="table_Herramienta">
          <thead>
            <tr >
           
           <th>Descripcion</th>
           <th>Tipo</th>
           <th>Capac.</th>
           <th>Rendimiento</th>
           <th>Costo por hora</th>
           <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
             <?php  

          $num_rowsEH = mysqli_num_rows($resultado3);
          
          $numEH=0;

          if( $num_rowsEH > 0){
                while ($fila3 = mysqli_fetch_array($resultado3)) {?>
          
            <tr id="herramienta<?php echo "$numEH"; ?>" class="selected" onclick="seleccionarH(this.id)">
           
           <td><input type="text"  style="border:none"  value="<?php echo "$fila3[descripcion]";?>" name="descripcionEH[<?php echo "$numEH"; ?>]"></td>
           <td><input type="text"  style="border:none"  value="<?php echo "$fila3[tipo]";?>"        name="tipoEH[<?php echo "$numEH"; ?>]"></td>
           <td><input type="text"  style="border:none"  value="<?php echo "$fila3[capacidad]";?>"   name="capacidadEH[<?php echo "$numEH"; ?>]"></td>
           <td><input type="number"  style="border:none"  value="<?php echo "$fila3[rendimiento]";?>" name="rendimientoEH[<?php echo "$numEH"; ?>]"></td>
           <td><input type="number"  style="border:none"  value="<?php echo "$fila3[costoHora]";?>"   name="costoHoraEH[<?php echo "$numEH"; ?>]"></td>
           <td><input type="number"  style="border:none"  value="<?php echo "$fila3[subTotal]";?>"    name="subTotalEH[<?php echo "$numEH"; ?>]"></td>
            </tr> 
            <?php $numEH=$numEH+1; } } ?>
               </tbody>
         </table>
           </div>
        <table>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            <td> SUBTOTAL</td>
            <td><input type="text" style="border:none" value="<?php echo "$filaTotales[totalEquipoHerramientas]"; ?>" name="totalEH" style="border:none" disabled>  </td>
            </tr></table>

       
      
        <table>
        <tr>        
         <td><button type="button" id="new-row-equipoHerramienta" class="btn btn-primary btn-tooltip" data-placement="bottom"  data-original-title="Agregar nuevo equipo o herramienta" data-target="#modalIngresarEH" data-toggle="modal"><i class="icon icon-plus"></i></button></td>
         <td><button type="button"  id="deleteHerramienta"  class="btn btn-danger btn-tooltip" data-placement="bottom"  data-original-title="Eliminar equipo o herramienta" data-target="#modalHerramienta"  data-toggle="modal" disabled="true"><i class="icon icon-remove"></i></button></td></tr>
         </table> 
       </div>
       <!--CUARTA TABLA-->
              <div class="wdgt wdgt-primary" hide-btn="true">
        <div class="wdgt-header" align="center">
       D- SUBCONTRATOS
       </div>
         
        <div class="wdgt-body wdgt-table">

         <table class="table" id="table_subcontratos">
          <thead >
            <tr >
           
           <th>Descripcion</th>
           <th>U</th>
           <th>Cantidad</th>
           <th>Valor</th>
           <th>Subtotal</th>
            </tr>
          </thead>
           <tbody>
         <?php  
          $num_rowsSC = mysqli_num_rows($resultado4);
          $numSC=0;
          if( $num_rowsSC > 0){
          while ($fila4 = mysqli_fetch_array($resultado4)) {?>
         
            <tr id="subcontrato<?php echo "$numSC"; ?>"  class="selected" onclick="seleccionar(this.id) " value=" " >
           
           <td><input type="text" style="border:none"    value="<?php echo "$fila4[descripcion]";?>" name="descripcionsc[<?php echo "$numSC"; ?>]"   ></td>
           <td><input type="text" style="border:none"    value="<?php echo "$fila4[unidad]";?>"      name="unidadsc[<?php echo "$numSC"; ?>]"   ></td>
           <td><input type="number" style="border:none"    value="<?php echo "$fila4[cantidad]";?>"    name="cantidadsc[<?php echo "$numSC"; ?>]"   ></td>
           <td><input type="number" style="border:none"    value="<?php echo "$fila4[valor]";?>"       name="valorsc[<?php echo "$numSC"; ?>]"   ></td>
           <td><input type="number" style="border:none"    value="<?php echo "$fila4[subTotal]";?>"    name="subTotalsc[<?php echo "$numSC"; ?>]"   ></td>
            </tr>

            <?php $numSC=$numSC+1; } }?>
               </tbody>

         </table>

        
        </div>
         <table>
         <tbody>
              <tr>
            <td></td>
            <td></td>
            <td></td>
            <td> <strong>SUBTOTAL</strong> </td>
            <td><input type="text" value="<?php echo "$filaTotales[totalSubContratos]"; ?>" name="totalSC" style="border:none" disabled> </td>
            </tr></tbody></table>
         <table>
         <tr>  <td>
         <button type="button"  id="new-row-subcontratos" class="btn btn-primary btn-tooltip" data-placement="bottom" data-original-title="Agregar nuevo Sub-Contrato" data-target="#modalAgregarSubcontrato"  data-toggle="modal"><i class="icon icon-plus"></i></button></td>
         
         <td><button id="detele" type="button"  class="btn btn-danger btn-tooltip" data-placement="bottom" title="" data-original-title="Eliminar Sub-Contrato" data-target="#modalSubContrato"  data-toggle="modal" disabled=true><i class="icon icon-remove" ></i></button></td></tr>
         <!--LISTA DE MODAL-->
         <!--MODAL ELIMINAR MATERIAL-->
            <div class="modal fade" id="modalMaterial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
           <div class="modal-content">
            
            <div class="modal-body">

      <div class="alert alert-warning"><span class="icon icon-warning-sign"></span> 
      <strong>Cuidado!</strong>  Esta seguro que desea eliminar este material</div>
             
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
             <button type="button" class="btn btn-warning"  id="delete-row-material" data-dismiss="modal">Aceptar</button>
            </div>
           </div>
          </div>
         </div> 
         <!--MODAL MANO OBRA-->
         <div class="modal fade" id="modalManoObra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
           <div class="modal-content">
            
            <div class="modal-body">

      <div class="alert alert-warning"><span class="icon icon-warning-sign"></span> 
      <strong>Cuidado!</strong>  Esta seguro que desea eliminar Mano de Obra</div>
             
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
             <button type="button" class="btn btn-warning"  id="delete-row-manoObra" data-dismiss="modal">Aceptar</button>
            </div>
           </div>
          </div>
         </div>

         <!--MODAL HERRAMIENTA-->

         <div class="modal fade" id="modalHerramienta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
           <div class="modal-content">
            
            <div class="modal-body">

      <div class="alert alert-warning"><span class="icon icon-warning-sign"></span> 
      <strong>Cuidado!</strong>  Esta seguro que desea este Equipo o Herramienta</div>
             
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
             <button type="button" class="btn btn-warning"  id="delete-row-herramienta" data-dismiss="modal">Aceptar</button>
            </div>
           </div>
          </div>
         </div>

         <!-- MODAL PARA AGREGAR SUBCONTRATO-->
        
         


        </table>
       </div>
       <!-- QUINTA TABLA -->
       <table class="table" align="center">
         
          <tbody>
             <?php  

        while($filaC= mysqli_fetch_array($resultadoC)) { ?>
            <tr>
           
           <td>COSTO DIRECTO</td>
           <td><?php  echo "$filaC[totalCD]";?></td>
            </tr>
            <tr>
              
              <td>COSTO INDIRECTO</td>
              <td><input type="number" value="<?php  echo "$filaC[totalCF]";?>" name="nuevoTotalCI" style="border:none"> </td>
            </tr>
            <tr>
              <td>COSTO UNITARIO</td>
              <td><?php  echo "$filaC[precioUnitario]";?></td>
            </tr>

            <?php }?>

            
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
     </form>

      </div>
     </div>

    </div>
    <!-- END PAGE CONTENT -->

   </div>
   <!-- END NAV, CRUMBS, & CONTENT -->
 



  </div>
  <!-- MODAL PARA INGRESAR MANO DE OBRA-->
  <div class="modal fade" id="modal-manoObra" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header modal-primary">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Ingresar Mano de Obra</h4>
                    </div>
                    <div class="modal-body">

                      <!-- content goes here -->
                      <form class="form-horizontal" action="agregarElementosPartida.php?numero= <?php echo "$numeroPartida";?>" method="POST">

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Descripcion</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="descripcion-manoObra" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Jornada</label>
                          <div class="col-lg-7">
                            <input type="number" class="form-control" name="jornada-manoObra" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">FP</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="FP" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Rendimiento</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="rendimiento" required/>
                          </div>
                        </div>

                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-success" name="agregar" value="Agregar">Ingresar</button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="reset" class="btn btn-info">Limpiar</button>
                          </div>
                        </div>

                      </form>

                    </div>
                    
                  </div>
                </div>
              </div>
  <!-- MODAL PARA INGRESAR EQUIPO Y HERRAMIENTAS-->
  <div class="modal fade" id="modalIngresarEH" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header modal-primary">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Ingresar Equipo y Herramientas</h4>
                    </div>
                    <div class="modal-body">

                      <!-- content goes here -->
                      <form class="form-horizontal" action="agregarElementosPartida.php?numero= <?php echo "$numeroPartida";?>" method="POST">

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Descripcion</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="descripcion-herramienta" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Tipo</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="tipo-herramienta"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Capacidad</label>
                          <div class="col-lg-7">
                            <input type="number" class="form-control" name="capacidad-herramienta"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Rendimiento</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="rendimiento-herramienta"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Costo Hora</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="costoHora"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Sub-Total</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="subTotal-herramienta" required/>
                          </div>
                        </div>

                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-success" name="agregar2" value="Agregar">Ingresar</button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="reset" class="btn btn-info">Limpiar</button>
                          </div>
                        </div>

                      </form>

                    </div>
                    
                  </div>
                </div>
              </div>
  <!-- MODAL INSERTAR SUBCONTRATO -->
    <div class="modal fade" id="modalAgregarSubcontrato" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header modal-primary">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Ingresar Sub-Contratos</h4>
                    </div>
                    <div class="modal-body">

                      <!-- content goes here -->
                      <form  action="agregarElementosPartida.php?numero= <?php echo "$numeroPartida";?>" method="POST" >
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Descripcion</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="descripcion" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Unidad</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="unidad"  maxlength="3" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Cantidad</label>
                          <div class="col-lg-7">
                            <input type="number" class="form-control" name="cantidad" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Valor</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="valor" required/>
                          </div>
                        </div>

                         <div class="form-group">
                          <label class="col-lg-3 control-label">Sub-Total</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="subtotal"  required/>
                          </div>
                        </div>

                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary" name="agregar3">Ingresar</button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="reset" class="btn btn-info">Limpiar</button>
                          </div>
                        </div>

                      </form>

                    </div>
                    
                  </div>
                </div>
              </div>
    <!-- MODAL PARA ELIMINAR SUBCONTRATO-->
         <div class="modal fade" id="modalSubContrato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
           <div class="modal-content">
            
            <div class="modal-body">
            <formaction="agregarElementosPartida.php?numero= <?php echo "$numeroPartida";?>" method="POST">
      <div class="alert alert-warning"><span class="icon icon-warning-sign"></span> 
      <strong>Cuidado!</strong>  Esta seguro que desea eliminar este Sub-Contrato</div>
             
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
             <button type="button" class="btn btn-warning"  id="delete-row-subcontrato" data-dismiss="modal">Aceptar</button>
            </div>
            </form>
           </div>
          </div>
         </div>
  
   <!-- Default JS (DO NOT TOUCH) -->
  <script src="../lib/JS/jquery-3.1.0.min.js"></script>
  <script src="../lib/JS/bootstrap.min.js"></script>
  <script src="../lib/JS/hogan.min.js"></script>
  <script src="../lib/JS/typeahead.min.js"></script>
  <script src="../lib/JS/typeahead-example.js"></script>
  
  <!-- Adjustable JS -->
  <script src="../lib/JS/soft-widgets.js"></script>
  <script src="../lib/JS/icheck.js"></script>
  <script src="../lib/js/jquery.jgrowl.min.js"></script>
  <script>
   $(document).ready(function(){
    $.jGrowl.defaults.pool = 5;
    $.jGrowl.defaults.position = 'bottom-right';
    $('.btn.btn-primary.btn-tooltip').tooltip();
    $('.btn.btn-danger.btn-tooltip').tooltip();

   
   });
  </script>
  <script>
   $(document).ready(function() { 
    $('.flat-checkbox').iCheck({
     checkboxClass: 'icheckbox_flat-purple',
     radioClass: 'iradio_flat-purple'
    });
   });

  
   
  </script>
  <!--Seleccion de filas de MANO DE OBRA-->

   <script>

   //seleccionar material
   var numeroMaterial=<?php echo "$numeroM";?>;
  

     function seleccionarMaterial(id_fila){

        if($('#'+id_fila).hasClass('seleccionada')){
          $('#'+id_fila).removeClass('seleccionada');
          $('#deleteMaterial').attr('disabled', true);
         
        }
        else{
          for(var i=0;i<=numeroMaterial;i++){
            $('#material'+i).removeClass('seleccionada');
          }
          $('#'+id_fila).addClass('seleccionada');
         $('#deleteMaterial').attr('disabled', false);
        }

        id_fila_selected=id_fila;


    }

    //Seleccion de filas de Mano de Obra
    function seleccionarMO(id_fila){

        if($('#'+id_fila).hasClass('seleccionada')){
          $('#'+id_fila).removeClass('seleccionada');
          $('#deleteMO').attr('disabled', true);
         
        }
        else{
          for(var i=0;i<=numeroMaterial;i++){
            $('#mano-obra'+i).removeClass('seleccionada');
          }
          $('#'+id_fila).addClass('seleccionada');
         $('#deleteMO').attr('disabled', false);
        }

        id_fila_selected=id_fila;


    }

    
  </script>

  <!-- Seleccion de filas de EQUIPO Y HERRAMIENTAS -->

  <script>
  var numeroH=<?php echo "$numEH"?>;
     function seleccionarH(id_fila){

        if($('#'+id_fila).hasClass('seleccionada')){
          $('#'+id_fila).removeClass('seleccionada');
          $('#deleteHerramienta').attr('disabled', true);
         
        }
        else{
          for(var i=0;i<=numeroH;i++){
            $('#herramienta'+i).removeClass('seleccionada');
          }
          $('#'+id_fila).addClass('seleccionada');
         $('#deleteHerramienta').attr('disabled', false);
        }

        id_fila_selected=id_fila;
    }


    

    
  </script>
  <!--Seleccion de filas de SUBCONTRATOS-->
  <script>
  var numero=<?php echo "$numeroMO"?>;
     function seleccionar(id_fila){

        if($('#'+id_fila).hasClass('seleccionada')){
          $('#'+id_fila).removeClass('seleccionada');
          $('#detele').attr('disabled', true);
         
        }
        else{
          for(var i=0;i<=numero;i++){
            $('#subcontrato'+i).removeClass('seleccionada');
          }
          $('#'+id_fila).addClass('seleccionada');
         $('#detele').attr('disabled', false);
        }

        id_fila_selected=id_fila;
    }
   
  </script>
  <script>
    $( function() {
    var tooltips = $( "[title]" ).tooltip({
      position: {
        my: "left top",
        at: "right+5 top-5",
        collision: "none"
      }
    });
});
    
  </script>

<!-- SCRIPT DE ELIMINACION-->
<script type="text/javascript">
//ELIMINACION DE MATERIAL
$('#delete-row-material').click(function(){
        //Recogemos la id del contenedor padre
        

       var idDescripcion = $('#'+id_fila_selected).children('td:eq(0)');


        //Recogemos el valor del servicio
        $.ajax({
            url: "agregarElementosPartida.php",
            method: "POST",
            data: { dMaterial: idDescripcion } ,

            success: function() {            
               
               // $('#delete-ok').append('<div>Se ha eliminado el sub contrato '+idDescripcion+'  correctamente.</div>').fadeIn("slow");
                 $('#deleteMO').attr('disabled', true);
                $('#detele').attr('disabled', true);
                $('#deleteHerramienta').attr('disabled', true);
                $('#'+id_fila_selected).remove();
            }
      
        }); 
    }); 
//ELIMINACION DE MANO DE OBRA
$('#delete-row-manoObra').click(function(){
        //Recogemos la id del contenedor padre
        

       var idDescripcion = $('#'+id_fila_selected).children('td:eq(0)').children('input:eq(0)').attr('value');


        //Recogemos el valor del servicio
        $.ajax({
            url: "agregarElementosPartida.php",
            method: "POST",
            data: { dMO:idDescripcion } ,

            success: function() {            
               
               // $('#delete-ok').append('<div>Se ha eliminado el sub contrato '+idDescripcion+'  correctamente.</div>').fadeIn("slow");
                 $('#deleteMO').attr('disabled', true);
                $('#detele').attr('disabled', true);
                $('#deleteHerramienta').attr('disabled', true);
                $('#'+id_fila_selected).remove();
            }
      
        }); 
    }); 
//ELIMINACION DE HERRAMIENTA Y EQUIPO
 $('#delete-row-herramienta').click(function(){
        //Recogemos la id del contenedor padre
        

       var idDescripcion = $('#'+id_fila_selected).children('td:eq(0)').children('input:eq(0)').attr('value');


        //Recogemos el valor del servicio
        $.ajax({
            url: "agregarElementosPartida.php",
            method: "POST",
            data: { dH:idDescripcion } ,

            success: function() {            
               
               // $('#delete-ok').append('<div>Se ha eliminado el sub contrato '+idDescripcion+'  correctamente.</div>').fadeIn("slow");
                 $('#deleteMO').attr('disabled', true);
                $('#detele').attr('disabled', true);
                $('#deleteHerramienta').attr('disabled', true);
                $('#'+id_fila_selected).remove();
            }
      
        }); 
    }); 

    $('#delete-row-subcontrato').click(function(){
        //Recogemos la id del contenedor padre
         $('#'+id_fila_selected).attr('value','prueba');

       var idDescripcion = $('#'+id_fila_selected).children('td:eq(0)').children('input:eq(0)').attr('value');


        //Recogemos el valor del servicio
        $.ajax({
            url: "agregarElementosPartida.php",
            method: "POST",
            data: { d:idDescripcion } ,

            success: function() {            
               
               // $('#delete-ok').append('<div>Se ha eliminado el sub contrato '+idDescripcion+'  correctamente.</div>').fadeIn("slow");
                 $('#deleteMO').attr('disabled', true);
                $('#detele').attr('disabled', true);
                $('#deleteHerramienta').attr('disabled', true);
                $('#'+id_fila_selected).remove();
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