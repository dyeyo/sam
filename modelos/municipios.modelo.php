<?php

require_once "conexion.php";

class ModeloMunicipios{

	/*=============================================
	CREAR mpios
	=============================================*/

	static public function mdlIngresarMunicipio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(municipio) VALUES (:municipio)");

		$stmt->bindParam(":municipio", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR mpio
	=============================================*/

	static public function mdlMostrarMunicipios($id) {
		if($id != '0'){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM municipios WHERE id_departamento = :id");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM municipios");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
	}

	static public function mdlMostrarMunicipiosEditar($id) {
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM municipios WHERE id = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	/*=============================================
	EDITAR mpio
	=============================================*/

	static public function mdlEditarMunicipio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET municipio = :municipio WHERE id = :id");

		$stmt -> bindParam(":municipio", $datos["municipio"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR mpio
	=============================================*/

	static public function mdlBorrarMunicipio($tabla, $datos){

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

}

