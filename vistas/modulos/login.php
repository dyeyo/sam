<div id="back"></div>

<div class="login-box">
  
  <div class="login-logo">

   

  </div>

  <div class="login-box-body">


    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" autofocus="" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword"  required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
       

      <div class="row">
       
        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary">Ingresar</button>
        
        </div>

      </div>

      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
        
      ?>

    </form>

  </div>

</div>
