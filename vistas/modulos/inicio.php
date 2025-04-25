<?php
header('Content-Type: text/html; charset=utf-8');
?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Tablero
      <small>Panel de Control</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Tablero</li>
    </ol>
  </section>

  <section class="content">

    <div class="row">
      <?php
      if (isset($_SESSION["perfil"]) && $_SESSION["perfil"] == "Administrador") {
          include "inicio/cajas-superiores.php";

      }
      if (isset($_SESSION["perfil"]) && $_SESSION["perfil"] == "Digitador") {
          include "inicio/cajas-superiores1.php";
          
      }
      if (isset($_SESSION["perfil"]) && $_SESSION["perfil"] == "Validador") {
          include "inicio/cajas-superiores2.php";
          
      }
      if (isset($_SESSION["perfil"]) && $_SESSION["perfil"] == "Gerencia") {
          include "inicio/cajas-superiores3.php";
          
      }
      ?>
    </div> 

     <div class="row">
       
        <div class="col-lg-12">

          

        </div>

         <div class="col-lg-12">
           
          <?php

          if($_SESSION["perfil"] =="Administrador" || $_SESSION["perfil"] =="Digitador"){

             echo '<div class="box box-success">

             <div class="box-header">

             <h1>Usuario en linea: ' .$_SESSION["nombre"].'</h1>

             </div>

             </div>';

          }

          ?>

         </div>

     </div>

  </section>
 
</div>