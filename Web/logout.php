<?php
// Iniciar sesión (debe ser lo primero)
session_start();

// Destruir completamente la sesión
$_SESSION = array();

// Eliminar cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );
}

// Destruir sesión
session_destroy();

// Redirección absoluta al login
header("Location: http://localhost/vitalRisk/Web/index.php");
exit();
?>