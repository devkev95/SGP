<?php


$cod=$_GET["cod"];
$cant=$_GET["cantidad"];

 error_reporting(0);

 $link=mysql_connect("localhost","sgp_user","56p_2016");
 
 if ($link) {
  mysql_select_db("sgp_system", $link);
  # code...
 }




$sql = mysql_query("select * from recurso where codigo='$cod' ");

        while ($row = mysql_fetch_array($sql)) {


     $valor=$row['costoDirecto'];
     echo $valor;

	$sub=($cant*$valor);



        $sql3=mysql_query("INSERT INTO linearecurso (id, numero, codigo, cantidad, subTotal) VALUES (null, 0,'$cod',$cant, $sub)");

}

header("Location:crear_partida.php");



?>