<?php
require_once '../services/conn.php';
if (isset($_POST["id"], $_POST["opt"])) {
	$db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
	$table = "";
	if ($_POST["opt"] == 1) {
		$table = "linearecurso";
	} elseif ($_POST["opt"] == 2) {
		$table = "lineamanoobra";
	} elseif ($_POST["opt"] == 3) {
		$table = "lineaequipoherramienta";
	} elseif ($_POST["opt"] == 4) {
		$table = "lineasubcontrato";
	}
	$query = "DELETE FROM ".$table." WHERE id=".$_POST["id"];
	$db->query($query);
}
?>