<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header con JavaScript</title>
</head>
<body>
    <header id="header">
        <div class="logo"></div>
        <nav class="menu" id="menu">
            <a href="#">Inicio</a>
            <a href="#">Servicios</a>
            <a href="#">Contacto</a>
        </nav>
        <div class="menu-toggle" id="menu-toggle">☰</div>
    </header>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const header = document.getElementById("header");
            const menuToggle = document.getElementById("menu-toggle");
            const menu = document.getElementById("menu");
            
            window.addEventListener("scroll", function() {
                if (window.scrollY > 50) {
                    header.classList.add("scrolled");
                } else {
                    header.classList.remove("scrolled");
                }
            });
            
            menuToggle.addEventListener("click", function() {
                menu.classList.toggle("active");
            });
        });
    </script>
</body>
</html>
