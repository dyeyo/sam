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

		$sql = "SELECT etnia, sexo, edad, departamento_id, municipio_id, COUNT(*) as total
				FROM encuestas e
				JOIN departamentos d ON e.departamento_id = d.id
        		JOIN municipios m ON e.municipio_id = m.id
				WHERE 1";

		$params = [];

		if (!empty($filtros['etnia'])) {
			$sql .= " AND etnia = :etnia";
			$params[':etnia'] = $filtros['etnia'];
		}

		if (!empty($filtros['sexo'])) {
			$sql .= " AND sexo = :sexo";
			$params[':sexo'] = $filtros['sexo'];
		}

		if (!empty($filtros['edad'])) {
			$sql .= " AND edad = :edad";
			$params[':edad'] = $filtros['edad'];
		}


		if (!empty($filtros['departamento'])) {
			$sql .= " AND departamento_id = :departamento";
			$params[':departamento'] = $filtros['departamento'];
		}

		if (!empty($filtros['municipio'])) {
			$sql .= " AND municipio_id = :municipio";
			$params[':municipio'] = $filtros['municipio'];
		}

		$sql .= " GROUP BY etnia, sexo, edad, departamento_id, municipio_id, d.nombre, m.nombre";

		$stmt = $db->prepare($sql);
		$stmt->execute($params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

