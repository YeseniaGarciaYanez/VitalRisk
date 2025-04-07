<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generar Reporte de Mantenimiento</title>
  <!-- Importar tipografía Montserrat -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* Reset y configuración básica */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f2f2f2;
      color: #333;
      line-height: 1.6;
      display: flex;
      min-height: 100vh;
    }
    /* Contenedor principal sin sidebar */
    .wrapper {
      display: flex;
      flex: 1;
    }
    /* Contenido principal */
    .main-content {
      flex: 1;
      padding: 40px;
    }
    .container {
      max-width: 900px;
      margin: auto;
      background-color: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    header {
      text-align: center;
      margin-bottom: 30px;
    }
    header img {
      width: 150px;
      margin-bottom: 20px;
    }
    h2 {
      font-size: 32px;
      color: #23998E;
      margin-bottom: 20px;
    }
    form {
      width: 100%;
    }
    /* Secciones de formulario */
    .form-section {
      margin-bottom: 30px;
    }
    .form-section h3 {
      background-color: #23998E;
      color: #fff;
      padding: 10px 15px;
      border-radius: 8px 8px 0 0;
      font-size: 18px;
      margin-bottom: 15px;
    }
    .form-group {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      margin-bottom: 15px;
    }
    .form-group label {
      flex: 1 0 200px;
      font-weight: 600;
      padding-right: 10px;
    }
    .form-group input,
    .form-group textarea {
      flex: 2 0 300px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }
    .form-group textarea {
      resize: vertical;
      min-height: 100px;
    }
    .button-container {
      text-align: center;
      margin-top: 30px;
    }
    .button {
      background-color: #23998E;
      color: #fff;
      border: none;
      padding: 15px 30px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    .button:hover {
      background-color: #1D5e69;
    }
    .footer {
      text-align: center;
      margin-top: 40px;
      font-size: 12px;
      color: #777;
    }
    @media (max-width: 768px) {
      .wrapper {
        flex-direction: column;
      }
      .main-content {
        padding: 20px;
      }
      .form-group {
        flex-direction: column;
        align-items: flex-start;
      }
      .form-group label {
        margin-bottom: 5px;
      }
    }
    /* Ocultar elementos con la clase no-print al imprimir */
    @media print {
      .no-print {
        display: none !important;
      }
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <!-- Contenido principal sin sidebar -->
    <main class="main-content">
      <div class="container">
        <!-- Botón para ir al inicio del Técnico (no se imprimirá) -->
        <div class="no-print" style="margin-bottom: 20px;">
          <a href="DashboardTec.php" class="button" style="background-color: #1D5e69;">
            <i class="fas fa-home"></i>
          </a>
        </div>
        <header>
          <img src="../../logo/logovital2.png" alt="VitalRisk">
          <h2>Formulario de Reporte de Mantenimiento</h2>
        </header>
        <form action="procesar_reporte.php" method="POST">
          <section class="form-section">
            <h3>Datos del Reporte</h3>
            <div class="form-group">
              <label for="equipo">Nombre del equipo</label>
              <input type="text" name="equipo" id="equipo" required>
            </div>
            <div class="form-group">
              <label for="equipo_id">ID del equipo</label>
              <input type="text" name="equipo_id" id="equipo_id" required>
            </div>
            <div class="form-group">
              <label for="ubicacion">Ubicación del equipo</label>
              <input type="text" name="ubicacion" id="ubicacion" required>
            </div>
            <div class="form-group">
              <label for="tecnico">Nombre del técnico responsable</label>
              <input type="text" name="tecnico" id="tecnico" required>
            </div>
          </section>
          <section class="form-section">
            <h3>Detalles del Mantenimiento</h3>
            <div class="form-group">
              <label for="detalles">Detalles del mantenimiento</label>
              <textarea name="detalles" id="detalles" placeholder="Ej: Revisión general, calibración, cambio de piezas..." required></textarea>
            </div>
            <div class="form-group">
              <label for="observaciones">Observaciones del técnico</label>
              <textarea name="observaciones" id="observaciones" required></textarea>
            </div>
            <div class="form-group">
              <label for="recomendaciones">Recomendaciones para el cliente</label>
              <textarea name="recomendaciones" id="recomendaciones" required></textarea>
            </div>
          </section>
          <div class="button-container">
            <button class="button" type="submit">Generar Reporte</button>
          </div>
        </form>
      </div>
      <div class="footer">
        <p>VitalRisk - Sistema de Mantenimiento de Equipos Médicos</p>
      </div>
    </main>
  </div>
</body>
</html>
