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
            $datosDetalle = [
                'encuesta_id' => $_POST['encuesta_id'],
                'nombre' => $_POST['nombre'],
                'tipo_documento' => $_POST['tipo_documento'],
                'num_documento' => $_POST['num_documento'],
                'fecha' => $_POST['fecha'],
                'correo' => $_POST['correo'],
                'telefono' => $_POST['telefono'],
                'edad' => $_POST['edad'],
                'escolaridad' => $_POST['escolaridad'],
                'cargo' => $_POST['cargo'],
                'entidad' => $_POST['entidad'],
                'sexo' => $_POST['sexo'],
                'ubicacion' => $_POST['ubicacion'],
                'etnia' => $_POST['etnia'],
                'etnia_otro' => $_POST['etnia_otro'],
                'discapacidad' => $_POST['discapacidad'],
            ];

            $save = ModeloEncuesta::mdlGuardarEncuesta($datosDetalle);

            // Éxito
            echo json_encode(['status' => 'ok', 'msg' => $save]);
        }else{
            http_response_code(500);
            echo json_encode(['status' => 'error', 'msg' => 'Error en el servidor']);
            exit;
        }

    }
}