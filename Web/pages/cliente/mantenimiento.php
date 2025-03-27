<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento - VitalRisk</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/mantenimiento.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Sidebar (copiado de tu dashboard) -->
    <div class="sidebar">
        <div class="sidebar-header">
        <img src="../../images/logovital2.png" alt="Logo" style="border-radius: 50%;">
            <h2>VitalRisk</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="mantenimiento.php"><i class="fas fa-tools"></i> Maintenance</a></li>
            <li><a href="historial.php"><i class="fas fa-history"></i> History</a></li>
            <li class="active"><a href="normativas.php"><i class="fas fa-file-alt"></i> Normativas</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header (copiado de tu dashboard) -->
        <div class="header">
            <div class="header-left">
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <h1>Cliente</h1>
            </div>
            <div class="header-right">
                <div class="notification">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">5</span>
                </div>
                <div class="user-profile">
                    <img src="https://via.placeholder.com/40" alt="User">
                    <span>Usuario</span>
                </div>
            </div>
        </div>

        <!-- Contenido dinámico -->
        <div class="content">
            <?php 
            $view = $_GET['view'] ?? 'current';
            if ($view === 'history'): ?>
                <!-- Vista de Historial -->
                <div class="maintenance-container">
                    <h2><i class="fas fa-history"></i> Historial de Mantenimientos</h2>
                    
                    <div class="maintenance-card">
                        <h3>Monitor de Signos Vitales</h3>
                        <p><strong>Fecha:</strong> 15/05/2023</p>
                        <p><strong>Estado:</strong> <span class="status-badge status-completed">Completado</span></p>
                        <p><strong>Descripción:</strong> Calibración preventiva trimestral</p>
                    </div>
                </div>
            <?php else: ?>
                <!-- Vista de Mantenimientos Actuales -->
                <div class="maintenance-container">
                    <div class="maintenance-header">
                        <h2><i class="fas fa-tools"></i> Mantenimientos Actuales</h2>
                        <a href="nuevo_mantenimiento.php" class="btn">
                            <i class="fas fa-plus"></i> Nuevo Mantenimiento
                        </a>
                    </div>
                    
                    <div class="maintenance-card">
                        <h3>Resonador Magnético</h3>
                        <p><strong>Fecha:</strong> 20/06/2023</p>
                        <p><strong>Estado:</strong> <span class="status-badge status-pending">Pendiente</span></p>
                        <p><strong>Descripción:</strong> Ruidos anormales durante el escaneo</p>
                        <button class="btn" style="margin-top: 10px;">
                            <i class="fas fa-eye"></i> Ver Detalles
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Menú móvil (igual que tu dashboard)
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
        
        // Marcar ítem activo en el menú
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