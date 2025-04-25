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
			
			<div class="chart" id="bar-chart1" style="height: 300px;"></div>
      <div class="chart" id="bar-chart1" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart1',
  resize: true,
  data: [

  <?php
    
    foreach($noRepetirNombres as $value){

      echo "{y: '".$value."', a: '".$suma[$value]."'},";

    }

  ?>
  ],
  barColors: ['#0af'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['actividades'],
  preUnits: '$',
  hideHover: 'auto'
});


</script>