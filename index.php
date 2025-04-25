<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/donantes.controlador.php";
require_once "controladores/ejes.controlador.php";
require_once "controladores/departamentos.controlador.php";
require_once "controladores/municipios.controlador.php";
require_once "controladores/actividades.controlador.php";
require_once "controladores/tipos.controlador.php";



require_once "controladores/tareas.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/donantes.modelo.php";
require_once "modelos/ejes.modelo.php";
require_once "modelos/departamentos.modelo.php";
require_once "modelos/municipios.modelo.php";
require_once "modelos/actividades.modelo.php";
require_once "modelos/tipos.modelo.php";
require_once "modelos/tareas.modelo.php";
require_once "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();

