<?php

require_once "../controladores/tipos.controlador.php";
require_once "../modelos/tipos.modelo.php";

class AjaxTipos{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $id;

	public function ajaxEditarTipo(){

		$item = "id";
		$valor = $this->id;

		$respuesta = ControladorTipos::ctrMostrarTipos($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["id"])){

	$tipo = new AjaxTipos();
	$tipo -> id = $_POST["id"];
	$tipo -> ajaxEditarTipo();
}
