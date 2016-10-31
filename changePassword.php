<?php
	require_once 'services/conn.php';

	if (isset($_GET["hash"])) {
		session_start();
		if (isset($_SESSION["userData"])) {
			session_write_close();
		 	header("Location: main/home.php");
		 	exit();
		}else{
			session_destroy();
		}
		$db =  ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
		if ($db->connect_errno) {
			$error = 1;
		}
		else{
			$date = new DateTime();
			$hash = $db->real_escape_string($_GET["hash"]);
			$query = "SELECT id, user from recoveryAccount WHERE hash = '".$hash."' AND expFecha >= '".$date->format("Y-m-d")."' AND usado = 0";
			$res = $db->query($query);
			if ($res and $res->num_rows > 0){
				$obj = $res->fetch_object();
				$email = $obj->user;
				$id = $obj->id;
			}else{
				if($db->errno){
					$error = 1;
				}else{
					$error = 2;
				}
			}
		}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="lib/CSS/changePassword.css">
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
		<title>Cambiar Contraseña</title>
	</head>
	<body>
		<?php if (!isset($error)) {?>
	   		<div id="chng-pass-tbl">
	   			<div id="chng-pass-contain">

		    		<div id="chng-passwd">
						<form id="chng-passwd-form" class="form" action="services/user/recChangePasswd.php" method="POST">
							<h2 id="form-header">Cambiar contraseña</h2>
		      				<div class="form-group">
                    			<label class="control-label" for="newPasswd">Nueva contraseña</label>
                      			<input class="form-control form-soft input-sm" type="password" name="newPasswd">
                  			</div>
                  			<div class="form-group">
                    			<label class="control-label" for="confirmNewPasswd">Confirmar nueva contraseña</label>
                      			<input class="form-control form-soft input-sm" type="password" name="confirmNewPasswd">
                  			</div>
                  			<input type="hidden" value="<?= $email ?>" name="user" />
                  			<input type="hidden" value="<?= $id ?>" name="id" />
		      				<div class="form-group">
		       					<button type="submit" id="login-btn" class="btn btn-primary btn-block btn-lg">Cambiar contraseña&nbsp;&nbsp;&nbsp;<i class="fa fa-play"></i></button>
		      				</div>
		      			 </form>
					</div>
			</div>
	    </div>
	    <?php } else { ?>
	    	<div class="alertDiv alert alert-danger alert-round alert-border alert-soft">
						 <span class="icon icon-remove-sign"></span> <strong>Error:</strong>
			<?php if ($error == 1) {
				echo "Problemas en la conexión con la base de datos, por favor intente más tarde";
			}else if ($error == 2){
				echo "El link no es válido";
			}
				?>
			</div>
	    <?php } ?>


		<script type="text/javascript" src="lib/JS/jquery-3.1.0.min.js"></script>
		<script type="text/javascript" src="lib/JS/bootstrap.min.js"></script>
		<script type="text/javascript" src="lib/JS/hogan.min.js" ></script>
		<script type="text/javascript" src="lib/JS/typeahead.min.js"></script>
		<script type="text/javascript" src="lib/JS/typeahead-example.js"></script>
		<script type="text/javascript" src="lib/JS/bootstrapValidator.js"></script>
		<script type="text/javascript">
		  	$(document).ready(function() {
		   		 $("#chng-passwd-form").bootstrapValidator({
			          fields : {
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
	} else{
		header("Location: index.php");
		exit();
	} 
?>