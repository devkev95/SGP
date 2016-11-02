<?php
require'../services/conn.php';
 $db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();

$codigo='HM13002';


 if(isset($_POST['nombre'])){
 	$nom= $_POST['nombre'];
 }
 if(isset($_POST['descripcion'])){
 	$des= $_POST['descripcion'];
 }
 if(isset($_POST['fInicio'])){
 	$feInicio= $_POST['fInicio'];
 }
 if(isset($_POST['fFin'])){
 	$feFin= $_POST['fFin'];
 }
 $fechaInicio=date('Y-m-d', strtotime($feInicio));
 $fechaFin=date('Y-m-d',strtotime($feFin));

 $queryModProyecto="UPDATE proyecto SET nombre='".$nom."', descripcion='".$des."', fechaInicio='".$fechaInicio."', fechaFin='".$fechaFin."' WHERE codigo='".$codigo."'";
$update=mysqli_query($db,$queryModProyecto);
echo "$queryModProyecto";
header("Location: modProyecto.php");

?>