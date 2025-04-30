<?php
require_once __DIR__ . "/../modelos/encuesta.modelo.php";
$respuesta = ControladorActividades::ctrCrearEncuesta();

if ($respuesta == "ok") {
    echo "
    <script>
        alert('Guardar con éxito.');
        window.history.go(-2);
        setTimeout(() => location.reload(), 500);
    </script>";
} else {
    echo "
    <script>
        alert('Error al guardar la encuesta, por favor intente nuevamente.');
    </script>";
}
class ControladorActividades
{
    static public function ctrCrearEncuesta()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Subida del archivo
            $ruta = null;
            if (!empty($_FILES['archivo']['name'])) {
                $archivoNombre = basename($_FILES['archivo']['name']);
                $ruta = 'uploads/' . $archivoNombre;
                move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta);
            }

            // Cabecera
            $datosCabecera = [
                'programa_id' => $_POST['programa'],
                'proyecto_id' => $_POST['proyecto'],
                'actividad' => $_POST['actividad'],
                'responsable_id' => $_POST['responsable'],
                'departamento_id' => $_POST['departamento'],
                'municipio_id' => $_POST['municipio'],
                'archivo' => $ruta
            ];

            $idEncuesta = ModeloEncuesta::mdlGuardarCabecera($datosCabecera);

            if (!$idEncuesta) {
                http_response_code(500);
                echo json_encode(['status' => 'error', 'msg' => 'Error al guardar cabecera']);
                exit;
            }

            foreach ($_POST['nombre'] as $i => $nombre) {
                $detalle = [
                    'encuesta_id' => $idEncuesta,
                    'nombre' => $nombre,
                    'tipo_documento' => $_POST['tipo_documento'][$i],
                    'num_documento' => $_POST['num_documento'][$i],
                    'fecha' => $_POST['fecha'][$i],
                    'correo' => $_POST['correo'][$i],
                    'telefono' => $_POST['telefono'][$i],
                    'edad' => $_POST['edad'][$i],
                    'escolaridad' => $_POST['escolaridad'][$i],
                    'cargo' => $_POST['cargo'][$i],
                    'entidad' => $_POST['entidad'][$i],
                    'sexo' => $_POST['sexo'][$i],
                    'ubicacion' => $_POST['ubicacion'][$i],
                    'etnia' => $_POST['etnia'][$i],
                    'etnia_otro' => $_POST['etnia_otro'][$i] ?? '',
                    'discapacidad' => $_POST['discapacidad'][$i] ?? ''
                ];

                $respuesta = ModeloEncuesta::mdlGuardarEncuesta($detalle);

                if ($respuesta !== 'ok') {
                    http_response_code(500);
                    echo json_encode(['status' => 'error', 'msg' => 'Error al guardar detalle']);
                    exit;
                }
            }

            // Éxito
            echo json_encode(['status' => 'ok', 'msg' => 'Encuesta guardada']);
        }

    }
}