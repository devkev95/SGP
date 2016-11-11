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

  $db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();

  $idProyecto= $_GET['id'];
	
	$queryProject="SELECT `idProyecto`, `nombre`, `descripcion`, `porcentajeCI`, `fechaInicio`, `fechaFin`, `montoTotal` FROM `proyecto` WHERE idProyecto=".$idProyecto;
	$resultProject= $db->query($queryProject);

  $sql = "call sp_selectEtapas_ModProyecto('1','".$idProyecto."')";
  $resultEtapas= $db->query($sql);




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
       <li><a href="consultarPartidas.php">Proyectos</a></li>
       <li class="active">Modificar Proyecto</li>
      </ol>
     </div>
    </div>
    
    <!-- BEGIN PAGE CONTENT -->
    <div class="content">
     <div class="page-h1">
      <h1>Modificar Proyecto</h1>
     </div>

     <div class="tbl">
      
      <div class="col-md-12">
     	<div class="wdgt-body wdgt-table">
      <h4>Detalle de Proyecto</h4>

         <table class="table" id="table-mat-prima" >
         <?php
         $num_rows=$resultProject->num_rows;
         if($num_rows > 0){

         	while ($projectrow = $resultProject->fetch_object()) { ?>
         <tr>
         	<td class="wdgt-primary wdgt-header col-md-3" >Nombre
         	</td>
         	<td id="tdName"><input type="hidden" name="projectName" value="<?php echo $projectrow->nombre; ?>"/>
         		<span><?php echo $projectrow->nombre; ?></span>
         	</td>
         </tr>
         <tr>
         	<td class="wdgt-primary wdgt-header">Descripcion
         	</td>
         	<td id="tdDescripcion"><input type="hidden" name="projectDescription" value="<?php echo $projectrow->descripcion ;?>" />
         		<span><?php echo $projectrow->descripcion ;?></span>
         	</td>
         </tr>
         <tr>
         	<td class="wdgt-primary wdgt-header">Porcentaje
         	</td>
         	<td id="tdPorcentaje"><input type="hidden" name="projectPorcent" value="<?php echo $projectrow->porcentajeCI; ?>" />
         		<span><?php echo $projectrow->porcentajeCI; ?></span>	
         	</td>
         </tr>
        <tr>

          <td class="wdgt-primary wdgt-header col-md-3" >Fecha Inicio
          </td>
          <td id="tdDate"><input type="hidden" name="projectDate" value="<?php echo $projectrow->fechaInicio; ?>"/>
            <span><?php echo $projectrow->fechaInicio; ?></span>
          </td>
         </tr>
          <tr>
          <td class="wdgt-primary wdgt-header col-md-3" >Fecha Fin
          </td>
          <td id="tdDate1"><input type="hidden" name="projectDate1" value="<?php echo $projectrow->fechaFin; ?>"/>
            <span><?php echo $projectrow->fechaFin; ?></span>
          </td>
         </tr>
         <tr>
         	<td class="wdgt-primary wdgt-header">Monto total
         	</td>
         	<td id="tdTotal"><input type="hidden" name="projectTotal" value="<?php echo $projectrow->montoTotal; ?>" />
         		<span><?php echo $projectrow->montoTotal; ?></span>
         	</td>
         </tr>
			<?php
				}
			}
			?>
         </table>
         <div class="row">
           
         </div>
			<button type="button" id="projectEdit"  class="edit btn btn-success btn-round btn-tooltip" name="enviarCambios" >    Editar   </button>

       </div>
         
        
  

      <div class="wdgt-body wdgt-table">
      <div class="wdgt wdgt-primary" hide-btn="true">
        <div class="wdgt-header" align="center">
      ETAPAS DEL PROYECTO
       <span><i class="fa fa-minus wdgt-hide"></i></span></div>
         
        <div class="wdgt-body wdgt-table">

         <table class="table" id="table-mano-obra">
          <thead>
            <tr>
           
           <th>Nombre</th>
           <th>C.D.</th>
           <th>C.I.</th>
           <th>IVA 13%</th>
           <th>Inicio Programado</th>
           <th>Fin Programado</th>
           <th>Estado</th>
           <th>Total</th>
           <th></th>
            </tr>
          </thead>
          <tbody>
          <?php
         

          while ($etapaRow = $resultEtapas->fetch_object()) { ?>
           
                   
         
            <tr id=<?php echo $etapaRow->etapa; ?> >
           <td><span><?php echo $etapaRow->nombre; ?></span></td>
           <td><span><?php echo $etapaRow->CD; ?></span></td>
           <td><span><?php echo $etapaRow->CI; ?></span></td>
           <td><span><?php echo $etapaRow->IVA; ?></span></td>
           <td><span><?php echo $etapaRow->inicioProgramado; ?></span></td>
           <td><span><?php echo $etapaRow->finProgramado; ?></span></td>
           <td><span><?php echo $etapaRow->estado; ?></span></td>
           <td><span><?php echo $etapaRow->totalEtapa; ?></span></td>
           <td class="center">
              <input style="max-width: 25px;" onclick="window.location.href='editarEtapak1.php?id=<?php echo $etapaRow->etapa; ?>&idProyecto=<?php echo $idProyecto; ?>';" type="image" src="../Imagenes/editar.png">
              <input style="max-width: 25px;" type="image" src="../Imagenes/eliminar.png" class="detele" id="delete<?php echo $etapaRow->etapa; ?>">
           </td>
           
            </tr>
          
            
          <?php
        }
      

           ?>
            </tbody>
         </table>
        
       </div>
       <br></br>

       <button type="button" id="agregarEtapa"  class="edit btn btn-success btn-round btn-tooltip" onclick="window.location.href='crearEtapa.php?id= <?php echo "$idProyecto";?>';" >Agregar Etapa</button>
        <br></br>
          <div id="alertaExito" class="alert alert-success alert-round alert-border alert-soft " >
   <span class="icon icon-ok-sign"></span>
   <a class="close" data-dismiss="alert">×</a><strong>EXITO</strong> La operacion se realizo correctamente </div>
         
      <div id="AlertaError" class="alert alert-danger alert-round alert-border alert-soft ">
      <span class="icon icon-remove-sign"></span> 
       <a class="close" data-dismiss="alert">×</a> <strong>Error</strong> La operacion fallo, intente de nuevo </div>
        </div>


 
    <!-- END PAGE CONTENT -->

   </div>
  </div>

   <!-- END NAV, CRUMBS, & CONTENT -->
 <!--MODAL TO EDIT PROJECT  -->
  <div class="modal fade" id="modalProject" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header modal-primary">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title" id="myModalLabel">Editar Proyecto</h4>
                    </div>
                    <div class="modal-body">

                      <!-- content goes here -->
                      <form id="projectForm" class="form-horizontal" >

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Nombre</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="projectNameNew" />
                          </div>

                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Descripcion</label>
                          <div class="col-lg-7">
                            <input type="text" class="form-control" name="projectDescriptionNew"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Porcentaje</label>
                          <div class="col-lg-7">
                            <input type="number" class="form-control" name="projectPorcentNew"/>
                          </div>
                        </div>

                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-success" id="agregar2" disabled="false">Ingresar</button>
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

     <!--ALERTAS-->

   <!-- Default JS (DO NOT TOUCH) -->
  <script src="../lib/JS/jquery-3.1.0.min.js"></script>
  <script src="../lib/JS/bootstrap.min.js"></script>
  <script src="../lib/JS/hogan.min.js"></script>
  <script src="../lib/JS/typeahead.min.js"></script>
  <script src="../lib/JS/typeahead-example.js"></script>
  
  <!-- Adjustable JS -->
  <script src="../lib/JS/bootstrapValidator.js"></script>
  <script src="../lib/JS/jquery.dataTables.js"></script>
  <script src="../lib/JS/DT_bootstrap.js"></script>
  <script src="../lib/JS/soft-widgets.js"></script>
  <script src="../lib/JS/icheck.js"></script>
  <script src="../lib/js/jquery.jgrowl.min.js"></script>
 <script>
    $(document).ready(function() {

       $("#modalProject").modal({ show: false});

       $("#projectEdit").click(function(){
        
        prepararModal();
        


        $("#modalProject").modal('show');



       });

       var prepararModal=function(){
        var modalForm= $("#modalProject form");
        var name=$("input[name='projectName']").val();
        var description =$("input[name='projectDescription']").val();
        var porcent=$("input[name='projectPorcent']").val();
        var total=$("input[name='projectTotal']").val();
        modalForm.find("input[name='projectNameNew']").val(name);
        modalForm.find("input[name='projectDescriptionNew']").val(description);
        modalForm.find("input[name='projectPorcentNew']").val(porcent);
       }
        $('#alertaExito').hide();
        $('#AlertaError').hide();
        $("#projectForm").bootstrapValidator({
          fields : {
            projectNameNew : {
              validators: {
                notEmpty : {
                  message : "Este campo no puede estar vacio"
                }
              }
            },
            projectDescriptionNew : {
              validators : {
                notEmpty : {
                  message : "Este campo no puede estar vacio"
                }
                
              }
            },
             projectPorcentNew : {
              validators : {
                notEmpty : {
                  message : "Este campo no puede estar vacio"
                }
                
              }
            }
          }
        });
      });
    var closeWindows=function(){
         $("#modalProject").modal('hide');
      }
    var actualizarTabla=function(){
      var nameNew=$("input[name='projectNameNew']").val();
      var descriptionNew=$("input[name='projectDescriptionNew']").val();
      var porcentNew=$("input[name='projectPorcentNew']").val();
      var totalNew=$("input[name='projectTotalNew']").val();
      document.getElementById("tdName").innerHTML = nameNew;
      document.getElementById("tdDescripcion").innerHTML=descriptionNew;
      document.getElementById("tdPorcentaje").innerHTML=porcentNew;

    }
    var idProyecto=<?php echo "$idProyecto";?>;

    $("form").on("submit",function(e){
        $("#agregar2").attr('disabled','disabled'); 
          $('#alertaExito').hide();
          $('#AlertaError').hide();
  			   e.preventDefault();
          
  			 var frm= $(this).serialize();
  			 actualizarTabla();
          closeWindows();
  			

  			 $.ajax({
  			 	type: "POST",
  			 	url: "modificarProyecto_exe.php?id="+idProyecto,
  			 	data: frm			 
  			 
  			 }).done( function(information){
          
          $("#agregar2").attr('disabled','disabled'); 
  			 	var json_info=JSON.parse(information);
         
          if((json_info.answer)=="ERROR"){
              
              $('#AlertaError').show();
              
          }else{
            $('#alertaExito').show();
            
          }
  			 
  			 });
  		});
   		
   		

		

    $('.detele').click(function(){
        $('#alertaExito').hide();
        $('#AlertaError').hide();
       var idEtapa=$(this).parent().parent().attr('id');
       var identificador=parseInt(idEtapa);
      $.ajax({
      type: "POST",
       url: "modificarProyecto_exe.php?id="+idProyecto+"&iden="+idEtapa,
       data: identificador
      }).done(function(info){
       
        var json_info=JSON.parse(info);
       
          if((json_info.deleteAnswer)=="ERROR"){
              
              $('#AlertaError').show();
              
          }else{
            $('#alertaExito').show();
            
          }

         
      }); 

      
    });
		
    
  </script>
  
 
 </body>
</html>