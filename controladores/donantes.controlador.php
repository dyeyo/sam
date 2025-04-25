<?php

class ControladorDonantes{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearDonante(){

		if(isset($_POST["nuevaDonante"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDonante"])){

				$tabla = "categorias";

				$datos = $_POST["nuevaDonante"];

				$respuesta = ModeloDonantes::mdlIngresarDonante($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El donante ha sido registrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "donantes";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El donante no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "donantes";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarDonantes($item, $valor){

		$tabla = "categorias";

		$respuesta = ModeloDonantes::mdlMostrarDonantes($tabla, $item, $valor);

		return $respuesta;
	
	}
	
	static public function ctrMostrarSumaDonantes(){

		$tabla = "categorias";

		$respuesta = ModeloDonantes::mdlMostrarSumaDonantes($tabla);

		return $respuesta;

	}

	static public function ctrMostrarDonantesDash($item, $valor){

		$tabla = "categorias";

		$respuesta = ModeloDonantes::mdlMostrarDonantesDash($tabla, $item, $valor);

		return $respuesta;
	
	}
	
	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarDonante(){

		if(isset($_POST["editarDonante"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDonante"])){

				$tabla = "categorias";

				$datos = array("categoria"=>$_POST["editarDonante"],
							   "id"=>$_POST["id"]);

				$respuesta = ModeloDonantes::mdlEditarDonante($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El donante ha sido actualizado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "donantes";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El donante no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "donantes";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarDonante(){

		if(isset($_GET["id"])){

			$tabla ="categorias";
			$datos = $_GET["id"];

			$respuesta = ModeloDonantes::mdlBorrarDonante($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El donante ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "donantes";

									}
								})

					</script>';
			}
		}
		
	}
}
