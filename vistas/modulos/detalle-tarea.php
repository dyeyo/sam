<?php

if($_SESSION["perfil"] == "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'obtenerDetalle':
            TareasController::obtenerDetalle();
            break;
        default:
            http_response_code(404);
            echo json_encode(['error' => 'Acción no encontrada']);
            break;
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'No se proporcionó ninguna acción']);
}
?>
<div>
  <h1>asd</h1>
</div>



