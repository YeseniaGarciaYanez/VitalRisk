<?php
// Función auxiliar para obtener un campo buscando variantes
function getFieldValue($item, $keys) {
    foreach ($keys as $key) {
        if (isset($item[$key])) {
            return $item[$key];
        }
    }
    return '';
}

// Número de registros por página
$limit = 10;

// Obtener el número de página actual desde la URL, por defecto será 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit; // Calcular el inicio de los datos para esta página

// Obtener los datos de la API
$url = 'https://sheet2api.com/v1/I4xIqLkaSRe4/empresas-vendedores-de-equipos-medicos';
$file = file_get_contents($url);
$data = json_decode($file, true);

// Recolectar ciudades disponibles para el dropdown
$ciudadesDisponibles = [];
foreach ($data as $item) {
    $ciudad = getFieldValue($item, ['Ubicación', 'ubicacion', 'Ciudad', 'ciudad']); // Adapta los nombres de los campos según tu API
    if ($ciudad && !in_array($ciudad, $ciudadesDisponibles)) {
        $ciudadesDisponibles[] = $ciudad;
    }
}
sort($ciudadesDisponibles);

// Recoger parámetros para filtros
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filtroCiudad = isset($_GET['ciudad']) ? $_GET['ciudad'] : '';

// Filtrar los equipos por búsqueda y ciudad
$data_filtrada = array_filter($data, function($item) use ($search, $filtroCiudad) {
    $productoCoincide = !$search || stripos($item['Producto'], $search) !== false;
    $empresaCoincide = !$search || stripos($item['Empresa'], $search) !== false;
    $ciudadCoincide = !$filtroCiudad || getFieldValue($item, ['Ubicación', 'ubicacion', 'Ciudad', 'ciudad']) === $filtroCiudad; // Adapta los nombres de los campos

    return ($productoCoincide || $empresaCoincide) && $ciudadCoincide;
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

    <style>
        /* Estilo para la barra de búsqueda con filtro de ciudad */
        * {
            font-family: 'Montserrat', sans-serif;
        }
        .search-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
            flex-wrap: wrap; /* Permite que los elementos se envuelvan en pantallas pequeñas */
        }
        .search-container > div {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .search-container label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        .search-container input[type="text"],
        .search-container select {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 300px; /* Ancho base para los inputs y selects */
            transition: all 0.3s ease;
            max-width: 100%; /* Asegura que no se desborden en pantallas pequeñas */
        }
        .search-container input[type="text"]:focus,
        .search-container select:focus {
            border-color: #7CBC9A;
            box-shadow: 0 0 5px rgba(92, 107, 192, 0.5);
        }
        .search-container button {
            padding: 10px 20px;
            background-color: #7CBC9A;
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
            margin-top: 10px; /* Espacio desde el formulario en pantallas pequeñas */
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
                    <label for="ciudad">Filtrar por ubicación:</label>
                    <select name="ciudad" id="ciudad">
                        <option value="">-- Todas --</option>
                        <?php foreach ($ciudadesDisponibles as $ciudad): ?>
                            <option value="<?php echo htmlspecialchars($ciudad); ?>" <?php if ($filtroCiudad == $ciudad) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($ciudad); ?>
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
                            <td><?php echo htmlspecialchars(getFieldValue($item, ['Ubicación', 'ubicacion', 'Ciudad', 'ciudad'])); ?></td>
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
                    <a href="?page=<?php echo ($page - 1); ?>&search=<?php echo urlencode($search); ?>&ciudad=<?php echo urlencode($filtroCiudad); ?>">‹</a>
                <?php endif; ?>

                <?php for ($i = $inicio_rango; $i <= $fin_rango; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>&ciudad=<?php echo urlencode($filtroCiudad); ?>" class="<?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $total_paginas): ?>
                    <a href="?page=<?php echo ($page + 1); ?>&search=<?php echo urlencode($search); ?>&ciudad=<?php echo urlencode($filtroCiudad); ?>">›</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="../../js/sidebar.js"></script>
</body>
</html>