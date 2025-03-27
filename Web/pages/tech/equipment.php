<?php
// Número de registros por página
$limit = 10;

// Obtener el número de página actual desde la URL, por defecto será 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit; // Calcular el inicio de los datos para esta página

// Obtener los datos de la API
$file = file_get_contents('https://sheet2api.com/v1/I4xIqLkaSRe4/equiposmedicos?ubicacion=Hospital%20General%20de%20Tijuana,%20Baja%20California');
$data = json_decode($file, true);

// Contar el total de registros
$total_records = count($data);
$total_pages = ceil($total_records / $limit);

// Limitar los datos a los que corresponden a la página actual
$data_paginada = array_slice($data, $offset, $limit);
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
    <link rel="stylesheet" href="../../css/pagination.css">
   
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
                <h1>Equipo médico</h1>
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

        <!-- Contenedor de la tabla -->
        <div class="table-container">
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Equipo</th>
                        <th>Categoría</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Piezas</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data_paginada as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['ID Equipo'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['Nombre del Equipo'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['Categoría'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['Marca'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['Modelo'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['Piezas'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['Estado'] ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Contenedor fijo de paginación -->
        <div class="pagination-container">
            <div class="pagination">
                <?php if ($page > 1): ?>
                    
                    <a href="?page=<?php echo ($page - 1); ?>">‹ </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="<?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo ($page + 1); ?>"> ›</a>
            
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
</body>
</html>
