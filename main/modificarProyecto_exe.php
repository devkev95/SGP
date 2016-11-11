<?php

require_once '../services/conn.php';
 $db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
 error_reporting(0);

  $idProyecto= $_GET['id'];

 $identificar=$_GET['iden'];

 $idEtapa=0;
 $idEtapa=(int)$idE;

$information=[];
$name=$_POST['projectNameNew'];	
$porcent=$_POST['projectPorcentNew'];


if(isset($_POST['projectDescriptionNew'])){
	$description=$_POST['projectDescriptionNew'];
}

$queryUpdate="UPDATE proyecto SET nombre='".$name."',descripcion='".$description."',porcentajeCI=".$porcent." WHERE idProyecto=".$idProyecto;
$resultProject= $db->query($queryUpdate);

//checkResultProject($resultProject);

//function checkResultProject($result){
if(!$resultProject) $information["answer"]="ERROR";
else $information["answer"]="EXITO";

//}

if(isset($identificar)){
	if (!$db->query("SET @respuesta = ''") || !$db->query("CALL delete_etapaProyecto('".$idProyecto."','".$identificar."',@respuesta)")) {
    echo "Falló CALL: (" . $db->errno . ") " . $db->error;
}

if (!($result = $db->query("SELECT @respuesta as _respuesta_"))) {
    echo "Falló la obtención: (" . $db->errno . ") " . $db->error;
}

$fila = $result->fetch_assoc();
$valor= $fila['_respuesta_'];
$information["deleteAnswer"]= $valor;
}

echo json_encode($information);




?>