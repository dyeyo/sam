<?php

class Conexion {

	static public function conectar() {

		try {
			$link = new PDO("mysql:host=127.0.0.1;port=3306;dbname=testsegoliamb", 
			                "root", 
			                "");
			$link->exec("set names utf8");
			return $link;
		} catch (PDOException $e) {
			echo "Error de conexión: " . $e->getMessage();
			return null;
		}
	}
}
