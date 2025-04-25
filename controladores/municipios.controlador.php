<?php

class ControladorMunicipios{

	/*=============================================
	CREAR MPIOS
	=============================================*/

	static public function ctrCrearMunicipio(){

		if(isset($_POST["nuevaMunicipio"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMunicipio"])){

				$tabla = "municipios";

				$datos = $_POST["nuevaMunicipio"];

				$respuesta = ModeloMunicipios::mdlIngresarMunicipio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Registrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "municipios";

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

							window.location = "municipios";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	MOSTRAR MPIOS
	=============================================*/

	static public function ctrMostrarMunicipiosAll(){
		$respuesta = ModeloMunicipios::mdlMostrarMunicipios('0');
		return $respuesta;
	}

	/*=============================================
	MOSTRAR MPIOS BY DEPARTAMENT
	=============================================*/

	static public function ctrMostrarMunicipios($id){
		$respuesta = ModeloMunicipios::mdlMostrarMunicipios($id);
		return $respuesta;
	}

	static public function ctrMostrarMunicipiosEditar($id){
		$respuesta = ModeloMunicipios::mdlMostrarMunicipiosEditar($id);
		return $respuesta;
	}

	/*=============================================
	EDITAR CMPIO
	=============================================*/

	static public function ctrEditarMunicipio(){

		if(isset($_POST["editarMunicipio"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMunicipio"])){

				$tabla = "municipios";

				$datos = array("municipio"=>$_POST["editarMunicipio"],
							   "id"=>$_POST["id"]);

				$respuesta = ModeloMunicipios::mdlEditarMunicipio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Actualizado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "municipios";

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

							window.location = "municipios";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarMunicipio(){

		if(isset($_GET["id"])){

			$tabla ="municipios";
			$datos = $_GET["id"];

			$respuesta = ModeloMunicipios::mdlBorrarMunicipio($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "Eiminado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "municipios";

									}
								})

					</script>';
			}
		}
		
	}
}
