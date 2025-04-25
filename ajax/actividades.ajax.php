<?php

require_once "../controladores/actividades.controlador.php";
require_once "../modelos/actividades.modelo.php";

class AjaxActividades{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $id;

	public function ajaxEditarActivid(){

		$item = "id";
		$valor = $this->id;

		$respuesta = ControladorActividades::ctrMostrarActividades($item, $valor);

		echo json_encode($respuesta[0]);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["id"])){

	$actividad = new AjaxActividades();
	$actividad -> id = $_POST["id"];
	$actividad -> ajaxEditarActivid();

}
