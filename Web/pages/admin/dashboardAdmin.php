<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard con Sidebar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/dashboard.css">

    <style>
            .content img {
      display: block;
      margin: 20px auto;
      max-width: 100%;
      height: auto;
      border-radius: 10%;
      width: 500px;
    }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../../logo/vitarisk.png" alt="Logo" style="border-radius: 50%;">
            <h2></h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboardAdmin.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="equipment.php"><i class="fas fa-tools"></i> Equipamiento</a></li>
            <li><a href="hospital.php"><i class="fas fa-history"></i> Hospital</a></li>
            <li><a href="../../logout.php" onclick="return confirm('¿Estás seguro de cerrar sesión?')"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
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
                <h1>Administrador</h1>
            </div>
            <div class="header-right">
                <div class="notification">
                </div>
            </div>
        </div>

        <div class="content">
      <h2>Bienvenido, Administrador</h2>
      <p>La gestión inteligente de equipos médicos comienza contigo.</p>
      <img src="../../images/admin.png" alt="Técnico">
    </div>
  </div>

    <script>        // Menú móvil
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>
