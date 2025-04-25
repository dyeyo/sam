<?php

require_once "../controladores/tareas.controlador.php";
require_once "../modelos/tareas.modelo.php";

class AjaxAprobarTarea{

	/*=============================================
	EDITAR TAREA
	=============================================*/	

	public $id;

	public function ajaxAprobarTarea() {
		$item = "id";
		$valor = $this->id;
		$aporte = $this->aporte;
		$actividad = $this->actividad_id;
	
	
		$respuesta = ModeloTareas::mdlUpdateEstadoTarea($valor, $aporte,$actividad);
		if ($respuesta === "ok") {
			echo "<script>
				alert('Estado actualizado con éxito.');
				window.history.back();
				location.reload();
			</script>";
		} else {
			echo "<script>
				alert('Error al actualizar el estado: " . $respuesta . "');
				window.history.back();
			</script>";
		}
	}
}

/*=============================================
EDITAR TAREA
=============================================*/	
if(isset($_POST["id"])){
	$tarea = new AjaxAprobarTarea();
	$tarea->id = $_POST["id"];
	$tarea->aporte = $_POST["aporte"];
	$tarea->actividad_id = $_POST["actividad_id"];
	$tarea->ajaxAprobarTarea();
}