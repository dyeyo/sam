<?php
require_once '../modelos/tareas.modelo.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
class ExportController {
    private $model;

    public function __construct() {
        $this->model = new ModeloTareas();
    }

    public function exportToExcel() {


        // Obtener datos desde el modelo
        $data = $this->model->mdlInformeAtrasadas();
        $dataEmail = $this->model->mdlInformeAtrasadasEmail();
        foreach ($dataEmail as $item) {
            $this->sendEmail($item["responsable_correo"],$item["actividades_nombres"]);
        };
        
        echo "\xEF\xBB\xBF";
    
        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename="reporte_atrrasadas.xls"');
    
        // Iniciar la salida del archivo Excel con una declaración específica
        echo "<html xmlns:x=\"urn:schemas-microsoft-com:office:excel\">";
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
        
        echo "<img src='https://seguimientounodc.com/UNODC/sam/ajax/icono.png' width='250' height='100' alt='Logo'> <h2>Informe de avances entregados</h2>";
        echo "<table>";
        echo "<tr>";
        echo "<th>#</th>";
        echo "<th>Actividad Nombre</th>";
        echo "<th>Responsables</th>";
        echo "<th>Fecha Inical</th>";
        echo "<th>Fecha de entrega</th>";
        echo "<th>Dias Restantes</th>";
        echo "<th>Observacion</th>";
        echo "<th>Avance</th>";
        echo "<th>Tarea Porcentaje de Aporte</th>";
        echo "<th>Tarea Descripción de Avance</th>";
        echo "<th>Tarea Fuentes de Verificación</th>";
        echo "</tr>";
    
        // Escribir los datos en las filas
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
            echo "<td>" . htmlspecialchars($item['actividad_nombre']) . "</td>";
            echo "<td>" . htmlspecialchars($item['responsables']) . "</td>";
            echo "<td>" . htmlspecialchars($item['actividad_fecha_inicio']) . "</td>";
            echo "<td>" . htmlspecialchars($item['actividad_fecha_fin']) . "</td>";
            echo "<td>" . $diasRestantes . "</td>";
            echo "<td>" . htmlspecialchars($item['actividad_observacion']) . "</td>";
            echo "<td>" . htmlspecialchars($item['actividad_avance']) . "</td>";
            echo "<td>" . htmlspecialchars($item['tarea_porcentaje_aporte']) . "</td>";
            echo "<td>" . htmlspecialchars($item['tarea_descripcion_avance']) . "</td>";
            echo "<td>" . htmlspecialchars($item['tarea_fuentes_verificacion']) . "</td>";
            echo "</tr>";
        }
    
        // Cerrar la tabla y la estructura HTML
        echo "</table>";
        echo "</body>";
        echo "</html>";
    
        exit;
    }
    
    public function sendEmail($email,$nombre){

		try {
			$emailArray = explode(", ", $email);
			$nombreArray = explode(", ", $nombre);
			foreach ($emailArray as $e) {
        		$mail = new PHPMailer(true);

				$mail->isSMTP();    
                $mail->CharSet = 'UTF-8';                                   
                $mail->Host = 'mail.seguimientounodc.com';                    
				$mail->SMTPAuth = true;                             
				$mail->Username = 'notificaciones@seguimientounodc.com';          
				$mail->Password = 'Colombia2024**';                 
				$mail->Port = 26;                                             

				$mail->setFrom('notificaciones@seguimientounodc.com', 'Notificaciones Plataforma de seguimiento'); 
				$mail->addAddress($e, $e); 

				$mail->isHTML(true);                                 
				$mail->Subject = 'Aviso de tareas vencidas';
				$mail->Body = '<div class="card" style="background: #f9f4f4;padding: 20px;border-radius: 1em;font-family: sans-serif;">
									<div class="card-boy">
										<h4>Hola '. $e . '</h4>
										<p>Por favor '. $e . '  debido al reporte evidenciado en el sistema necesitamos se ponga al d&iacute;a en el avance de su tarea: <strong>'. $nombre .' </strong></p>
										<p>Por favor revisar.</p>
									</div>
								</div>';
				$mail->AltBody = 'Este es el cuerpo del mensaje en texto plano para clientes que no soportan HTML.';

				// Enviar el correo
				$mail->send();
			}
		} catch (Exception $e) {
			echo "Error al enviar el correo: {$mail->ErrorInfo}";
		}
	}
}

// Verificar si se llamó desde el botón del HTML
if (isset($_GET['action']) && $_GET['action'] === 'exportToExcel') {
    $controller = new ExportController();
    $controller->exportToExcel();
}
