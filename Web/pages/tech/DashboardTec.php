<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Técnico</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../../css/dashboard.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      font-family: 'Montserrat', sans-serif;
    }
    .content img {
      display: block;
      margin: 20px auto;
      max-width: 100%;
      height: auto;
      border-radius: 10%;
      width: 450px;
    }

  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <img src="../../logo/vitarisk.png" alt="Logo">
    </div>
    <ul class="sidebar-menu">
    <li><a href="DashboardTec.php"><i class="fas fa-home"></i> Inicio</a></li>
    <li><a href="crear_reporte.php"><i class="fas fa-users"></i> Generar reporte</a></li>
    <li><a href="hospital.php"><i class="fas fa-hospital"></i> Hospitales</a></li>
    <li><a href="maintenance.php"><i class="fas fa-tools"></i> Mantenimiento</a></li>
    <li><a href="company.php"><i class="fas fa-building"></i>Empresas</a></li>
    <li><a href="equipment.php"><i class="fas fa-laptop-medical"></i>Equipos</a></li>
    <li><a href="https://drive.google.com/drive/folders/1k3gWuIPc31SIB2A0FGoBuh_SX_AAwbyJ?usp=sharing" target="_blank">
    <i class="fas fa-file"></i> Archivos</a>
</ul>

    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header">
      <div class="header-left">
        <div class="menu-toggle">
          <i class="fas fa-bars"></i>
        </div>
        <h1>Dashboard</h1>
      </div>
      <div class="header-right">
        <div class="user-profile">
          <span>Usuario Técnico</span>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="content">
      <h2>Bienvenido, Técnico</h2>
      <p>Tu experiencia mantiene la precisión y confiabilidad de cada equipo médico. ¡Gracias por tu trabajo!</p>
      <img src="../../images/tecnico.png" alt="Técnico">
    </div>
  </div>


</body>
</html>
