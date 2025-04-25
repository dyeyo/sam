<?php

$item = null;
$valor = null;

$actividades = ControladorActividades::ctrMostrarActividades($item, $valor);
$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

$arrayActividades = array();
$arraylistaActividades = array();

foreach ($actividades as $key => $valueActividades) {

  foreach ($usuarios as $key => $valueUsuarios) {

    if($valueUsuarios["id"] == $valueActividades["id"]){

        #Capturamos los vendedores en un array
        array_push($arrayActividades, $valueUsuarios["nombre"]);

        #Capturamos las nombres y los valores netos en un mismo array
        $arraylistaActividades = array($valueUsuarios["id"] => $valueActividades["avance"]);

         #Sumamos los netos de cada vendedor

        foreach ($arraylistaActividades as $key => $value) {

         
         }

    }
  
  }

}

#Evitamos repetir nombre
$noRepetirNombres = array_unique($arrayActividades);

?>


<!--=====================================
VENDEDORES
======================================-->

<div class="box box-success">
	
	<div class="box-header with-border">
    
    	<h3 class="box-title">Actividades</h3>
  
  	</div>

  	<div class="box-body">
  		
		<div class="chart-responsive">
			
    <button onclick="cargarDatos('funcion1')">Datos 1</button>
    <button onclick="cargarDatos('funcion2')">Datos 2</button>
    <button onclick="cargarDatos('funcion3')">Datos 3</button>

    <!-- Canvas para la gráfica -->
    <canvas id="graficaTorta"></canvas>

  

		</div>

  	</div>

</div>

<script>
        // Inicializar gráfica vacía
        const ctx = document.getElementById('graficaTorta').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [], // Etiquetas vacías inicialmente
                datasets: [{
                    label: 'Dataset',
                    data: [], // Datos vacíos inicialmente
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });

        // Función para cargar datos desde PHP
        async function cargarDatos(funcion) {
            try {
                const response = await fetch(`controlador.php?funcion=${funcion}`);
                const data = await response.json();
                
                // Actualizar la gráfica con los datos recibidos
                chart.data.labels = data.labels;
                chart.data.datasets[0].data = data.values;
                chart.update();
            } catch (error) {
                console.error('Error al cargar datos:', error);
            }
        }
    </script>