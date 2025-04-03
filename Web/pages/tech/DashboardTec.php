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
      <img src="../../logo/vitarisk.png" alt="Logo">
    </div>
    <ul class="sidebar-menu" id="sidebar-menu">
      <!-- Menú generado dinámicamente -->
    </ul>
    <div class="logout-btn">
      <button id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</button>
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
        <h1>Técnico</h1>
      </div>
      <div class="header-right">
        <div class="user-profile">
          <img src="https://via.placeholder.com/40" alt="User">
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

  <script>
    document.getElementById('logoutBtn').addEventListener('click', function() {
      window.location.href = "logout.php";
    });
  </script>
  <script src="../../js/sidebar.js"></script>

</body>
</html>
