<aside class="main-sidebar">

   <section class="sidebar">

    <ul class="sidebar-menu">

    <?php

    if($_SESSION["perfil"] == "Administrador"){

      echo '<li class="active">

        <a href="inicio">

          <i class="fa fa-home"></i>
          <span>Inicio</span>

        </a>

      </li>';

      echo '<li class="active">

        <a href="lista-encuesta">

          <i class="fa fa-tasks"></i>
          <span>Encuesta</span>

        </a>

      </li>
      ';
    }

    if($_SESSION["perfil"] == "Administrador"){

      echo '<li class="treeview">

        <a href="#">

          <i class="fa fa-cog"></i>
          
          <span>Administrar</span>
          
          <span class="pull-right-container">
          
            <i class="fa fa-angle-left pull-right"></i>

          </span>

        </a>

        <ul class="treeview-menu">
          <a href="#">

          <li>
          <a href="usuarios">

            <i class="fa fa-user"></i>
            <span>Usuarios</span>
          </a>
          

          </li>


          <li>

            <a href="donantes">

            <i class="fa fa-university" aria-hidden="true"></i>
            <span>Donantes</span>

            </a>

          </li>
          <li>
          <a href="ejes">

          <i class="fa fa-anchor" aria-hidden="true"></i>
          <span>Ejes</span>

          </a>
          </li>

          <li>
          <a href="departamentos">

          <i class="fa fa-map-pin" aria-hidden="true"></i>
          <span>Departamentos</span>

          </a>
          </li>
          <li>
          <a href="municipios">

        <i class="fa fa-map-marker" aria-hidden="true"></i>
          <span>Municipios</span>

          </a>
          </li>

          <li>
          <a href="actividades">

          <i class="fa fa-tasks" aria-hidden="true"></i>
          <span>Actividades</span>

          </a>
          </li>

          <li>
          <a href="tipos">

          <i class="fa fa-bullseye" aria-hidden="true"></i>
          <span>Tipo de actividades</span>

          </a>
          </li>

          <li>
          

          </a>
          </li>
      ';

    }
    ?> 
   </section>

</aside>