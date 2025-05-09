<?php
require_once __DIR__ . "/../modelos/programa.modelo.php";

class ControladorProgramas {
	static public function ctrMostrarProgramas($item, $valor){
		$tabla = "programas";
		$respuesta = ModeloProgramas::mdlMostrarProgramas($tabla, $item, $valor);
		return $respuesta;
	}
	static public function ctrMostrarAllProgramas($item, $valor){
		$tabla = "programas";
		$respuesta = ModeloProgramas::mdlMostrarAllProgramas($tabla, $item, $valor);
		return $respuesta;
	}
}
