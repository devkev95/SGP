<?php
	require_once '../../model/Usuario.php';
	require_once '../../DAO/UsuarioDAO.php';

	session_start();

	header('Content-Type: application/json');

	$userDAO = new UsuarioDAO();
	if (is_null($userDAO->getError())) {
		$users = $userDAO->getUsuarios();

		if(is_array($users)){
			$res = array();
			foreach ($users as $user) {
				if($_SESSION["userData"]->getEmail() != $user->getEmail()){
				$res[] = $user->jsonSerialize();
				}
			}
			session_write_close();
			echo json_encode(array('data'=>$res), JSON_PRETTY_PRINT);
		}
	}

?>