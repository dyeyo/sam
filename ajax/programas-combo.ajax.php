<?php

require_once "../controladores/programas.controlador.php";
require_once "../modelos/programa.modelo.php";

class AjaxProgramas{

	public $id;

	public function ajaxProgramas(){
		$item = "id";
		$valor = $this->id;
		$respuesta = ModeloProgramas::mdlMostrarProgamas($valor);
		echo json_encode($respuesta);
	}
}

if(isset($_GET["id"])){
	$municipio = new AjaxProgramas();
	$municipio->id = $_GET["id"];
	$municipio->ajaxProgramas();
}
