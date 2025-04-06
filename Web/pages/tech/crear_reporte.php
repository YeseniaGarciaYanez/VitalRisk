<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generar Reporte de Mantenimiento</title>
  
  <!-- Importar tipografía Montserrat desde Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 900px;
      margin: auto;
      background-color: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      margin-top: 40px;
    }

    h2 {
      text-align: center;
      color: #1a73e8;
      font-size: 28px;
      font-weight: 700;
    }

    .logo {
      display: block;
      margin: 0 auto;
      width: 200px;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-spacing: 0;
    }

    th, td {
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #1a73e8;
      color: white;
      font-weight: bold;
    }

    td {
      border: 1px solid #ccc;
      background-color: #f9f9f9;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #333;
    }

    input[type="text"],
    input[type="date"],
    textarea {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }

    textarea {
      height: 120px;
      resize: vertical;
    }

    .button {
      background-color: #1a73e8;
      color: white;
      border: none;
      padding: 14px 28px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
      width: 100%;
    }

    .button:hover {
      background-color: #155ab6;
    }

    .footer {
      text-align: center;
      margin-top: 40px;
      font-size: 12px;
      color: #777;
    }

  </style>
</head>
<body>
  <!-- Logo -->
  <img src="../../logo/logovital2.png" class="logo" alt="VitalRisk">

  <div class="container">
    <h2>Formulario de Reporte de Mantenimiento</h2>
    <form action="procesar_reporte.php" method="POST">
      <table>
        <tr>
          <th colspan="2">Datos del Reporte</th>
        </tr>
        <tr>
          <td><label for="equipo">Nombre del equipo</label></td>
          <td><input type="text" name="equipo" id="equipo" required></td>
        </tr>
        <tr>
          <td><label for="equipo_id">ID del equipo</label></td>
          <td><input type="text" name="equipo_id" id="equipo_id" required></td>
        </tr>
        <tr>
          <td><label for="ubicacion">Ubicación del equipo</label></td>
          <td><input type="text" name="ubicacion" id="ubicacion" required></td>
        </tr>
        <tr>
          <td><label for="tecnico">Nombre del técnico responsable</label></td>
          <td><input type="text" name="tecnico" id="tecnico" required></td>
        </tr>
        <tr>
          <td><label for="detalles">Detalles del mantenimiento</label></td>
          <td><textarea name="detalles" id="detalles" placeholder="Ej: Revisión general, calibración, cambio de piezas..." required></textarea></td>
        </tr>
        <tr>
          <td><label for="observaciones">Observaciones del técnico</label></td>
          <td><textarea name="observaciones" id="observaciones" required></textarea></td>
        </tr>
        <tr>
          <td><label for="recomendaciones">Recomendaciones para el cliente</label></td>
          <td><textarea name="recomendaciones" id="recomendaciones" required></textarea></td>
        </tr>
      </table>

      <button class="button" type="submit">📄 Generar Reporte y Subir a Drive</button>
    </form>
  </div>

  <!-- Pie de página -->
  <div class="footer">
    <p>VitalRisk - Sistema de Mantenimiento de Equipos Médicos</p>
  </div>
</body>
</html>
