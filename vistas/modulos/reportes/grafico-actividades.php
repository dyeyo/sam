<?php

error_reporting(0);

if(isset($_GET["fechaInicial"])){

    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];

}else{

$fechaInicial = null;
$fechaFinal = null;

}

$respuesta = ControladorActividades::ctrRangoFechasActividades($fechaInicial, $fechaFinal);

$arrayFechas = array();
$arrayVentas = array();
$sumaPagosMes = array();

foreach ($respuesta as $key => $value) {

	#Capturamos sólo el año y el mes
	$fecha = substr($value["fecha"],0,7);

	#Introducir las fechas en arrayFechas
	array_push($arrayFechas, $fecha);

	#Capturamos las ventas
	$arrayActividades = array($fecha => $value["id"]);

	#Sumamos los pagos que ocurrieron el mismo mes
	foreach ($arrayActividades as $key => $value) {
		
		$suma[$key] += $value;
	}

}


$noRepetirFechas = array_unique($arrayFechas);


?>

<!--=====================================
GRÁFICO DE VENTAS
======================================-->


<div class="box box-solid bg-teal-gradient">
	
	<div class="box-header">
		
 		<i class="fa fa-th"></i>

  		<h3 class="box-title">Gráfico</h3>

	</div>

	<div class="box-body border-radius-none nuevoGraficoActividades">

		<div class="chart" id="line-chart-actividades" style="height: 750px;"></div>

  </div>

</div>

<script>
	
 var line = new Morris.Bar({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [

    <?php

    if($noRepetirFechas != null){

	    foreach($noRepetirFechas as $key){

	    	echo "{ y: '".$key."', actividades: ".$suma[$key]." },";


	    }

	    echo "{y: '".$key."', actividades: ".$suma[$key]." }";

    }else{

       echo "{ y: '0', actividades: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['actividades'],
    labels           : ['actividades'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 10
  });

</script>