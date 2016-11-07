<?php 


  require'../services/conn.php';
  require_once '../model/Usuario.php';
  
  session_start();

 if (!isset($_SESSION["userData"])){
    session_destroy();
    header("Location: home.php");
    exit();
  }
    $userData = $_SESSION["userData"];
    session_write_close();
  $db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "prueba_sgp_system")->getConnection();

$numeroPartida = $_GET['numero'];

$query= "SELECT numero, version, nombre, totalCD, totalCF, precioUnitario, totalMateriales, totalManoObra, totalEquipoHerramientas, totalSubContratos FROM partida WHERE numero=".$numeroPartida." HAVING version = MAX(version)";
$resultado= $db->query($query);
            
$query1="SELECT b.id, a.nombre, a.unidad, b.cantidad, a.total, b.subTotal, d.version partidaVersion FROM recurso a INNER JOIN linearecurso b ON a.codigo = b.codigo AND a.version = b.version INNER JOIN linearecursoPartida c ON b.id = c.idLinea INNER JOIN partida d ON c.numPartida = d.numero AND c.versionPartida = d.version WHERE d.numero=".$numeroPartida." GROUP BY b.id HAVING d.version = MAX(d.version)";
$resultado1=$db->query($query1);

$query2="SELECT a.id, a.descripcion, a.jornada, a.FP, a.jornadaTotal, a.rendimiento, a.subTotal, c.version partidaVersion FROM lineamanoobra a INNER JOIN lineamanoobraPartida b ON a.id = b.idLinea INNER JOIN partida c ON b.numPartida = c.numero AND b.versionPartida = c.version WHERE numero = ".$numeroPartida." HAVING c.version = MAX(c.version)";
  $resultado2=$db->query($query2);
$query3="SELECT a.id, a.descripcion, a.tipo, a.capacidad, a.rendimiento, a.costoHora, a.subTotal, c.version partidaVersion FROM lineaequipoherramienta a INNER JOIN lineaequipoherramientaPartida b ON b.idLinea INNER JOIN partida c ON b.numPartida = c.numero AND b.versionPartida = c.version WHERE c.numero = ".$numeroPartida." HAVING c.version = MAX(c.version)";
  $resultado3=$db->query($query3);
