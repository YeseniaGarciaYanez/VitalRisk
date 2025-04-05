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
    * {
      font-family: 'Montserrat', sans-serif;
    }

    .cliente-img {
        margin-top: 20px;
        display: flex;
        justify-content: center; /* Centrar la imagen horizontalmente */
        align-items: center;
    }

    .img-cliente {
        width: 100% !important; /* Asegura que la imagen crezca */
        max-width: 1000px !important; /* Tamaño máximo */
        height: auto !important;
        display: block;
    }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
        <img src="../../images/logovital2.png" alt="Logo" style="border-radius: 50%;">
            <h2>VitalRisk</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboardCliente.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li class="active"><a href="normativas.php"><i class="fas fa-file-alt"></i> Normativas</a></li>
            <li><a href="../../logout.php" onclick="return confirm('¿Estás seguro de cerrar sesión?')"> <i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
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
                <h1>Cliente</h1>
            </div>
            <div class="header-right">
                <div class="notification">
                </div>
                <div class="user-profile">
                    <span>Usuario</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
      <h2>Bienvenido a Vitalrisk</h2>
      <p>Con nuestro sistema, tus equipos médicos estarán siempre listos para salvar vidas. ¡Estamos contigo!</p>
      <div class="cliente-img">
        <img src="../../images/cliente.png" alt="Cliente" class="img-cliente">
    </div>
  </div>

    <script>
        // Menú móvil
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Cambiar ítem activo en el menú
        const menuItems = document.querySelectorAll('.sidebar-menu li');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                menuItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>