<?php
header('Content-Type: text/html; charset=utf8mb3_spanish_ci');
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf8mb3_spanish_ci">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UNODC</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/a.ico">
  
    <!-- PLUGINS DE CSS -->
    <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">
    <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">

    <!-- PLUGINS DE JAVASCRIPT -->
    <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="vistas/dist/js/adminlte.min.js"></script>
    <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
    <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script src="vistas/plugins/iCheck/icheck.min.js"></script>
    <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>
    <script src="vistas/bower_components/moment/min/moment.min.js"></script>
    <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="vistas/bower_components/raphael/raphael.min.js"></script>
    <script src="vistas/bower_components/morris.js/morris.min.js"></script>
    <script src="vistas/bower_components/Chart.js/Chart.js"></script>
</head>

<style>
    @font-face {
        font-family: 'MiFuente';
        src: url('../src/fonts/GeometriaNarrow-Regular-trial.otf') format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    p, h1, h2, h3, h4, a, span {
        font-family: 'MiFuente', Arial, sans-serif !important;
    }
</style>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">

    <?php
    if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
        echo '<div class="wrapper">';

        // CABEZOTE
        include "modulos/cabezote.php";

        // MENU
        if ($_GET["ruta"] != "primer-acceso") {
            include "modulos/menu.php";
        }

        // CONTENIDO
        if (isset($_GET["ruta"])) {
            $ruta = $_GET["ruta"];
            $modulosPermitidos = [
                "inicio", "usuarios", "validacion", "donantes", "departamentos", "municipios", "encuesta",
                "lista-encuesta","ejes", "actividades", "reportes/actividades", "grafica.ajax", "ajax/reportes.ajax",
                "tareas", "detalle-tarea", "tipos", "reportes1", "dashboard", "reportes", "reporte",
                "primer-acceso", "salir"
            ];

            if (in_array($ruta, $modulosPermitidos)) {
                include "modulos/$ruta.php";
            } else {
                include "modulos/404.php";
            }
        } else {
            include "modulos/inicio.php";
        }

        // FOOTER
        include "modulos/footer.php";

        echo '</div>';
    } else {
        include "modulos/login.php";
    }
    ?>

    <script src="vistas/js/plantilla.js"></script>
    <script src="vistas/js/usuarios.js"></script>
    <script src="vistas/js/donantes.js"></script>
    <script src="vistas/js/departamentos.js"></script>
    <script src="vistas/js/municipios.js"></script>
    <script src="vistas/js/ejes.js"></script>
    <script src="vistas/js/tareas.js"></script>
    <script src="vistas/js/actividades.js"></script>
    <script src="vistas/js/tipos.js"></script>
    <script src="vistas/js/reportes.js"></script>
</body>
</html>