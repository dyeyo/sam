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
            header('Content-Type: application/json');
            echo json_encode($idEncuesta); // Solo esto
            exit;
        }else{
            http_response_code(500);
            echo json_encode(['status' => 'error', 'msg' => 'Error en el servidor']);
            exit;
        }

    }
}