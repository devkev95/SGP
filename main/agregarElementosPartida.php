<?php
 error_reporting(0);
 require'../services/conn.php';
 $db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();

 $numeroPartida = $_GET['numero'];

 //ELIMINAR MATERIAL
// $desMaterial=$_POST['dMaterial'];
 //$queryrecurso="SELECT codigo FROM recurso WHERE nombre='".$desMaterial."'";

// $resultadoQueryRecurso=mysqli_query($db,$queryrecurso);

// while ($r=mysqli_fetch($resultadoQueryRecurso)) {
 //	$codigoMaterial="$r[codigo]";
 	//$queryDeleteMaterial="DELETE FROM linearecurso WHERE codigo='".$codigoMaterial."'";
 	//$deleteMaterial=mysqli_query($db,$queryDeleteMaterial);
 //}

 //ELIMINAR MONO DE OBRA
 $desMO=$_POST['dMO'];
 $queryDeleteMO="DELETE FROM lineamanoobra WHERE descripcion='".$desMO."'";
 $deleteMO=mysqli_query($db,$queryDeleteMO);
//ELIMINAR EQUIPO y HERRAMIENTAS
 $desH=$_POST['dH'];
$queryDeleteH="DELETE FROM lineaequipoherramienta WHERE descripcion='".$desH."'";
$deleteH=mysqli_query($db,$queryDeleteH);
//ELIMINAR SUBCONTRATO
$des=$_POST['d'];

 $queryDelete="DELETE FROM lineasubcontrato WHERE descripcion='".$des."'";
 $delete=mysqli_query($db,$queryDelete);
//VARIABLE PARA INGRESAR MANO DE OBRA
 $MO1=$_POST['descripcion-manoObra'];
 $MO2=$_POST['jornada-manoObra'];
 $MO3=$_POST['FP'];
 $MO4=$_POST['rendimiento'];

//VARIABLES PARA INGRESAR EQUIPO Y HERRAMIENTAS
$hE1= $_POST['descripcion-herramienta'];
$hE2= $_POST['tipo-herramienta'];
$hE3= $_POST['capacidad-herramienta'];
$hE4= $_POST['rendimiento-herramienta'];
$hE5= $_POST['costoHora'];
$hE6= $_POST['subTotal-herramienta'];

if($hE3==null){
	$hE3='null';
}

if($hE4==null){
	$hE4='null';
}
if($hE5==null){
	$hE5='null';
}

 //VARIABLES PARA INGRESAR SUBCONTRATO
 $sC1= $_POST['descripcion'];
$sC2= $_POST['unidad'];
$sC3= $_POST['cantidad'];
$sC4= $_POST['valor'];
$sC5= $_POST['subtotal'];
//CONSULTA Y PROCEDIMIENTO PARA INGRESAR MANO DE OBRA
$jornadaTotalMO=0;
$subTotalMO=0;
$jornadaTotalMO=($MO2*$MO3);
$subTotalMO=round(($jornadaTotalMO/$MO4),2);


$queryInsertMO="INSERT INTO lineamanoobra (numero,descripcion,jornada,FP, jornadaTotal, rendimiento,subTotal) VALUES (".$numeroPartida.",'".$MO1."',".$MO2.",".$MO3.",".$jornadaTotalMO.",".$MO4.",".$subTotalMO.")";
$insertMO=mysqli_query($db,$queryInsertMO);


//CONSULTA PARA INGRESAR EQUIPO Y HERRAMIENTAS
$queryInsertEH="INSERT INTO lineaequipoherramienta (numero,descripcion, tipo, capacidad, rendimiento, costoHora, subTotal) VALUES (".$numeroPartida.",'".$hE1."','".$hE2."',".$hE3.",".$hE4.",".$hE5.",".$hE6.")";
$insertEH=mysqli_query($db,$queryInsertEH);
//CONSULTA PARA INGRESAR SUBCONTRATO
$query="INSERT INTO lineasubcontrato (numero,unidad,cantidad, valor, descripcion, subTotal) VALUES (".$numeroPartida.",'".$sC2."',".$sC3.",".$sC4.",'".$sC1."',".$sC5.")";

	$insert= mysqli_query($db,$query);



header("Location: modPartida.php?numero=$numeroPartida");
	

?>