<?php
	require_once '../../DAO/UsuarioDAO.php';
	require_once '../../model/Usuario.php';
	require_once '../PHPMailer/PHPMailerAutoload.php';

	$userDAO = new UsuarioDAO();
	if (isset($_POST["email"]) and is_null($userDAO->getError())) {
			$usuario = new Usuario();
			$usuario->setEmail($_POST["email"]);
			$usuario->setPerfil(isset($_POST["perfil"]) ? $_POST["perfil"] : "");
			$usuario->setEstado(isset($_POST["estado"]) ? true : false);
			$res = $userDAO->actualizarPermisosUsuario($usuario);
			$usuario = $userDAO->getUserByIdAll($_POST["email"]);
			if ($res) {
				if (isset($_POST["estado"])) {
				$mail = new PHPMailer;
				$mail->isSMTP();                                         // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'pruebasgp.2016.1@gmail.com';                 // SMTP username
				$mail->Password = 'prueba_sgp';                           // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                    // TCP port to connect to

				$mail->setFrom('admon_sgp@diaza.com.sv', 'Admon_DIAZA_SGP');
				$mail->addAddress($_POST["email"], $usuario->getNombres()." ".$usuario->getApellidos());     // Add a recipient
				$mail->isHTML(true);                                  // Set email format to HTML

				$mail->Subject = 'Activación de cuenta';
				$mail->Body    = 'Su cuenta para el sistema DIAZA SGP ha sido activada. <br/><b>Por Favor no responda a este mensaje</b>';
				$mail->AltBody = 'Su cuenta para el sistema DIAZA SGP ha sido activada. Por Favor no responda a este mensaje';
				$mail->send();
				}
				header("Location: ../../main/admin/users.php");
				
			}
	}
	
?>