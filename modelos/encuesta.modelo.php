<?php

require_once "conexion.php";

class ModeloEncuesta
{
	static public function mdlGuardarEncuesta($datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO encuestas (programa_id, proyecto_id, actividad, responsable_id, tipo_documento, num_documento, departamento_id, municipio_id, fecha, correo, telefono, edad, escolaridad, cargo, sexo, ubicacion, etnia, etnia_otro, archivo, discapacidad) VALUES (:programa_id, :proyecto_id, :actividad, :responsable_id, :tipo_documento, :num_documento, :departamento_id, :municipio_id, :fecha, :correo, :telefono, :edad, :escolaridad, :cargo, :sexo, :ubicacion, :etnia, :etnia_otro, :archivo, :discapacidad)");

		foreach ($datos as $clave => $valor) {
			$stmt->bindParam(":" . $clave, $datos[$clave], PDO::PARAM_STR);
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
		if ($filtros) {
			if (!empty($filtros['etnia'])) {
				$where .= " AND etnia = :etnia";
				$params[':etnia'] = $filtros['etnia'];
			}

			if (!empty($filtros['sexo'])) {
				$where .= " AND sexo = :sexo";
				$params[':sexo'] = $filtros['sexo'];
			}

			if (!empty($filtros['edad'])) {
				$where .= " AND edad = :edad";
				$params[':edad'] = $filtros['edad'];
			}

			if (!empty($filtros['departamento'])) {
				$where .= " AND departamento_id = :departamento";
				$params[':departamento'] = $filtros['departamento'];
			}

			if (!empty($filtros['municipio'])) {
				$where .= " AND municipio_id = :municipio";
				$params[':municipio'] = $filtros['municipio'];
			}

			// Consulta para obtener los datos filtrados (sin agrupación)
			$sqlData = "SELECT * FROM encuestas e
						JOIN departamentos d ON e.departamento_id = d.id
						JOIN municipios m ON e.municipio_id = m.id
						$where";

			$stmtData = $db->prepare($sqlData);
			$stmtData->execute($params);
			$data = $stmtData->fetchAll(PDO::FETCH_ASSOC);

			// Consulta para obtener el total de registros
			$sqlCount = "SELECT COUNT(*) as total FROM encuestas e $where";
			$stmtCount = $db->prepare($sqlCount);
			$stmtCount->execute($params);
			$total = $stmtCount->fetchColumn();
		} else {
			$sqlData = "SELECT * FROM encuestas e
			JOIN departamentos d ON e.departamento_id = d.id
			JOIN municipios m ON e.municipio_id = m.id";

			$stmtData = $db->prepare($sqlData);
			$stmtData->execute($params);
			$data = $stmtData->fetchAll(PDO::FETCH_ASSOC);

			// Consulta para obtener el total de registros
			$sqlCount = "SELECT COUNT(*) as total FROM encuestas e $where";
			$stmtCount = $db->prepare($sqlCount);
			$stmtCount->execute($params);
			$total = $stmtCount->fetchColumn();
		}


		return [
			'data' => $data,
			'total_registros' => $total
		];
	}


}

