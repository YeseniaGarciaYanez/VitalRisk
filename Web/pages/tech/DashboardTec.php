<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard con Sidebar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* Se fuerza el uso de Montserrat para que quede igual */
    * {
      font-family: 'Montserrat', sans-serif;
    }
    .content img {
      display: block;
      margin: 20px auto;
      max-width: 100%;
      height: auto;
    }
    /* Estilo para el botón de logout */
    .logout-btn {
      position: absolute;
      bottom: 20px;
      width: 100%;
      text-align: center;
    }
    .logout-btn button {
      background-color: var(--primary-color);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1rem;
    }
    .logout-btn button:hover {
      background-color: var(--hover-color);
    }
  </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../../Logo/vitarisk.png" alt="Logo">
        </div>
        <ul class="sidebar-menu" id="sidebar-menu">
            <!-- Menú generado dinámicamente -->
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <h1>Technician</h1>
            </div>
            <div class="header-right">
                <div class="notification">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">5</span>
                </div>
                <div class="user-profile">
                    <img src="https://via.placeholder.com/40" alt="User">
                    <span>Usuario Técnico</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>"Bienvenido, Técnico. Tu experiencia mantiene la precisión y confiabilidad de cada equipo médico. ¡Gracias por tu trabajo!"</h2>
            <p>Todo listo para optimizar el rendimiento de los equipos médicos. Selecciona una opción para comenzar.</p>
            <img src="../../images/tecnico.png" alt="tecnico" style="border-radius: 10%; width: 450px; height: auto;">
        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
</body>
</html>