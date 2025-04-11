<?php
// eliminar_mantenimiento.php

// Se espera que la eliminación se haga mediante un formulario POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aquí agregarías la lógica para eliminar el mantenimiento de la base de datos.
    $equipo = $_POST['equipo'] ?? '';
    $mensaje = "Mantenimiento del equipo '$equipo' eliminado correctamente.";
} else {
    $mensaje = "Acción no permitida.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eliminar Mantenimiento</title>
  <!-- Tipografía Montserrat -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Montserrat', sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .header {
      background-color: #1D5E69;
      color: #fff;
      width: 100%;
      padding: 15px 20px;
      display: flex;
      align-items: center;
    }
    .header img {
      height: 40px;
      margin-right: 15px;
    }
    .header h1 {
      font-size: 1.5em;
      margin: 0;
    }
    .container {
      background: #fff;
      width: 90%;
      max-width: 600px;
      margin: 30px 0;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
      text-align: center;
    }
    h2 {
      margin-bottom: 20px;
      color: #1D5E69;
    }
    .mensaje {
      background-color: #f2dede;
      color: #a94442;
      padding: 10px;
      border-radius: 4px;
      margin-bottom: 15px;
    }
    .btn-back {
      background-color: #1D5E69;
      color: #fff;
      text-decoration: none;
      display: inline-block;
      padding: 10px 15px;
      border-radius: 4px;
      margin-top: 15px;
    }
    @media (max-width: 600px) {
      .container {
        margin: 15px;
        padding: 20px;
      }
      .header {
        flex-direction: column;
        text-align: center;
      }
      .header img {
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>
  <!-- Encabezado con logo -->
  <div class="header">
    <img src="../../Logo/vitalrisk.png" alt="Vitalrisk Logo">
    <h1>Eliminar Mantenimiento</h1>
  </div>
  
  <div class="container">
    <h2>Eliminar Registro</h2>
    <div class="mensaje"><?php echo $mensaje; ?></div>
    <a href="maintenance.php" class="btn-back">Regresar a Mantenimientos</a>
  </div>
</body>
</html>
