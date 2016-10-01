<?php


$cod=$_GET["cod"];

 error_reporting(0);

 $link=mysql_connect("localhost","sgp_user","56p_2016");
 
 if ($link) {
  mysql_select_db("sgp_system", $link);
  # code...
 }

$sql="DELETE FROM recurso WHERE codigo='$cod'";
$comprobar=mysql_query($sql);



header("Location:tabla_recursos.php");



?>