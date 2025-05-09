<?php

require_once "conexion.php";

class ModeloEncuesta
{
	static public function mdlGuardarCabecera($datosCabecera)
	{
		$conexion = Conexion::conectar();

		$stmt = $conexion->prepare("INSERT INTO encuesta (
        programa_id, proyecto_id, actividad, responsable_id, departamento_id, municipio_id, archivo
		) VALUES (
			:programa_id, :proyecto_id, :actividad, :responsable_id, :departamento_id, :municipio_id, :archivo
		)");

		$stmt->bindParam(":programa_id", $datosCabecera["programa_id"], PDO::PARAM_INT);
		$stmt->bindParam(":proyecto_id", $datosCabecera["proyecto_id"], PDO::PARAM_INT);
		$stmt->bindParam(":actividad", $datosCabecera["actividad"], PDO::PARAM_STR);
		$stmt->bindParam(":responsable_id", $datosCabecera["responsable_id"], PDO::PARAM_INT);
		$stmt->bindParam(":departamento_id", $datosCabecera["departamento_id"], PDO::PARAM_INT);
		$stmt->bindParam(":municipio_id", $datosCabecera["municipio_id"], PDO::PARAM_INT);
		$stmt->bindParam(":archivo", $datosCabecera["archivo"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return $conexion->lastInsertId(); 
		} else {
			return "error";
		}
	}

	static public function mdlGuardarEncuesta($datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO detalle_encuesta (
        encuesta_id, nombre, tipo_documento, num_documento, fecha, correo, telefono, edad,entidad,
        escolaridad, cargo, sexo, ubicacion, etnia, etnia_otro, discapacidad
		) VALUES (
			:encuesta_id, :nombre, :tipo_documento, :num_documento, :fecha, :correo, :telefono, :edad, :entidad,
			:escolaridad, :cargo, :sexo, :ubicacion, :etnia, :etnia_otro, :discapacidad
		)");

		foreach ($datos as $clave => $valor) {
			$stmt->bindValue(":" . $clave, $valor, PDO::PARAM_STR);
		}

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
	}

	public static function filtrarEncuestas($filtros)
	{
		$db = Conexion::conectar();

		$where = "WHERE 1";
		$params = [];
		if (!empty($filtros['programa'])) {
			$where .= " AND e.programa_id = :programa";
			$params[':programa'] = $filtros['programa'];
		}

		if (!empty($filtros['proyecto'])) {
			$where .= " AND e.proyecto_id = :proyecto";
			$params[':proyecto'] = $filtros['proyecto'];
		}

		if (!empty($filtros['etnia'])) {
			$where .= " AND de.etnia = :etnia";
			$params[':etnia'] = $filtros['etnia'];
		}
		if (!empty($filtros['responsable'])) {
			$where .= " AND e.responsable_id = :responsable";
			$params[':responsable'] = $filtros['responsable'];
		}

		if (!empty($filtros['fecha'])) {
			$where .= " AND e.fecha = :fecha";
			$params[':fecha'] = $filtros['fecha'];
		}

		if (!empty($filtros['sexo'])) {
			$where .= " AND de.sexo = :sexo";
			$params[':sexo'] = $filtros['sexo'];
		}

		if (!empty($filtros['ubicacion'])) {
			$where .= " AND de.ubicacion = :ubicacion";
			$params[':ubicacion'] = $filtros['ubicacion'];
		}

		if (!empty($filtros['edad'])) {
			$where .= " AND de.edad = :edad";
			$params[':edad'] = $filtros['edad'];
		}

		if (!empty($filtros['departamento'])) {
			$where .= " AND e.departamento_id = :departamento";
			$params[':departamento'] = $filtros['departamento'];
		}

		if (!empty($filtros['municipio'])) {
			$where .= " AND e.municipio_id = :municipio";
			$params[':municipio'] = $filtros['municipio'];
		}

		// JOIN con detalle_encuesta
		$sqlData = "SELECT e.*, d.departamento AS nombre_departamento, m.municipio AS nombre_municipio, de.* 
				FROM encuesta e
				JOIN departamentos d ON e.departamento_id = d.id
				JOIN municipios m ON e.municipio_id = m.id
				JOIN detalle_encuesta de ON e.id = de.encuesta_id
				$where";

		$stmtData = $db->prepare($sqlData);
		$stmtData->execute($params);
		$data = $stmtData->fetchAll(PDO::FETCH_ASSOC);

		// Repetir para COUNT
		$sqlCount = "SELECT COUNT(*) as total FROM encuesta e
				 JOIN detalle_encuesta de ON e.id = de.encuesta_id
				 $where";
		$stmtCount = $db->prepare($sqlCount);
		$stmtCount->execute($params);
		$total = $stmtCount->fetchColumn();

		return [
			'data' => $data,
			'total_registros' => $total
		];
	}

}

