<?php

require_once "../../controladores/actividades.controlador.php";
require_once "../../modelos/actividades.modelo.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
require_once "../../controladores/donantes.controlador.php";
require_once "../../modelos/donantes.modelo.php";

$reporte = new ControladorActividades();
$reporte -> ctrDescargarReporteActividades();