document.addEventListener("DOMContentLoaded", function () {
    // Simulación de usuario logueado (esto puede venir de sesión o base de datos)
    const usuarioLogueado = "editor"; // Cambia esto a "admin", "editor" o "viewer"

    // Cargar el archivo JSON
    fetch("users.json")
        .then(response => response.json())
        .then(data => {
            if (data[usuarioLogueado]) {
                generarHeader(data[usuarioLogueado]);
            } else {
                console.error("Tipo de usuario no válido");
            }
        })
        .catch(error => console.error("Error al cargar JSON:", error));
});

function generarHeader(usuario) {
    const header = document.getElementById("header");
    header.innerHTML = `<h2>Bienvenido, ${usuario.nombre}</h2><nav><ul>${usuario.menu.map(item => `<li>${item}</li>`).join("")}</ul></nav>`;
}
