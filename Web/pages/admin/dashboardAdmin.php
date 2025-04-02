<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard con Sidebar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
        <img src="../../images/vita" alt="Logo" style="border-radius: 50%;">
            <h2>VitalRisk</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboardAdmin.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="mantenimiento.php"><i class="fas fa-tools"></i> Maintenance</a></li>
            <li><a href="historial.php"><i class="fas fa-history"></i> History</a></li>
            <li><a href="../../logout.php" onclick="return confirm('¿Estás seguro de cerrar sesión?')"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
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
                <div class="user-profile">
                    <span>Usuario Administrador</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>¡Bienvenido al sistema VitalRisk!</h2>
            <p>Seleccione una opción del menú para continuar</p>
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