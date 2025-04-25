<?php

require_once "../controladores/tareas.controlador.php";
require_once "../modelos/tareas.modelo.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

class AjaxDesaprobarTarea{

	/*=============================================
	EDITAR TAREA
	=============================================*/	

	public $id;

	public function ajaxDesaprobarTarea(){

		$item = "id";
		$valor = $this->id;
		$aporte = $this->aporte;
		$actividad = $this->actividad_id;
		$email = $this->email;
		$name = $this->name;
		$nota = $this->nota;
		$actividad_nombre = $this->actividad_nombre;
		
		$respuesta =  ModeloTareas::mdlUpdateRechazoEstadoTarea($valor,$aporte,$actividad,$nota);
		
		if ($respuesta) {
			$this->sendEmail($email,$name,$nota,$valor,$actividad_nombre);
			echo "<script>
				alert('Tarea rechazada correctamente.');
				window.location.href = '/validacion';
			</script>;";
			
		} else {
			echo "<script>
				alert('Error al actualizar el estado.');
				window.history.back()
			</script>";
		}

	}

	public function sendEmail($email,$name, $nota, $id, $actividad_nombre){


		try {
			$emailArray = explode(", ", $email);
			$nameArray = explode(", ", $name);
			foreach ($emailArray as $e) {
				$mail = new PHPMailer(true);

				$mail->isSMTP();  
				$mail->CharSet = 'UTF-8';                                   
				$mail->Host = 'mail.seguimientounodc.com';                    
				$mail->SMTPAuth = true;                             
				$mail->Username = '_mainaccount@seguimientounodc.com';          
				$mail->Password = 'Colombia2024**';                 
				$mail->Port = 26;                                   

				$mail->setFrom('notificaciones@seguimientounodc.com', 'Notificaciones Plataforma de seguimiento'); 
				$mail->addAddress($e, $e); 

				$mail->isHTML(true);                                 
				$mail->Subject = 'Aviso de tarea rechazada';
				$mail->Body = '<div class="card" style="background: #f9f4f4;padding: 20px;border-radius: 1em;font-family: sans-serif;">
									<div class="card-boy">
										<h4>Hola '. $e . '</h4>
										<p>El revisor del sistema regreso tu tarea: <strong>'. $actividad_nombre. ' </strong>, debido a las siguientes observaciones:  <strong>'. $nota . '</strong> </p>
										<p>Por favor revisar.</p>
									</div>
								</div>';
				$mail->AltBody = 'Este es el cuerpo del mensaje en texto plano para clientes que no soportan HTML.';

				$mail->send();
			}
		} catch (Exception $e) {
			echo "Error al enviar el correo: {$mail->ErrorInfo}";
		}
	}
}

/*=============================================
EDITAR TAREA
=============================================*/	
if(isset($_POST["id"])){
	$tarea = new AjaxDesaprobarTarea();
	$tarea->id = $_POST["id"];
	$tarea->aporte = $_POST["aporte"];
	$tarea->actividad_id = $_POST["actividad_id"];
	$tarea->email = $_POST["email"];
	$tarea->name = $_POST["name"];
	$tarea->nota = $_POST["nota"];
	$tarea->actividad_nombre = $_POST["actividad_nombre"];
	$tarea->ajaxDesaprobarTarea();
}

