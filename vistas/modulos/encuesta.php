<div class="content-wrapper">
  <section class="content">
    <div class="box container">
      <div class="card">
        <div class="card-title">
          <h3>Encuesta</h3>
        </div>
        <div class="card-body">
          <form action="controladores/encuesta.controlador.php" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <label for="">Nombre completo:</label>
                <input name="nombre" required id="" class="form-control">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <label for="">Programa:</label>
                <select name="programa" required id="" class="form-control">
                  <option value="">Seleccionar tipo de actividad</option>
                  <?php
                  require_once "controladores/programas.controlador.php";
                  $item = null;
                  $valor = null;
                  $programa = ControladorProgramas::ctrMostrarProgramas($item, $valor);
                  foreach ($programa as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="col-sm-12 col-md-6">
                <label for="">Proyecto:</label>
                <select name="proyecto" required id="" class="form-control">
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
                <label for="">Actividad/Evento</label>
                <input required type="text" class="form-control" name="actividad" id="">
              </div>
              <div class="col-sm-12 col-md-6">
                <label for="">Responsable:</label>
                <select name="responsable" required id="" class="form-control">
                  <option value=""></option>
                  <?php

                  $item = null;
                  $valor = null;
                  $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                  foreach ($usuarios as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <label for="">Tipo Documento:</label>
                <select name="tipo_documento" required id="" class="form-control">
                  <option value="">-Seleccione opción--</option>
                  <option value="TI">TI</option>
                  <option value="CC">CC</option>
                  <option value="CE">CE</option>
                  <option value="Pasaporte">Pasaporte</option>
                </select>
              </div>
              <div class="col-sm-12 col-md-6">
                <label for="">Num Documento:</label>
                <input required type="text" class="form-control" name="num_documento" id="">
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
                <select required class="form-control " id="seleccionarMunicipioCrear" name="municipio">
                  <option value="">Seleccionar municipio</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <label for="">Fecha:</label>
                <input required type="date" class="form-control" name="fecha" id="">
              </div>
              <div class="col-sm-12 col-md-6">
                <label for="">Correo electónico</label>
                <input required type="email" class="form-control" name="correo" id="">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <label for="">Telefono:</label>
                <input required type="text" class="form-control" name="telefono" id="">
              </div>
              <div class="col-sm-12 col-md-6">
                <label for="">Edad:</label>
                <select name="edad" required id="" class="form-control">
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
              <div class="col-sm-12 col-md-6">
                <label for="">Nivel De Escolaridad:</label>
                <select name="escolaridad" required id="" class="form-control">
                  <option value="">-Seleccione opción--</option>
                  <option value="primaria">Primaria</option>
                  <option value="secundaria">Secundaria</option>
                  <option value="técnico">Técnico</option>
                  <option value="profesional">Profesional</option>
                  <option value="N/A">N/A</option>
                  <option value="sin información">Sin información</option>
                </select>
              </div>
              <div class="col-sm-12 col-md-6">
                <label for="">Cargo:</label>
                <select name="cargo" required id="" class="form-control">
                  <option value="">-Seleccione opción--</option>
                  <option value="Publica">Publica</option>
                  <option value="Privada">Privada</option>
                  <option value="ONG">ONG</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <label for="">Sexo:</label>
                <select name="sexo" required id="" class="form-control">
                  <option value="">-Seleccione opción--</option>
                  <option value="Masculino">Masculino</option>
                  <option value="Femenino">Femenino</option>
                  <option value="ONG">ONG</option>
                </select>
              </div>
              <div class="col-sm-12 col-md-6">
                <label for="">Ubicacion:</label>
                <select name="ubicacion" required id="" class="form-control">
                  <option value="">-Seleccione opción--</option>
                  <option value="Urbano">Urbano</option>
                  <option value="Rural">Rural</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <label for="">Etina:</label>
                <select onchange="otherRaza()" name="etnia" id="raza" class="form-control">
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
                <input type="text" class="form-control" name="etnia_otro">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-12 col-md-6">
                <label for="">Archivo:</label>
                <input required type="file" class="form-control" name="archivo">
              </div>
              <div class="col-sm-12 col-md-6">
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
            <div style="display: flex;justify-content: space-around;">
              <button type="submit" class="btn btn-success btn-md">Guardar</button>
            </div>
          </form>
        </div>
      </div>
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
</script>