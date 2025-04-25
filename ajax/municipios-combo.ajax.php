<?php

require_once "../controladores/municipios.controlador.php";
require_once "../modelos/municipios.modelo.php";

class AjaxMunicipios{

	public $id;

	public function ajaxEditarMunicipio(){
		$item = "id";
		$valor = $this->id;
		$respuesta = ControladorMunicipios::ctrMostrarMunicipios($valor);
		echo json_encode($respuesta);
	}
}

if(isset($_GET["id"])){
	$municipio = new AjaxMunicipios();
	$municipio->id = $_GET["id"];
	$municipio->ajaxEditarMunicipio();
}
