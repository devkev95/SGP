<?php
	require_once '../conn.php';
	if(isset($_POST["nombre"], $_POST["CI"])){
		$nombre = $_POST["nombre"];
		$porcentaje_indirecto= $_POST["CI"];
		$conn = ConnectionFactory::getFactory("sgp_user", "56p_2016", "prueba_sgp_system")->getConnection();
		if($conn->connect_errno){
			$error = 1;
		}
		else{
			$total_materiales = 0;
			$total_MO = 0;
			$total_herramientas = 0;
			$total_subcontratos = 0;
			if(isset($_POST["subTotal_recursos"])){
				$total_materiales = array_sum($_POST["subTotal_recursos"]);
			}
			if(isset($_POST["subTotal_MO"])){
				$total_MO = array_sum($_POST["subTotal_MO"]);
			}
			if(isset($_POST["subTotal_herramienta"])){
				$total_herramientas = array_sum($_POST["subTotal_herramienta"]);
			}
			if (isset($_POST["subTotal_subcontrato"])) {
				$total_subcontratos = array_sum($_POST["subTotal_subcontrato"]);
			}
			$cd = $total_materiales + $total_MO + $total_herramientas + $total_subcontratos;
			$costo_indirecto = round(($porcentaje_indirecto / 100) * $cd, 2);
			$precio_unitario = round($costo_indirecto + $cd, 2);
			$nombre = $conn->real_escape_string($nombre);
			$query = "INSERT INTO partida(nombre, totalCD, totalCF, precioUnitario, totalMateriales, totalManoObra, totalEquipoHerramientas, totalSubContratos) VALUES ('".$nombre."', ".$cd.", ".$porcentaje_indirecto.", ".$precio_unitario.", ".$total_materiales.", ".$total_MO.", ".$total_herramientas.", ".$total_subcontratos.")";
			if($conn->query($query)){
				$id = $conn->insert_id;

				$n = count($_POST["subTotal_recursos"]);
				for ($i = 0; $i < $n; $i++){
					$query = "INSERT INTO linearecurso (codigo, version, cantidad, subTotal) VALUES(".$_POST["codigo"][$i].", ".$_POST["version"][$i].", ".$_POST["cantidad"][$i].", ".$_POST["subTotal_recursos"][$i].")";
					$conn->query($query);
					$idLinea = $conn->insert_id;
					$query = "INSERT INTO linearecursoPartida (idLinea, numPartida, versionPartida) VALUES (".$idLinea.", ".$id.", 1)";
					$conn->query($query);
				}

				$n = count($_POST["subTotal_MO"]);
				for ($i = 0; $i < $n; $i++){
					$query = "INSERT INTO lineamanoobra (descripcion, jornada, FP, jornadaTotal, rendimiento, subTotal) VALUES('".$_POST["descripcion_mano_obra"][$i]."', ".$_POST["jornada"][$i].", ".$_POST["FP"][$i].", ".($_POST["jornada"][$i] * $_POST["FP"][$i]).", ".$_POST["rendimiento_MO"][$i].", ".$_POST["subTotal_MO"][$i].")";
					$conn->query($query);
					$idLinea = $conn->insert_id;
					$query = "INSERT INTO lineamanoobraPartida (idLinea, numPartida, versionPartida) VALUES (".$idLinea.", ".$id.", 1)";
					$conn->query($query);
				}
				

				$n = count($_POST["subTotal_herramienta"]);
				for ($i = 0; $i < $n; $i++){
					$query = "INSERT INTO lineaequipoherramienta (descripcion, tipo, capacidad, rendimiento, costoHora, subTotal) VALUES ('".$_POST["descripcion_herramienta"][$i]."', '". $_POST["tipo"][$i]."', '".$_POST["capacidad"][$i]."', ".$_POST["rendimiento_herramienta"][$i].", ".$_POST["costo_hora"][$i].", ".$_POST["subTotal_herramienta"][$i].")";
					$conn->query($query);
					$idLinea = $conn->insert_id;
					$query = "INSERT INTO lineaequipoherramientaPartida (idLinea, numPartida, versionPartida) VALUES (".$idLinea.", ".$id.", 1)";
					$conn->query($query);
				}

				$n = count($_POST["subTotal_subcontrato"]);
				for ($i = 0; $i < $n; $i++){
					$query = "INSERT INTO lineasubcontrato (descripcion, unidad, cantidad, valor, subtotal) VALUES ('".$_POST["descripcion_subcontrato"][$i]."', '".$_POST["unidad"][$i]."', ".$_POST["cantidad_subcontrato"][$i].", ".$_POST["valor"][$i].", ".$_POST["subTotal_subcontrato"][$i].")";
					$conn->query($query);
					$idLinea = $conn->insert_id;
					$query = "INSERT INTO lineasubcontratoPartida (idLinea, numPartida, versionPartida) VALUES (".$idLinea.", ".$id.", 1)";
					$conn->query($query);
				}
				if ($conn->errno) {
					echo $conn->error;
				} else {
				header("Location: ../../main/consultarPartidas.php");
				}
			}else{
				$error = 2;
				echo $conn->error;
			}
			


		}
	}

?>