<?php
    require'../services/conn.php';
require '../model/Usuario.php';

session_start();

if (!isset($_SESSION["userData"])){
    session_destroy();
    header("Location: home.php");
    exit();
}
$userData = $_SESSION["userData"];
session_write_close();

error_reporting(0);

     $proyecto = $_GET['id'];
    echo $proyecto;

    $nombre = $_POST["nombre"];
    $detalle = $_POST["detalle"];
    $fechaInicioProgramada = $_POST["fechaInicioProgramada"];
    $fechaFinProgramada = $_POST["fechaFinProgramada"];
    $estado = $_POST["estado"];
   
    $conn = ConnectionFactory::getFactory("sgp_user", "56p_2016", "sgp_system")->getConnection();

   
      $total_etapa = 0;

      if(isset($_POST["subTotal_etapa"])){
        $total_etapa = array_sum($_POST["subTotal_etapa"]);
      }
      $query = "INSERT INTO etapa(nombre, detalle, idProyecto, fechaInicioProgramada, fechaFinProgramada, estado) VALUES ('".$nombre."', '".$detalle."', '".$proyecto."', '".$fechaInicioProgramada."', '".$fechaFinProgramada."', '".$estado."')";
     // $conn->query($query);
      if($conn->query($query)){
        $id = $conn->insert_id;
        echo $id;



        $n = count($_POST["subTotal_etapa"]);
        echo $n;
        for ($i = 0; $i < $n; $i++){
          $query1 = "INSERT INTO etapapartida(idEtapa, cantidad, CD, CI, IVA, PU, subTotal) VALUES('".$id."', ".$_POST["cantidad"][$i].", ".$_POST["CDD"][$i].", ".$_POST["CII"][$i].", '".$_POST["IVAA"][$i]."', ".$_POST["PUU"][$i].", ".$_POST["subTotal_etapa"][$i].")";
          
          $conn->query($query1);

        }
        
      }else{
       
      }      


    
  

