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
            <img src="../../logo/vitarisk.png" alt="Logo">
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
                <h1>Maintenance</h1>
            </div>
            <div class="header-right">
                
                <div class="user-profile">
                    
                    <span>Usuario Técnico</span>
                </div>
            </div>
        </div>

    <script src="../../js/sidebar.js"></script>
</body>
</html>
