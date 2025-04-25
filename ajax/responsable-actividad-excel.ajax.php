<?php
require_once '../modelos/actividades.modelo.php'; 

class ExportResponsableActividadController {
    private $model;

    public function __construct() {
        $this->model = new ModeloActividades();
    }

    public function exportToResponsableVSActividadExcel() {
        if (isset($_GET['responsable_id']) && isset($_GET['ejes_intervienen_id'])) {
            $data = $this->model->mdlAvanceVSResponsable($_GET['responsable_id'],$_GET['ejes_intervienen_id']);
            // Establecer las cabeceras del navegador para forzar la descarga del archivo
            echo "\xEF\xBB\xBF";
    
            header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
            header('Content-Disposition: attachment; filename="responasble-vs-actividades.xls"');

            // Iniciar la salida del archivo Excel
            echo "<html>";
            echo "<head>";
            echo "<style>";
            echo "table { border-collapse: collapse; width: 100%; }";
            echo "th, td { border: 1px solid black; padding: 8px; text-align: left; }";
            echo "th { background-color: #4F81BD; color: white; font-weight: bold; }";
            echo "</style>";
            echo "</head>";
            echo "<body>";

            // Crear la tabla con los encabezados
            echo "<img src='https://seguimientounodc.com/UNODC/sam/ajax/icono.png' width='250' height='100' alt='Logo'> <h2>Responsables vs Tareas </h2>";
            echo "<table>";
            echo "<tr>";
            echo "<th>N Actividad</th>";
            echo "<th>Nombre Actividad</th>";
            echo "<th>Descripcion Tarea</th>";
            echo "<th>Fecha Tarea</th>";
            echo "<th>Porcentaje Tarea</th>";
            echo "<th>Avance Actividad</th>";
            echo "</tr>";

            // Escribir los datos en las filas
            foreach ($data as $item) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($item['actividad_id']) . "</td>";
                echo "<td>" . htmlspecialchars($item['actividad_nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($item['descripcion_avance']) . "</td>";
                echo "<td>" . htmlspecialchars($item['fecha_aporte']) . "</td>";
                echo "<td>" . htmlspecialchars($item['porcentaje_aporte']) . "</td>";
                echo "<td>" . htmlspecialchars($item['avance']) . "</td>";
                echo "</tr>";
            }

            // Cerrar la tabla y la estructura HTML
            echo "</table>";
            echo "</body>";
            echo "</html>";

            exit;
        }
    }
    
}
if (isset($_GET['action']) && $_GET['action'] === 'exportToResponsableVSActividadExcel') {
    $controller = new ExportResponsableActividadController();
    $controller->exportToResponsableVSActividadExcel();
}