<?php

require_once "../controladores/donantes.controlador.php";
require_once "../modelos/donantes.modelo.php";

class AjaxDonantes{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $id;

	public function ajaxEditarDonante(){

		$item = "id";
		$valor = $this->id;

		$respuesta = ControladorDonantes::ctrMostrarDonantes($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["id"])){

	$donante = new AjaxDonantes();
	$donante -> id = $_POST["id"];
	$donante -> ajaxEditarDonante();
}
