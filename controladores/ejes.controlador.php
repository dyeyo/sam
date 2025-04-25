<?php

class ControladorEjes{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearEje($datos){

		if(isset($_POST["nuevaEje"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaEje"])){

				$tabla = "ejes";
				$datos["usuarios"] = json_encode($datos["usuarios"]);
				$respuesta = ModeloEjes::mdlIngresarEje($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El eje ha sido registrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ejes";

									}
								})

					</script>';

				}
			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El eje no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ejes";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarEjes($item, $valor){

		$tabla = "ejes";

		$respuesta = ModeloEjes::mdlMostrarEjes($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarEje($datos){

		if(isset($_POST["editarEje"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarEje"])){
				
				$datos["usuarios"] = json_encode($datos["usuarios"]);
				$respuesta = ModeloEjes::mdlEditarEje($datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El eje ha sido actualizado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ejes";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El eje no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "ejes";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarEje(){

		if(isset($_GET["id"])){

			$tabla ="ejes";
			$datos = $_GET["id"];

			$respuesta = ModeloEjes::mdlBorrarEje($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El eje ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ejes";

									}
								})

					</script>';
			}
		}
		
	}
}
