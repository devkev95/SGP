<?php
	
	require_once '../../model/Usuario.php';
	require_once '../../DAO/UsuarioDAO.php';

	$email = $_POST["email"];
	$password = $_POST["pass"];

	$error = null;

	$userDAO = new UsuarioDAO();
	$error = $userDAO->getError();
	if (is_null($error)){
		$user = $userDAO->getUserById($email);
		if (is_a($user, "Usuario")){
			if(password_verify($password, $user->getEncryptedPassword())){
				session_start();
				$_SESSION["userData"] = $user;
				session_write_close();
				header("Location: ../../main/home.php");
				exit();
			}else{
				$error = 2;
			}
		}else{
			$error = $user;
		}
	}

	if(!is_null($error)){
		header("Location: ../../index.php?error=".$error);
		exit();
	}


?>