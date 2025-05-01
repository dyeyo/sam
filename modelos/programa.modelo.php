<?php

require_once "conexion.php";

class ModeloProgramas
{
	static public function mdlMostrarProgramas($tabla, $item, $valor)
	{
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where id = $item");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlMostrarProgamas($id)
	{
		if ($id != '0') {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM programas WHERE user_id = :id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM programas");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

	}
}

