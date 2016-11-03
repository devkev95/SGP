
<?php 
 require_once '../services/conn.php';
 $conn = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
 error_reporting(0);

  $numeroPartida = $_POST['idPartida'];
  $porcentaje_indirecto= $_POST["CI"];
  $total_materiales = 0;
  $total_MO = 0;
  $total_herramientas = 0;
  $total_subcontratos = 0;
  if(isset($_POST["subTotal_recursos"])){
    $total_materiales = array_sum($_POST["subTotal_recursos"]);
  }
  if(isset($_POST["subTotalMO"])){
    $total_MO = array_sum($_POST["subTotalMO"]);
  }
  if(isset($_POST["subTotalEH"])){
    $total_herramientas = array_sum($_POST["subTotalEH"]);
  }
  if (isset($_POST["subtotalsc"])) {
    $total_subcontratos = array_sum($_POST["subtotalsc"]);
  }

  $cd = $total_materiales + $total_MO + $total_herramientas + $total_subcontratos;
  if (is_string($porcentaje_indirecto)) {
    $porcentaje_indirecto = explode("%", $porcentaje_indirecto);
    $porcentaje_indirecto = (float)$porcentaje_indirecto[0] / 100;

  }
  if(is_numeric($porcentaje_indirecto) and $porcentaje_indirecto > 0){
    $porcentaje_indirecto /= 100;
  }
  $costo_indirecto = round($porcentaje_indirecto * $cd, 2);
  $precio_unitario = round($costo_indirecto + $cd, 2);
  $query = "UPDATE partida SET totalCD =".$cd.", totalCF=".($porcentaje_indirecto * 100).", precioUnitario=".$precio_unitario.", totalMateriales=".$total_materiales.", totalManoObra=".$total_MO.", totalEquipoHerramientas=".$total_herramientas.", totalSubContratos=".$total_subcontratos." WHERE numero=".$numeroPartida;
  if($conn->query($query)){

    $n = count($_POST["idLineaMatPrima"]);
    for ($i = 0; $i < $n; $i++){
      $query = "UPDATE linearecurso SET cantidad=".$_POST["cantidadMateria"][$i].", subTotal=".$_POST["subTotal_recursos"][$i]." WHERE id=".$_POST["idLineaMatPrima"][$i];
      $conn->query($query);
    }
    $offset = $i;

    $n = count($_POST["codigo"]);
    for ($i = 0; $i < $n; $i++){
      $query = "INSERT INTO linearecurso (numero, codigo, cantidad, subTotal) VALUES(".$numeroPartida.", '".$_POST["codigo"][$i]."', ".$_POST["cantidadMateria"][$i+$offset].", ".$_POST["subTotal_recursos"][$i+$offset].")";
      $conn->query($query);
    }

    $n = count($_POST["idLineaMO"]);
    for ($i = 0; $i < $n; $i++){
      $query = "UPDATE lineamanoobra SET descripcion='".$_POST["descripcionMO"][$i]."', jornada=".$_POST["jornadaMO"][$i].", FP=".$_POST["FPMO"][$i].", jornadaTotal=".round($_POST["jornadaMO"][$i] * $_POST["FPMO"][$i], 2).", rendimiento=".$_POST["rendimientoMO"].", subTotal=".$_POST["subTotalMO"]." WHERE id=".$_POST["idLineaMO"][$i];
      $conn->query($query);
    }
    $offset = $i;

    $n = count($_POST["rendimientoMO"]) - count($_POST["idLineaMO"]);
    for ($i = 0; $i < $n; $i++){
      $query = "INSERT INTO lineamanoobra (numero, descripcion, jornada, FP, jornadaTotal, rendimiento, subTotal) VALUES(".$numeroPartida.", '".$_POST["descripcionMO"][$i+$offset]."', ".$_POST["jornadaMO"][$i+$offset].", ".$_POST["FPMO"][$i+$offset].", ".round($_POST["jornadaMO"][$i+$offset] * $_POST["FPMO"][$i+$offset], 2).", ".$_POST["rendimientoMO"][$i+$offset].", ".$_POST["subTotalMO"][$i+$offset].")";
      $conn->query($query);
    }
    
     $n = count($_POST["idLineaEH"]);
    for ($i = 0; $i < $n; $i++){
      $query = "UPDATE lineaequipoherramienta SET descripcion='".$_POST["descripcionEH"][$i]."', tipo='".$_POST["tipoEH"][$i]."', capacidad=".$_POST["capacidadEH"][$i].", rendimiento=".$_POST["rendimientoEH"].", costoHora=".$_POST["costo_hora"].", subTotal=".$_POST["subTotalEH"]." WHERE id=".$_POST["idLineaEH"][$i];
      $conn->query($query);
    }
    $offset = $i;

    $n = count($_POST["rendimientoEH"]) - count($_POST["idLineaEH"]);
    for ($i = 0; $i < $n; $i++){
      $query = "INSERT INTO lineaequipoherramienta (numero, descripcion, tipo, capacidad, rendimiento, costoHora, subTotal) VALUES (".$numeroPartida.", '".$_POST["descripcionEH"][$i+$offset]."', '". $_POST["tipoEH"][$i+$offset]."', '".$_POST["capacidadEH"][$i+$offset]."', ".$_POST["rendimientoEH"][$i+$offset].", ".$_POST["costo_hora"][$i+$offset].", ".$_POST["subTotalEH"][$i+$offset].")";
      $conn->query($query);
    }

    $n = count($_POST["idLineaSC"]);
    for ($i = 0; $i < $n; $i++){
      $query = "UPDATE lineasubcontrato SET unidad='".$_POST["unidadsc"][$i]."', cantidad='".$_POST["cantidadsc"][$i]."', valor=".$_POST["valorsc"][$i].", descripcion=".$_POST["descripcionsc"].", subTotal=".$_POST["subtotalsc"]." WHERE id=".$_POST["idLineaSC"][$i];
      $conn->query($query);
    }
    $offset = $i;

    $n = count($_POST["unidadsc"]) - count($_POST["idLineaSC"]);
    for ($i = 0; $i < $n; $i++){
      $query = "INSERT INTO lineasubcontrato (numero, descripcion, unidad, cantidad, valor, subtotal) VALUES (".$numeroPartida.", '".$_POST["descripcionsc"][$i+$offset]."', '".$_POST["unidadsc"][$i+$offset]."', ".$_POST["cantidadsc"][$i+$offset].", ".$_POST["valorsc"][$i+$offset].", ".$_POST["subtotalsc"][$i+$offset].")";
      $conn->query($query);

    }
    header("Location: consultarPartidas.php");
  }else{
    echo $conn->error;
  }
  




?>