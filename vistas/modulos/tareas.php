<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}
if (isset($_GET['action']) && $_GET['action'] == 'obtenerDetalle') {
    // Esto es una solicitud AJAX, solo devuelve JSON
    header('Content-Type: application/json');
    return; // Evitar que el resto del código HTML se ejecute
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Manejo de archivos subidos
  $rutaBase = "uploads/"; // Carpeta para guardar archivos
  $archivos = ["archivo_1", "archivo_2", "archivo_3"];
  $urlsArchivos = [];

  // Crear carpeta si no existe
  if (!is_dir($rutaBase)) {
      mkdir($rutaBase, 0755, true);
  }

  // Procesar archivos
  foreach ($archivos as $archivo) {
      if (isset($_FILES[$archivo]) && $_FILES[$archivo]["error"] === UPLOAD_ERR_OK) {
          $nombreArchivo = uniqid() . "_" . basename($_FILES[$archivo]["name"]);
          $rutaDestino = $rutaBase . $nombreArchivo;

          if (move_uploaded_file($_FILES[$archivo]["tmp_name"], $rutaDestino)) {
              $urlsArchivos[$archivo] = $rutaDestino; 
          } else {
              $urlsArchivos[$archivo] = null;
          }
      } else {
          $urlsArchivos[$archivo] = null;
      }
  }
  // Preparar datos para enviar al controlador
  $datos = [
      "actividad_id" => $_POST["actividad_id"],
      "persona_apoyan_id" => $_POST["persona_apoyan_id"],
      "ejes_intervienen_id" => $_POST["ejes_intervienen_id"],
      "archivo_1" => $urlsArchivos["archivo_1"],
      "archivo_2" => $urlsArchivos["archivo_2"],
      "archivo_3" => $urlsArchivos["archivo_3"],
      "porcentaje_aporte" => $_POST["porcentaje_aporte"],
      "fecha_aporte" => $_POST["fecha_aporte"],
      "descripcion_avance" => $_POST["descripcion_avance"],
      "fuentes_verificacion" => $_POST["fuentes_verificacion"]
  ]; 

  // Llamar al controlador para guardar la tarea
  $respuesta = TareasController::ctrCrearTarea($datos);

  if ($respuesta == "ok") {
      echo "Tarea guardada y avance actualizado correctamente.";
  } else {
      echo "Error al guardar la tarea: " . $respuesta;
  }
}
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar tareas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar tareas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      <div class="box-body">
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
      <thead>
          <tr>
            <th style="width:10px">#</th>
            <th>Nombre</th>
            <th>Dias vigencia</th>
            <th>Avance Tarea</th>
            <th>Acciones</th>
          </tr> 
          </thead>
        <tbody>
          <?php
            $item = null;
            $valor = null;

            $tareas = TareasController::ctrMostrarTareas();
            foreach ($tareas as $task) {
              $fechaInicio = new DateTime($task["fecha_inicio"]);
              $fechaFin = new DateTime($task["fecha_fin"]);
              $hoy = new DateTime(); 
      
              if ($hoy < $fechaFin) {
                  $diasRestantes = $hoy->diff($fechaFin)->days +1; 
              } else {
                  $diasRestantes = 0; 
              }
              echo ' <tr>
                      <td class="text-uppercase">'.$task["id"].'</td>
                      <td class="text-uppercase" style="width: 70%;">'.$task["nombre"].'</td>';
                      if ($diasRestantes <= 3) {
                        echo ' <td class="text-uppercase"><p style="background: #dc3545; color:#fff; text-align: center;">'.$diasRestantes.'</p></td>';
                      }
                      elseif ($diasRestantes > 3 && $diasRestantes <= 10 ) {
                        echo ' <td class="text-uppercase"><p style="background: #edbf37; color:#fff; text-align: center;">'.$diasRestantes.'</p></td>';
                      }
                      elseif ($diasRestantes > 11) {
                        echo ' <td class="text-uppercase"><p style="background: #5fca98; color:#fff; text-align: center;">'.$diasRestantes.'</p></td>';
                      }
                      if ($task["avance"] <= 30) {
                          echo '<td class="text-uppercase"><p style="background: #dc3545; color:#fff; text-align: center;">'.$task["avance"].'%</p></td>';
                      } elseif ($task["avance"] > 30 && $task["avance"] <= 99) {
                          echo '<td class="text-uppercase"><p style="background: #edbf37; color:#fff; text-align: center;">'.$task["avance"].'%</p></td>';
                      } elseif ($task["avance"] = 100) {
                          echo '<td class="text-uppercase"><p style="background: #5fca98; color:#fff; text-align: center;">'.$task["avance"].'%</p></td>';
                      }

                      echo '
                      
                      <td class="text-uppercase">
                            
                          <button title="Detalle" class="btn btn-primary btnDetalleTarea" id="'.$task["id"].'" data-toggle="modal"
                          data-target="#modalDetalleTarea"><i class="fa fa-eye"></i></button>

                          <button title="Avance tarea" class="btn btn-warning btnEditarAvance" id="'.$task["id"].'"  data-toggle="modal"
                              data-target="#modalEditarAvance"><i class="fa fa-tags"></i>
                          </button>
                      </td>
                    </tr>';
            }

          ?>
        </tbody>
       </table>
      </div>
    </div>

  </section>

