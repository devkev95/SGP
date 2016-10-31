<?php
	require_once "../../model/Usuario.php";
	require_once "../../DAO/UsuarioDAO.php";
	require_once "../conn.php";

	if (isset($_POST["newPasswd"], $_POST["user"], $_POST["id"])) {
		$userDAO = new UsuarioDAO();
		$db =  ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
		if (is_null($userDAO->getError()) and $db->connect_errno == 0) {
			$options = [
			'cost' => 15,
			];
			$newPass = password_hash($_POST["newPasswd"], PASSWORD_BCRYPT, $options);
			$res = $userDAO->cambiarPasswd($_POST["user"], $newPass);
			$query = "UPDATE recoveryAccount set usado = 1 WHERE id =".$_POST["id"];
			$res2 = $db->query($query);
			if (is_numeric($res) or !$res2) {
				$error = 1;
			}

		}else{
			$error = 1;
		}
		header("Location: ../../index.php");
		exit();
	}
?>