?>



  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalle Etapa</title>

    <!-- Default Styles (DO NOT TOUCH) -->
    <link rel="stylesheet" href="../lib/CSS/font-awesome.min.css">
    <link rel="stylesheet" href="../lib/CSS/emergente.css">
    <link rel="stylesheet" href="../lib/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/CSS/fonts.css">
    <link type="text/css" rel="stylesheet" href="../lib/CSS/soft-admin.css" />
    <!-- link calendar resources -->
    <link rel="stylesheet" type="text/css" href="../lib/CSS/tcal.css">
    <script type="text/javascript" src="../lib/JS/tcal.js"></script>

    <!-- Adjustable Styles -->
    <link type="text/css" rel="stylesheet" href="../lib/CSS/DT_bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="../lib/CSS/icheck.css?v=1.0.1">



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="lib/js/html5shiv.js"></script>
<script src="lib/js/respond.min.js"></script>
<![endif]-->

  </head>

  <body>

    <div class="cntnr">

      <!-- RESPONSIVE LEFT SIDEBAR & LOGO -->
      <div class="left hidden-xs">
        <div class="logo"> <img id="logo" src="../Imagenes/logo.png" style="width:159px !important; height:52px; !important"> </div>
        <div class="sidebar">
          <div class="accordion">
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="sbtn btn-default" href="home.php">
                  <span class="fa fa-home"></span> &nbsp;&nbsp;Home
                </a>
              </div>
            </div>
            <?php if ($userData->getPerfil() == "Administrador"){ ?>
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="sbtn btn-default" href="admin/users.php">
                  <span class="fa fa-users"></span> &nbsp;&nbsp;Usuarios
                </a>
              </div>
            </div>
            <?php } ?>

            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="sbtn btn-default" data-toggle="collapse" href="#c-tables">
                  <span class="fa fa-table"></span> &nbsp;&nbsp;Partidas
                  <span class="caret"></span>
                </a>
              </div>
              <div id="c-tables" class="accordion-body collapse">
                <div class="accordion-inner">
                  <a href="consultarPartidas.php" class="sbtn sbtn-default">Ver Partidas</a>
                  <a href="crear_partida.php" class="sbtn sbtn-default">Crear Partida</a>
                </div>
              </div>
            </div>

            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="sbtn sbtn-default" data-toggle="collapse" href="#c-forms">
                  <span class="fa fa-pencil-square-o"></span> &nbsp;&nbsp;Recursos
                  <span class="caret"></span>
                </a>
              </div>
              <div id="c-forms" class="accordion-body collapse">
                <div class="accordion-inner">
                  <a href="tabla_recursos.php" class="sbtn sbtn-default">Ver Recursos</a>
                  <a href="ingresar.php" class="sbtn sbtn-default">Agregar Nuevo Recurso</a>
                </div>
              </div>
            </div>

            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="sbtn btn-default active" href="proyectos.php">
                  <span class="fa fa-list-alt"></span> &nbsp;&nbsp;Proyectos
                </a>
              </div>
            </div>



          </div>
        </div>
      </div>
      <!-- END LEFT SIDEBAR & LOGO -->


      <!-- RESPONSIVE NAVIGATION -->
      <div id="secondary" class="btn-group visible-xs">
        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"><span class="icon icon-th-large"></span>&nbsp;&nbsp;Menu&nbsp;&nbsp;<span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-info pull-right" role="menu">
          <li><a href="../home.php">Home</a></li>
          <li class="dropdown-header">Recursos</li>
          <li><a href="tabla_recursos.php">Ver Recursos</a></li>
          <li><a href="ingresar.php">Agregar Recurso</a></li>
          <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
          <li class="dropdown-header">Partidas</li>
          <li><a href="consultarPartidas.php">Ver Partidas</a></li>
          <li><a href="crear_partida.php">Crear Partida</a></li>
          <li class="divider" style="border-bottom:1px solid #ddd; margin:0px; margin-top:5px;"></li>
        </ul>
      </div>

      <div id="secondary-search" class="input-icon visible-xs">
        <i class="icon icon-search"></i>
        <input class="form-control form-info input-sm" type="text">
      </div>
      <!-- END RESPONSIVE NAVIGATION -->

      <!-- RIGHT NAV, CRUMBS, & CONTENT -->
      <div class="right">

        <div class="nav">
          <div class="bar">

            <div class="logo-small visible-xs"><img style="width:120px; !important; height:32px; !important" src="../Imagenes/logo.png"></div>

            <div class="hov">
              <div class="btn-group">
                <a class="con" href="" data-toggle="dropdown"><span class="icon icon-user"></span></a>
                <ul class="dropdown-menu pull-right dropdown-profile" role="menu">
                  <li class="title"><span class="icon icon-user"></span>&nbsp;&nbsp;Bienvenido,
                    <?= $userData->getNombres()?>
                  </li>
                  <li><a href="changePassword.php">Cambiar contraseña</a></li>
                  <li><a href="../services/user/logout.php"><span class="fa fa-power-off"></span>Desconectar</a></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- BREADCRUMBS -->
          <div class="crumbs">
            <ol class="breadcrumb hidden-xs">
              <li><i class="fa fa-home"></i> <a href="home.php">Home</a></li>
              <li class="active">
                <Etapas></Etapas>
              </li>
              <li class="active">Detalle Etapa</li>
            </ol>
          </div>
        </div>

        <!-- BEGIN PAGE CONTENT -->
        <div class="content">
          <div class="page-h1">
            <h1>Detalle Etapa <small>// Informacion sobre etapa seleccionada</small></h1>
          </div>
          <div class="tb1">

            <form method="POST" action="">
              <div class="col-md-12">
                <div class="wdgt wdgt-primary" hide-btn="true">
                  <div class="wdgt-header">Datos Etapa</div>
                  <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">

                    <div class="form-group">
                      <label>Nombre de Etapa</label>
                      <input type="text" class="form-control" required id="inputFName" placeholder="nombre" name="nombre">
                      <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                      <label>Detalle de Etapa</label>
                      <input type="text" class="form-control" required id="inputFName" placeholder="detalle" name="detalle">
                      <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                      <label>Fecha Inicio Programada</label>
                      <br>
                      <input type="date" class="tcal" required id="inputFName" placeholder="FechaInicioProgramada" name="fechaInicioProgramada">
                      <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                      <label>Fecha Fin programada</label>
                      <br>
                      <input type="date" class="tcal" required id="inputFName" placeholder="FechaFinProgramada" name="fechaFinProgramada">
                      <span class="help-block"></span>
                    </div>


                    <div class="form-group">
                      <label for="disabledSelect">Estado</label>
                      <select id="disabledSelect" class="form-control form-primary" name="estado" required="required" id="inputFName">
                      <span class="help-block"></span>
                    </div>

                    <div class="form-group">
                      <button id="principal" class="btn btn-primary btn-lg" type="submit" name="guardar" value="Guardar" disabled>Regresar</button>
                    </div>

                      
            </form>


            </div>


            </div>

            <!-- END PAGE CONTENT -->

            </div>
            <!-- END NAV, CRUMBS, & CONTENT -->

          </div>

          <!-- Default JS (DO NOT TOUCH) -->
          <script src="../lib/JS/jquery-3.1.0.min.js"></script>
          <script src="../lib/JS/bootstrap.min.js"></script>
          <script src="../lib/JS/hogan.min.js"></script>
          <script src="../lib/JS/typeahead.min.js"></script>
          <script src="../lib/JS/typeahead-example.js"></script>

          <!-- Adjustable JS -->
          <script src="../lib/JS/jquery.dataTables.js"></script>
          <script src="../lib/JS/DT_bootstrap.js"></script>
          <script src="../lib/JS/soft-widgets.js"></script>
          <script src="../lib/js/bootstrapValidator.js"></script>
          <script>
      $(document).ready(function() {
       window.cantidad= function (numero, nombre, totalMateriales, totalManoObra, totalEquipoHerramientas, totalSubContratos) {
        var cant = "";
        totalMateriales= +totalMateriales;
        totalManoObra = +totalManoObra;
        totalEquipoHerramientas = +totalEquipoHerramientas;
        totalSubContratos = +totalSubContratos;
        cant = +prompt("Indique la cantidad a agregar de " + nombre + ":", "");
        $('#squarespaceModal').modal('hide');
        if (cant != null) {
          
          var totalOtros = (totalEquipoHerramientas + totalSubContratos);
          var CD = (totalMateriales + totalManoObra + totalEquipoHerramientas + totalSubContratos);
          var CI = CD * 0.29;
          var IVA1 = (CD + CI) * 0.13;
          var precioUnitario = CD + CI + IVA1;
          var subtotal = precioUnitario*cant;

         if (/^([0-9])*$/.test(cant)){
          $("#partidas tr:last td").each(function(index){
            if (index == 0){
              $("input[type='hidden']", this).val(numero);
              $("span", this).text(nombre);
            }else if(index == 1){
              $("input[type='hidden']", this).val(cant.toFixed(2));
              $("span", this).text(cant.toFixed(2));

            }else if(index == 2){
             // $("span", this).text(unidad);
            }
            else if(index == 3){
              $("span", this).text(totalMateriales.toFixed(2));
            }
            else if(index == 4){
              $("span", this).text(totalManoObra.toFixed(2));
            }
            else if(index == 5){
             $("input[type='hidden']", this).val(totalOtros.toFixed(2));
              $("span", this).text(totalOtros.toFixed(2));
            }
            else if(index == 6){
             $("input[type='hidden']", this).val(CD.toFixed(2));
              $("span", this).text(CD.toFixed(2));
            }
            else if(index == 7){
             $("input[type='hidden']", this).val(CI.toFixed(2));
              $("span", this).text(CI.toFixed(2));
            }
            else if(index == 8){
             $("input[type='hidden']", this).val(IVA1.toFixed(2));
              $("span", this).text(IVA1.toFixed(2));
            }
            else if(index == 9){
             $("input[type='hidden']", this).val(precioUnitario.toFixed(2));
              $("span", this).text(precioUnitario.toFixed(2));
            }
            else if(index == 10){
              $("input[type='hidden']", this).val(subtotal.toFixed(2));
              $("span", this).text(subtotal.toFixed(2));
            }
          });
          var total_etapa = +$("#sub-total-etapa").text() + subtotal;
          $("#sub-total-etapa").text(total_etapa.toFixed(2));
        }
         
        else {
         alert("El valor " + cant + " no es un número");
        }
        
       }
        }


        $('#squarespaceModal').modal({ show: false});
        $("#modal2").modal({show: false});
        $("#modal3").modal({show: false});
        $("#modal4").modal({show: false});
        $('.datatable').dataTable({
          "sPaginationType": "bs_full"
        });
        $('.datatable').each(function() {
          var datatable = $(this);
          // SEARCH - Add the placeholder for Search and Turn this into in-line form control
          var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
          search_input.attr('placeholder', 'Search');
          search_input.addClass('form-control input-sm');
          // LENGTH - Inline-Form control
          var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
          length_sel.addClass('form-control input-sm');
        });

        $("#new-row-recursos").click(function() {
          $('#squarespaceModal').modal('show');
          var table = $(this).parents(".wdgt-body").children("table");
          var count = table.children("tbody").children("tr").length;

          html = "<tr><td><span></span></td><td><span></span><input type='hidden' name='cantidad[]'/></td><td><span></span></td><td><span></span></td><td><span></span></td><td><span></span></td><td><span></span><input type='hidden' name='CDD[]'/></td><td><span></span><input type='hidden' name='CII[]'/></td><td><span></span><input type='hidden' name='IVAA[]'/></td><td><span></span><input type='hidden' name='PUU[]'/></td><td><span class='subtotal'></span><input type='hidden' name='subTotal_etapa[]'/></td><td><button class='eliminar btn btn-info btn-sm'><i class='icon icon-trash'></i></button></td></tr>";
          table.append(html);
           $("#principal").prop("disabled", false);
        });
      });
    </script>
  </body>

  </html>