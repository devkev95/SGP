<?php
	session_start();
	if (isset($_SESSION["userData"])) {
		session_write_close();
	 	header("Location: main/home.php");
	 	exit();
	 }else{
	 	session_destroy();
	 } 
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="lib/CSS/new_account.css">
		<link rel="stylesheet" href="lib/CSS/font-awesome.min.css">
	  	<link rel="stylesheet" href="lib/CSS/bootstrap.min.css">
	  	<link rel="stylesheet" href="lib/CSS/fonts.css">
	  	<link type="text/css" rel="stylesheet" href="lib/CSS/soft-admin.css"/>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  	<!--[if lt IE 9]>
	   		<script src="lib/js/html5shiv.js"></script>
	   		<script src="lib/js/respond.min.js"></script>
	  	<![endif]-->

		<meta charset="utf-8">
		<title>Crear Nuevo Usuario-Sistema de Generación de Presupuestos y Control de Proyectos</title>
	</head>
	<body>
	   		<div id="new-account-tbl">
	   			<div id="new-account-contain">
	   				<?php
						if (isset($_GET["error"])){
					?>
						 <div class="alertDiv alert alert-danger alert-round alert-border alert-soft">
						 	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						 <span class="icon icon-remove-sign">
						 	
						 </span> <strong>Error:</strong>
					<?php
						if ($_GET["error"] == 1){

							echo "Problemas en la conexión, por favor intente mas tarde";
						}
						elseif ($_GET["error"] == 2 ){

							echo "Este correo ya ha sido registrado por otro usuario, por favor use otro";
						}
					?>
					</div>
				<?php
					}
				?>

		    		<div id="new-account">
						<form id="new-account-form" class="form" action="services/user/new_user.php" method="POST">
							<h2 id="form-header">Crear Nuevo Usuario</h2>
		      				<div class="form-group">
		       					<label class="control-label" for="email">Correo Electrónico</label>
		        				<input class="form-control form-soft input-sm" type="text" name="email">
		      				</div>
		      				<div class="form-group">
		       					<label class="control-label" for="nombres">Nombres</label>
		        				<input class="form-control form-soft input-sm" type="text" name="nombres">
		      				</div>
		      				<div class="form-group">
		       					<label class="control-label" for="apellidos">Apellidos</label>
		        				<input class="form-control form-soft input-sm" type="text" name="apellidos">
		      				</div>
		      				<div class="form-group">
		       					<label class="control-label" for="pass">Contraseña</label>
		        				<input class="form-control form-soft input-sm" type="password" name="pass">
		      				</div>
		      				<div class="form-group">
		       					<label class="control-label" for="confirmPass">Repetir Contraseña</label>
		        				<input class="form-control form-soft input-sm" type="password" name="confirmPass">
		      				</div>
		      				<div class="form-group">
		       					<button type="submit" id="login-btn" class="btn btn-primary btn-block btn-lg">Crear Usuario&nbsp;&nbsp;&nbsp;<i class="fa fa-play"></i></button>
		      				</div>
		      			 </form>
					</div>
			</div>
	    </div>

		<script type="text/javascript" src="lib/JS/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" src="lib/JS/bootstrap.min.js"></script>
		<script type="text/javascript" src="lib/JS/hogan.min.js" ></script>
		<script type="text/javascript" src="lib/JS/typeahead.min.js"></script>
		<script type="text/javascript" src="lib/JS/typeahead-example.js"></script>
		<script type="text/javascript" src="lib/JS/bootstrapValidator.js"></script>
		<script type="text/javascript">
		  	$(document).ready(function() {
		   		$('#new-account-form').bootstrapValidator({
		    		fields: {
		     			email: {
		      				validators: {
                    			notEmpty: {
                        			message: 'Este campo no puede estar vacio'
                    			},
                    			emailAddress: {
                        			message: 'Por favor ingrese un correo válido'
                    			}
                			}
		 	 			},
		     			pass: {
                			validators: {
                    			notEmpty: {
                        			message: 'Este campo no puede estar vacio'
                    			},
                    			stringLength: {
        							min: 8,
        							max: 40,
        							message: 'La contraseña debe contener entre 8 y 40 carácteres'
       							},
       							identical: {
        							field: 'confirmPass',
        							message: 'Las contraseñas no son iguales'
       							}
                			}
            			},
            			confirmPass :{
            				validators: {
                    			notEmpty: {
                        			message: 'Este campo no puede estar vacio'
                    			},
       							identical: {
        							field: 'pass',
        							message: 'Las contraseñas no son iguales'
       							}
                			}
            			},
            			apellidos :{
            				validators:{
            					notEmpty:{
            						message: 'Este campo no puede estar vacio'
            					}
            				}
            			},
            			nombres:{
            				validators:{
            					notEmpty:{
            						message:'Este campo no puede estar vacio'
            					}
            				}
            			}
		    		}
		   		});
		  	});
	  </script>
	</body>
</html>