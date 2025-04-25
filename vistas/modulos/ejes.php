<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar ejes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ejes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEje">
          
          Agregar ejes

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Ejes</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $ejes = ControladorEjes::ctrMostrarEjes($item, $valor);

          foreach ($ejes as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["eje"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarEje" id="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarEje"><i class="fa fa-pencil"></i></button>';

                        if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarEje" id="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                        }

                      echo '</div>  

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
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarEje" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar eje</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaEje" placeholder="Ingresar eje" required>
              </div>
              <div>
                <label for="">Personas que apoyan</label>
                <?php $personas = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);?>
                <select class="js-example-basic-multiple form-control input-lg"  name="usuarios[]"  multiple="multiple" id="usuarios" required>
                  <?php foreach ($personas as $persona): ?>
                    <option value="<?php echo $persona['id']; ?>"><?php echo $persona['nombre']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar eje</button>
        </div>
        <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $datos = [
                "eje" => $_POST["nuevaEje"],
                "usuarios" => $_POST["usuarios"],
            ];
            $respuesta = ControladorEjes::ctrCrearEje($datos);
          
            if ($respuesta == "ok") {
                echo "Tarea guardada y avance actualizado correctamente.";
            } else {
                echo "Error al guardar la tarea: " . $respuesta;
            }
          }
        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarEje" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar eje</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" class="form-control input-lg" name="editarEje" id="editarEje" required>
                 <input type="hidden"  name="id" id="id" required>
              </div>
              <div>
                <label for="">Personas que apoyan</label>
                <?php $personas = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);?>
                <select class="js-example-basic-multiple form-control input-lg"  name="usuariosE[]"   multiple="multiple" id="usuariosEditar" required>
                  <?php foreach ($personas as $persona): ?>
                    <option value="<?php echo $persona['id']; ?>"><?php echo $persona['nombre']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
  
          </div>

        </div>
        <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["id"] != null) {
            $datos = [
                "eje" => $_POST["editarEje"],
                "usuarios" => $_POST["usuariosE"],
                "id" => $_POST["id"],
            ];
         
            $respuesta = ControladorEjes::ctrEditarEje($datos);
            if ($respuesta == "ok") {
                echo "Tarea guardada y avance actualizado correctamente.";
            } else {
                echo "Error al guardar la tarea: " . $respuesta;
            }
          }
        ?>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

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
<?php

  $borrarEje = new ControladorEjes();
  $borrarEje -> ctrBorrarEje();

?>


