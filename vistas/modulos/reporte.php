<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">
  <section class="content-header">
    
    <h1>
      
      INFORME DE AVANCES ENTREGADOS
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">INFORME DE AVANCES ENTREGADOS</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="input-group">

          <button type="button" class="btn btn-default" id="daterange-btn2">
           
           

           

          </button>

        </div>

        <div class="box-tools pull-right">

        <?php

        if(isset($_GET["fechaInicial"])){

          echo '<a href="vistas/modulos/descargar-reporte1.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

        }else{

           echo '<a href="vistas/modulos/descargar-reporte1.php?reporte=reporte">';

        }         

        ?>
           
           <button class="btn btn-success" style="margin-top:5px">Descargar reporte en Excel</button>

          </a>

        </div>
         
      </div>
  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Id</th>
           <th>Actividad</th>
           <th>Cantidad</th>
           <th>Aporte</th>
           <th>Avance</th>
          <th>INFO</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $actividades = ControladorActividades::ctrMostrarActividades($item, $valor);

          foreach ($actividades as $key => $value) {
           echo $valor;
            echo ' <tr>
                     <td>'.($key+1).'</td>
                    <td class="text-uppercase">'.$value["actividad"].'</td>
                    <td class="text-uppercase">'.$value["nombre"].'</td>
                    <td class="text-uppercase">'.$value["cantidad"].'</td>
                    <td class="text-uppercase">'.$value["aporte"].'</td>
                    <td class="text-uppercase">'.$value["avance"].'</td>
                    <td>

                      <div class="btn-group">
                        
                         <button class="btn btn-warning btnEditarActividad" data-toggle="modal" data-target="#modalEditarActividad" id="'.$value["id"].'"><i class="fa fa-eye"></i></button>';

                        

                      echo '</div>  

                    </td>

                  </tr>';
          }

        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>





<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarActividad" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">AVANCE</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span>  

                <input type="number" readonly () min="0" class="form-control input-lg" class="form-control input-lg" name="editarActividad" id="editarActividad" required>
            <input type="hidden" id="id" name="id">

              </div>
              
            </div>

            <div class="form-group">
               <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <textarea class="form-control input-lg" name="editarNombre" readonly () id="editarNombre" placeholder="Ingresar identificador de la actividad" rows="6" style="width: 100%; overflow-y: auto;" required></textarea>

               </div>
            </div>

            <div class="form-group">

               <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="number" readonly () min="0" class="form-control input-lg" class="form-control input-lg" name="editarCantidad" id="editarCantidad" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" readonly () class="form-control input-lg" name="editarAporte" id="editarAporte" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                <input type="text" readonly () class="form-control input-lg" name="editarAvance" id="editarAvance" required>
           
              </div>
            </div>


  
          </div>

        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        
        </div>

      </form>
  

    </div>

  </div>

</div>




