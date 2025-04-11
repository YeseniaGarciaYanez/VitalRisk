<?php

// Número de registros por página
$limit = 10;

// Obtener el número de página actual desde la URL, por defecto será 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit; // Calcular el inicio de los datos para esta página

// Obtener los datos de la API
$url = 'https://sheet2api.com/v1/I4xIqLkaSRe4/empresas-vendedores-de-equipos-medicos';
$file = file_get_contents($url);
$data = json_decode($file, true);

// Recolectar ubicaciones únicas para el dropdown
$ubicacionesDisponibles = [];
foreach ($data as $item) {
    $ubicacion = isset($item['Ubicación']) ? $item['Ubicación'] : null;
    if ($ubicacion && !in_array($ubicacion, $ubicacionesDisponibles)) {
        $ubicacionesDisponibles[] = $ubicacion;
    }
}
sort($ubicacionesDisponibles);

// Recoger parámetros para filtros
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filtroUbicacion = isset($_GET['ubicacion']) ? $_GET['ubicacion'] : '';


// Filtrar los equipos por búsqueda y ubicación
$data_filtrada = array_filter($data, function($item) use ($search, $filtroUbicacion) {
    $productoCoincide = !$search || stripos($item['Producto'], $search) !== false;
    $empresaCoincide = !$search || stripos($item['Empresa'], $search) !== false;
    $ubicacionCoincide = !$filtroUbicacion || ($item['Ubicación'] ?? '') === $filtroUbicacion;

    return ($productoCoincide || $empresaCoincide) && $ubicacionCoincide;
});


// Contar el total de registros filtrados
$total_records = count($data_filtrada);
$total_paginas = ceil($total_records / $limit);

// Limitar los datos filtrados a los que corresponden a la página actual
$data_paginada = array_slice($data_filtrada, $offset, $limit);
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
    <link rel="stylesheet" href="../../css/search.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../../logo/vitarisk.png" alt="Logo">
        </div>
        <ul class="sidebar-menu" id="sidebar-menu">
            </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div class="header-left">
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <h1>Empresas vendedoras</h1>
            </div>
            <div class="header-right">
             
                <div class="user-profile">
                 
                    <span>Usuario Técnico</span>
                </div>
            </div>
        </div>

        <div class="search-container">
            <form method="get" action="">
                <div>
                    <label for="search">Buscar por producto o empresa:</label>
                    <input type="text" name="search" id="search" placeholder="Buscar..." value="<?php echo htmlspecialchars($search); ?>">
                </div>
                <div>
                    <label for="ubicacion">Filtrar por ubicación:</label>
                    <select name="ubicacion" id="ubicacion">
                        <option value="">-- Todas --</option>
                        <?php foreach ($ubicacionesDisponibles as $ubicacion): ?>
                            <option value="<?php echo htmlspecialchars($ubicacion); ?>" <?php if ($filtroUbicacion == $ubicacion) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($ubicacion); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit"><i class="fas fa-search"></i> Filtrar</button>
            </form>
       
        </div>

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
                    <a href="?page=<?php echo ($page - 1); ?>&search=<?php echo urlencode($search); ?>&ubicacion=<?php echo urlencode($filtroUbicacion); ?>">‹</a>
                <?php endif; ?>

                <?php for ($i = $inicio_rango; $i <= $fin_rango; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&ubicacion=<?php echo urlencode($filtroUbicacion); ?>" class="<?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $total_paginas): ?>
                    <a href="?page=<?php echo ($page + 1); ?>&search=<?php echo urlencode($search); ?>&ubicacion=<?php echo urlencode($filtroUbicacion); ?>">›</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
</body>
</html>