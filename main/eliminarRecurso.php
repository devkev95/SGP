<?php


$cod=$_GET["cod"];
require_once "../services/conn.php";
$conn = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
 error_reporting(0);

$sql="SELECT codigo FROM linearecurso WHERE codigo='$cod'";
$comprobar = $conn->query($sql);

if($comprobar->num_rows <= 0){
    $sql="DELETE FROM recurso WHERE codigo='$cod'";
    $conn->query($sql);
}



header("Location:tabla_recursos.php");



?>