$query4="SELECT a.id, a.descripcion, a.unidad, a.cantidad, a.valor, a.subTotal, c.version partidaVersion FROM  lineasubcontrato a INNER JOIN lineasubcontratoPartida b ON  b.idLinea = a.id INNER JOIN partida c ON b.numPartida = c.numero AND b.versionPartida = c.version WHERE c.numero = ".$numeroPartida." HAVING c.version = MAX(c.version)";
$resultado4=$db->query($query4);

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
  <link type="text/css" rel="stylesheet" href="../lib/CSS/icheck.css?v=1.0.1"/>
  
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
      <form action="modPartida_exe.php" method="POST">
      <!-- ENCABEZADO-->
      <input type="hidden" value="<?php echo $numeroPartida; ?>" name="idPartida" />
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
       $fila = $resultado->fetch_object() ?>
          Partida N°  <?php echo $fila->numero; ?>  UNIDAD: <br>
          <?php
          echo $fila->nombre."<br>";
        ?><br></div>
       <input type="hidden" value="<?php echo $fila->version; ?>" name="version" />
       </div>
       <!--PRIMERA TABLA-->
          <div class="wdgt wdgt-primary" hide-btn="true">
        <div class="wdgt-header" align="center">
       A- MATERIALES
       </div>
         
        <div class="wdgt-body wdgt-table">
         <table class="table" id="table-mat-prima">
          <thead >
            <tr >
          
           <th align="center">Descripcion</th>
           <th>U</th>
           <th>Cantidad</th>
           <th>Valor</th>
           <th>Subtotal</th>
           <th>Acciones</th>
            </tr>
          </thead>
           <tbody>
           <?php  
          $num_rows = $resultado1->num_rows;
          if($num_rows > 0){

        
        while ($fila_m = $resultado1->fetch_object()) { ?>
         
         
            <tr class="materiaPrima">
           <input type="hidden" class="id" name="idLineaMatPrima[]" value="<?php echo $fila_m->id; ?>"/>
           <td><span><?php echo $fila_m->nombre; ?></span></td>
           <td><span><?php echo $fila_m->unidad; ?></span></td>
           
           <td><input type="hidden" name="cantidadMateria[]" value="<?php echo $fila_m->cantidad; ?>"/><span><?php echo $fila_m->cantidad; ?></span></td>
           <td><input type="hidden" name="subTotal_recursos[]" value="<?php echo $fila_m->subTotal; ?>"/><span><?php echo $fila_m->total; ?></span></td>
           

           <td><span class="subtotal"><?php echo $fila_m->subTotal; ?></span></td>
           <td><button type="button" class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button>
           <button type="button" class="editar btn btn-info btn-sm"><i class="icon icon-edit" ></i></button></td>

            </tr>
            <?php } } ?>
             </tbody>


         </table>
          </div>
      
       
          <table>
              <tr>
            <td></td>
              <td></td>
                <td></td>
            <td> <strong>SUBTOTAL:</strong></td>
            <td class="subtotal" id="subtotalMatPrima">&nbsp;<?php echo $fila->totalMateriales; ?></td>
            </tr>
          </table>

          <table>
          <tr>
            <td><button type="button" id="new-row-material" class="btn btn-primary btn-tooltip"><i class="icon icon-plus"></i></button></td>
          </tr>

        </table>
         
      </div>
         
        
       
         
       <!-- SEGUNDA TABLA-->
        <div class="wdgt wdgt-primary" hide-btn="true">
        <div class="wdgt-header" align="center">
       B- MANO DE OBRA
       </div>
         
        <div class="wdgt-body wdgt-table">

         <table class="table" id="table-mano-obra">
          <thead >
            <tr >
           
           <th>Descripcion</th>
           <th>Jorn.</th>
           <th>F.P.</th>
           <th>Jorn. Total</th>
           <th>Rendimiento</th>
           <th>Subtotal</th>
           <th>Acciones</th>
            </tr>
          </thead>
           <tbody>
         <?php  
          
           $num_rowsMO = $resultado2->num_rows;
           
          if($num_rowsMO > 0){
         
        while ($fila_mo = $resultado2->fetch_object()) { ?>
          
         
            <tr class="manoObra">
           <input type="hidden" class="id" name="idLineaMO[]" value="<?php echo $fila_mo->id; ?>"/>
           <td><input type="hidden" name="descripcionMO[]" value="<?php echo $fila_mo->descripcion; ?>"/><span><?php echo $fila_mo->descripcion; ?></span></td>
           <td><input type="hidden" name="jornadaMO[]" value="<?php echo $fila_mo->jornada; ?>"/><span><?php echo $fila_mo->jornada; ?></span></td>
           <td><input type="hidden" name="FPMO[]" value="<?php echo $fila_mo->FP; ?>"/><span><?php echo $fila_mo->FP; ?></span></td>
           <td><span><?php echo $fila_mo->jornadaTotal; ?></span></td>
           <td><input type="hidden" name="rendimientoMO[]" value="<?php echo $fila_mo->rendimiento; ?>"/><span><?php echo $fila_mo->rendimiento; ?></span></td> 
           <td><input type="hidden" value="<?php echo $fila_mo->subTotal; ?>" name="subTotalMO[]"/><span class="subtotal"><?php echo $fila_mo->subTotal; ?></span></td>
           <td><button type="button" class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button>
           <button type="button" class="editar btn btn-info btn-sm"><i class="icon icon-edit"></i></button></td>
            </tr>
          <?php }  } ?>

             </tbody>
          

         </table>
        
       </div>

        <table>
              <tr>
            <td></td>
              <td></td>
                <td></td>
                <td></td>
            <td><strong>SUBTOTAL:</strong></td>
            <td class="subtotal" id="subTotalMO">&nbsp;<?php echo $fila->totalManoObra; ?></td>
            </tr></table>

         
        <table>
          <tr>
            <td><button type="button" id="new-row-mano-obra" class="btn btn-primary btn-tooltip"><i class="icon icon-plus"></i></button></td>
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
           <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
             <?php  

          $num_rowsEH = $resultado3->num_rows;
          
          if( $num_rowsEH > 0){
                while ($fila_EH = $resultado3->fetch_object()) { ?>
          
            <tr class="EH">
           <input type="hidden" class="id" name="idLineaEH[]" value="<?php echo $fila_EH->id; ?>"/>
           <td><input type="hidden" name="descripcionEH[]" value="<?php echo $fila_EH->descripcion; ?>" /><span><?php echo $fila_EH->descripcion; ?></span></td>
           <td><input type="hidden" name="tipoEH[]" value="<?php echo $fila_EH->tipo; ?>"/><span><?php echo $fila_EH->tipo; ?></span></td>
           <td><input type="hidden" name="capacidadEH[]" value="<?php echo $fila_EH->capacidad; ?>"/><span><?php echo $fila_EH->capacidad; ?></span></td>
           <td><input type="hidden" name="rendimientoEH[]" value="<?php echo $fila_EH->rendimiento; ?>"/><span><?php echo $fila_EH->rendimiento; ?></span></td>
           <td><input type="hidden" name="costo_hora[]" value="<?php echo $fila_EH->costoHora; ?>"/><span><?php echo $fila_EH->costoHora; ?></span></td>
           <td><input type="hidden" name="subTotalEH[]" value="<?php echo $fila_EH->subTotal; ?>"/><span class="subtotal"><?php echo $fila_EH->subTotal; ?></span></td>
           <td><button type="button" class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button>
           <button type="button" class="editar btn btn-info btn-sm"><i class="icon icon-edit" ></i></button></td>
            </tr> 
            <?php } } ?>
               </tbody>
         </table>
           </div>
        <table>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            <td> <strong>SUBTOTAL:</strong></td>
            <td class="subtotal" id="subtotal_EH">&nbsp;<?php echo $fila->totalEquipoHerramientas; ?></td>
            </tr></table>

       
      
        <table>
        <tr>        
         <td><button type="button" id="new-row-equipoHerramienta" class="btn btn-primary btn-tooltip"><i class="icon icon-plus"></i></button></td>
         </tr>
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
           <th>Acciones</th>
            </tr>
          </thead>
           <tbody>
         <?php  
          $num_rowsSC = $resultado4->num_rows;
          if( $num_rowsSC > 0){
          while ($fila_sub = $resultado4->fetch_object()) { ?>
         
            <tr class="subcontrato">
            <input type="hidden" class="id" name="idLineaSC[]" value="<?php echo $fila_sub->id; ?>/"/>
           
           <td><input type="hidden" name="descripcionsc[]" value="<?php echo $fila_sub->descripcion; ?>"/><span><?php echo $fila_sub->descripcion; ?></span></td>
           <td><input type="hidden" name="unidadsc[]" value="<?php echo $fila_sub->unidad; ?>"/><span><?php echo $fila_sub->unidad; ?></span></td>
           <td><input type="hidden" name="cantidadsc[]" value="<?php echo $fila_sub->cantidad; ?>"/><span><?php echo $fila_sub->cantidad; ?></span></td>
           <td><input type="hidden" name="valorsc[]" value="<?php echo $fila_sub->valor; ?>"/><span><?php echo $fila_sub->valor; ?></span></td>
           <td><input type="hidden" name="subtotalsc[]" value="<?php echo $fila_sub->subTotal; ?>"/><span class="subtotal"><?php echo $fila_sub->subTotal; ?></span></td>
           <td><button type="button" class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button>
           <button type="button" class="editar btn btn-info btn-sm"><i class="icon icon-edit" ></i></button></td>
            </tr>

            <?php } } ?>
               </tbody>

         </table>

        
        </div>
         <table>
         <tbody>
              <tr>
            <td></td>
            <td></td>
            <td></td>
            <td> <strong>SUBTOTAL:</strong> </td>
            <td class="subtotal" id="subtotal-subcontrato">&nbsp;<?php echo $fila->totalSubContratos; ?></td>
            </tr></tbody></table>
         <table>
         <tr>  <td>
         <button type="button"  id="new-row-subcontratos" class="btn btn-primary btn-tooltip"><i class="icon icon-plus"></i></button></td>
         </tr>
         <!--LISTA DE MODAL-->
        </table>
       </div>
       <!-- QUINTA TABLA -->
       <table class="table" align="center">
         
          <tbody>
            <tr>
           
           <td>COSTO DIRECTO</td>
           <td id="cd"><?php  echo $fila->totalCD;?></td>
            </tr>
            <tr>
              
              <td>COSTO INDIRECTO</td>
              <td><input type="number" value="<?php  echo $fila->totalCF; ?>" name="CI" step="any"/> </td>
            </tr>
            <tr>
              <td>COSTO UNITARIO</td>
              <td id="cu"><?php echo $fila->precioUnitario; ?></td>
            </tr>            
          </tbody>


         </table>
         <div>  

          <button  type="submit" class="btn btn-primary btn-round" name="enviarCambios" disabled>Relizar cambios</button>
          <br>    <br>   <br>              
          
               
        </div>
        </form>
       <!-- FIN DE TABLAS-->

     
      <!--MODAL ELIMINAR-->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
           <div class="modal-content">
            
            <div class="modal-body">

      <div class="alert alert-warning"><span class="icon icon-warning-sign"></span> 
      <strong>Cuidado</strong> <span id="confirmMessage"></span></div>
             
            </div>
            <div class="modal-footer">
             <button type="button" class="btn btn-dark" id="cancel">Cancelar</button>
             <button type="button" class="btn btn-warning"  id="accept">Aceptar</button>
            </div>
           </div>
          </div>
         </div> 

       <div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
              <div class="modal-dialog" style="width:75%">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="lineModalLabel">Recursos</h3>
                  </div>
                  <div class="modal-body">

                    <!-- content goes here -->

                    <div class="content">

                      <div class="tbl">
                        <div class="col-md-12">
                          <div class="wdgt" hide-btn="true">
                            <div class="wdgt-header">Tabla de recursos</div>
                            <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">
                              <table id="recursos-seleccion" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">


                                <!--ENCABEZADO DE LA TABLA RECURSOS -->

                                <thead>
                                  <tr>
                                    <th>Código</th>
                                    <th>Nombre del recurso</th>
                                    <th>Unidad</th>
                                    <th>Costo Directo</th>
                                    <th>Iva</th>
                                    <th>Total</th>
                                    <th>Fecha Modificación</th>
                                    <th>Empresa Proveedora</th>
                                    <th>Tipo de recurso</th>
                                    <th></th>





                                  </tr>
                                </thead>


                                <!--CUERPO DE LA TABLA RECURSOS -->


                                <tbody>
