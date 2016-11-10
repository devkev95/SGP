<?php

require_once '../services/conn.php';
 $db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
 error_reporting(0);
 
$information=[];
$name=$_POST['projectNameNew'];	
$porcent=$_POST['projectPorcentNew'];
$total=$_POST['projectTotalNew'];

if(isset($_POST['projectDescriptionNew'])){
	$description=$_POST['projectDescriptionNew'];
}

$queryUpdate="UPDATE proyecto SET nombre='".$name."',descripcion='".$description."',porcentajeCI=".$porcent.", montoTotal=".$total." WHERE idProyecto=1";
$resultProject= $db->query($queryUpdate);

checkResultProject($resultProject);

function checkResultProject($result){
if(!$result) $information["answer"]="ERROR";
else $information["answer"]="EXITO";
echo json_encode($information);

}



?>