<?php
	require_once '../conn.php';
	if(isset($_POST["nombre"], $_POST["descripcion"], $_POST["porcentajeCI"], $_POST["fechaInicio"], $_POST["fechaFin"] )){
		$nombre = $_POST["nombre"];
		$descripcion = $_POST["descripcion"];
		$fechaInicio = $_POST["fechaInicio"];
		$fechaFin = $_POST["fechaFin"];
		$porcentaje_indirecto= $_POST["porcentajeCI"];
		$conn = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();

			$query = "INSERT INTO proyecto(idProyecto, nombre, descripcion, porcentajeCI, fechaInicio, fechaFin, montoTotal) VALUES (NULL,'".$nombre."', '".$descripcion."', '".$porcentaje_indirecto."', '".$fechaInicio."', '".$fechaFin."', NULL)";
			$resultado4=$conn->query($query);
				

		}
	

?>