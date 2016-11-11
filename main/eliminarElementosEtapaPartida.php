<?php
require_once '../services/conn.php';
if (isset($_POST["id1"], $_POST["id2"], $_POST["id3"], $_POST["opt"])) {
	$db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
	$table = "";
	if ($_POST["opt"] == 1) {
		$table = "etapapartida";
	} 
	$query = "DELETE FROM ".$table." WHERE idPartida=".$_POST["id1"]." AND versionPartida=".$_POST["id2"]." AND idEtapa=".$_POST["id3"];
	$db->query($query);
}
?>