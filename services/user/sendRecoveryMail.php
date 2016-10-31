<?php
	require_once '../conn.php';
	require_once '../PHPMailer/PHPMailerAutoload.php';

	if (isset($_POST["email"])){
		$db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
		if ($db->connect_errno) {
					$error = 1;
		}else{
			$email = $db->real_escape_string($_POST["email"]);
			$query = "SELECT email, nombres, apellidos FROM usuario WHERE email='".$email."'";
			$res = $db->query($query);
			if ($res and $res->num_rows > 0){
				$obj = $res->fetch_object();
				$nombres = $obj->nombres;
				$apellidos = $obj->apellidos;
				$hash = bin2hex(openssl_random_pseudo_bytes(25));
				$date = new DateTime();
				$date->add(new DateInterval("P1D"));
				$query = "INSERT INTO recoveryAccount (hash, user, expFecha) VALUES ('".$hash."', '".$email."', '".$date->format("Y-m-d")."' )";
				$res = $db->query($query);
				if(!$res){
					$error = 1;
				}else{
					$mail = new PHPMailer;
					$mail->isSMTP();                                         // Set mailer to use SMTP
					$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'pruebasgp.2016.1@gmail.com';                 // SMTP username
					$mail->Password = 'prueba_sgp';                           // SMTP password
					$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 587;                                    // TCP port to connect to

					$mail->setFrom('admon_sgp@diaza.com.sv', 'Admon_DIAZA_SGP');
					$mail->addAddress($_POST["email"], $nombres." ".$apellidos);     // Add a recipient
					$mail->isHTML(true);                                  // Set email format to HTML

					$mail->Subject = 'Cambiar contraseña';
					$mail->Body    = 'Estimado/a '.$nombres.' '.$apellidos.'<br/> Por favor de click al siguiente link para cambiar su contraseña <br/> <a href="localhost/dsi_sgp/changePassword.php?hash='.$hash.'">Cambiar contraseña</a> <br/> La validez del link será solamente de un dia desde el envio de este mensaje <br/> Si usted no ha pedido este mensaje por favor ignorelo';
					$mail->AltBody = 'Estimado/a '.$nombres.' '.$apellidos.'<br/> Por favor de click al siguiente link para cambiar su contraseña <br/> <a href="localhost/dsi_sgp/changePassword.php?hash='.$hash.'">Cambiar contraseña</a> <br/> La validez del link será solamente de un dia desde el envio de este mensaje <br/> Si usted no ha pedido este mensaje por favor ignorelo';
					$mail->send();
				}
			}else{
				if($db->errno){
					$error = 1;
				}else{
					$error = 2;
				}
			}
		}
		$string = isset($error) ?  "error=".$error : "success";
		header("Location: ../../recoveryMail.php?".$string);
	}
?>