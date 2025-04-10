document.addEventListener("DOMContentLoaded", function () {
    const userType = "tecnico"; // Se puede cambiar dinámicamente según sesión

    const menus = {
        "tecnico": [
            { "icon": "fas fa-home", "name": "Inicio", "url": "DashboardTec.php" },
            { "icon": "fas fa-hospital", "name": "Hospitales", "url": "hospital.php" },
            { "icon": "fas fa-tools", "name": "Mantenimiento", "submenu": [
                { "name": "Preventivo", "url": "maintenance.php" },
               
            ]},
            { "icon": "far fa-building", "name": "Empresas", "url": "company.php" },
            { "icon": "fas fa-laptop-medical", "name": "Equipos", "url": "equipment.php" },
            { "icon": "fas fa-file", "name": "Archivos", "submenu": [
                { "name": "Subidos", "url": "https://drive.google.com/drive/folders/1k3gWuIPc31SIB2A0FGoBuh_SX_AAwbyJ?usp=drive_link", "target": "_blank" },
                
            ]},
         
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

        if (menu.submenu) {
            let submenu = document.createElement("ul");
            submenu.classList.add("submenu");

            menu.submenu.forEach(sub => {
                let subLi = document.createElement("li");
                let subLink = document.createElement("a");
                subLink.href = sub.url;
                subLink.textContent = sub.name;
                subLink.classList.add("submenu-link");
                if (sub.target) {
                    subLink.target = sub.target;
                }
                subLi.appendChild(subLink);
                submenu.appendChild(subLi);
            });

            li.appendChild(submenu);
        } else if (menu.url) {
            li.innerHTML = `<a href="${menu.url}" class="menu-link"><i class="${menu.icon}"></i> ${menu.name}</a>`;
        }

        li.addEventListener("click", function (event) {
            if (event.target.tagName === "A") return;
            const isActive = this.classList.contains("active");
            document.querySelectorAll(".menu-item").forEach(el => el.classList.remove("active"));
            if (!isActive) {
                this.classList.add("active");
            }
        });

        sidebarMenu.appendChild(li);
    });

    const menuToggle = document.querySelector('.menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    } else {
        console.error("Elemento .menu-toggle no encontrado");
    }
});