<?php
$sql = $db->query("SELECT codigo, version, nombre, unidad, costoDirecto, iva, total, fecha, empresaProveedora, tipoRecurso FROM recurso GROUP BY codigo HAVING version = MAX(version)");
while ($row = $sql->fetch_array()) {
    echo '<tr>';
    echo '<td>'. $row['codigo'] . '</td>';
    echo '<td>'. $row['nombre'] .'</td>';
    echo '<td>'. $row['unidad'] .'</td>';
    echo '<td>'. $row['costoDirecto'] . '</td>';
    echo '<td>'. $row['iva'] .'</td>';
    echo '<td>'. $row['total'] .'</td>';
    echo '<td>'. $row['fecha'] . '</td>';
    echo '<td>'. $row['empresaProveedora'] . '</td>';
    echo '<td>'. $row['tipoRecurso'] . '</td>';
    
    $nombre=$row['nombre'];
    $codigo=$row['codigo'];
    $unidad = $row['unidad'];
    $valor = $row['total'];
    $version = $row["version"];
    
    
    
    echo '<td><button onclick="cantidad(\''.$codigo.'\', \''.$nombre.'\', \''.$unidad.'\', \''.$valor.'\', \''.$version.'\')">Agregar</button></td>';
    
    
    
    
    
    
    echo '</tr>';
}?>                            </tbody>
                              </table>



                            </div>
                          </div>

                        </div>
                      </div>

                    </div>
                    </div>
                </div>
              </div>
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
                      <form class="form-horizontal">

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Descripcion</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="descripcion" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Jornada</label>
                          <div class="col-lg-7">
                            <input type="number" class="form-control" name="jornada" required/>
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
                            <button type="button" class="btn btn-success" name="agregar" value="Agregar">Ingresar</button>
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
                      <form class="form-horizontal">

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Descripcion</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="descripcion" required/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Tipo</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="tipo"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Capacidad</label>
                          <div class="col-lg-7">
                            <input type="number" class="form-control" name="capacidad"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Rendimiento</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="rendimiento"/>
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
                            <input type="number" step="0.01" class="form-control" name="subTotal" required/>
                          </div>
                        </div>

                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-success" name="agregar2" value="Agregar">Ingresar</button>
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
                      <form class="form-horizontal">
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
                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary" name="agregar3">Ingresar</button>
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
              <!-- MODAL EDITAR MATERIALES -->
    <div class="modal fade" id="modalEditarMateriales" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header modal-primary">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Editar Materia Prima</h4>
                    </div>
                    <div class="modal-body">

                      <!-- content goes here -->
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Cantidad</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="cantidad" required/>
                          </div>
                        </div>
                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary" name="agregar4">Ingresar</button>
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

      </div>
        

      </div>
     </div>
     </div>

    <!-- END PAGE CONTENT -->

   </div>
   <!-- END NAV, CRUMBS, & CONTENT -->
 
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
  <script src="../lib/JS/icheck.js"></script>
  <script src="../lib/js/jquery.jgrowl.min.js"></script>
  <script>
   $(document).ready(function(){
    $('#squarespaceModal').modal({ show: false});
        $("#modal-manoObra").modal({show: false});
        $("#modalIngresarEH").modal({show: false});
        $("#modalAgregarSubcontrato").modal({show: false});
        $("#modalEliminar").modal({show: false});
        $("#modalEditarMateriales").modal({show: false});
        $('.datatable').dataTable({
          "sPaginationType": "bs_full"
        });
        $('.datatable').each(function() {
          var datatable = $(this);
          // SEARCH - Add the placeholder for Search and Turn this into in-line form control
          var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
          search_input.attr('placeholder', 'Search');
          search_input.addClass('form-control input-sm');
          // LENGTH - Inline-Form control
          var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
          length_sel.addClass('form-control input-sm');
        });

    window.cantidadMatPrima= function (codigo, nombre, unidad, valor, version) {
        var cant = "";
        valor = +valor;
        cant = +prompt("Indique la cantidad a agregar de " + nombre + ":", "");
        $('#squarespaceModal').modal('hide');
        if (cant != null) {
          var subtotal = valor * cant;
         if (/^([0-9])*$/.test(cant)){
          $("#recursos tr:last td").each(function(index){
            if (index == 0){
              $("input[type='hidden']", this).val(codigo);
              $("span", this).text(nombre);
            }else if(index == 1){
              $("input[type='hidden']", this).val(cant.toFixed(2));
              $("span", this).text(unidad);
            }else if(index == 2){
              $("input[type='hidden']", this).val(version);
              $("span", this).text(cant.toFixed(2));
            }
            else if(index == 3){
              $("span", this).text(valor.toFixed(2));
            }
            else if(index == 4){
              $("input[type='hidden']", this).val(subtotal.toFixed(2));
              $("span", this).text(subtotal.toFixed(2));
            }
          });
          var total_recursos = +$("#sub-total-recursos").text() + subtotal;
          $("#sub-total-recursos").text(total_recursos.toFixed(2));
        }
         
        else {
         alert("El valor " + cant + " no es un número");
        }
        total();
       }
        }

    $("#new-row-material").click(function() {
          $('#squarespaceModal').modal('show');
          var table = $("#table-mat-prima");

          html = "<tr><td><span></span><input type='hidden' name='codigo[]'/></td><td><span></span><input type='hidden' name='cantidadMateria[]'/></td><td><input type='hidden' name='version[]'/><span></span></td><td><span></span></td><td><span class='subtotal'></span><input type='hidden' name='subTotal_recursos[]'/></td><td><button type='button' class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button>&nbsp;<button type='button' class='editar btn btn-info btn-sm'><i class='icon icon-edit' ></i></button></td></tr>";
          table.append(html);
           $("button[name='enviarCambios']").prop("disabled", false);
        });

    $("#modalEditarMateriales form button[name='agregar4']").click(function(){
      cantidad = + $(this).parents("form").find("input[name='cantidad']").val();
       var selector = '';
          if (length > 0) {
            selector = $("#table-mat-prima tr.selected td");
          }else{
            selector = $("#table-mat-prima tr:last td");
          }
          var valor = + selector.eq(3).find("span").text();
          var cantidadAnterior = +selector.eq(2).find("span").text();
          var subTotalAnterior = valor * cantidadAnterior;

          subTotal = valor * cantidad;
          selector.each(function(index){
            if (index == 2) {
              $("span", this).text(cantidad);
              $("input[type='hidden']", this).val(cantidad);
            } else if (index == 3){
              $("input[type='hidden']", this).val(subTotal);
            }
            else if (index == 4) {
           
              $("span", this).text(subTotal);
            }
          });
          $("#table-mat-prima tr").removeClass("selected");
          $("#modalEditarMateriales").modal("hide");
          var total_MatPrima = +$("#subtotalMatPrima").text() + (subTotal - subTotalAnterior);
          $("#subtotalMatPrima").text(total_MatPrima.toFixed(2));
          total();
          $(this).parents("form").find(":input").val("");
    });

    $(document).on("click", ".eliminar", function(){
      var row = $(this).closest("tr");
       var total1 = +$(this).parents("div.wdgt-primary").find("table tr td.subtotal").text();
      var subtotal = +$(this).closest("tr").find("td span.subtotal").text();
        confirmDialog("Esta seguro que desea eliminar el registro", function(){
          $("button[name='enviarCambios']").prop("disabled", false);
          total1 = total1 - subtotal;
          row.parents("div.wdgt-primary").find("table tr td.subtotal").text(total1.toFixed(2));
          countRows = $("#table-mat-prima tbody tr").length + $("#table-mano-obra tbody tr").length + $("#table_Herramienta tbody tr").length + $("#table_subcontratos tbody tr").length;
          if (countRows <= 0) {
             $("button[name='enviarCambios']").prop("disabled", true);
          }
          var version = $("input[name='version']").val();
          var idPartida = $("input[name='idPartida']").val():
          if(row.find("input.id").length > 0){
            var id = row.closest("tr").find("input.id").val();
            var opt = "";
            var table = row.closest("table").attr("id");
            if (table == "table-mat-prima") {
              opt = 1;
            } else if (table == "table-mano-obra") {
              opt = 2;
            } else if (table == "table_Herramienta") {
              opt = 3;
            } else if (table == "table_subcontratos") {
              opt = 4
            }
            $.ajax({
            url: "eliminarElementosPartida.php",
            method: "POST",
            data: { "opt" : opt , "id" : id, "version" : version, "idPartida" : idPartida } 
          });
          }
          total();
          row.remove();

        });
      });

    $(document).on("click", ".editar", function(){
      var row = $(this).closest("tr");
      row.addClass("selected");
      $("button[name='enviarCambios']").prop("disabled", false);
      var id = $(this).closest("table").attr('id');
        if (id == "table-mat-prima") {
          var modalForm = $("#modalEditarMateriales form");
          var val = row.find("td input[name='cantidadMateria[]']").val();
          modalForm.find("input[name='cantidad']").val(val);
          $("#modalEditarMateriales").modal("show");
        } else if (id == "table-mano-obra") {
          var modalForm = $("#modal-manoObra form");
          var descripcion = row.find("input[name='descripcionMO[]']").val();
          var FP = row.find("input[name='FPMO[]']").val();
          var jornada = row.find("input[name='jornadaMO[]']").val();
          var rendimiento = row.find("input[name='rendimientoMO[]']").val();
          modalForm.find("input[name='rendimiento']").val(rendimiento);
          modalForm.find("input[name='descripcion']").val(descripcion);
          modalForm.find("input[name='FP']").val(FP);
          modalForm.find("input[name='jornada']").val(jornada);
          $("#modal-manoObra").modal('show');
        } else if (id == "table_Herramienta") {
          var modalForm = $("#modalIngresarEH form");
          var descripcion = row.find("input[name='descripcionEH[]']").val();
          var tipo = row.find("input[name='tipoEH[]']").val();
          var capacidad = row.find("input[name='capacidadEH[]']").val();
          var rendimiento = row.find("input[name='rendimientoEH[]']").val();
          var costoHora = row.find("input[name='costo_hora[]']").val();
          var subTotal = row.find("input[name='subTotalEH[]']").val();
          modalForm.find("input[name='descripcion']").val(descripcion);
          modalForm.find("input[name='tipo']").val(tipo);
          modalForm.find("input[name='capacidad']").val(capacidad);
          modalForm.find("input[name='rendimiento']").val(rendimiento);
          modalForm.find("input[name='costoHora']").val(costoHora);
          modalForm.find("input[name='subTotal']").val(subTotal);
          $("#modalIngresarEH").modal("show");
        } else if (id == "table_subcontratos") {
          modalForm = $("#modalAgregarSubcontrato form");
          var descripcion = row.find("input[name='descripcionsc[]']").val();
          var unidad = row.find("input[name='unidadsc[]']").val();
          var cantidad = row.find("input[name='cantidadsc[]']").val();
          var valor = row.find("input[name='valorsc[]']").val();
          modalForm.find("input[name='descripcion']").val(descripcion);
          modalForm.find("input[name='unidad']").val(unidad);
          modalForm.find("input[name='cantidad']").val(cantidad);
          modalForm.find("input[name='valor']").val(valor);
          $("#modalAgregarSubcontrato").modal("show");
        }
    });

    function confirmDialog(message, onConfirm){
    var fClose = function(){
        modal.modal("hide");
    };
    var modal = $("#modalEliminar");
    modal.modal("show");
    $("#confirmMessage").empty().append(message);
    $("#accept").one('click', onConfirm);
    $("#accept").one('click', fClose);
    $("#cancel").one("click", fClose);
  }
  function total(){
          var total_subcontrato = +$("#subtotal-subcontrato").text();
          var total_herramienta = +$("#subtotal_EH").text();
          var total_MO = +$("#subTotalMO").text();
          var total_recursos = +$("#subtotalMatPrima").text();
          var cd = total_subcontrato + total_herramienta + total_MO + total_recursos;
          $("#cd").text(cd.toFixed(2));
          var ci = + $("input[name='CI']").val();
          cu = cd * (1 + (ci / 100));
          $("#cu").text(cu.toFixed(2));

        }

   $("#new-row-mano-obra").click(function() {
          $('#modal-manoObra').modal('show');
          var table = $("#table-mano-obra");

          html = "<tr><td><span></span><input type='hidden' name='descripcionMO[]'/></td><td><span></span><input type='hidden' name='jornadaMO[]'/></td><td><span></span><input type='hidden' name='FPMO[]'/></td><td><span></span></td><td><span></span><input type='hidden' name='rendimientoMO[]'/></td><td><span class='subtotal'></span><input type='hidden' name='subTotalMO[]'/></td><td><button type='button' class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button>&nbsp;<button type='button' class='editar btn btn-info btn-sm'><i class='icon icon-edit' ></i></button></td></tr>";
          table.append(html);
          $("button[name='enviarCambios']").prop("disabled", false);
        });

   $("#modal-manoObra form button[name='agregar']").click(function(){
          var descripcion = $(this).parents("form").find("input[name='descripcion']").val();
          var jornada = + $(this).parents("form").find("input[name='jornada']").val();
          var FP = + $(this).parents("form").find("input[name='FP']").val();
          var rendimiento = + $(this).parents("form").find("input[name='rendimiento']").val();
          var jornada_total = jornada * FP;
          var subtotal = jornada_total / rendimiento;
          var seleccionado = $("#table-mano-obra tr.seleccionado").length;
          var selector = '';
          if (length > 0) {
            selector = $("#table-mano-obra tr.selected td");
          }else{
            selector = $("#table-mano-obra tr:last td");
          }
          var subTotalAnterior = +selector.eq(5).find("span").text();
          selector.each(function(index){
            if (index == 0) {
              $("span", this).text(descripcion);
              $("input[type='hidden']", this).val(descripcion);
            }else if (index == 1) {
              $("span", this).text(jornada.toFixed(2));
              $("input[type='hidden']", this).val(jornada.toFixed(2));
            }else if (index == 2) {
              $("span", this).text(FP.toFixed(2));
              $("input[type='hidden']", this).val(FP.toFixed(2));
            }else if (index == 3) {
              $("span", this).text(jornada_total.toFixed(2));
            }else if (index == 4) {
              $("span", this).text(rendimiento.toFixed(2));
              $("input[type='hidden']", this).val(rendimiento.toFixed(2));
            }else if(index == 5){
              $("span", this).text(subtotal.toFixed(2));
              $("input[type='hidden']", this).val(subtotal.toFixed(2));
            }
          });
          $("#table-mano-obra tr").removeClass("selected");
          $("#modal-manoObra").modal("hide");
          var total_MO = +$("#subTotalMO").text() + (subtotal - subTotalAnterior);
          $("#subTotalMO").text(total_MO.toFixed(2));
          total();
          $(this).parents("form").find(":input").val("");
        });

     $("#new-row-equipoHerramienta").click(function() {
          $('#modalIngresarEH').modal('show');
          var table = $("#table_Herramienta");
          var count = table.children("tbody").children("tr").length;

          html = "<tr><td><span></span><input type='hidden' name='descripcionEH[]'/></td><td><span></span><input type='hidden' name='tipoEH[]'/></td><td><span></span><input type='hidden' name='capacidadEH[]'/></td><td><span></span><input type='hidden' name='rendimientoEH[]'/></td><td><span></span><input type='hidden' name='costo_hora[]'/></td><td><span class='subtotal'></span><input type='hidden' name='subTotalEH[]'/></td><td><button type='button' class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button>&nbsp;<button type='button' class='editar btn btn-info btn-sm'><i class='icon icon-edit' ></i></button></td></tr>";
          table.append(html);
           $("button[name='enviarCambios']").prop("disabled", false);
        });

         $("#modalIngresarEH form button[name='agregar2']").click(function(){
          var descripcion = $(this).parents("form").find("input[name='descripcion']").val();
          var tipo = $(this).parents("form").find("input[name='tipo']").val();
          var capacidad =  $(this).parents("form").find("input[name='capacidad']").val();
          var rendimiento = + $(this).parents("form").find("input[name='rendimiento']").val();
          var costo_hora = + $(this).parents("form").find("input[name='costoHora']").val();
          var subtotal = + $(this).parents("form").find("input[name='subTotal']").val();
          var selector = '';
          if (length > 0) {
            selector = $("#table_Herramienta tr.selected td");
          }else{
            selector = $("#table_Herramienta tr:last td");
          }
          var subTotalAnterior = +selector.eq(5).find("span").text();
          selector.each(function(index){
            if (index == 0) {
              $("span", this).text(descripcion);
              $("input[type='hidden']", this).val(descripcion);
            }else if (index == 1) {
              if (tipo.length == 0) {
              $("span", this).text("N/E");
              $("input[type='hidden']", this).val(0);
              }else{
              $("span", this).text(tipo);
              $("input[type='hidden']", this).val(tipo)
              }
            }
            else if (index == 2) {
              if (tipo.length == 0) {
              $("span", this).text("N/E");
              $("input[type='hidden']", this).val(0);
              }else{
              $("span", this).text(capacidad);
              $("input[type='hidden']", this).val(capacidad);
              }
             
            }else if (index == 3) {
              $("span", this).text(rendimiento.toFixed(2));
              $("input[type='hidden']", this).val(rendimiento.toFixed(2));
            }else if (index == 4) {
              $("span", this).text(costo_hora.toFixed(2));
              $("input[type='hidden']", this).val(costo_hora.toFixed(2));
            }else if(index == 5){
              $("span", this).text(subtotal.toFixed(2));
              $("input[type='hidden']", this).val(subtotal.toFixed(2));
            }
          });
          $("#table_Herramienta tr").removeClass("selected");
          $("#modalIngresarEH").modal("hide");
          var total_herramienta = +$("#subtotal_EH").text() + (subtotal - subTotalAnterior);
          $("#subtotal_EH").text(total_herramienta.toFixed(2));
          total();
          $(this).parents("form").find(":input").val("");
        });

         
         $("#new-row-subcontratos").click(function() {
          $('#modalAgregarSubcontrato').modal('show');
          var table = $("#table_subcontratos");
          var count = table.children("tbody").children("tr").length;

          html = "<tr><td><span></span><input type='hidden' name='descripcionsc[]'/></td><td><span></span><input type='hidden' name='unidadsc[]'/></td><td><span></span><input type='hidden' name='cantidadsc[]'/></td><td><span></span><input type='hidden' name='valorsc[]'/></td><td><span class='subtotal'></span><input type='hidden' name='subtotalsc[]'/></td><td><button type='button' class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button>&nbsp;<button type='button' class='editar btn btn-info btn-sm'><i class='icon icon-edit' ></i></button></td></tr>";
          table.append(html);
           $("button[name='enviarCambios']").prop("disabled", false);
        });

         $("#modalAgregarSubcontrato form button[name='agregar3']").click(function(){
          var descripcion = $(this).parents("form").find("input[name='descripcion']").val();
          var unidad =  $(this).parents("form").find("input[name='unidad']").val();
          var cantidad = + $(this).parents("form").find("input[name='cantidad']").val();
          var valor = + $(this).parents("form").find("input[name='valor']").val();
          var subtotal = cantidad * valor;
          var selector = '';
          if (length > 0) {
            selector = $("#table_subcontratos tr.selected td");
          }else{
            selector = $("#table_subcontratos tr:last td");
          }
          var subTotalAnterior = +selector.eq(4).find("span").text();
          $("#table_subcontratos tr:last td").each(function(index){
            if (index == 0) {
              $("span", this).text(descripcion);
              $("input[type='hidden']", this).val(descripcion);
            }else if (index == 1) {
              $("span", this).text(unidad);
              $("input[type='hidden']", this).val(unidad);
            }else if (index == 2) {
              $("span", this).text(cantidad.toFixed(2));
              $("input[type='hidden']", this).val(cantidad.toFixed(2));
            }else if (index == 3) {
              $("span", this).text(valor.toFixed(2));
              $("input[type='hidden']", this).val(valor.toFixed(2));
            }else if(index == 4){
              $("span", this).text(subtotal.toFixed(2));
              $("input[type='hidden']", this).val(subtotal.toFixed(2));
            }
          });
           $("#table_subcontratos tr").removeClass("selected");
          $("#modalAgregarSubcontrato").modal("hide");
          var total_subcontrato = +$("#subtotal-subcontrato").text() + (subtotal - subTotalAnterior);
          $("#subtotal-subcontrato").text(total_subcontrato.toFixed(2));
          total();
          $(this).parents("form").find(":input").val("");
        });
        $('.modal').on('hidden.bs.modal', function () {
          $("#table-mat-prima tr").removeClass("selected");
          $("#table-mano-obra tr").removeClass("selected");
          $("#table_Herramienta tr").removeClass("selected");
          $("#table_subcontratos tr").removeClass("selected");
          $(this).find("form :input").val("");
        });

        $("input[name='CI']").blur(function(){
          cd = + $("#cd").text();
          var ci = + $("input[name='CI']").val();
          cu = cd * (1 + (ci / 100));
          $("#cu").text(cu.toFixed(2));
          $("button[name='enviarCambios']").prop("disabled", false);
        });
      });
  </script>
 </body>
</html>