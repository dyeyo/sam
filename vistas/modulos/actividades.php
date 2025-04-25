<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">
  <section class="content-header">
    
    <h1>
      
      Administrar actividad
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar actividades</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarActividad">
          
          Agregar actividades

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
        <thead>
          <tr>
            <th style="width:10px">#</th>
            <th>Actividad</th>
            <th>Cantidad</th>
            <th>Aporte</th>
            <th>Dias vigencia</th>
            <th>Avance</th>
            <th>Acciones</th>
          </tr> 
        </thead>
        <tbody>
          <?php
            $item = null;
            $valor = null;
            $actividades = ControladorActividades::ctrMostrarActividades($item, $valor);

            foreach ($actividades as $key => $value) {
              $fechaInicio = new DateTime($value["fecha_inicio"]);
              $fechaFin = new DateTime($value["fecha_fin"]);
              $hoy = new DateTime(); 
      
              if ($hoy < $fechaFin) {
                  $diasRestantes = $hoy->diff($fechaFin)->days +1; 
              } else {
                  $diasRestantes = 0; 
              }
              echo '<tr>
                      <td class="text-uppercase">'.$value["id"].'</td>
                      <td class="text-uppercase">'.$value["nombre"].'</td>
                      <td class="text-uppercase">'.$value["cantidad"].'</td>
                      <td class="text-uppercase">'.$value["aporte"].'</td>';
                      
                      if ($diasRestantes <= 3) {
                        echo ' <td class="text-uppercase"><p style="background: #dc3545; color:#fff; text-align: center;">'.$diasRestantes.'</p></td>';
                      }
                      elseif ($diasRestantes > 3 && $diasRestantes <= 10 ) {
                        echo ' <td class="text-uppercase"><p style="background: #edbf37; color:#fff; text-align: center;">'.$diasRestantes.'</p></td>';
                      }
                      elseif ($diasRestantes > 11) {
                        echo ' <td class="text-uppercase"><p style="background: #5fca98; color:#fff; text-align: center;">'.$diasRestantes.'</p></td>';
                      }

                      if ($value["avance"] <= 30) {
                          echo '<td class="text-uppercase"><p style="background: #dc3545; color:#fff; text-align: center;">'.$value["avance"].'%</p></td>';
                      } elseif ($value["avance"] > 30 && $value["avance"] <= 99) {
                          echo '<td class="text-uppercase"><p style="background: #edbf37; color:#fff; text-align: center;">'.$value["avance"].'%</p></td>';
                      } elseif ($value["avance"] = 100) {
                          echo '<td class="text-uppercase"><p style="background: #5fca98; color:#fff; text-align: center;">'.$value["avance"].'%</p></td>';
                      }
                  
                      echo '<td>
                              <div class="btn-group">
                                  <button class="btn btn-warning btnEditarActividad" data-toggle="modal" data-target="#modalEditarActividades" id="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';
                      if ($_SESSION["perfil"] == "Administrador") {
                          echo '<button class="btn btn-danger btnEliminarActividad" id="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                      }
              echo '  </div>  
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



<div id="modalEditarActividades" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    <form role="form" method="post">
      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Editar actividad</h4>

      </div>

     <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <label>Actividad</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="number" min="0" class="form-control input-lg"class="form-control input-lg"
                 name="editarnuevaActividad" id="editarnuevaActividad"
                  placeholder="Ingresar identificador de la actividad" required>
                <input type="hidden"  class="form-control input-lg"class="form-control input-lg"
                 name="id" id="id"
                  placeholder="Ingresar identificador de la actividad" required>
              </div>
            </div>

            <div class="form-group">
              <label>Tipo</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                
                <select class="form-control input-lg"  name="seleccionarTipo" id="editarseleccionarTipo" required>

                <option value="">Seleccionar tipo de actividad</option>

                <?php

                  $item = null;
                  $valor = null;

                  $tipos = ControladorTipos::ctrMostrarTipos($item, $valor);

                    foreach ($tipos as $key => $value) {

                      echo '<option value="'.$value["id"].'">'.$value["tipo"].'</option>';

                    }

                ?>
                </select>
              </div>
            </div>

            <div class="form-group">   
              <label>Nombre</label>       
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                 <textarea class="form-control input-lg" name="nuevoNombre" id="editarnuevoNombre"  placeholder="Ingrese la descripción de la actividad" rows="6" style="width: 100%; overflow-y: auto;" required></textarea>
              </div>
            </div>

            <div class="form-group">
              <label>Cantidad</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
              <input type="number" min="0" class="form-control input-lg" name="nuevaCantidad" id="editarnuevaCantidad" placeholder="Ingresar cantidad" required>
              </div>
            </div>

            <div class="form-group">
              <label>Fecha Inicio</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <input type="date" class="form-control input-lg"  name="seleccionarFechaInicio" id="editarseleccionarFechaInicio" required>           
                </div>
            </div>

            <div class="form-group">
              <label>Fecha Entrega</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <input type="date" class="form-control input-lg"  name="seleccionarFechaFin" id="editarseleccionarFechaFin" required>           
                </div>
            </div>

            <div class="form-group">
              <label>Año</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <input type="number" class="form-control input-lg"  min="1900" max="2099" step="1" value="" name="seleccionarAnio" id="editarseleccionarAnio" required/>
              </div>
            </div>

            <div class="form-group">
              <label>Mes</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg"  name="seleccionarMes" id="editarseleccionarMes" required>
                  <option value="Enero">Enero</option>
                  <option value="Febrero">Febrero</option>
                  <option value="Marzo">Marzo</option>
                  <option value="Abril">Abril</option>
                  <option value="Mayo">Mayo</option>
                  <option value="Junio">Junio</option>
                  <option value="Julio">Julio</option>
                  <option value="Agosto">Agosto</option>
                  <option value="Septiembre">Septiembre</option>
                  <option value="Octubre">Octubre</option>
                  <option value="Noviembre">Noviembre</option>
                  <option value="Diciembre">Diciembre</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label>Donante</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="seleccionarDonante" id="editarseleccionarDonante" required>
                  <option value="">Seleccionar donante</option>
                  <?php

                    $item = null;
                    $valor = null;

                    $donantes = ControladorDonantes::ctrMostrarDonantes($item, $valor);

                    foreach ($donantes as $key => $value) {

                      echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';

                    }

                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label>Departamento</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <select class="form-control input-lg"  name="seleccionarDepartamento" id="editarseleccionarDepartamento" required>
                  <option value="">Seleccionar Departamento</option>
                  <?php
                    $item = null;
                    $valor = null;
                    $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);
                    foreach ($departamentos as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["departamento"].'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label>Municipio</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                <select class="form-control input-lg"  name="seleccionarMunicipio" id="editarseleccionarMunicipio" >
                  <option value="">Seleccionar municipio</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label>Eje</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="seleccionarEje" id="editarseleccionarEje" required>
                  <option value="">Seleccionar responsable</option>
                  <?php

                    $item = null;
                    $valor = null;

                    $ejes = ControladorEjes::ctrMostrarEjes($item, $valor);

                      foreach ($ejes as $key => $value) {

                        echo '<option value="'.$value["id"].'">'.$value["eje"].'</option>';

                      }

                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">   
              <label>Observacion</label>              
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <textarea class="form-control input-lg" name="nuevaObservacion" id="editarnuevaObservacion"  placeholder="Observacion" rows="6" style="width: 100%; overflow-y: auto;" required></textarea>
              </div>
            </div>

            <div class="form-group"> 
              <label>Avance</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id="editarAporte" name="editarAporte" required>
                  <option value="">Seleccionar responsable</option>
                  <option value="Comenzado">Comenzado</option>
                  <option value="No Comenzado">No Comenzado</option>
                  <option value="Terminado">Terminado</option>
                </select>
              </div>
            </div>

            <div class="form-group"> 
              <label>Porcentaje Avance</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarAvance" id="editarAvance" placeholder="Ingresar descripción del avance" required>
              </div>
            </div>

          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
    </form>
    <?php

      $editarActividad = new ControladorActividades();
      $editarActividad -> ctrEditarActividad();

    ?> 
    </div>
  </div>
</div>

<div id="modalAgregarActividad" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar actividad</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <label>Actividad</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="number" min="0" class="form-control input-lg"class="form-control input-lg" name="nuevaActividad" placeholder="Ingresar identificador de la actividad" required>
              </div>
            </div>

            <div class="form-group">
              <label>Tipo</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" id="seleccionarTipo" name="seleccionarTipo" required>
                  <option value="">Seleccionar tipo de actividad</option>

                  <?php

                    $item = null;
                    $valor = null;

                    $tipos = ControladorTipos::ctrMostrarTipos($item, $valor);

                      foreach ($tipos as $key => $value) {

                        echo '<option value="'.$value["id"].'">'.$value["tipo"].'</option>';

                      }

                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">  
              <label>Nombre</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                 <textarea class="form-control input-lg" name="nuevoNombre" id="nuevoNombre" placeholder="Ingrese la descripción de la actividad" rows="6" style="width: 100%; overflow-y: auto;" required></textarea>
              </div>
            </div>

            <div class="form-group">
              <label>Cantidad</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
              <input type="number" min="0" class="form-control input-lg" name="nuevaCantidad" placeholder="Ingresar cantidad" required>
              </div>
            </div>

            <div class="form-group">
              <label>Fecha Inicio</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <input type="date" class="form-control input-lg"  name="seleccionarFechaInicio" id="crearseleccionarFechaInicio" required>           
                </div>
            </div>

            <div class="form-group">
              <label>Fecha Entrega</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <input type="date" class="form-control input-lg"  name="seleccionarFechaFin" id="crearseleccionarFechaFin" required>           
                </div>
            </div>

            <div class="form-group">
              <label>Año</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <input type="number" class="form-control input-lg"  min="1900" max="2099" step="1" value="" id="seleccionarAnio" name="seleccionarAnio" required />
              </div>
            </div>

            <div class="form-group">
              <label>Mes</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" id="seleccionarMes" name="seleccionarMes" required>
                  <option value="Enero">Enero</option>
                  <option value="Febrero">Febrero</option>
                  <option value="Marzo">Marzo</option>
                  <option value="Abril">Abril</option>
                  <option value="Mayo">Mayo</option>
                  <option value="Junio">Junio</option>
                  <option value="Julio">Julio</option>
                  <option value="Agosto">Agosto</option>
                  <option value="Septiembre">Septiembre</option>
                  <option value="Octubre">Octubre</option>
                  <option value="Noviembre">Noviembre</option>
                  <option value="Diciembre">Diciembre</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label>Donante</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" id="seleccionarDonante" name="seleccionarDonante" required>
                  <option value="">Seleccionar donante</option>
                  <?php

                    $item = null;
                    $valor = null;

                    $donantes = ControladorDonantes::ctrMostrarDonantes($item, $valor);

                    foreach ($donantes as $key => $value) {

                      echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';

                    }

                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label>Departamento</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <select class="form-control input-lg" id="seleccionarDepartamentoCrear"  name="seleccionarDepartamento" required>
                  <option value="">Seleccionar Departamento</option>
                  <?php
                    $item = null;
                    $valor = null;
                    $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);
                    foreach ($departamentos as $key => $value) {
                      echo '<option value="'.$value["id"].'">'.$value["departamento"].'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label>Municipio</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                <select class="form-control input-lg" id="seleccionarMunicipioCrear" name="seleccionarMunicipio" >
                  <option value="">Seleccionar municipio</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label>Eje</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" id="seleccionarEje" name="seleccionarEje" required>
                  <option value="">Seleccionar responsable</option>
                  <?php

                    $item = null;
                    $valor = null;

                    $ejes = ControladorEjes::ctrMostrarEjes($item, $valor);

                      foreach ($ejes as $key => $value) {

                        echo '<option value="'.$value["id"].'">'.$value["eje"].'</option>';

                      }

                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">   
              <label>Observacion</label>       
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <textarea class="form-control input-lg" name="nuevaObservacion" id="nuevaObservacion" placeholder="Observacion" rows="6" style="width: 100%; overflow-y: auto;" required></textarea>
              </div>
            </div>

            <div class="form-group"> 
              <label>Avance</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" id="nuevoAporte" name="nuevoAporte" required>
                  <option value="">Seleccionar responsable</option>
                  <option value="Comenzado">Comenzado</option>
                  <option value="No Comenzado">No Comenzado</option>
                  <option value="Terminado">Terminado</option>
                </select>
              </div>
            </div>

            <div class="form-group"> 
              <label>Porcentaje Avance </label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="number" class="form-control input-lg"  min="0" max="100" name="nuevoAvance" placeholder="Ingresar descripción del avance" required>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar actividad</button>
        </div>
        </form>
        <?php
          $crearActividad = new ControladorActividades();
          $crearActividad->ctrCrearActividad();
        ?>
    </div>
  </div>
</div>

<script>
  document.getElementById('seleccionarAnio').addEventListener('change', function() {
    const fechaSeleccionada = this.value;

    const anio = fechaSeleccionada ? new Date(fechaSeleccionada).getFullYear() : 'N/A';

    document.getElementById('yearOutput').textContent = anio;
  });

  document.addEventListener("DOMContentLoaded", function () {
    const fechaInicioE = document.getElementById("editarseleccionarFechaInicio");
    const fechaFinE = document.getElementById("editarseleccionarFechaFin");

    fechaInicioE.addEventListener("change", function () {
      if (fechaInicioE.value) {
        fechaFinE.min = fechaInicioE.value;
        fechaFinE.value = ""; 
      }
    });

    fechaFinE.addEventListener("change", function () {
      if (fechaFin.value < fechaInicioE.value) {
        alert("La Fecha Entrega debe ser mayor o igual a la fecha de inicio.");
        fechaFinE.value = ""; 
      }
    });
  });

  document.addEventListener("DOMContentLoaded", function () {
    const fechaInicio = document.getElementById("crearseleccionarFechaInicio");
    const fechaFin = document.getElementById("crearseleccionarFechaFin");

    fechaInicio.addEventListener("change", function () {
      if (fechaInicio.value) {
        fechaFin.min = fechaInicio.value;
        fechaFin.value = ""; 
      }
    });

    fechaFin.addEventListener("change", function () {
      if (fechaFin.value < fechaInicio.value) {
        alert("La fecha fin debe ser mayor o igual a la fecha de inicio.");
        fechaFin.value = ""; 
      }
    });
  });

</script>
<script>
  document.getElementById("seleccionarDepartamentoCrear").addEventListener("change", async  function() {
    try {
      const selectElement = document.getElementById('seleccionarDepartamentoCrear');
      const id_municipio = selectElement.value;
      const response = await fetch(`ajax/municipios-combo.ajax.php?id=${id_municipio}`);
      const data = await response.json();
      const municipioSelect = document.getElementById('seleccionarMunicipioCrear');
      municipioSelect.innerHTML = '<option value="">Seleccionar municipio</option>';
      data.forEach(item => {
          const option = document.createElement('option');
          option.value = item.id; 
          option.textContent = item.municipio; 
          municipioSelect.appendChild(option);
      });
    } catch (error) {
       console.error('Error fetching municipios:', error);
    }
  });
  document.getElementById("editarseleccionarDepartamento").addEventListener("change", async  function() {
    try {
      const selectElement = document.getElementById('editarseleccionarDepartamento');
      const id_municipio = selectElement.value;
      const response = await fetch(`ajax/municipios-combo.ajax.php?id=${id_municipio}`);
      const data = await response.json();
      const municipioSelect = document.getElementById('editarseleccionarMunicipio');
      municipioSelect.innerHTML = '<option value="">Seleccionar municipio</option>';
      data.forEach(item => {
          const option = document.createElement('option');
          option.value = item.id; 
          option.textContent = item.municipio; 
          municipioSelect.appendChild(option);
      });
      
    } catch (error) {
       console.error('Error fetching municipios:', error);
    }
  });
</script>
<?php
  $borrarActividad = new ControladorActividades();
  $borrarActividad -> ctrBorrarActividad();
?>


