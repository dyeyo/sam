<?php

class ControladorActividades{

    static public function ctrRangoFechasActividades($fechaInicial, $fechaFinal){

        $tabla = "actividades";

        $respuesta = ModeloActividades::mdlRangoFechasActividades($tabla, $fechaInicial, $fechaFinal);

        return $respuesta;
        
    }

	static public function ctrCrearActividad() {

        if (isset($_POST["nuevaActividad"])) {

            $tabla = "actividades";	
            $datos = array(
                "actividad" => $_POST["nuevaActividad"],
                "nombre" => $_POST["nuevoNombre"],
                "cantidad" => $_POST["nuevaCantidad"],
                "aporte" => $_POST["nuevoAporte"],
                "avance" => $_POST["nuevoAvance"],
                "id_tipos"=> $_POST["seleccionarTipo"],
                "mes"=> $_POST["seleccionarMes"],
                "anio"=> $_POST["seleccionarAnio"],
                "id_donante"=> $_POST["seleccionarDonante"],
                "id_departamento"=> $_POST["seleccionarDepartamento"],
                "id_municipio"=> $_POST["seleccionarMunicipio"],
                "id_eje"=> $_POST["seleccionarEje"],
                "observacion"=> $_POST["nuevaObservacion"],
                "fecha_inicio"=> $_POST["seleccionarFechaInicio"],
                "fecha_fin"=> $_POST["seleccionarFechaFin"]
            );
            $respuesta = ModeloActividades::mdlIngresarActividad($tabla, $datos);
    
            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                          type: "success",
                          title: "Registrado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {
                                        window.location = "actividades";
                                    }
                                });
                    </script>';
            } else {
                echo '<script>
                    swal({
                          type: "error",
                          title: "Hubo un error en el registro",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                if (result.value) {
                                    window.location = "actividades";
                                }
                            });
                    </script>';
            }
        }		
    }

	static public function ctrMostrarActividades($item, $valor){

		$tabla = "actividades";

		$respuesta = ModeloActividades::mdlMostrarActividades($tabla, $item, $valor);

		return $respuesta;
	
	}

	static public function ctrEditarActividad(){

        if (isset($_POST["editarnuevaActividad"])) {

            $tabla = "actividades";

            $datos = array(
                "id" => $_POST["id"],
                "actividad" => $_POST["editarnuevaActividad"],
                "nombre" => $_POST["nuevoNombre"],
                "cantidad" => $_POST["nuevaCantidad"],
                "id_tipos"=> $_POST["seleccionarTipo"],
                "mes"=> $_POST["seleccionarMes"],
                "aporte" => $_POST["editarAporte"],
                "avance" => $_POST["editarAvance"],
                "anio"=> $_POST["seleccionarAnio"],
                "id_donante"=> $_POST["seleccionarDonante"],
                "id_departamento"=> $_POST["seleccionarDepartamento"],
                "id_municipio"=> $_POST["seleccionarMunicipio"],
                "id_eje"=> $_POST["seleccionarEje"],
                "observacion"=> $_POST["nuevaObservacion"],
                "fecha_inicio"=> $_POST["seleccionarFechaInicio"],
                "fecha_fin"=> $_POST["seleccionarFechaFin"]
            );

            $respuesta = ModeloActividades::mdlEditarActividad($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "Actualizado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                                    if (result.value) {
                                        window.location = "actividades";
                                    }
                                })
                </script>';
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "Hubo un problema al actualizar la actividad",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                                    if (result.value) {
                                        window.location = "actividades";
                                    }
                                })
                </script>';
            }
        }
    }


    public function ctrDescargarReporteActividades(){

        if(isset($_GET["reporte"])){

            $tabla = "actividades";
            $item = null;
            $valor = null;

            $actividades = ModeloActividades::mdlMostrarActividades($tabla, $item, $valor);

        }


        $Name = $_GET["reporte"].'.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate"); 
        header('Content-Description: File Transfer');
        header('Last-Modified: '.date('D, d M Y H:i:s'));
        header("Pragma: public"); 
        header('Content-Disposition:; filename="'.$Name.'"');
        header("Content-Transfer-Encoding: binary");
    
        echo utf8_decode("<table border='0'> 

                <tr> 
                <td style='font-weight:bold; border:1px solid #eee;'>ID</td> 
                <td style='font-weight:bold; border:1px solid #eee;'>ACTIVIDAD</td>
                <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
                <td style='font-weight:bold; border:1px solid #eee;'>DONANTE</td>
                <td style='font-weight:bold; border:1px solid #eee;'>A</td>
                <td style='font-weight:bold; border:1px solid #eee;'>B</td>
                <td style='font-weight:bold; border:1px solid #eee;'>C</td>      
                <td style='font-weight:bold; border:1px solid #eee;'>D</td>     
                <td style='font-weight:bold; border:1px solid #eee;'>E</td 
                <td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>     
                </tr>");

        foreach ($actividades as $row => $item){

            $usuario = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id"]);
            $donante = ControladorDonantes::ctrMostrarDonantes("id", $item["id"]);

            echo utf8_decode("<tr>
                    <td style='border:1px solid #eee;'>".$item["actividad"]."</td> 
                    <td style='border:1px solid #eee;'>".$item["nombre"]."</td>
                    <td style='border:1px solid #eee;'>".$item["cantidad"]."</td>
                    <td style='border:1px solid #eee;'>");

            $donante =  json_decode($item["id"], true);

            foreach ($donante as $key => $valueDonante) {
                    
                    echo utf8_decode($valueDonante["id"]."<br>");
                }

            echo utf8_decode("</td><td style='border:1px solid #eee;'>");   

            foreach ($usuario as $key => $valueUsuarios) {
                    
                echo utf8_decode($valueUsuarios["nombre"]."<br>");
            
            }

            echo utf8_decode("</td>
                <td style='border:1px solid #eee;'>$ ".number_format($item["fecha"],2)."</td>
                <td style='border:1px solid #eee;'>$ ".number_format($item["fecha"],2)."</td>    
                <td style='border:1px solid #eee;'>$ ".number_format($item["fecha"],2)."</td>
                <td style='border:1px solid #eee;'>".$item["fecha"]."</td>
                <td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>     
                </tr>");


        }

        echo "</table>";

    }

    public function ctrSumaTotalActividades(){

        $tabla = "ventas";

        $respuesta = ModeloActividades::mdlSumaTotalActividades($tabla);

        return $respuesta;

    }

	static public function ctrBorrarActividad(){

		if(isset($_GET["id"])){

			$tabla ="actividades";
			$datos = $_GET["id"];

			$respuesta = ModeloActividades::mdlBorrarActividad($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "Borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "actividades";

									}
								})

					</script>';
			}
		}
		
	}
}
