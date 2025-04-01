<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Se actualizó la ruta al CSS -->
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
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <!-- Se actualizó la ruta del logo y se mantiene el estilo -->
      <img src="../../Logo/vitarisk.png" alt="Logo" style="border-radius: 50%;">
      <h2>VitalRisk</h2>
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
        <!-- Se conserva "Dashboard" para que coincida con el contenido original -->
        <h1>Dashboard</h1>
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
      <!-- Se actualizó la ruta de la imagen -->
      <img src="../../images/tecnico.png" alt="tecnico" style="border-radius: 10%; width: 450px; height: auto;">
    </div>
  </div>

  <!-- Script para generar el menú lateral -->
  <script>
    const userType = "tecnico";
    const menus = {
      "tecnico": [
        { "icon": "fas fa-tools", "name": "Maintenance" },
        { "icon": "fas fa-box-open", "name": "Inventory" },
        { "icon": "fas fa-file", "name": "Files" },
        { "icon": "fas fa-folder", "name": "Reports" }
      ]
    };

    const sidebarMenu = document.getElementById("sidebar-menu");

    menus[userType].forEach(menu => {
      let li = document.createElement("li");
      li.innerHTML = `<i class="${menu.icon}"></i> ${menu.name}`;
      sidebarMenu.appendChild(li);
    });

    document.querySelector('.menu-toggle').addEventListener('click', function() {
      document.querySelector('.sidebar').classList.toggle('active');
    });
  </script>
  <!-- Si prefieres usar un archivo externo para el JS, descomenta la siguiente línea y asegúrate de tener el archivo en la ruta indicada -->
  <!-- <script src="../../js/sidebar.js"></script> -->
</body>
</html>
