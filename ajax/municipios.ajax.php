<?php

require_once "../controladores/municipios.controlador.php";
require_once "../modelos/municipios.modelo.php";

class AjaxMunicipios{

	public $id;

	public function ajaxEditarMunicipio(){
		$item = "id";
		$valor = $this->id;
		$respuesta = ControladorMunicipios::ctrMostrarMunicipiosEditar($valor);
		echo json_encode($respuesta);
	}
}
if(isset($_POST["id"])){
	$municipio = new AjaxMunicipios();
	$municipio->id = $_POST["id"];
	$municipio->ajaxEditarMunicipio();
}
