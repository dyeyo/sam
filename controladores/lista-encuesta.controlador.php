<?php
require_once __DIR__ . "/../modelos/encuesta.modelo.php";
$filtros = ControladorActividades::ctrFiltarEncuesta();


class ControladorActividades
{
    static public function ctrFiltarEncuesta()
    {
        $filtros = [
            'programa' => $_POST['programa'] ?? '',
            'proyecto' => $_POST['proyecto'] ?? '',
            'etnia' => $_POST['etnia'] ?? '',
            'sexo' => $_POST['sexo'] ?? '',
            'edad' => $_POST['edad'] ?? '',
            'ubicacion' => $_POST['ubicacion'] ?? '',
            'responsable' => $_POST['responsable'] ?? '',
            'fecha' => $_POST['fecha'] ?? '',
            'departamento' => isset($_POST['departamento']) ? intval($_POST['departamento']) : 0,
            'municipio' => isset($_POST['municipio']) ? intval($_POST['municipio']) : 0
        ];
        $resultados = ModeloEncuesta::filtrarEncuestas($filtros);
        echo json_encode($resultados);

    }

}