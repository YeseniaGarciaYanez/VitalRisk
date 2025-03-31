document.addEventListener("DOMContentLoaded", function () {
    const userType = "tecnico"; // Se puede cambiar dinámicamente según sesión

    const menus = {
        "tecnico": [
            { "icon": "fas fa-home", "name": "Inicio", "url": "DashboardTec.php" },
            { "icon": "fas fa-hospital", "name": "Hospitales", "url": "hospital.php" },
            { "icon": "fas fa-tools", "name": "Mantenimiento", "submenu": [
                { "name": "Preventivo", "url": "maintenance.php" },
                { "name": "Reportes", "url": "corrective.html" }
            ]},
            { "icon": "fas fa-laptop-medical", "name": "Equipos", "url": "equipment.php" },
            { "icon": "fas fa-file", "name": "Archivos", "submenu": [
                { "name": "Subidos", "url": "uploaded.html" },
                { "name": "Compartidos", "url": "shared.html" }
            ]},
            { "icon": "fas fa-folder", "name": "Reportes", "submenu": [
                { "name": "Diario", "url": "daily-reports.html" },
                { "name": "Mensual", "url": "monthly-reports.html" }
            ]}
        ]
    };

    const sidebarMenu = document.getElementById("sidebar-menu");
    if (!sidebarMenu) {
        console.error("Elemento #sidebar-menu no encontrado");
        return;
    }

    menus[userType].forEach(menu => {
        let li = document.createElement("li");
        li.classList.add("menu-item");
        li.innerHTML = `<i class="${menu.icon}"></i> ${menu.name}`;

        // Si el menú tiene submenús, los agregamos
        if (menu.submenu) {
            let submenu = document.createElement("ul");
            submenu.classList.add("submenu");

            menu.submenu.forEach(sub => {
                let subLi = document.createElement("li");
                subLi.innerHTML = `<a href="${sub.url}" class="submenu-link">${sub.name}</a>`;
                submenu.appendChild(subLi);
            });

            li.appendChild(submenu);
        } else if (menu.url) {
            // Si no tiene submenú, le agregamos un enlace directo
            li.innerHTML = `<a href="${menu.url}" class="menu-link"><i class="${menu.icon}"></i> ${menu.name}</a>`;
        }

        li.addEventListener("click", function (event) {
            if (event.target.tagName === "A") return; // Evita que se cierre al hacer clic en un enlace

            const isActive = this.classList.contains("active");
            document.querySelectorAll(".menu-item").forEach(el => el.classList.remove("active"));

            if (!isActive) {
                this.classList.add("active");
            }
        });

        sidebarMenu.appendChild(li);
    });

    // Controlador para el botón de menú lateral
    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    } else {
        console.error("Elemento .menu-toggle no encontrado");
    }
});
