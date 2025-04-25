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

$municipios = ControladorMunicipios::ctrMostrarMunicipiosAll();
$totalMunicipios = count($municipios);

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
$totalUsuarios = count($usuarios);



?>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
   
      <p>Seguimiento</p>
    
    </div>
    
    <div class="icon">
    
      <i class="fa fa-university"></i>
    
    </div>
    
    <a href="dashboard" class="small-box-footer">
      
      <p>Dashboard para realizar seguimiento al avance de tareas </p><i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
       <p>Reportes</p>
  
    </div>
    
    <div class="icon">
    
      <i class="fa fa-file"></i>
    
    </div>
    
    <a href="reportes1" class="small-box-footer">

      <p>Permite generar reportes derivados de la información del sistema.</p> <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>
