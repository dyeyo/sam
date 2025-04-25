<?php
require_once "../modelos/actividades.modelo.php";

if (isset($_GET['id_eje'])) {
    $actividades = ModeloActividades::mdlNivelAvance($_GET['id_eje']);
    $resultado = [
        'atrasadas' => $actividades[0]["atrasadas"],
        'en_proceso' => $actividades[0]["en_proceso"],
        'terminadas' => $actividades[0]["terminadas"],
        'porcentaje_atrasadas' => $actividades[0]["porcentaje_atrasadas"],
        'porcentaje_en_proceso' => $actividades[0]["porcentaje_en_proceso"],
        'porcentaje_terminadas' => $actividades[0]["porcentaje_terminadas"],
    ];
    header('Content-Type: application/json');
    echo json_encode($resultado);
} else {
    header('Content-Type: application/json');
    echo json_encode([
        'error' => 'El parámetro id es obligatorio y no puede estar vacío.'
    ]);
}
