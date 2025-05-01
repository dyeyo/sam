<div class="content-wrapper">
  <section class="content">
    <div class="box container">
      <div class="card">
        <div class="card-title"
          style="display: flex;flex-direction: row;justify-content: space-between;align-items: center;">
          <h3>Encuesta</h3>
          <div>
            <a href="encuesta" class="btn btn-primary">Crear encuesta</a>
          </div>
        </div>
        </br>
        <div class="card-body">
          <form id="formEncuesta" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <label for="">Programa:</label>
                <select name="programa" required id="" class="form-control">
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
                  <option value="Otro Cual">Otro</option>
                </select>
              </div>
            </div>
            <br>
            <div style="display: flex;justify-content: center;gap: 10px;" class="mt-3">
              <button type="button" id="limpiar" class="btn btn-default btn-md">Limpiar</button>
              <button type="button" id="btnFiltrar" onclick="getData()" class="btn btn-success btn-md">Buscar</button>
            </div>
          </form>
        </div>
      </div>
      <div class="card">
        <button onclick="descargarPDF()" class="btn btn-primary" style="float: inline-end;">Descargar PDF</button>
        <div class="card-body">
          <div id="seccionTable">
            <h2>Resultado de Encuestas</h2>
            <h3 id="total"> </h3>
            <table class="table table-bordered table-striped dt-responsive tablas tabla-resultados" width="100%">
              <thead>
                <tr>
                  <th>Nombre completo</th>
                  <th>Etnia</th>
                  <th>Sexo</th>
                  <th>Edad</th>
                  <th>Departamento</th>
                  <th>Municipio</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

          <div class="card-body" id="seccionPDF" style="display: none;">
            <h2>Resultado de Encuestas</h2>
            <p>Total registros: <strong id="total2"></strong></p>
            <div class="row">
              <div class="col-12">
                <table class="table table-bordered table-striped dt-responsive  tabla2-resultados" width="100%">
                  <thead>
                    <tr>
                      <th>Nombre completo</th>
                      <th>Etnia</th>
                      <th>Sexo</th>
                      <th>Edad</th>
                      <th>Departamento</th>
                      <th>Municipio</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
  </section>
</div>

<style>
  #seccionPDF {
    font-family: Arial, sans-serif;
    font-size: 18px;
    padding: 20px;
    color: #333;
    background: white;
    width: 100%;
  }

  h2 {
    text-align: center;
    font-size: 28px;
    margin-bottom: 20px;
  }

  #seccionPDF table {
    width: 100%;
    border-collapse: collapse;
  }

  #seccionPDF th,
  #seccionPDF td {
    border: 1px solid #999;
    padding: 8px;
    text-align: center;
    font-size: 16px;
  }

  #seccionPDF th {
    background-color: #eee;
  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
  $(document).ready(function () {
    getData();
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

  $('#limpiar').on('click', function () {
    const selects = document.querySelectorAll('select');
    selects.forEach(select => {
      select.selectedIndex = 0;
    });
  })

  function getData() {
    const formData = $('#formEncuesta').serialize();
    $.ajax({
      url: 'controladores/lista-encuesta.controlador.php',
      type: 'POST',
      data: formData,
      success: function (response) {
        let res = JSON.parse(response);
        let total = res.total_registros;
        document.getElementById("total").textContent = 'Total registros: ' + total;
        document.getElementById("total2").textContent =  total;
        const tbody = document.querySelector(".tabla-resultados tbody");
        const tbody2 = document.querySelector(".tabla2-resultados tbody");
        tbody.innerHTML = "";
        tbody2.innerHTML = "";
        res.data.forEach(item => {
          const tr = document.createElement("tr");
          const tr2 = document.createElement("tr");
          tr.innerHTML = `
            <td>${item.nombre}</td>
            <td>${item.etnia}</td>
            <td>${item.sexo}</td>
            <td>${item.edad}</td>
            <td>${item.nombre_departamento}</td>
            <td>${item.nombre_municipio}</td>
          `;
          tbody.appendChild(tr);
          tr2.innerHTML = `
            <td>${item.nombre}</td>
            <td>${item.etnia}</td>
            <td>${item.sexo}</td>
            <td>${item.edad}</td>
            <td>${item.nombre_departamento}</td>
            <td>${item.nombre_municipio}</td>
          `;
          tbody.appendChild(tr);
          tbody2.appendChild(tr2);
        });
      },
      error: function () {
        alert('Ocurrió un error al procesar la encuesta.');
      }
    });

  };

  async function descargarPDF() {
    const { jsPDF } = window.jspdf;
    const seccion = document.getElementById('seccionPDF');
    const tabla = document.getElementById('seccionTable');
    seccion.style.display = "block"
    tabla.style.display = "none"
    const canvas = await html2canvas(seccion, { scale: 5 }); // escala x2
    const imgData = canvas.toDataURL('image/png');
    const pdf = new jsPDF();
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = (canvas.height * pdfWidth) / canvas.width;
    pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
    const now = new Date(Date.now());
    const day = now.getDate();
    const month = now.getMonth() + 1;
    const year = now.getFullYear();
    tabla.style.display = "block"
    seccion.style.display = "none"
    pdf.save(`Resumen de Encuestas ${day}/${month}/${year}.pdf`);
  }
</script>