<?php
// Número de registros por página
$limit = 10;

// Obtener el número de página actual desde la URL, por defecto será 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit; // Calcular el inicio de los datos para esta página

// Obtener los datos de la API
$file = file_get_contents('https://sheet2api.com/v1/I4xIqLkaSRe4/equiposmedicos?ubicacion=Hospital%20General%20de%20Tijuana,%20Baja%20California');
$data = json_decode($file, true);

// Filtrar los equipos por búsqueda
$search = isset($_GET['search']) ? $_GET['search'] : '';
if ($search) {
    $data = array_filter($data, function($item) use ($search) {
        return stripos($item['Marca'], $search) !== false || stripos($item['Categoría'], $search) !== false;
    });
}

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
    <style>
        /* Estilo para la barra de búsqueda centrada */
        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
        }

        .search-container input[type="text"] {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 300px;
            transition: all 0.3s ease;
        }

        .search-container input[type="text"]:focus {
            border-color: #5C6BC0;
            box-shadow: 0 0 5px rgba(92, 107, 192, 0.5);
        }

        .search-container button {
            padding: 10px 20px;
            background-color: #5C6BC0;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .search-container button:hover {
            background-color: #3f51b5;
        }

        .reset-button {
            padding: 10px 20px;
            background-color: #5C6BC0;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .reset-button:hover {
            background-color: #3f51b5;
        }

        /* Estilo para el botón "Ver Todos" centrado en la parte inferior */
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-container a {
            padding: 10px 20px;
            background-color: #5C6BC0;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .button-container a:hover {
            background-color: #3f51b5;
        }
    </style>
</head>
<body>

        

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../../logo/vitarisk.png" alt="Logo">
        </div>
        <ul class="sidebar-menu">
            <li><a href="dashboardAdmin.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="equipment.php"><i class="fas fa-tools"></i> Equipamiento</a></li>
            <li><a href="hospital.php"><i class="fas fa-history"></i> Hospital</a></li>
            <li><a href="../../logout.php" onclick="return confirm('¿Estás seguro de cerrar sesión?')"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
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
                </div>
                <div class="user-profile">
                    <span>Usuario Administrador</span>
                </div>
            </div>
        </div>

        <!-- Barra de búsqueda centrada -->
        <div class="search-container">
            <form method="get" action="">
                <input type="text" name="search" placeholder="Buscar por marca o categoría..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit"><i class="fas fa-search"></i> Buscar</button>
            </form>
        </div>

        <!-- Botón para regresar a la vista principal -->
        <?php if ($search): ?>
            <div class="button-container">
                <a href="equipment.php" class="reset-button">Ver Todos</a>
            </div>
        <?php endif; ?>

        <!-- Contenedor de la tabla -->
        <div class="table-container">
            <table class="styled-table">
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
