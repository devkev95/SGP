<?php
require_once '../services/conn.php';
if (isset($_POST["id"], $_POST["opt"], $_POST["version"], $_POST["idPartida"])) {
	$db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "prueba_sgp_system")->getConnection();
	$table = "";
	if ($_POST["opt"] == 1) {
		$table = "linearecurso";
		$table2 = "linearecursoPartida";
	} elseif ($_POST["opt"] == 2) {
		$table = "lineamanoobra";
		$table2 = "lineamanoobraPartida";
	} elseif ($_POST["opt"] == 3) {
		$table = "lineaequipoherramienta";
		$table2 = "lineaequipoherramientaPartida";
	} elseif ($_POST["opt"] == 4) {
		$table = "lineasubcontrato";
		$table2 = "lineasubcontratoPartida";
	}

	// Revisamos si la linea de partida esta relacionada con alguna partida relacionada con algún proyecto finalizado
	$query = "SELECT a.id FROM ".$table." a INNER JOIN ".$table2." b ON a.id = b.idLinea INNER JOIN partida c ON b.numPartida = c.numero AND b.versionPartida = c.version INNER JOIN etapapartida d ON d.idPartida = c.numero AND d.versionPartida = c.version INNER JOIN etapa e ON e.idEtapa=d.idEtapa INNER JOIN proyecto f ON f.idProyecto = e.idProyecto WHERE f.estado != 0 AND c.version = ".$_POST["version"]." AND a.id = ".$_POST["id"]." AND c.numero = ".$_POST["idPartida"];
	$res = $db->query($query);

	// Si la cantidad de filas que manda es mayor a 0 quiere decir que esta relacionado con alguna partida relacionada 
	// con algún proyecto finalizado por lo tanto no hacemos nada, ya que eso se manejara en la parte de guardar 
	// partida. En el caso contrario eliminamos directamente la linea de partida 
	if ($res->num_rows <= 0) {

		// Prime eliminamos el registro de la tabla que lleva la relacion de las lineas con las versiones y luego 
		// eliminamos la linea en si
		$query = "DELETE FROM ".$table2." WHERE idLinea=".$_POST["id"]." AND numPartida=".$_POST["idPartida"]." AND versionPartida=".$_POST["version"];
		$db->query($query);

		$query = "DELETE FROM ".$table." WHERE id=".$_POST["id"];
		$db->query($query);
	}
	
}
?>