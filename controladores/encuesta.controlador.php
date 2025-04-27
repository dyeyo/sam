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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Guardar archivo
            $archivo = $_FILES["archivo"]["name"];
            $ruta = "uploads/" . basename($archivo);
            move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);

            $datos = array(
                "nombre" => $_POST["nombre"],
                "programa_id" => $_POST["programa"],
                "proyecto_id" => $_POST["proyecto"],
                "actividad" => $_POST["actividad"],
                "responsable_id" => $_POST["responsable"],
                "tipo_documento" => $_POST["tipo_documento"],
                "num_documento" => $_POST["num_documento"],
                "departamento_id" => $_POST["departamento"],
                "municipio_id" => $_POST["municipio"],
                "fecha" => $_POST["fecha"],
                "correo" => $_POST["correo"],
                "telefono" => $_POST["telefono"],
                "edad" => $_POST["edad"],
                "escolaridad" => $_POST["escolaridad"],
                "cargo" => $_POST["cargo"],
                "sexo" => $_POST["sexo"],
                "ubicacion" => $_POST["ubicacion"],
                "etnia" => $_POST["etnia"],
                "etnia_otro" => $_POST["etnia_otro"] ?? null,
                "archivo" => $ruta,
                "discapacidad" => isset($_POST["discapacidad"]) && $_POST["discapacidad"] == "on" ? "Si" : "No"
            );

            $respuesta = ModeloEncuesta::mdlGuardarEncuesta($datos);
            return $respuesta;
        }
    }

}