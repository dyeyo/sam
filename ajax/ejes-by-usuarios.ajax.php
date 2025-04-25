<?php

require_once "../controladores/ejes.controlador.php";
require_once "../modelos/ejes.modelo.php";

class AjaxEjesUser{

	public $id;

	public function ajaxGetEjes(){
		$item = "id";
		$valor = $this->id;
		$respuesta = ModeloEjes::mdlGetEjes($valor);
		echo json_encode($respuesta);
	}
}

if(isset($_GET["id"])){
	$municipio = new AjaxEjesUser();
	$municipio->id = $_GET["id"];
	$municipio->ajaxGetEjes();
}
