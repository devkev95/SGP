<?php
	require_once '../conn.php';
	 error_reporting(0);
	
		$nombre = $_POST["nombre"];
		$detalle = $_POST["detalle"];
		$fechaInicioProgramada = $_POST["fechaInicioProgramada"];
		$fechaFinProgramada = $_POST["fechaFinProgramada"];
		$estado = $_POST["estado"];
		$proyecto = $_POST["idProyecto"];
		echo $proyecto;
		$conn = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
		if($conn->connect_errno){
			$error = 1;
		}
		else{
			$total_etapa = 0;

			if(isset($_POST["subTotal_etapa"])){
				$total_etapa = array_sum($_POST["subTotal_etapa"]);
			}
			$query = "INSERT INTO etapa(nombre, detalle, idProyecto, fechaInicioProgramada, fechaFinProgramada, estado) VALUES ('".$nombre."', '".$detalle."', '".$proyecto."', '".$fechaInicioProgramada."', '".$fechaFinProgramada."', '".$estado."'')";
			if($conn->query($query)){
				$id = $conn->insert_id;

				$n = count($_POST["subTotal_etapa"]);
				for ($i = 0; $i < $n; $i++){
					$query1 = "INSERT INTO etapapartida(idEtapa, cantidad, CD, CI, IVA, PU, subTotal) VALUES(".$id.", ".$_POST["cantidad"][$i].", ".$_POST["CD"][$i].", ".$_POST["CI"][$i].", ".$_POST["IVA"][$i].", ".$_POST["PU"][$i].", ".$_POST["subTotal_etapa"][$i].")";
					$conn->query($query1);
				}
				
			}else{
				$error = 2;
			}
			


		}
	

?>