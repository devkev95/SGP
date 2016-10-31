<?php
 require'../services/conn.php';
 $db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();

 
$des=$_POST['d'];

 $queryDelete="DELETE FROM lineasubcontrato WHERE descripcion='".$des."'";
 $delete=mysqli_query($db,$queryDelete);

?>