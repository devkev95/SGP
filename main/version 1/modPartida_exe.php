
<?php 
 require'../services/conn.php';
 $db = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();
 

$numeroPartida = $_GET['numero'];
//VARIABLES MATERIALES
 $cantidadM= $_POST['cantidadMaterial'];
//VARIABLES MANO DE OBRA
$manoObraDes= $_POST['descripcionMO'];
$manoObraJor= $_POST['jornadaMO'];
$manoObraFPn= $_POST['FPMO'];
$manoObraJorT= $_POST['jornadaTotalMO'];
$manoObraRen= $_POST['rendimientoMO'];
$manoObraSubT= $_POST['subTotalMO'];

//VARIABLES EQUIPOO Y MAQUINARIA

$hE1= $_POST['descripcionEH'];
$hE2= $_POST['tipoEH'];
$hE3= $_POST['capacidadEH'];
$hE4= $_POST['rendimientoEH'];
$hE5= $_POST['costoHoraEH'];
$hE6= $_POST['subTotalEH'];

//$queruSHE="SELECT id FROM lineaequipoherramienta WHERE id"

//VARIABLES SUB CONTRATO
$sC1= $_POST['descripcionSC'];
$sC2= $_POST['unidadSC'];
$sC3= $_POST['cantidadSC'];
$sC4= $_POST['valorSC'];
$sC5= $_POST['subTotalSC'];



//CONSULTA MATERIALES
$query1="SELECT a.codigo, a.unidad, b.cantidad, a.total, b.subTotal FROM recurso a INNER JOIN linearecurso b ON a.codigo = b.codigo WHERE numero =".$numeroPartida;
          $resultado1=mysqli_query($db,$query1);
//CONSULTAS MANO DE OBRA
 $queryMO="SELECT id FROM lineamanoobra WHERE numero=".$numeroPartida;
$resultadoMO=mysqli_query($db,$queryMO);
//CONSULTA EQUIPO Y HERRAMIENTAS
$queryEH="SELECT id FROM lineaequipoherramienta WHERE numero=".$numeroPartida;
$resultadoEH=mysqli_query($db,$queryEH);
//CONSULTA SUBCONTRATO
$querySC="SELECT id FROM lineasubcontrato WHERE numero=".$numeroPartida;
$resultadoSC=mysqli_query($db,$querySC);
    

        

//matteriales
  $num_rows = mysqli_num_rows($resultado1);
          $numero=0;
          if($num_rows > 0){

        
        while ($fila1 = mysqli_fetch_array($resultado1)){
        	

        	$nuevoSubTotal=0;
        	$totalM=0;
        	
        
        	
        	$totalM="$fila1[total]";
        	$nuevoSubTotal=( $totalM*$cantidadM[$numero]);
        	$codigoMaterial="$fila1[codigo]";
       

        	
        	$queryUpdate="UPDATE linearecurso SET cantidad=".$cantidadM[$numero].", subTotal=".$nuevoSubTotal." WHERE codigo='".$codigoMaterial."'";
        	$update= mysqli_query($db,$queryUpdate);
        
			$numero=$numero+1;

        }


    }

    //mano de obra
    $num_rowsM = mysqli_num_rows($resultadoMO);
          $numeroM=0;

          if($num_rowsM > 0){

        
        while ($filaMO = mysqli_fetch_array($resultadoMO)){
          
          $descripcion=null;
          $jor=0;
          $FP=0;
          $jornadaTotal=0;
          $rendimiento=0;
          $STMO=0;

          $identificador="$filaMO[id]";
          $descripcion=$manoObraDes[$numeroM];
          $jor=$manoObraJor[$numeroM];
          $FP=$manoObraFPn[$numeroM];
          $jornadaTotal=$manoObraJorT[$numeroM];
          $rendimiento=$manoObraRen[$numeroM];
          $STMO=$manoObraSubT[$numeroM];

          $queryMO1="UPDATE lineamanoobra SET descripcion='".$descripcion."', jornada=".$jor.", FP=".$FP.", jornadaTotal=".$jornadaTotal.", rendimiento=".$rendimiento.", subTotal=".$STMO." WHERE id=".$identificador;
          

            $update=mysqli_query($db,$queryMO1);

            

          
         
            $numeroM=$numeroM+1;
          

       

        }


    }

    //equipo y herramientas
        $num_rowsEH = mysqli_num_rows($resultadoEH);
          $numeroEH=0;

          if($num_rowsEH > 0){

        
        while ($filaEH = mysqli_fetch_array($resultadoEH)){
          
          $descripcionNEH=null;
          $tipoNEH=null;
          $cantidadNEH=null;
          $rendimientoNEH=0;
          $costoHoraNEH=0;
          $subTotalNEH=0;

          $identificadorEH="$filaEH[id]";
          $descripcionNEH=$hE1[$numeroEH];
          $tipoNEH=$hE2[$numeroEH];
          $capacidadNEH=$hE3[$numeroEH];
          $rendimientoNEH=$hE4[$numeroEH];
          $costoHoraNEH=$hE5[$numeroEH];
          $subTotalNEH=$hE6[$numeroEH];

          $queryEH1="UPDATE lineaequipoherramienta SET descripcion='".$descripcionNEH."', tipo='".$tipoNEH."', capacidad='".$capacidadNEH."',rendimiento=".$rendimientoNEH.", costoHora=".$costoHoraNEH.", subTotal=".$subTotalNEH." WHERE id=".$identificadorEH;

          

            $updateEH=mysqli_query($db,$queryEH1);       
           
            $numeroEH=$numeroEH+1;
          
        }


    }

    //subcontratos
    $num_rowsSC = mysqli_num_rows($resultadoSC);
          $numeroSC=0;

          if($num_rowsSC> 0){

        
        while ($filaSC = mysqli_fetch_array($resultadoSC)){
          
          $descripcionNSC=null;
          $unidadNSC=null;
          $cantidadNSC=0;
          $valorNSC=0;
          $subTotalNSC=0;

          $identificadorSC="$filaSC[id]";
          $descripcionNSC=$sC1[$numeroSC];
          $unidadNSC=$sC2[$numeroSC];
          $cantidadNSC=$sC3[$numeroSC];
          $valorNSC=$sC4[$numeroSC];
          $subTotalNSC=$sC5[$numeroSC];

          
          $querySC1="UPDATE lineasubcontrato SET unidad='".$unidadNSC."', cantidad=".$cantidadNSC.",valor=". $valorNSC.",descripcion='".$descripcionNSC."', subTotal=".$subTotalNSC." WHERE id=".$identificadorSC;

          

            $updateSC1=mysqli_query($db,$querySC1);
                 
         
            $numeroSC=$numeroSC+1;
          
        }


    }
  

  




header("Location: modPartida.php?numero=$numeroPartida");




?>