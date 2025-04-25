<?php
require_once "tareas.controlador.php";
require_once "../modelos/tareas.modelo.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Manejo de archivos subidos
    $rutaBase = "uploads/"; // Carpeta para guardar archivos
    $archivos = ["archivo_1", "archivo_2", "archivo_3"];
    $urlsArchivos = [];

    // Crear carpeta si no existe
    if (!is_dir($rutaBase)) {
        mkdir($rutaBase, 0755, true);
    }

    // Procesar archivos
    foreach ($archivos as $archivo) {
        if (isset($_FILES[$archivo]) && $_FILES[$archivo]["error"] === UPLOAD_ERR_OK) {
            $nombreArchivo = uniqid() . "_" . basename($_FILES[$archivo]["name"]);
            $rutaDestino = $rutaBase . $nombreArchivo;

            if (move_uploaded_file($_FILES[$archivo]["tmp_name"], $rutaDestino)) {
                $urlsArchivos[$archivo] = $rutaDestino; // Ruta guardada
            } else {
                $urlsArchivos[$archivo] = null; // Si no se movió correctamente
            }
        } else {
            $urlsArchivos[$archivo] = null;
        }
    }

    // Convertir valores múltiples de los select a JSON
    $personaApoyanId = isset($_POST["persona_apoyan_id"]) ? json_encode($_POST["persona_apoyan_id"]) : json_encode([]);
    $ejesIntervienenId = isset($_POST["ejes_intervienen_id"]) ? json_encode($_POST["ejes_intervienen_id"]) : json_encode([]);

    $datos = [
        "actividad_id" => $_POST["actividad_id"],
        "persona_apoyan_id" => $personaApoyanId, // Guardar como JSON
        "ejes_intervienen_id" => $ejesIntervienenId, // Guardar como JSON
        "archivo_1" => $urlsArchivos["archivo_1"],
        "archivo_2" => $urlsArchivos["archivo_2"],
        "archivo_3" => $urlsArchivos["archivo_3"],
        "porcentaje_aporte" => $_POST["porcentaje_aporte"],
        "fecha_aporte" => $_POST["fecha_aporte"],
        "descripcion_avance" => $_POST["descripcion_avance"],
        "fuentes_verificacion" => $_POST["fuentes_verificacion"]
    ];

    // Guardar los datos usando el modelo
    $respuesta = ModeloTareas::mdlCrearTarea($datos);

    if ($respuesta == "ok") {
        echo '<script>
        alert("Tarea guardada y avance actualizado correctamente.");
        window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
        </script>';
        exit;
    } else {
        echo "Error al guardar la tarea: " . $respuesta;
    }
}

