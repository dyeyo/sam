<?php
require_once '../modelos/actividades.modelo.php'; 

class ExportLevelAvanceController {
    private $model;

    public function __construct() {
        $this->model = new ModeloActividades();
    }

    public function exportToLevelAvanceExcel() {
        // Obtener datos desde el modelo
        if (isset($_GET['id_eje'])) {

            $data = $this->model->mdlNivelAvance($_GET['id_eje']);

            // Establecer las cabeceras del navegador para forzar la descarga del archivo
            echo "\xEF\xBB\xBF";
    
            header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
            header('Content-Disposition: attachment; filename="reporte-por-avance.xls"');

            // Iniciar la salida del archivo Excel
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

            // Crear la tabla con los encabezados
            echo "<img src='https://seguimientounodc.com/UNODC/sam/ajax/icono.png' width='250' height='100' alt='Logo'> <h2>Niveles de avance</h2> ";
            echo "<table>";
            echo "<tr>";
            echo "<th>Total Terminadas</th>";
            echo "<th>Total En proceso</th>";
            echo "<th>Total Atrasadas</th>";
            echo "<th>Porcentaje Terminadas</th>";
            echo "<th>Porcentaje En proceso</th>";
            echo "<th>Porcentaje Atradasas</th>";
            echo "</tr>";

            // Escribir los datos en las filas
            foreach ($data as $item) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($item['terminadas']) . "</td>";
                echo "<td>" . htmlspecialchars($item['en_proceso']) . "</td>";
                echo "<td>" . htmlspecialchars($item['atrasadas']) . "</td>";
                echo "<td>" . htmlspecialchars($item['porcentaje_terminadas']) . "</td>";
                echo "<td>" . htmlspecialchars($item['porcentaje_en_proceso']) . "</td>";
                echo "<td>" . htmlspecialchars($item['porcentaje_atrasadas']) . "</td>";
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
if (isset($_GET['action']) && $_GET['action'] === 'exportToLevelAvanceExcel') {
    $controller = new ExportLevelAvanceController();
    $controller->exportToLevelAvanceExcel();
}