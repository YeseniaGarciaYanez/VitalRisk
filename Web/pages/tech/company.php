<?php
// Número de registros por página
$limit = 10;

// Obtener el número de página actual desde la URL, por defecto será 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit; // Calcular el inicio de los datos para esta página

// Obtener los datos de la API
$file = file_get_contents('https://sheet2api.com/v1/I4xIqLkaSRe4/empresas-vendedores-de-equipos-medicos');
$data = json_decode($file, true);

// Filtrar los equipos por búsqueda
$search = isset($_GET['search']) ? $_GET['search'] : '';
if ($search) {
    $data = array_filter($data, function($item) use ($search) {
        return stripos($item['producto'], $search) !== false || stripos($item['Empresa'], $search) !== false;
    });
}

// Contar el total de registros
$total_records = count($data);
$total_paginas = ceil($total_records / $limit);

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
        * {
      font-family: 'Montserrat', sans-serif;
    }
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

        <!-- Barra de búsqueda centrada -->
        <div class="search-container">
            <form method="get" action="">
                <input type="text" name="search" placeholder="Buscar por producto o empresa..." value="<?php echo htmlspecialchars($search); ?>">
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
                        <th>Empresa</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Especificaciones</th>
                        <th>Ubicación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data_paginada as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['ID'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['Empresa'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['Producto'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['Precio'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['Especificaciones'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($item['Ubicación'] ?? ''); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Sección de paginación -->
        <?php
        // Definir el máximo de botones a mostrar
        $max_botones = 6;

        // Asegurarse de que la página actual esté dentro de los límites
        $total_paginas = ceil($total_records / $limit);
        $page = max(1, min($page, $total_paginas));

        // Calcular el rango de botones a mostrar
        $inicio_rango = max(1, $page - floor($max_botones / 2));
        $fin_rango = $inicio_rango + $max_botones - 1;
        if ($fin_rango > $total_paginas) {
            $fin_rango = $total_paginas;
            $inicio_rango = max(1, $fin_rango - $max_botones + 1);
        }
        ?>

        <div class="pagination-container">
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo ($page - 1); ?>&search=<?php echo urlencode($search); ?>">‹</a>
                <?php endif; ?>

                <?php for ($i = $inicio_rango; $i <= $fin_rango; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" class="<?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $total_paginas): ?>
                    <a href="?page=<?php echo ($page + 1); ?>&search=<?php echo urlencode($search); ?>">›</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
</body>
</html>
