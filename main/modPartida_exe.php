
<?php 
 require_once '../services/conn.php';
 $conn = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();

  $numeroPartida = $_POST['idPartida'];
  $porcentaje_indirecto= $_POST["CI"];
  $total_materiales = 0;
  $total_MO = 0;
  $total_herramientas = 0;
  $total_subcontratos = 0;
  $offsetMatPrima = 0;
  $offsetEH = 0;
  $offsetMO = 0;
  $offsetSC = 0;
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
  // Obteniedo la ultima versión de la partida
  $version = $_POST["version"];
  $nuevaVersion = 0;

  // Calculos de costos totales
  $cd = $total_materiales + $total_MO + $total_herramientas + $total_subcontratos;
  $costo_indirecto = round(($porcentaje_indirecto / 100) * $cd, 2);
  $precio_unitario = round($costo_indirecto + $cd, 2);

  // Revisando si la partida que estamos editando no esta relacionada con nigún proyecto finalizado o en progreso
  $query = "SELECT a.nombre FROM partida a INNER JOIN etapapartida b ON b.idPartida = a.numero AND b.versioNPartida = a.version INNER JOIN etapa c ON b.idEtapa = c.idEtapa INNER JOIN proyecto d ON d.idProyecto = c.idProyecto WHERE d.estado != 0 AND a.numero = ".$numeroPartida." AND a.version = ".$version;
  $res = $conn->query($query);

  // Si retorna mas que una fila quiere decir que la partida esta relacionada con proyectos finalizados o en progreso 
  // y por lo tanto hay que crear una nueva versión de esta
  if ($res->num_rows > 0) {
    $nuevaVersion = $version + 1;
    $row = $res->fetch_object();
    $nombre = $row->nombre;
    $query = "INSERT INTO partida(numero, version ,nombre, totalCD, totalCF, precioUnitario, totalMateriales, totalManoObra, totalEquipoHerramientas, totalSubContratos) VALUES (".$numeroPartida.", ".$nuevaVersion.", '".$nombre."', ".$cd.", ".$porcentaje_indirecto.", ".$precio_unitario.", ".$total_materiales.", ".$total_MO.", ".$total_herramientas.", ".$total_subcontratos.")";
    $conn->query($query);

      // Relacionamos las lineas de la versión anterior de la partida con la nueva versión de la partida
      if (isset($_POST["idLineaMatPrima"])) {
        $n = count($_POST["idLineaMatPrima"]);
        for ($i = 0; $i < $n; $i++){
          $query = "INSERT INTO linearecursopartida (idLinea, numPartida, versionPartida) VALUES (".$_POST["idLineaMatPrima"][$i].", ".$numeroPartida.", ".$nuevaVersion.")";
            $conn->query($query);
        }
        $offsetMatPrima = $i;   
      }
      
      if (isset($_POST["idLineaMO"])) {
        $n = count($_POST["idLineaMO"]);
        for ($i = 0; $i < $n; $i++){
            $query = "INSERT INTO lineamanoobrapartida (idLinea, numPartida, versionPartida) VALUES (".$_POST["idLineaMO"][$i].", ".$numeroPartida.", ".$nuevaVersion.")";
            $conn->query($query);
        }
        $offsetMO = $i;
      }
      
      if (isset($_POST["idLineaEH"])) {
        $n = count($_POST["idLineaEH"]);
        for ($i = 0; $i < $n; $i++){
          $query = "INSERT INTO lineaequipoherramientapartida (idLinea, numPartida, versionPartida) VALUES (".$_POST["idLineaEH"][$i].", ".$numeroPartida.", ".$nuevaVersion.")";
            $conn->query($query);
        }
        $offsetEH = $i;
              
      }      

      if (isset($_POST["idLineaSC"])) {
        $n = count($_POST["idLineaSC"]);
        for ($i = 0; $i < $n; $i++){
          $query = "INSERT INTO lineasubcontratopartida (idLinea, numPartida, versionPartida) VALUES (".$_POST["idLineaSC"][$i].", ".$numeroPartida.", ".$nuevaVersion.")";
            $conn->query($query);
        }
        $offsetSC = $i;
      }
    
  } else {

    // Actualizamos la partida y sus lineas si no se encuentran relacionada con ningún proyecto finalizado o en
    // progreso
    $query = "UPDATE partida SET totalCD =".$cd.", totalCF=".$porcentaje_indirecto.", precioUnitario=".$precio_unitario.", totalMateriales=".$total_materiales.", totalManoObra=".$total_MO.", totalEquipoHerramientas=".$total_herramientas.", totalSubContratos=".$total_subcontratos." WHERE numero=".$numeroPartida." AND version=".$version;
    if($conn->query($query)){

      if (isset($_POST["idLineaMatPrima"])) {
        $n = count($_POST["idLineaMatPrima"]);
        for ($i = 0; $i < $n; $i++){
          $query = "UPDATE linearecurso SET cantidad=".$_POST["cantidadMateria"][$i].", subTotal=".$_POST["subTotal_recursos"][$i]." WHERE id=".$_POST["idLineaMatPrima"][$i];
          $conn->query($query);
        }
        $offsetMatPrima = $i;
      }

      if (isset($_POST["idLineaMO"])) {
        $n = count($_POST["idLineaMO"]);
        for ($i = 0; $i < $n; $i++){
          $query = "UPDATE lineamanoobra SET descripcion='".$_POST["descripcionMO"][$i]."', jornada=".$_POST["jornadaMO"][$i].", FP=".$_POST["FPMO"][$i].", jornadaTotal=".round($_POST["jornadaMO"][$i] * $_POST["FPMO"][$i], 2).", rendimiento=".$_POST["rendimientoMO"].", subTotal=".$_POST["subTotalMO"]." WHERE id=".$_POST["idLineaMO"][$i];
          $conn->query($query);
        }
        $offsetMO = $i;
      }
      
      if (isset($_POST["idLineaEH"])) {
        $n = count($_POST["idLineaEH"]);
        for ($i = 0; $i < $n; $i++){
          $query = "UPDATE lineaequipoherramienta SET descripcion='".$_POST["descripcionEH"][$i]."', tipo='".$_POST["tipoEH"][$i]."', capacidad=".$_POST["capacidadEH"][$i].", rendimiento=".$_POST["rendimientoEH"].", costoHora=".$_POST["costo_hora"].", subTotal=".$_POST["subTotalEH"]." WHERE id=".$_POST["idLineaEH"][$i];
          $conn->query($query);
        }
        $offsetEH = $i;
      }
      
      if (isset($_POST["idLineaSC"])) {
        $n = count($_POST["idLineaSC"]);
        for ($i = 0; $i < $n; $i++){
          $query = "UPDATE lineasubcontrato SET unidad='".$_POST["unidadsc"][$i]."', cantidad='".$_POST["cantidadsc"][$i]."', valor=".$_POST["valorsc"][$i].", descripcion=".$_POST["descripcionsc"].", subTotal=".$_POST["subtotalsc"]." WHERE id=".$_POST["idLineaSC"][$i];
          $conn->query($query);
        }
        $offsetSC = $i;
      }
      

    }
    
  }
  
  // Creamos los nuevas lineas agregadas para cualquier caso
    if (isset($_POST["codigo"])) {
      $n = count($_POST["codigo"]);
      for ($i = 0; $i < $n; $i++){
        $query = "INSERT INTO linearecurso (codigo, version, cantidad, subTotal) VALUES(".$_POST["codigo"][$i].", ".$_POST["versionMatPrima"][$i]." ,".$_POST["cantidadMateria"][$i+$offsetMatPrima].", ".$_POST["subTotal_recursos"][$i+$offsetMatPrima].")";
        $conn->query($query);
        $idLinea = $conn->insert_id;
        $query = "INSERT INTO linearecursoPartida (idLinea, numPartida, versionPartida) VALUES (".$idLinea.", ".$numeroPartida;
        if ($nuevaVersion != 0) {
          $query .= ", ".$nuevaVersion.")";
        } else {
          $query .= ", ".$version.")";
        }
        $conn->query($query);
      }
    }
    
    if (isset($_POST["rendimientoMO"], $_POST["idLineaMO"])) {
      $n = count($_POST["rendimientoMO"]) - count($_POST["idLineaMO"]);
      for ($i = 0; $i < $n; $i++){
        $query = "INSERT INTO lineamanoobra (descripcion, jornada, FP, jornadaTotal, rendimiento, subTotal) VALUES('".$_POST["descripcionMO"][$i+$offsetMO]."', ".$_POST["jornadaMO"][$i+$offsetMO].", ".$_POST["FPMO"][$i+$offsetMO].", ".($_POST["jornadaMO"][$i+$offsetMO] * $_POST["FPMO"][$i+$offsetMO]).", ".$_POST["rendimientoMO"][$i+$offsetMO].", ".$_POST["subTotalMO"][$i+$offsetMO].")";
        $conn->query($query);
        $idLinea = $conn->insert_id;
          $query = "INSERT INTO lineamanoobraPartida (idLinea, numPartida, versionPartida) VALUES (".$idLinea.", ".$numeroPartida;
          if ($nuevaVersion != 0) {
            $query .= ", ".$nuevaVersion.")";
          } else {
            $query .= ", ".$version.")";
          }
          $conn->query($query);
      }
    }
    
      if (isset($_POST["rendimientoEH"], $_POST["idLineaEH"])) {
        $n = count($_POST["rendimientoEH"]) - count($_POST["idLineaEH"]);
        for ($i = 0; $i < $n; $i++){
          $query = "INSERT INTO lineaequipoherramienta (descripcion, tipo, capacidad, rendimiento, costoHora, subTotal) VALUES ('".$_POST["descripcionEH"][$i+$offsetEH]."', '". $_POST["tipoEH"][$i+$offsetEH]."', '".$_POST["capacidadEH"][$i+$offsetEH]."', ".$_POST["rendimientoEH"][$i+$offsetEH].", ".$_POST["costo_hora"][$i+$offsetEH].", ".$_POST["subTotalEH"][$i+$offsetEH].")";
          $conn->query($query);
           $idLinea = $conn->insert_id;
            $query = "INSERT INTO lineaequipoherramientaPartida (idLinea, numPartida, versionPartida) VALUES (".$idLinea.", ".$numeroPartida;
             if ($nuevaVersion != 0) {
              $query .= ", ".$nuevaVersion.")";
            } else {
              $query .= ", ".$version.")";
            }
            $conn->query($query);
        }  
      }
      
      if (isset($_POST["unidadsc"], $_POST["idLineaSC"])) {
        $n = count($_POST["unidadsc"]) - count($_POST["idLineaSC"]);
        for ($i = 0; $i < $n; $i++){
          $query = "INSERT INTO lineasubcontrato (descripcion, unidad, cantidad, valor, subtotal) VALUES ('".$_POST["descripcionsc"][$i+$offsetSC]."', '".$_POST["unidadsc"][$i+$offsetSC]."', ".$_POST["cantidadsc"][$i+$offsetSC].", ".$_POST["valorsc"][$i+$offsetSC].", ".$_POST["subtotalsc"][$i+$offsetSC].")";
          $conn->query($query);
          $idLinea = $conn->insert_id;
            $query = "INSERT INTO lineasubcontratoPartida (idLinea, numPartida, versionPartida) VALUES (".$idLinea.", ".$numeroPartida;
             if ($nuevaVersion != 0) {
                $query .= ", ".$nuevaVersion.")";
              } else {
                $query .= ", ".$version.")";
              }
            $conn->query($query);
        }  
      }
      

    // Revisamos si hay proyectos no iniciados relacionados con está partida, si es asi tenemos que actualizar la 
    // relación con los cambios hechos en la partida
      $query = "SELECT a.cantidad, a.idEtapa, a.CI, a.subTotal FROM etapapartida a INNER JOIN partida b ON a.idPartida = b.numero AND a.versionPartida = b.version INNER JOIN etapa c ON c.idEtapa = a.idEtapa INNER JOIN proyecto d ON c.idProyecto = d.idProyecto WHERE b.numero = ".$numeroPartida." AND b.version = ".$version." AND d.estado = 0";
      $res = $conn->query($query);
      if ($res->num_rows > 0) {
        
        while($row = $res->fetch_object()){
          $iva = $cd * (1 + ($row->CI / 100)) * 0.13;
          $puPartidaEtapa = $cd * (1 + ($row->CI / 100) + 0.13);
          $subtotalPartidaEtapa = $puPartidaEtapa * $row->cantidad;
          $diff = $subtotalPartidaEtapa - $row->subTotal;
          $query = "UPDATE etapapartida SET IVA=".$iva.", CD=".$cd.", PU=".$puPartidaEtapa;
          if ($nuevaVersion != 0) {
            $query .= ", versionPartida=".$nuevaVersion;
          }
          $query .= ", subTotal=".$subtotalPartidaEtapa." WHERE idPartida=".$numeroPartida." AND versionPartida=".$version." AND idEtapa=".$row->idEtapa;
          $conn->query($query);

          $query = "SELECT b.idProyecto, b.montoTotal FROM etapa a INNER JOIN proyecto b ON a.idProyecto = b.idProyecto WHERE a.idEtapa=".$row->idEtapa;
          $res2 = $conn->query($query);
          $idProyecto = $res2->fetch_object()->idProyecto;
          $montoTotal = $res2->fetch_object()->montoTotal;
          $nuevoMontoTotal = $montoTotal + ($diff * (1 + ($row->CI / 100) + 0.13));

          $query = "UPDATE proyecto SET montoTotal=".$nuevoMontoTotal." WHERE idProyecto =".$idProyecto;
          $conn->query($query);
        }
      } 

    if ($conn->errno){
      echo $conn->error;
    } else{

    header("Location: consultarPartidas.php");
  }


?>