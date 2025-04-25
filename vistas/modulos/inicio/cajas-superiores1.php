<?php

$item = null;
$valor = null;
$orden = "id";

$result_numero = ControladorDonantes::ctrMostrarDonantes($item, $valor);


$actividades = ControladorActividades::ctrMostrarActividades($item, $valor);
$totalActividades = count($actividades);

$ejes = ControladorEjes::ctrMostrarEjes($item, $valor);
$totalEjes = count($ejes);

$donantes = ControladorDonantes::ctrMostrarDonantes($item, $valor);
$totalDonantes = count($donantes);

$departamentos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);
$totalDepartamentos = count($departamentos);

$municipios = ControladorMunicipios::ctrMostrarMunicipios($item, $valor);
$totalMunicipios = count($municipios);

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
$totalUsuarios = count($usuarios);



?>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">

    
    <div class="inner">
            
      <p>Tareas</p>
    
    </div>
    
    <div class="icon">
      
      <i class="fa fa-tasks"></i>
    
    </div>
    
    <a href="tareas" class="small-box-footer">
      
      <p>Consulta las actividades pendientes y carga los avances.</p> <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

