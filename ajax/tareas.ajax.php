<?php

require_once "../controladores/tareas.controlador.php";
require_once "../modelos/tareas.modelo.php";

class AjaxTarea{

	/*=============================================
	EDITAR TAREA
	=============================================*/	

	public $id;

	public function ajaxEditarTarea(){

		$item = "id";
		$valor = $this->id;

		$respuesta = TareasController::ctrDetalleTarea($valor);

		echo json_encode($respuesta[0]);

	}
}

/*=============================================
EDITAR TAREA
=============================================*/	
if(isset($_POST["id"])){
	$eje = new AjaxTarea();
	$eje -> id = $_POST["id"];
	$eje -> ajaxEditarTarea();
}
