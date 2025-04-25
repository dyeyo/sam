<?php
class TareasController{

	/*=============================================
	MOSTRAR TAREAS
	=============================================*/

	static public function ctrMostrarTareas(){

		$respuesta = ModeloTareas::mdlMostrarTareas();
		return $respuesta;
	
	}

	static public function ctrMostrarTareasPendientes(){
		$respuesta = ModeloTareas::mdlMostrarTareasPendientes();
		return $respuesta;
	}

	/*=============================================
	MOSTRAR DETALLE
	=============================================*/

	static public function ctrDetalleTarea($id){
		$respuesta = ModeloTareas::mdlDetalleTareas($id);
		return $respuesta;
	}

	// /*=============================================
	// CREAR TAREAS
	// =============================================*/
	static public function ctrCrearTarea($datos) {
        return ModeloTareas::mdlCrearTarea($datos);
    }

	static public function ctrTareasRojo() {
		return ModeloTareas::mdlTareasRojo();
    }

	static public function ctrTareasAmarillo() {
		return ModeloTareas::mdlTareasAmarillo();
    }

	static public function ctrTareasVerde() {
		return ModeloTareas::mdlTareasVerde();
    }

}
