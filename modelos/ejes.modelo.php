<?php

require_once "conexion.php";

class ModeloEjes{

	/*=============================================
	CREAR CATEGORIA
	=============================================*/

	static public function mdlIngresarEje($tabla, $datos){
		$conexion = Conexion::conectar();
    
		$conexion->beginTransaction();

		$sqlInsertarEje = "INSERT INTO ejes (eje, usuarios) VALUES (:eje, :usuarios)";
		$stmtInsertar = $conexion->prepare($sqlInsertarEje);

		$stmtInsertar->bindParam(":eje", $datos["eje"], PDO::PARAM_STR);
		$stmtInsertar->bindParam(":usuarios", $datos["usuarios"], PDO::PARAM_STR); 

		if (!$stmtInsertar->execute()) {
			$conexion->rollBack();
			return "error al insertar tarea";
		}

		$conexion->commit();
		return "ok";
	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function mdlMostrarEjes($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarEje($datos){

		$conexion = Conexion::conectar();
		$conexion->beginTransaction();
	
		$sqlActualizarEje = "UPDATE ejes SET eje = :eje, usuarios = :usuarios WHERE id = :id";
		$stmtActualizar = $conexion->prepare($sqlActualizarEje);

		$stmtActualizar->bindParam(":eje", $datos["eje"], PDO::PARAM_STR);
		$stmtActualizar->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmtActualizar->bindParam(":usuarios", $datos["usuarios"], PDO::PARAM_STR);
		if (!$stmtActualizar->execute()) {
			$conexion->rollBack();
			return "error al actualizar eje";
		}
	
		$conexion->commit();
		return "ok";
	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlBorrarEje($tabla, $datos){

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

	static public function mdlGetEjes($id){
		$idStr = '"'.$id.'"';
		$stmt = Conexion::conectar()->prepare("SELECT * FROM ejes WHERE JSON_CONTAINS(usuarios, :idStr, '$');");
		$stmt->bindParam(':idStr', $idStr, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}

