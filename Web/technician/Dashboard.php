<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard con Sidebar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <style>
        /* CSS adicional para submenú */
        .submenu {
            display: none;
            list-style: none;
            padding-left: 20px;
            margin-top: 5px;
        }

        .submenu.active {
            display: block;
        }

        .submenu li {
            padding: 8px 15px;
            margin-bottom: 5px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .submenu li a {
            text-decoration: none;
            color: var(--sidebar-text);
            display: block;
        }

        .submenu li:hover {
            background-color: var(--hover-color);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../Logo/vitarisk.png" alt="Logo">
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
                <h1>Technician</h1>
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
                { "icon": "fas fa-tools", "name": "Maintenance", "submenu": [
                    { "name": "Preventive", "url": "preventive.html" },
                    { "name": "Corrective", "url": "corrective.html" }
                ]},
                { "icon": "fas fa-box-open", "name": "Inventory", "submenu": [
                    { "name": "New Items", "url": "new-items.html" },
                    { "name": "Stock Levels", "url": "stock-levels.html" }
                ]},
                { "icon": "fas fa-file", "name": "Files", "submenu": [
                    { "name": "Uploaded", "url": "uploaded.html" },
                    { "name": "Shared", "url": "shared.html" }
                ]},
                { "icon": "fas fa-folder", "name": "Reports", "submenu": [
                    { "name": "Daily", "url": "daily-reports.html" },
                    { "name": "Monthly", "url": "monthly-reports.html" }
                ]}
            ]
        };

        const sidebarMenu = document.getElementById("sidebar-menu");

        menus[userType].forEach(menu => {
            let li = document.createElement("li");
            li.innerHTML = `<i class="${menu.icon}"></i> ${menu.name}`;
            li.classList.add("menu-item");

            let submenu = document.createElement("ul");
            submenu.classList.add("submenu");

            menu.submenu.forEach(sub => {
                let subLi = document.createElement("li");
                subLi.innerHTML = `<a href="${sub.url}" class="submenu-link">${sub.name}</a>`;
                submenu.appendChild(subLi);
            });

            li.appendChild(submenu);
            li.addEventListener("click", function() {
                submenu.classList.toggle("active");
            });

            sidebarMenu.appendChild(li);
        });

        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>
