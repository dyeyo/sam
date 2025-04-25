<div id="back"></div>

<div class="login-box">
  <div class="login-logo">
  </div>
  <div class="login-box-body">
  <form method="post" action="">
  <div class="form-group has-feedback">
    <label for="">Correo electronico</label>
    <input type="email" class="form-control" placeholder="Correo electronico" name="email" required>
  </div>
  <div class="form-group has-feedback">
    <label for="">Contraseña actual</label>
    <input type="password" class="form-control" placeholder="Contraseña actual" name="ingPassword" required>
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <label for="">Nueva contraseña</label>
    <input type="password" class="form-control" placeholder="Nueva contraseña" name="newPassword" required>
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="row">
    <div class="col-xs-4">
      <button type="submit" class="btn btn-primary">Actualizar contraseña</button>
    </div>
  </div>
</form>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $changepass = new ControladorUsuarios();
    $changepass->ctrChangePass();
  }
?>



  </div>

</div>
