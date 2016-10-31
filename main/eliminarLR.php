<?php
	
	require '../model/Usuario.php';

	session_start();

	if (!isset($_SESSION["userData"])){
		session_destroy();
		header("Location: ../index.php");
		exit();
	}
	$userData = $_SESSION["userData"];
	session_write_close();
?>


<?php


$cod=$_GET["cod"];


 error_reporting(0);

 $link=mysql_connect("localhost","sgp_user","56p_2016");
 
 if ($link) {
  mysql_select_db("sgp_system", $link);
  # code...
 }




$sql = mysql_query("delete from linearecurso where codigo='$cod' and numero=0 ");

header("Location:crear_partida.php");



?>