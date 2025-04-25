<?php

require_once "../controladores/ejes.controlador.php";
require_once "../modelos/ejes.modelo.php";

class AjaxEjes{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $id;

	public function ajaxEditarEje(){

		$item = "id";
		$valor = $this->id;

		$respuesta = ControladorEjes::ctrMostrarEjes($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["id"])){

	$eje = new AjaxEjes();
	$eje -> id = $_POST["id"];
	$eje -> ajaxEditarEje();
}
