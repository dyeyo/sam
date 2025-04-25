<?php
require_once '../modelos/tareas.modelo.php'; // Ajusta la ruta según tu estructura.

class ExportController {
    private $model;

    public function __construct() {
        $this->model = new ModeloTareas();
    }

    public function exportToExcel() {
        $data = $this->model->mdlInformeEntregados();
    
        echo "\xEF\xBB\xBF";
    
        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="actividades_y_tareas.xls"');
    
        echo "<html>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<style>";
        echo "table { border-collapse: collapse; width: 100%; }";
        echo "th, td { border: 1px solid black; padding: 8px; text-align: left; }";
        echo "th { background-color: #4F81BD; color: white; font-weight: bold; }";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<img src='https://seguimientounodc.com/UNODC/sam/ajax/icono.png' width='250' height='100' alt='Logo'> <h2>Informe de avances entregados</h2>";
        echo "<table>";
        echo "<tr>";
        echo "<th>#</th>";
        echo "<th>Actividad Nombre</th>";
        echo "<th>Responsables</th>";
        echo "<th>Fecha Inicio</th>";
        echo "<th>Fecha de entrega</th>";
        echo "<th>Dias Restantes</th>";
        echo "<th>Observacion</th>";
        echo "<th>Avance</th>";
        echo "<th>Tarea Porcentaje de Aporte</th>";
        echo "<th>Tarea Descripción de Avance</th>";
        echo "<th>Tarea Fuentes de Verificación</th>";
        echo "</tr>";
    
        foreach ($data as $item) {
            $fechaInicio = new DateTime($item["actividad_fecha_inicio"]);
            $fechaFin = new DateTime($item["actividad_fecha_fin"]);
            $hoy = new DateTime(); 
    
            if ($hoy < $fechaFin) {
                $diasRestantes = $hoy->diff($fechaFin)->days +1; 
            } else {
                $diasRestantes = 0; 
            }
            echo "<tr>";
            echo "<td>" . htmlspecialchars($item['actividad_id']) . "</td>";
            echo "<td>" . htmlspecialchars($item['actividad_nombre'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($item['responsables'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($item['actividad_fecha_inicio'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($item['actividad_fecha_fin'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . $diasRestantes . "</td>";
            echo "<td>" . htmlspecialchars($item['actividad_observacion'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($item['actividad_avance'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($item['tarea_porcentaje_aporte'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($item['tarea_descripcion_avance'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($item['tarea_fuentes_verificacion'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "</tr>";
        }
    
        echo "</table>";
        echo "</body>";
        echo "</html>";
    
        exit;
    }
    
    
}

// Verificar si se llamó desde el botón del HTML
if (isset($_GET['action']) && $_GET['action'] === 'exportToExcel') {
    $controller = new ExportController();
    $controller->exportToExcel();
}
