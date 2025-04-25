<?php

require_once "conexion.php";

class ModeloActividades{

			/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasActividades($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	 


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}



	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarActividad($tabla, $datos){
		$conexion = Conexion::conectar();
    
		$conexion->beginTransaction();

		$sqlInsertarActividad = "INSERT INTO actividades(
					actividad, nombre, cantidad, avance, id_tipos, aporte,
					fecha_inicio, fecha_fin, mes, anio, id_donante, id_departamento,
					id_municipio, id_eje, observacion, fecha
			) VALUES (:actividad, :nombre, :cantidad, :avance, :id_tipos, :aporte,
					:fecha_inicio, :fecha_fin, :mes, :anio, :id_donante, :id_departamento, :id_municipio,
					:id_eje, :observacion, :fecha)";

		$stmt = $conexion->prepare($sqlInsertarActividad);

		$stmt->bindParam(":actividad",$datos["actividad"]);
		$stmt->bindParam(":nombre",$datos["nombre"]);
		$stmt->bindParam(":cantidad",$datos["cantidad"]);
		$stmt->bindParam(":avance", $datos["avance"]);
		$stmt->bindParam(":aporte", $datos["aporte"]);
		$stmt->bindParam(":id_tipos", $datos["id_tipos"]);
		$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"]);
		$stmt->bindParam(":fecha_fin", $datos["fecha_fin"]);
		$stmt->bindParam(":mes", $datos["mes"]);
		$stmt->bindParam(":anio", $datos["anio"]);
		$stmt->bindParam(":id_donante", $datos["id_donante"]);
		$stmt->bindParam(":id_departamento", $datos["id_departamento"]);
		$stmt->bindParam(":id_municipio", $datos["id_municipio"]);
		$stmt->bindParam(":id_eje", $datos["id_eje"]);
		$stmt->bindParam(":observacion", $datos["observacion"]);
		$stmt->bindParam(":fecha", $datos["fecha"]);

		if (!$stmt->execute()) {
			$conexion->rollBack();
			return "error al insertar actividad";
		}

		$conexion->commit();
		return "ok";

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarActividades($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM actividades WHERE id = $valor");
			$stmt->execute();
			return  $stmt->fetchAll(PDO::FETCH_ASSOC);
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return$stmt->fetchAll();
		}
		$stmt->close();
		$stmt = null;
	}

	
	static public function mdlEditarActividad($tabla, $datos) {
		try {
			// Preparar la consulta de actualización
			$stmt = Conexion::conectar()->prepare("
				UPDATE $tabla SET
					actividad = :actividad,
					nombre = :nombre,
					cantidad = :cantidad,
					aporte = :aporte,
					avance = :avance,
					id_tipos = :id_tipos,
					fecha_inicio = :fecha_inicio,
					fecha_fin = :fecha_fin,
					mes = :mes,
					anio = :anio,
					id_donante = :id_donante,
					id_departamento = :id_departamento,
					id_municipio = :id_municipio,
					id_eje = :id_eje,
					observacion = :observacion,
					fecha = :fecha
				WHERE id = :id");
	
			// Vinculación de parámetros
			$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
			$stmt->bindParam(":actividad", $datos["actividad"]);
			$stmt->bindParam(":nombre", $datos["nombre"]);
			$stmt->bindParam(":cantidad", $datos["cantidad"]);
			$stmt->bindParam(":aporte", $datos["aporte"]);
			$stmt->bindParam(":avance", $datos["avance"]);
			$stmt->bindParam(":id_tipos", $datos["id_tipos"]);
			$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"]);
			$stmt->bindParam(":fecha_fin", $datos["fecha_fin"]);
			$stmt->bindParam(":mes", $datos["mes"]);
			$stmt->bindParam(":anio", $datos["anio"]);
			$stmt->bindParam(":id_donante", $datos["id_donante"]);
			$stmt->bindParam(":id_departamento", $datos["id_departamento"]);
			$stmt->bindParam(":id_municipio", $datos["id_municipio"]);
			$stmt->bindParam(":id_eje", $datos["id_eje"]);
			$stmt->bindParam(":observacion", $datos["observacion"]);
			$stmt->bindParam(":fecha", $datos["fecha"]);
	
			// Ejecutar la consulta
			if ($stmt->execute()) {
				return "ok";
			} else {
				return "error";
			}
		} catch (Exception $e) {
			// Retornar un mensaje de error detallado para fines de depuración
			return "error: " . $e->getMessage();
		} finally {
			// Cerrar la conexión
			$stmt = null;
		}
	}
	

static public function mdlSumaTotalActividades($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(id) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}
	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlBorrarActividad($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlNivelAvance($id){
		$amarillo = Conexion::conectar()->prepare("SELECT
						COUNT(CASE WHEN avance <= 30 THEN 1 END) AS atrasadas,
						COUNT(CASE WHEN avance > 30 AND avance < 100 THEN 1 END) AS en_proceso,
						COUNT(CASE WHEN avance = 100 THEN 1 END) AS terminadas,
						COUNT(*) AS total_actividades,
						(COUNT(CASE WHEN avance <= 30 THEN 1 END) * 100.0) / COUNT(*) AS porcentaje_atrasadas,
						(COUNT(CASE WHEN avance > 30 AND avance < 100 THEN 1 END) * 100.0) / COUNT(*) AS porcentaje_en_proceso,
						(COUNT(CASE WHEN avance = 100 THEN 1 END) * 100.0) / COUNT(*) AS porcentaje_terminadas
					FROM actividades
					WHERE id_eje = $id;");
		$amarillo->execute();
		return  $amarillo->fetchAll(PDO::FETCH_ASSOC);
	}

	static public function mdlAvanceVSResponsable($responsable_id, $ejes_intervienen_id){
		$avance = Conexion::conectar()->prepare(" SELECT 
				actividades.id AS actividad_id,
				actividades.nombre AS actividad_nombre,
				actividades.avance,
				tareas.id AS tarea_id,
				tareas.descripcion_avance,
				tareas.fecha_aporte,
				tareas.porcentaje_aporte
			FROM actividades
			INNER JOIN tareas ON actividades.id = tareas.actividad_id
			WHERE 
  				JSON_CONTAINS(JSON_UNQUOTE(tareas.persona_apoyan_id), '\"$responsable_id\"', '$') = 1
    			AND JSON_CONTAINS(JSON_UNQUOTE(tareas.ejes_intervienen_id), '\"$ejes_intervienen_id\"', '$') = 1;");
		$avance->execute();
		return  $avance->fetchAll(PDO::FETCH_ASSOC);
	}
}

