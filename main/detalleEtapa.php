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
                <div class="wdgt-header">Etapas</div>
                <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">

              <div class="form-group">
              <label>Nombre de Etapa</label>
               <input type="text" class="form-control" required id="inputFName" placeholder="nombre" name="nombre"  >
              <span class="help-block"></span>
               </div>

               <div class="form-group">
              <label>Detalle de Etapa</label>
               <input type="text" class="form-control" required id="inputFName" placeholder="detalle" name="detalle"  >
              <span class="help-block"></span>
               </div>

              <div class="form-group">
              <label>Fecha Inicio Programada</label>
              <br>
               <input type="date" class="tcal" required id="inputFName" placeholder="FechaInicioProgramada" name="fechaInicioProgramada"  >
              <span class="help-block"></span>
               </div>

              <div class="form-group">
              <label>Fecha Fin programada</label>
              <br>
               <input type="date" class="tcal" required id="inputFName" placeholder="FechaFinProgramada" name="fechaFinProgramada"  >
              <span class="help-block"></span>
               </div>   

          
             <div class="form-group">
               <label for="disabledSelect">Seleccionar el estado</label>
               <select id="disabledSelect" class="form-control form-primary" name="estado" required="required" id="inputFName">
                  <option value="Espera" <?php echo $estado == 'Espera'?'selected':'';?>>Espera</option>
                  <option value="Iniciado" <?php echo $estado == 'Iniciado'?'selected':'';?>>Iniciado</option>
                  <option value="Terminado" <?php echo $estado == 'Terminado'?'selected':'';?>>Terminado</option>

               </select>
                <span class="help-block"></span>
             </div>
             <br>
             <br>
             <br>
             <br>
             </div>

              <div class="wdgt-body" style="padding-bottom:0px; padding-top:10px;">


                  <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-striped" id="partidas">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>totalCD</th>
                        <th>totalCF</th>
                        <th>precioUnitario</th>
                        <th>totalMateriales</th>
                        <th>totalManoObra</th>
                        <th>totalEquipoHerramientas</th>
                        <th>totalSubContratos</th>
                        <th></th>
                         
                      </tr>
                    </thead>
                    <tbody>
                       <?php
                          #include 'connect_db.php';
                          require("connect_db.php");
                          $sql = mysql_query("SELECT * FROM partida WHERE numero>=3");

                          while ($row = mysql_fetch_array($sql)) {
                            echo '<tr>';
                            echo '<td>'. $row['nombre'] . '</td>';
                            echo '<td>'. $row['totalCD'] .'</td>';
                            echo '<td>'. $row['totalCF'] .'</td>';
                            echo '<td>'. $row['precioUnitario'] . '</td>';
                            echo '<td>'. $row['totalMateriales'] .'</td>';
                            echo '<td>'. $row['totalManoObra'] .'</td>';
                            echo '<td>'. $row['totalEquipoHerramientas'] .'</td>';
                            echo '<td>'. $row['totalSubContratos'] .'</td>';
                            echo '</tr>';
                          }
                       ?> 

                    </tbody>
                  </table>
                  <br>
                </div>
              </div>

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
          
  </body>

  </html>