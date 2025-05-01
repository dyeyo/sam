<?php
require_once __DIR__ . "/../modelos/programa.modelo.php";

class ControladorProgramas {
	static public function ctrMostrarProgramas($item, $valor){
		$tabla = "programas";
		$respuesta = ModeloProgramas::mdlMostrarProgramas($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrMostrarProgram($id){
		$respuesta = ModeloProgramas::mdlMostrarProgamas($id);
		return $respuesta;
	}
}
