<?php

class ControladorDepartamentos{

	/*=============================================
	CREAR DEPTO
	=============================================*/

	static public function ctrCrearDepartamento(){

		if(isset($_POST["nuevaDepartamento"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDepartamento"])){

				$tabla = "departamentos";

				$datos = $_POST["nuevaDepartamento"];

				$respuesta = ModeloDepartamentos::mdlIngresarDepartamento($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Registrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "departamentos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡No puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "departamentos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR DEPTOS
	=============================================*/

	static public function ctrMostrarDepartamentos($item, $valor){

		$tabla = "departamentos";

		$respuesta = ModeloDepartamentos::mdlMostrarDepartamentos($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR DEPTOS
	=============================================*/

	static public function ctrEditarDepartamento(){

		if(isset($_POST["editarDepartamento"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDepartamento"])){

				$tabla = "departamentos";

				$datos = array("departamento"=>$_POST["editarDepartamento"],
							   "id"=>$_POST["id"]);

				$respuesta = ModeloDepartamentos::mdlEditarDepartamento($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Actualizado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "departamentos";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡No puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "departamentos";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR DEPTOS
	=============================================*/

	static public function ctrBorrarDepartamento(){

		if(isset($_GET["id"])){

			$tabla ="departamentos";
			$datos = $_GET["id"];
			

			$respuesta = ModeloDepartamentos::mdlBorrarDepartamento($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "Eiminado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "departamentos";

									}
								})

					</script>';

			}
		}
		
	}
}
