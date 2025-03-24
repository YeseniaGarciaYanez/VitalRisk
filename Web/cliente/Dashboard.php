<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard con Sidebar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="https://via.placeholder.com/50" alt="Logo" style="border-radius: 50%;">
            <h2>VitalRisk</h2>
        </div>
        <ul class="sidebar-menu">
            <li class="active"><i class="fas fa-home"></i> Dashboard</li>
            <li><i class="fas fa-chart-line"></i> Analytics</li>
            <li><i class="fas fa-project-diagram"></i> Proyectos</li>
            <li><i class="fas fa-envelope"></i> Mensajes <span class="notification-badge">3</span></li>
            <li><i class="fas fa-calendar-alt"></i> Calendario</li>
            <li><i class="fas fa-cog"></i> Configuración</li>
            <li><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</li>
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
                <h1>Dashboard</h1>
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

        <!-- Content -->
        <div class="content">
            <div class="cards">
                <div class="card">
                    <h3>Maquinas Activos</h3>
                    <p>1,245</p>
                </div>
                <div class="card">
                    <h3>Ingresos</h3>
                    <p>$34,245</p>
                </div>
                <div class="card">
                    <h3>Tareas Pendientes</h3>
                    <p>12</p>
                </div>
                <div class="card">
                    <h3>Proyectos</h3>
                    <p>8</p>
                </div>
            </div>

            <div class="chart-container">
                <h2>Gráfico de Actividad</h2>
                <!-- Aquí iría tu gráfico (Chart.js, etc.) -->
                <div style="height: 300px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                    Área de Gráfico
                </div>
            </div>

            <div class="recent-activity">
                <h2>Actividad Reciente</h2>
                <p>Aquí iría la lista de actividades recientes...</p>
            </div>
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