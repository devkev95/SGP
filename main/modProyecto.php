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
	
	$queryProject="SELECT `idProyecto`, `nombre`, `descripcion`, `porcentajeCI`, `fechaInicio`, `fechaFin`, `montoTotal` FROM `proyecto` WHERE idProyecto=1";
	$resultProject= $db->query($queryProject);

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

         <table class="table" id="table-mat-prima" >
         <?php
         $num_rows=$resultProject->num_rows;
         if($num_rows > 0){

         	while ($projectrow = $resultProject->fetch_object()) { ?>
         <tr>
         	<td style="background:#CCCCCC" class="col-md-3"><strong>Nombre</strong>
         	</td>
         	<td id="tdName"><input type="hidden" name="projectName" value="<?php echo $projectrow->nombre; ?>"/>
         		<span><?php echo $projectrow->nombre; ?></span>
         	</td>
         </tr>
         <tr>
         	<td style="background:#CCCCCC "><strong>Descripcion</strong>
         	</td>
         	<td id="tdDescripcion"><input type="hidden" name="projectDescription" value="<?php echo $projectrow->descripcion ;?>" />
         		<span><?php echo $projectrow->descripcion ;?></span>
         	</td>
         </tr>
         <tr>
         	<td style="background:#CCCCCC "><strong>Pocentaje</strong>
         	</td>
         	<td id="tdPorcentaje"><input type="hidden" name="projectPorcent" value="<?php echo $projectrow->porcentajeCI; ?>" />
         		<span><?php echo $projectrow->porcentajeCI; ?></span>	
         	</td>
         </tr>
        
         <tr>
         	<td style="background:#CCCCCC "><strong>Monto Total</strong>
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
			<button type="button" id="projectEdit"  class="edit btn btn-primary btn-round btn-tooltip" name="enviarCambios" >Editar</button>
          </div>

      </div>
        

      </div>
      <div class="wdgt wdgt-primary" hide-btn="true">
        <div class="wdgt-header" align="center">
      ETAPAS
       <span><i class="fa fa-minus wdgt-hide"></i></span></div>
         
        <div class="wdgt-body wdgt-table">

         <table class="table" id="table-mano-obra">
          <thead>
            <tr>
           
           <th>Nombre</th>
           <th>Fecha Inicio</th>
           <th>fecha Fin</th>
           <th>Total</th>
           
            </tr>
          </thead>
           <tbody>
                   
         
            <tr class="manoObra">
           <input type="hidden" class="id" name="idLineaMO[]" value="6">
           <td><input type="hidden" name="descripcionMO[]" value="asd"><span></span></td>
           <td><input type="hidden" name="jornadaMO[]" value="5"><span></span></td>
           <td><input type="hidden" name="FPMO[]" value="5"><span></span></td>
           
            </tr>
          
             </tbody>
          

         </table>
        
       </div>

        <table>
              <tbody><tr>
            <td></td>
              <td></td>
                <td></td>
                <td></td>
           
            </tr></tbody></table>

         
        <table>
          	<tbody>
          		<tr>
            		<td><button type="button" id="new-row-mano-obra" class="btn btn-primary btn-tooltip"><i class="icon icon-plus"></i></button></td>
          		</tr>

        	</tbody>

      	</table>
         
         
        </div>
   <div class="col-sm-offset-2 col-sm-8">
				<p class="mensaje"></p>
			</div>

    <!-- END PAGE CONTENT -->

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

                        <div class="form-group">
                          <label class="col-lg-3 control-label">Monto Total</label>
                          <div class="col-lg-7">
                            <input type="number" step="0.01" class="form-control" name="projectTotalNew"/>
                          </div>
                        </div>

                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                          <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-success" name="agregar2" value="Agregar" >Ingresar</button>
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
            },
           
            projectTotalNew: {
              validators : {
                notEmpty: {
                  message: 'Este campo no puede estar vacio'
                  },
              }
            }
          }
        });
      });
    $("form").on("submit",function(e){

  			 e.preventDefault();


  			 var frm= $(this).serialize();

  			// console.log(frm);
  			

  			 $.ajax({
  			 	type: "POST",
  			 	url: "modificarProyecto_exe.php",
  			 	data: frm			 
  			 
  			 }).done( function(infomation){

  			 	var json_info=JSON.parse(infomation);
  			 	closeWindows();
  			 	showMessage(json_info);	
  			 });
  		});
   		var closeWindows=function(){
   			 $("#modalProject").modal('hide');
   		}
   		var showMessage = function( informacion ){
		var texto = "", color = "";
		if( informacion.answer == "EXITO" ){

		actualizarTabla();
		texto = "<strong>EXITO!</strong> Se han guardado los cambios correctamente.";
		color = "#379911";
		}else if( informacion.answer == "ERROR"){
		texto = "<strong>Error</strong>, no se ejecutó la consulta.";
		color = "#C9302C";
		}	
		$(".mensaje").html( texto ).css({"color": color });
		$(".mensaje").fadeOut(5000, function(){
		$(this).html("");
		$(this).fadeIn(3000);
		}); 
		}

		var actualizarTabla=function(){
			var nameNew=$("input[name='projectNameNew']").val();
			var descriptionNew=$("input[name='projectDescriptionNew']").val();
			var porcentNew=$("input[name='projectPorcentNew']").val();
			var totalNew=$("input[name='projectTotalNew']").val();
			document.getElementById("tdName").innerHTML = nameNew;
			document.getElementById("tdDescripcion").innerHTML=descriptionNew;
			document.getElementById("tdPorcentaje").innerHTML=porcentNew;
			document.getElementById("tdTotal").innerHTML=totalNew


		}
		

  </script>
  <script>
  	$(document).ready(function() {
  	 	 $("#modalProject").modal({ show: false});
  	 	 $("#projectEdit").click(function(){
  	 	 	var modalForm= $("#modalProject form");
  	 	 	var name=$("input[name='projectName']").val();
  	 	 	var description =$("input[name='projectDescription']").val();
  	 	 	var porcent=$("input[name='projectPorcent']").val();
  	 	 	var total=$("input[name='projectTotal']").val();
  	 	 	modalForm.find("input[name='projectNameNew']").val(name);
  	 	 	modalForm.find("input[name='projectDescriptionNew']").val(description);
  	 	 	modalForm.find("input[name='projectPorcentNew']").val(porcent);
  	 	 	modalForm.find("input[name='projectTotalNew']").val(total);


  	 	 	$("#modalProject").modal('show');



  	 	 });

      	 }); 
  </script>
 
 </body>
</html>