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
            <img src="Logo/vitarisk.png" alt="Logo" style="border-radius: 50%;">
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
            <h2>Bienvenido, Técnico</h2>
            <p>Selecciona una opción del menú para continuar.</p>
        </div>
    </div>

    <script>
        const userType = "tecnico"; // Se puede cambiar dinámicamente según sesión

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
</body>
</html>
