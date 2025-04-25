<?php

if($_SESSION["perfil"] == "Digitador" || $_SESSION["perfil"] == "Digitador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Validar tareas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Validar Tareas</li>
    
    </ol>

  </section>

  <section class="content">
    <div class="box">
    <div class="box-body">
    <?php
    $tareas = TareasController::ctrMostrarTareasPendientes();
    if (!empty($tareas)){
        echo '
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            <thead>
            <tr>
                <th style="width:10px">#</th>
                <th>Nombre</th>
                <th>Responsables</th>
                <th>Fuentes verificación</th>
                <th>Porcentaje aporte</th>
                <th>Fecha</th>
                <th>Descripcion avance</th>
                <th>Archivos</th>
                <th>Acciones</th>
            </tr> 
            </thead>
            <tbody>';
              foreach ($tareas as $task) {
                  echo '<tr>
                          <td>' . $task["tarea_id"] . '</td>
                          <td>' . $task["actividad_nombre"] . '</td>
                          <td>' . $task["correos"] . '</td>
                          <td>' . $task["tarea_fuentes_verificacion"] . '</td>
                          <td>' . $task["tarea_porcentaje_aporte"] . '%</td>
                          <td>' . $task["fecha_aporte"] . '</td>
                          <td>' . $task["tarea_descripcion_avance"] . '</td>';
                  
                  echo '<td>';
                  if ($task["archivo_1"]) {
                      echo '<a href="../sam/controladores/' . $task["archivo_1"] . '" class="btn btn-info" download="' . basename($task["archivo_1"]) . '">Adjunto 1</a>';
                  }
                  if ($task["archivo_2"]) {
                      echo '<a href="../sam/controladores/' . $task["archivo_2"] . '" class="btn btn-info" download="' . basename($task["archivo_2"]) . '">Adjunto 2</a>';
                  }
                  if ($task["archivo_3"]) {
                      echo '<a href="../sam/controladores/' . $task["archivo_3"] . '" class="btn btn-info" download="' . basename($task["archivo_3"]) . '">Adjunto 3</a>';
                  }
                  echo '</td>';

                  echo '<td>
                          <form method="POST" action="ajax/aprobar-tarea.ajax.php" style="margin-top: -19px;">
                              <input type="hidden" name="action" value="aprobarTarea">
                              <input type="hidden" name="aporte" value="' . $task['tarea_porcentaje_aporte'] . '">
                              <input type="hidden" name="estado" value="1">
                              <input type="hidden" name="id" value="' . $task["tarea_id"] . '">
                              <input type="hidden" name="actividad_id" value="' . $task["actividad_id"] . '">
                              <button class="btn btn-success btn-xs btnActivarTarea" type="submit" style=" height: 3em;margin-top: 19px;">Aprobar</button>
                          </form>
                        </td>';

                  echo '<td>
                          <form method="POST" action="ajax/desaprobar-tarea.ajax.php" style="display: flex; gap: 1em;" id="formulario">
                              <input type="hidden" name="action" value="aprobarTarea">
                              <input type="hidden" name="aporte" value="' . $task['tarea_porcentaje_aporte'] . '">
                              <input type="hidden" name="estado" value="1">
                              <input type="hidden" name="id" value="' . $task["tarea_id"] . '">
                              <input type="hidden" name="actividad_nombre" value="' . $task["actividad_nombre"] . '">
                              <input type="hidden" name="email" value="' . $task["correos"] . '">
                              <input type="hidden" name="name" value="' . $task["correos"] . '">
                              <input type="hidden" name="actividad_id" value="' . $task["actividad_id"] . '">
                              <input type="text" class="form-control" placeholder="Motivo rechazo" required name="nota">
                              <button class="btn btn-danger btn-xs btnInactivar" type="submit" style="margin-top: 0">Rechazar</button>
                          </form>
                        </td>';

                  echo '</tr>';
              }
            echo '</tbody>
        </table>';
    } else {
        echo '<h3>No tenemos datos</h3>';
    }
    ?>
</div>


    </div>

  </section>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const forms = document.querySelector('#formulario');

  forms.forEach(form => {
      form.addEventListener("submit", async function (e) {
          e.preventDefault();

          const formData = new FormData(this);

          try {
              const response = await fetch(this.action, {
                  method: "POST",
                  body: formData,
              });

              if (response.ok) {
                  alert("Tarea rechazada correctamente.");
                  
                  document.querySelectorAll(".nota-campo").forEach(input => {
                      input.value = "";
                  });

                  window.location.href = "/UNODC/sam/validacion";
              } else {
                  alert("Error al actualizar el estado.");
              }
          } catch (error) {
              console.error("Error:", error);
              alert("Ocurrió un error inesperado.");
          }
      });
  });
});
$(document).ready(function() {
  $('#nota').val("");
})
</script>