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
                <h1>Hospitales</h1>
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
            <table border="1">
                <thead>
                    <tr>
                        <th>CLUES</th>
                        <th>Clave</th>
                        <th>Hospital</th>
                        <th>Estado</th>
                        <th>Ver en Mapa</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                    // URL de la API
                    $url = "https://sheet2api.com/v1/OOb2tXvPROOB/ola";

                    // Obtener los datos desde la API
                    $response = file_get_contents($url);
                    $data = json_decode($response, true);

                    // Array para almacenar nombres únicos
                    $hospitales_unicos = [];
                ?>

                <tbody>
                    <?php foreach ($data as $item): 
                        $hospital = $item['NOMBRE DE LA INSTITUCION'] ?? ''; 
                        $estado = $item['ESTADO'] ?? 'Desconocido'; 

                        // Verificar si el hospital ya fue agregado
                        if (!in_array($hospital, $hospitales_unicos)) {
                            $hospitales_unicos[] = $hospital; // Agregar a la lista de únicos
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['CLUES'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['CLAVE DE LA INSTITUCION'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($hospital); ?></td>
                            <td><?php echo htmlspecialchars($estado); ?></td>
                            <td>
                                <a href="mapa.php?estado=<?php echo urlencode($estado); ?>" class="btn-mapa">
                                    <i class="fas fa-map-marked-alt"></i> Ver Mapa
                                </a>
                            </td>
                        </tr>
                    <?php 
                        } 
                    endforeach; ?>
                </tbody>
            </table>

            <!-- Botón para ver el mapa con todos los hospitales -->
            <div style="margin-top: 20px;">
                <a href="mapa.php" class="btn-mapa-global">
                    <i class="fas fa-map"></i> Ver Todos en el Mapa
                </a>
            </div>

        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
</body>
</html>
