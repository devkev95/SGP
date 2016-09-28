<?php
	require_once "../../model/Usuario.php";
	require_once "../../DAO/UsuarioDAO.php";

	if (isset($_POST["actualPasswd"], $_POST["newPasswd"])) {
		session_start();
		$userData = $_SESSION["userData"];
		session_write_close();	
		$userDAO = new UsuarioDAO();
		if (is_null($userDAO->getError())) {
			$options = [
			'cost' => 15,
			];
			if (password_verify($_POST["actualPasswd"], $userData->getEncryptedPassword())){
				$newPass = password_hash($_POST["newPasswd"], PASSWORD_BCRYPT, $options);
				$res = $userDAO->cambiarPasswd($userData->getEmail(), $newPass);
				if (is_numeric($res)) {
					$error = 1;
				}else{
					$userData->setEncryptedPassword($newPass);
				}
			}
			else{
				$error = 2;
			}
		}else{
			$error = 1;
		}
		if(isset($error)){
			$str = "error=".$error;
		}else{
			$str = "success";
		}
		header("Location: ../../main/changePassword.php?".$str);
	}

?>