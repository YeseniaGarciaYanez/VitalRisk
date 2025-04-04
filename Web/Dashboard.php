<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
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
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="Logo/vitarisk.png" alt="Logo" style="border-radius: 50%;">
            <h2>VitalRisk</h2>
        </div>
        <ul class="sidebar-menu" id="sidebar-menu">
        </ul>
    </div>
    
    <div class="main-content">
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
        
        <div class="content">
            <h2>"Bienvenido, Técnico. Tu experiencia mantiene la precisión y confiabilidad de cada equipo médico. ¡Gracias por tu trabajo!"</h2>
            <p>Todo listo para optimizar el rendimiento de los equipos médicos. Selecciona una opción para comenzar.</p>
            <img src="images/tecnico.png" alt="tecnico" style="border-radius: 10%; width: 450px; height: auto;">
        </div>
    </div>
    
    <script>
        const userType = "tecnico";
        const menus = {
            "tecnico": [
                { "icon": "fas fa-tools", "name": "Maintenance" },
                { "icon": "fas fa-box-open", "name": "Inventory" },
                { "icon": "fas fa-file", "name": "Files" },
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
