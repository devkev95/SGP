

<?php

require_once '../services/conn.php';
 $db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
 error_reporting(0);

  $idPartida= $_GET['id1'];

  echo $idPartida;
 $identificar=$_GET['id3'];
 echo $identificar;
 $versionPartida=$_GET['versionPartida'];
 echo $versionPartida;


$information=[];


if(isset($identificar)){
	if ($db->query("DELETE FROM etapapartida WHERE idPartida=".$idPartida." AND idEtapa=".$identificar." AND versionPartida=".$versionPartida."")) {
    echo $db->error;
}


$fila = $result->fetch_assoc();
$valor= $fila['_respuesta_'];
$information["deleteAnswer"]= $valor;
}

echo json_encode($information);




?>