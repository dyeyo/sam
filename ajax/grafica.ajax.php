<?php
require_once "../controladores/tareas.controlador.php";
require_once "../modelos/tareas.modelo.php";

if (isset($_GET['categoria'])) {
    $rojo = ModeloTareas::mdlTareasRojo($_GET['categoria']);
    $amarillo = ModeloTareas::mdlTareasAmarillo($_GET['categoria']);
    $verde = ModeloTareas::mdlTareasVerde($_GET['categoria']);
    $year = ModeloTareas::mdlTareasRojo($_GET['categoria']);
    $rojoValue = isset($rojo[0]['SUM(CASE WHEN avance < 30 THEN 1 ELSE 0 END)']) ? $rojo[0]['SUM(CASE WHEN avance < 30 THEN 1 ELSE 0 END)'] : 0;
    $amarilloValue = $amarillo[0]['SUM(CASE WHEN avance BETWEEN 31 AND 99 THEN 1 ELSE 0 END)'];
    $verdeValue = isset($verde[0]['SUM(CASE WHEN avance = 100 THEN 1 ELSE 0 END)']) ? $verde[0]['SUM(CASE WHEN avance = 100 THEN 1 ELSE 0 END)'] : 0;

    $datos = [
        'labels' => ['Incompletos', 'En proceso', 'Terminados'],
        'values' => [$rojoValue, $amarilloValue, $verdeValue],
        'anio' => $year
    ];

    // Enviar datos como JSON
    header('Content-Type: application/json');
    echo json_encode($datos);
} else {
    // Respuesta de error si no se recibe un id válido
    header('Content-Type: application/json');
    echo json_encode([
        'error' => 'El parámetro id es obligatorio y no puede estar vacío.'
    ]);
}