</div>

<!--=====================================
MODAL DETALLE TAREA
======================================-->

<div id="modalDetalleTarea" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalle actividad</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div id="detalle-container">
              <label for="nombre">Nombre</label>  
              <textarea name="nombre" id="nombre" class="form-control input-lg"></textarea>
              <label for="fecha_inicio">Fecha inicio</label>
              <input type="text" class="form-control input-lg" name="fecha_inicio" id="fecha_inicio" readonly>
              <label for="fecha_fin">Fecha de entrega</label>
              <input type="text" class="form-control input-lg" name="fecha_fin" id="fecha_fin" readonly>
              <!-- <label for="fecha">Fecha</label>
              <input type="text" class="form-control input-lg" name="fecha" id="fecha" readonly> -->
              <label for="aporte">Aporte</label>
              <input type="text" class="form-control input-lg" name="aporte" id="aporte" readonly>
              <label for="observacion">Observación</label>
              <input type="text" class="form-control input-lg" name="observacion" id="observacion" readonly>
            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
        </div>
      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL CREAR TAREA
======================================-->

<div id="modalEditarAvance" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Tarea</h4>

        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
            <!-- ENTRADA PARA EL NOMBRE -->
          <form action="controladores/guardar_tarea.controlador.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <div>
                <label for="descripcion_avance">Descripcion de avance </label>
                <textarea name="descripcion_avance" class="form-control input-lg"  id="descripcion_avance"></textarea>
              </div>
              <div>
                <label for="fuentes_verificacion">Fuentes de verificiación</label>
                <input type="text" class="form-control input-lg" name="fuentes_verificacion" id="fuentes_verificacion" required>
              </div>
              <div>
                <label for="ejes_intervienen_id">Ejes que intervienen</label>
                <?php $ejes = ControladorEjes::ctrMostrarEjes($item, $valor);?>
                <select class="js-example-basic-multiple js-states form-control" name="ejes_intervienen_id[]" multiple="multiple" required>
                    <?php foreach ($ejes as $eje): ?>
                      <option value="<?php echo $eje['id']; ?>"><?php echo $eje['eje']; ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
              <div>
                <label for="">Personas que apoyan</label>
                <?php $personas = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);?>
                <select class="js-example-basic-multiple form-control input-lg"  name="persona_apoyan_id[]"  multiple="multiple" id="persona_apoyan_id" required>
                  <?php foreach ($personas as $persona): ?>
                    <option value="<?php echo $persona['id']; ?>"><?php echo $persona['nombre']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div>
                <label for="fecha_aporte">Fecha aporte</label>
                <input type="date" class="form-control input-lg" name="fecha_aporte" id="fecha_aporte" required>
              </div>
              <div>
                <label for="porcentaje_aporte">% Aporte</label>
                <input type="number" class="form-control input-lg"  min="0" max="100" name="porcentaje_aporte" id="porcentaje_aporte" required>
              </div>
              <div>
                <label for="">Archivos</label>
                <input type="file" class="form-control input-lg" name="archivo_1" id="archivo_1" >
                <input type="file" class="form-control input-lg" name="archivo_2" id="archivo_2" >
                <input type="file" class="form-control input-lg" name="archivo_3" id="archivo_3" >
                <input type="hidden"  name="actividad_id" id="actividad_id" required>
              </div>

          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>
          </form>

        </div>


    </div>

  </div>

</div>     
<style>
  .select2 {
    width: 100% !important;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice{
    background-color: #3c8dbc !important;
  }
</style>
<script>
  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
