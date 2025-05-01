<div class="content-wrapper">
  <section class="content">
    <div class="box container">
      <div class="card">
        <div class="card-title">
          <h3>Encuesta</h3>
        </div>
        <div class="card-body">
          <form action="controladores/encuesta.controlador.php" method="POST" enctype="multipart/form-data">
            <div class="headers">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <label for="">Responsable:</label>
                  <select name="responsable" required id="responsable" class="form-control">
                    <option value=""></option>
                    <?php

                    $item = null;
                    $valor = null;
                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                    $userSelect = $_SESSION["id"];
                    foreach ($usuarios as $key => $value) {
                      $selected = ($value["id"] == $userSelect) ? 'selected' : '';
                      echo '<option value="' . $value["id"] . '" ' . $selected . '>' . $value["nombre"] . '</option>';
                    }
                    ?>
                  </select>

                </div>
                <div class="col-sm-12 col-md-6">
                  <label for="">Programa:</label>
                  <select name="programa" required id="programa" class="form-control">
                    <option value="">Seleccionar tipo de actividad</option>
                    <?php
                    require_once "controladores/programa.controlador.php";
                    $item = null;
                    $valor = null;
                    $programa = ControladorProgramas::ctrMostrarProgramas($item, $valor);
                    foreach ($programa as $key => $value) {
                      echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                    }
                    ?>
                  </select>
                </div>

              </div>
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <label for="">Actividad/Evento</label>
                  <input required type="text" class="form-control" name="actividad" id="actividad">
                </div>
                <div class="col-sm-12 col-md-6">
                  <label for="">Proyecto:</label>
                  <select name="proyecto" required id="proyecto" class="form-control">
                    <option value=""></option>
                    <?php

                    $item = null;
                    $valor = null;
                    $donantes = ControladorDonantes::ctrMostrarDonantes($item, $valor);
                    foreach ($donantes as $key => $value) {
                      echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <label for="">Departamento:</label>
                  <select required class="form-control " id="seleccionarDepartamentoCrear" name="departamento" required>
                    <option value="">Seleccionar Departamento</option>
                    <?php
                    $item = null;
                    $valor = null;
                    $departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);
                    foreach ($departamentos as $key => $value) {
                      echo '<option value="' . $value["id"] . '">' . $value["departamento"] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-12 col-md-6">
                  <label for="">Municipio:</label>
                  <select required class="form-control" id="seleccionarMunicipioCrear" name="municipio">
                    <option value="">Seleccionar municipio</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <label for="">Archivo:</label>
                  <input required type="file" class="form-control" id="archivo" name="archivo">
                </div>
              </div>
              <div style="display: flex;justify-content: center;gap: 10px; margin-top: 1em;" class="mt-3">
                <button type="button" id="limpiar" class="btn btn-default btn-md">Limpiar</button>
                <button type="button" id="btnFiltrar" onclick="guardarCabecera()" class="btn btn-success btn-md">Guardar
                  cabecera</button>
              </div>
              <br>
            </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-title">
        <h3>Detalle Encuesta</h3>
      </div>
      <div class="card-body" style="margin-top: 1em;" id="detalles-container">
        <div id="detalle" class="box container" style="padding: 1em;">
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <label for="">Nombre completo:</label>
              <input name="nombre" required id="nombre" class="form-control">
              <input name="encuesta_id" type="hidden" id="encuesta_id" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 col-md-6">
              <label for="">Tipo Documento:</label>
              <select name="tipo_documento" required id="tipo_documento" class="form-control">
                <option value="">-Seleccione opción--</option>
                <option value="TI">TI</option>
                <option value="CC">CC</option>
                <option value="CE">CE</option>
                <option value="Pasaporte">Pasaporte</option>
              </select>
            </div>
            <div class="col-sm-12 col-md-6">
              <label for="">Num Documento:</label>
              <input required type="text" class="form-control" name="num_documento" id="num_documento">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 col-md-6">
              <label for="">Fecha:</label>
              <input required type="date" class="form-control" name="fecha" id="fecha">
            </div>
            <div class="col-sm-12 col-md-6">
              <label for="">Correo electónico</label>
              <input required type="email" class="form-control" name="correo" id="correo">
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <label for="">Telefono:</label>
              <input required type="number" class="form-control" name="telefono" id="telefono">
            </div>
            <div class="col-sm-12 col-md-6">
              <label for="">Edad:</label>
              <select name="edad" required id="edad" class="form-control">
                <option value="Menor a 18">Menor a 18</option>
                <option value="10 a 24">10 a 24</option>
                <option value="25 a 34">25 a 34</option>
                <option value="35 a 44">35 a 44</option>
                <option value="45 a 54">45 a 54</option>
                <option value="Mas de 54">Mas de 54</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-4">
              <label for="">Nivel De Escolaridad:</label>
              <select name="escolaridad" required id="escolaridad" class="form-control">
                <option value="">-Seleccione opción--</option>
                <option value="primaria">Primaria</option>
                <option value="secundaria">Secundaria</option>
                <option value="técnico">Técnico</option>
                <option value="profesional">Profesional</option>
                <option value="N/A">N/A</option>
                <option value="sin información">Sin información</option>
              </select>
            </div>
            <div class="col-sm-12 col-md-4">
              <label for="">Cargo:</label>
              <select name="cargo" required id="cargo" class="form-control">
                <option value="">-Seleccione opción--</option>
                <option value="Publica">Publica</option>
                <option value="Privada">Privada</option>
                <option value="ONG">ONG</option>
              </select>
            </div>
            <div class="col-sm-12 col-md-4">
              <label for="">Nombre entidad:</label>
              <input required type="text" class="form-control" name="entidad" id="entidad">

            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <label for="">Sexo:</label>
              <select name="sexo" required id="sexo" class="form-control">
                <option value="">-Seleccione opción--</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="ONG">ONG</option>
              </select>
            </div>
            <div class="col-sm-12 col-md-6">
              <label for="">Ubicacion:</label>
              <select name="ubicacion" required id="ubicacion" class="form-control">
                <option value="">-Seleccione opción--</option>
                <option value="Urbano">Urbano</option>
                <option value="Rural">Rural</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <label for="">Etina:</label>
              <select onchange="otherRaza()" name="etnia" id="etnia" class="form-control">
                <option value="">-Seleccione opción--</option>
                <option value="Mestizo">Mestizo</option>
                <option value="Indigen">Indigen</option>
                <option value="Afrodesendiente">Afrodesendiente</option>
                <option value="N/A">N/A</option>
                <option value="Otro Cual">Otro Cual</option>
              </select>
            </div>
            <div class="col-sm-12 col-md-6" id="otroCual">
              <label for="">Cual:</label>
              <input type="text" class="form-control" id="etnia_otro" name="etnia_otro">
            </div>
            <div class="col-sm-12 col-md-6">
              <div style="    display: flex;gap: 1em;align-items: flex-end;margin-top: 1em;">
                <label for="">Discapacidad:</label>
                <div class="form-check">
                  <input required class="form-check-input" type="radio" name="discapacidad" id="flexRadioDefault1">
                  <label class="form-check-label" for="flexRadioDefault1">
                    Si
                  </label>
                </div>
                <div class="form-check">
                  <input required class="form-check-input" type="radio" name="discapacidad" id="flexRadioDefault2"
                    checked>
                  <label class="form-check-label" for="flexRadioDefault2">
                    No
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="" style="display: flex;justify-content: center;gap: 10px; padding: 1em;">
            <button onclick="window.history.back();" type="button" class="btn btn-default btn-md">Volver</button>
            <button type="button" onclick="guardarDetalle()" class="btn btn-success btn-md">Guardar</button>
          </div>
        </div>
        <hr>
      </div>
    </div>

</div>

<br>

</form>
</section>

</div>
<style>
  #otroCual {
    display: none;
  }

  .form-check {
    margin-top: 10px;
  }

  .form-check-input {
    margin-right: 5px;
  }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

  document.addEventListener("DOMContentLoaded", async function () {
    try {
      const selectElement = document.getElementById('responsable');
      const id_prod = selectElement.value;
      const response = await fetch('ajax/programas-combo.ajax.php?id=' + id_prod);
      const data = await response.json();
      console.log(data);
      const programaSelect = document.getElementById('programa');
      programaSelect.innerHTML = '<option value="">Seleccionar programa</option>';
      data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.textContent = item.nombre;
        programaSelect.appendChild(option);
      });
    } catch (error) {
      console.error('Error fetching programa:', error);
    }
  });

  document.getElementById("responsable").addEventListener("change", async function () {
    try {
      const selectElement = document.getElementById('responsable');
      const id_prod = selectElement.value;
      const response = await fetch(`ajax/programas-combo.ajax.php?id=${id_prod}`);
      const data = await response.json();
      console.log(data);
      const programaSelect = document.getElementById('programa');
      programaSelect.innerHTML = '<option value="">Seleccionar programa</option>';
      data.forEach(item => {
        const option = document.createElement('option');
        option.value = item.id;
        option.textContent = item.nombre;
        programaSelect.appendChild(option);
      });
    } catch (error) {
      console.error('Error fetching municipios:', error);
    }
  });

  document.getElementById("seleccionarDepartamentoCrear").addEventListener("change", async function () {
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

  function otherRaza() {
    var raza = document.getElementById("raza").value;
    if (raza == "Otro Cual") {
      document.getElementById("otroCual").style.display = "block";
    } else {
      document.getElementById("otroCual").style.display = "none";
    }
  }

  document.getElementById('btn-add').addEventListener('click', function () {
    const container = document.getElementById('detalles-container');
    const detalle = document.getElementById('detalle');
    const clone = detalle.cloneNode(true); // Clona todo el contenido del #detalle

    // Limpiar los valores de los inputs del clon
    clone.querySelectorAll('input').forEach(input => {
      input.value = '';
    });

    clone.querySelectorAll('select').forEach(select => {
      select.selectedIndex = 0;
    });

    container.appendChild(clone); // Agrega el clon al container
  });

  function guardarCabecera() {
    const detalles = document.querySelectorAll('#detalle');
    const formData = new FormData();

    formData.append('programa', document.getElementById('programa').value);
    formData.append('proyecto', document.getElementById('proyecto').value);
    formData.append('actividad', document.getElementById('actividad').value);
    formData.append('responsable', document.getElementById('responsable').value);
    formData.append('departamento', document.getElementById('seleccionarDepartamentoCrear').value);
    formData.append('municipio', document.getElementById('seleccionarMunicipioCrear').value);

    const archivoInput = document.getElementById('archivo');
    if (archivoInput.files.length > 0) {
      formData.append('archivo', archivoInput.files[0]);
    }

    fetch('controladores/encuesta.controlador.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json()) // <-- Cambia .text() por .json()
      .then(result => {
        console.log(result);
        if (result) {
          document.getElementById('encuesta_id').value = result;
          alert("Cabecera de encuesta guardada");
        } else {
          alert("Error al guardar la encuesta: ");
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }

  function guardarDetalle() {
    const detalles = document.querySelectorAll('#detalle');
    const formData = new FormData();

    formData.append('encuesta_id', document.getElementById('encuesta_id').value);
    formData.append('nombre', document.getElementById('nombre').value);
    formData.append('tipo_documento', document.getElementById('tipo_documento').value);
    formData.append('num_documento', document.getElementById('num_documento').value);
    formData.append('fecha', document.getElementById('fecha').value);
    formData.append('correo', document.getElementById('correo').value);
    formData.append('telefono', document.getElementById('telefono').value);
    formData.append('edad', document.getElementById('edad').value);
    formData.append('escolaridad', document.getElementById('escolaridad').value);
    formData.append('cargo', document.getElementById('cargo').value);
    formData.append('entidad', document.getElementById('entidad').value);
    formData.append('sexo', document.getElementById('sexo').value);
    formData.append('ubicacion', document.getElementById('ubicacion').value);
    formData.append('etnia', document.getElementById('etnia').value);
    formData.append('etnia_otro', document.getElementById('etnia_otro').value);
    formData.append('etnia_otro', document.getElementsByName('discapacidad').value);

    fetch('controladores/encuesta-detalle.controlador.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.text())
      .then(result => {
        if (confirm("Registro  guardado ¿Desea guardar otro?")) {
          document.getElementById('nombre').value = "";
          document.getElementById('tipo_documento').value = "";
          document.getElementById('num_documento').value = "";
          document.getElementById('fecha').value = "";
          document.getElementById('correo').value = "";
          document.getElementById('telefono').value = "";
          document.getElementById('edad').value = "";
          document.getElementById('escolaridad').value = "";
          document.getElementById('cargo').value = "";
          document.getElementById('entidad').value = "";
          document.getElementById('sexo').value = "";
          document.getElementById('ubicacion').value = "";
          document.getElementById('etnia').value = "";
          document.getElementById('etnia_otro').value = "";
          document.getElementsByName('discapacidad').value = "";
        }else{
          window.location = "lista-encuesta";
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }
</script>