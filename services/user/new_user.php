<?php

	require_once '../../model/Usuario.php';
	require_once '../../DAO/UsuarioDAO.php';

	$email = $_POST["email"];
	$nombres = $_POST["nombres"];
	$apellidos = $_POST["apellidos"];
	$password = $_POST["pass"];

	$res = null;

	$userDAO = new UsuarioDAO();
	if (is_null($res)) {
		$options = [
			'cost' => 15,
		];
		$user = new Usuario();
		$user->setEncryptedPassword(password_hash($password, PASSWORD_BCRYPT, $options));
		$user->setNombres($nombres);
		$user->setApellidos($apellidos);
		$user->setEmail($email);
		$res = $userDAO->save($user);
		if (!is_numeric($res)){
			header("Location: ../../index.php?error=0");
			exit();
		}else{
			header("Location: ../../new_account.php?error=".$res);
		}
	}

	
?>