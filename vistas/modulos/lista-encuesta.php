<div class="content-wrapper">
  <section class="content">
    <div class="box container">
      <div class="card">
        <div class="card-title">
          <h3>Encuesta</h3>
        </div>
        <div class="card-body">
          <form id="formEncuesta" method="POST" enctype="multipart/form-data">
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
                <label for="">Edad:</label>
                <select name="edad" required id="" class="form-control">
                  <option value="">-Seleccione opción--</option>
                  <option value="Menor a 18">Menor a 18</option>
                  <option value="10 a 24">10 a 24</option>
                  <option value="25 a 34">25 a 34</option>
                  <option value="35 a 44">35 a 44</option>
                  <option value="45 a 54">45 a 54</option>
                  <option value="Mas de 54">Mas de 54</option>
                </select>
              </div>
              <div class="col-sm-12 col-md-6">
                <label for="">Sexo:</label>
                <select name="sexo" required id="" class="form-control">
                  <option value="">-Seleccione opción--</option>
                  <option value="Masculino">Masculino</option>
                  <option value="Femenino">Femenino</option>
                  <option value="ONG">ONG</option>
                </select>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <label for="">Ubicacion:</label>
                <select name="ubicacion" required id="" class="form-control">
                  <option value="">-Seleccione opción--</option>
                  <option value="Urbano">Urbano</option>
                  <option value="Rural">Rural</option>
                </select>
              </div>
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
            </div>
            <div style="display: flex;justify-content: space-around;">
              <button type="button" id="btnFiltrar" class="btn btn-success btn-md">Buscar</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <table class="table table-bordered" id="tabla-resultados">
            <thead>
              <tr>
                <th>Etnia</th>
                <th>Sexo</th>
                <th>Edad</th>
                <th>Departamento</th>
                <th>Municipio</th>
                <th># Personas</th>
              </tr>
            </thead>
            <tbody>
              <!-- Resultados por PHP o JS -->
            </tbody>
          </table>
        </div>
      </div>
  </section>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

  $('#btnFiltrar').on('click', function () {
    const formData = $('#formEncuesta').serialize();

    $.ajax({
      url: 'controladores/lista-encuesta.controlador.php',
      type: 'POST',
      data: formData,
      success: function (response) {
        let data = JSON.parse(response)
        const tbody = document.querySelector("#tabla-resultados tbody");
        tbody.innerHTML = "";
        data.forEach(item => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
            <td>${item.etnia}</td>
            <td>${item.sexo}</td>
            <td>${item.edad}</td>
            <td>${item.departamentos.nombre}</td>
            <td>${item.municipio_id}</td>
            <td>${item.total}</td>
          `;
          tbody.appendChild(tr);
        });
      },
      error: function () {
        alert('Ocurrió un error al procesar la encuesta.');
      }
    });
  });
</script>