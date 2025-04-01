<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// URL de tu API, asegúrate que la ruta sea correcta
$apiUrl = 'api_endpoints.php';

// Obtener la respuesta de la API
$response = file_get_contents($apiUrl);
if ($response === false) {
    die("Error: No se pudo conectar con la API en $apiUrl");
}

// Decodificar el JSON
$data = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error al decodificar el JSON: " . json_last_error_msg());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard con Sidebar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/table.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../../Logo/vitarisk.png" alt="Logo">
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
                <h1>Maintenance</h1>
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
            <h2>Listado de Mantenimientos</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Hospital</th>
                        <th>Equipment</th>
                        <th>Date</th>
                        <th>Priority</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['hospital']); ?></td>
                        <td><?php echo htmlspecialchars($item['equipment']); ?></td>
                        <td><?php echo htmlspecialchars($item['date']); ?></td>
                        <td><?php echo htmlspecialchars($item['priority']); ?></td>
                        <td><?php echo htmlspecialchars($item['notes']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
</body>
</html>
