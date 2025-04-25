<?php

require_once "../controladores/departamentos.controlador.php";
require_once "../modelos/departamentos.modelo.php";

class AjaxDepartamentos{

	/*=============================================
	EDITAR DEPTOS
	=============================================*/	

	public $id;

	public function ajaxEditarDepartamento(){

		$item = "id";
		$valor = $this->id;

		$respuesta = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR DEPTO
=============================================*/	
if(isset($_POST["id"])){

	$departamento = new AjaxDepartamentos();
	$departamento -> id = $_POST["id"];
	$departamento -> ajaxEditarDepartamento();
}
