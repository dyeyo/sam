<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="content-wrapper">
    <section class="content-header">
        
        <h1>
        
        Dashboard estado de avance
        
        </h1>

        <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
        <li class="active">Dashboard estado de avance</li>
        
        </ol>

    </section>

    <div class="container">
        <?php  $donante = ControladorDonantes::ctrMostrarDonantes('','') ?>
        <?php foreach ($donante as $d): ?>
            <a onclick="cargarDatos(<?php echo($d['id']); ?>)"class="btn btn-primary"><?php echo($d['categoria']); ?></a>
        <?php endforeach; ?>
        <br>
        <canvas id="graficaTorta"></canvas>
    </div>
</div>
<script>
    // Inicializar gráfica vacía
    const ctx = document.getElementById('graficaTorta').getContext('2d');
    const centerTextPlugin = {
        id: 'centerText',
        beforeDraw(chart) {
            const { ctx, width, height, data } = chart;
            ctx.save();
            ctx.font = 'bold 20px Arial';
            ctx.fillStyle = '#000';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            const anio = data.anio; 
            ctx.fillText(anio, width / 2, height / 2); 
            ctx.restore();
        }
    };
    const chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [], // Etiquetas vacías inicialmente
            datasets: [{
                label: 'Actividades',
                data: [], // Datos vacíos inicialmente
                backgroundColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 206, 86)',
                    'rgba(103, 224, 174)',
                ],
                borderColor: [
                    'rgba(255, 99, 132)',
                    'rgba(255, 206, 86)',
                    'rgba(200, 243, 200)',
                ],
                borderWidth: 1
            }],
            anio: '' 
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        },
        plugins: [centerTextPlugin]
    });

    function showDona(){
        document.getElementById('grafica').style.display = "block";
    }
    async function cargarDatos(id) {
        try {
            const response = await fetch(`ajax/grafica.ajax.php?categoria=${id}`);
            const data = await response.json();
            chart.data.labels = data.labels;
            chart.data.datasets[0].data = data.values;
            chart.data.anio = data.anio[0].anio;
            chart.update();
        } catch (error) {
            console.error('Error al cargar datos:', error);
        }
    }
</script>
   
  </section>
 <style>
    #grafica{
        display:none;
    }
    canvas{
        margin-left: 20em !important;
        height: 700px !important;
        width: 700px !important;
    }
 </style>
