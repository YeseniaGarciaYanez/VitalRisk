<?php
session_start();
require_once __DIR__ . '/includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUsuario = trim($_POST['idUsuario']);
    $username = trim($_POST['username']);

    // Validar que el ID sea numérico
    if (!is_numeric($idUsuario)) {
        header('Location: index.php?error=El ID debe ser numérico');
        exit();
    }

    try {
        // Buscar usuario por ID y username
        $stmt = $pdo->prepare("SELECT idUsuario, username, usuario, rol FROM USUARIO WHERE idUsuario = ? AND username = ?");
        $stmt->execute([$idUsuario, $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Autenticación exitosa
            $_SESSION['user_id'] = $user['idUsuario'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['usuario'];
            $_SESSION['role'] = $user['rol'];

            // Redirigir según el rol
            switch ($user['rol']) {
                case 'admin':
                    header('Location: pages/admin/DashboardAdmin.php');
                    break;
                case 'tecnico':
                    header('Location: pages/tech/DashboardTec.php');
                    break;
                case 'cliente':
                    header('Location: pages/cliente/DashboardCliente.php');
                    break;
                default:
                    header('Location: index.php?error=Rol no reconocido');
            }
            exit();
        } else {
            header('Location: index.php?error=Credenciales incorrectas');
            exit();
        }
    } catch (PDOException $e) {
        error_log("Error de base de datos: " . $e->getMessage());
        header('Location: index.php?error=Error en el sistema');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?>