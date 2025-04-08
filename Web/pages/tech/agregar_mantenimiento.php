<?php
// agregar_mantenimiento.php

// Si se envía el formulario, procesamos la información (en este ejemplo, solo se simula la acción)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aquí se insertaría la lógica para almacenar el nuevo mantenimiento en la base de datos.
    $hospital   = $_POST['hospital'] ?? '';
    $equipo     = $_POST['equipo'] ?? '';
    $fecha      = $_POST['fecha'] ?? '';
    $prioridad  = $_POST['prioridad'] ?? '';
    $notas      = $_POST['notas'] ?? '';

    // Simulación de inserción exitosa.
    $mensaje = "Mantenimiento agregado correctamente.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Mantenimiento</title>
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
    }
    h2 {
      margin-bottom: 20px;
      color: #1D5E69;
      text-align: center;
    }
    form {
      display: flex;
      flex-direction: column;
    }
    form label {
      margin-bottom: 5px;
      font-weight: 500;
    }
    form input, form select, form textarea {
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .btn {
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1em;
    }
    .btn-submit {
      background-color: #5cb85c;
      color: #fff;
      width: 100%;
      margin-bottom: 15px;
    }
    .btn-back {
      background-color: #1D5E69;
      color: #fff;
      text-decoration: none;
      text-align: center;
      display: block;
      padding: 10px;
      border-radius: 4px;
    }
    .mensaje {
      background-color: #dff0d8;
      color: #3c763d;
      padding: 10px;
      border-radius: 4px;
      margin-bottom: 15px;
      text-align: center;
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
    <h1>Agregar Mantenimiento</h1>
  </div>
  
  <div class="container">
    <h2>Nuevo Mantenimiento</h2>
    <?php if(isset($mensaje)) : ?>
      <div class="mensaje"><?php echo $mensaje; ?></div>
    <?php endif; ?>
    <form action="agregar_mantenimiento.php" method="post">
      <label for="hospital">Hospital:</label>
      <input type="text" name="hospital" id="hospital" required>

      <label for="equipo">Equipo:</label>
      <input type="text" name="equipo" id="equipo" required>

      <label for="fecha">Fecha:</label>
      <input type="date" name="fecha" id="fecha" required>

      <label for="prioridad">Prioridad:</label>
      <select name="prioridad" id="prioridad" required>
        <option value="high">Alta</option>
        <option value="medium">Media</option>
        <option value="low">Baja</option>
      </select>

      <label for="notas">Notas:</label>
      <textarea name="notas" id="notas" rows="4" required></textarea>

      <button type="submit" class="btn btn-submit">Agregar</button>
    </form>
    <a href="maintenance.php" class="btn-back">Regresar a Mantenimientos</a>
  </div>
</body>
</html>
