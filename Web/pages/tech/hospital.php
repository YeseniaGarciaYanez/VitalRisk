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

// URL de la API de hospitales
$url = "https://sheet2api.com/v1/OOb2tXvPROOB/ola";
$response = file_get_contents($url);
$data = json_decode($response, true);

// Verificar si los datos vienen en un índice "data" o directamente
if (isset($data['data']) && is_array($data['data'])) {
    $items = $data['data'];
} else {
    $items = $data;
}

// Recolectar ciudades disponibles para el dropdown
$ciudadesDisponibles = [];
foreach ($items as $item) {
    $ciudad = getFieldValue($item, ['MUNICIPIO', 'municipio']);
    if ($ciudad && !in_array($ciudad, $ciudadesDisponibles)) {
        $ciudadesDisponibles[] = $ciudad;
    }
}
sort($ciudadesDisponibles);

// Recoger parámetros para filtros y paginación
$busqueda = isset($_GET['busqueda']) ? strtolower(trim($_GET['busqueda'])) : '';
$filtroCiudad = isset($_GET['ciudad']) ? $_GET['ciudad'] : '';
$pagina = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
$limite = 30;
$inicio = ($pagina - 1) * $limite;

// Aplicar filtros y evitar duplicados (por nombre)
$hospitales_unicos = [];
$hospitales_filtrados = [];
foreach ($items as $item) {
    $nombreHospital = $item['NOMBRE DE LA INSTITUCION'] ?? '';
    $estado = getFieldValue($item, ['ENTIDAD', 'entidad']);
    $ciudad = getFieldValue($item, ['MUNICIPIO', 'municipio']);
    
    // Evitar duplicados por nombre
    if (in_array($nombreHospital, $hospitales_unicos)) {
        continue;
    }
    // Filtrar según búsqueda y ciudad
    if ($busqueda && strpos(strtolower($nombreHospital), $busqueda) === false) {
        continue;
    }
    if ($filtroCiudad && $ciudad !== $filtroCiudad) {
        continue;
    }
    $hospitales_unicos[] = $nombreHospital;
    $hospitales_filtrados[] = $item;
}

$total_hospitales = count($hospitales_filtrados);
$total_paginas = ceil($total_hospitales / $limite);
$hospitales_paginados = array_slice($hospitales_filtrados, $inicio, $limite);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Hospitales</title>
  <!-- Tus hojas de estilo originales -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../../css/dashboard.css">
  <link rel="stylesheet" href="../../css/table.css">
  <style>
      :root {
          --sidebar-bg: #1D5E69;
          --sidebar-text: #F3E1B6;
          --header-bg: #7CBC9A;
          --content-bg: #FFFFFF;
          --primary-color: #FA3419;
          --secondary-color: #23998E;
          --hover-color: #7CBC9A;
          --accent-light: #F3E1B6;
          --accent-dark: #1D5E69;
          --card-bg: #F9F7F3;
          --notification: #FA3419;
          --success: #7CBC9A;
      }
      /* Estilos para la barra de búsqueda */
      .search-container {
          display: flex;
          flex-wrap: wrap;
          gap: 20px;
          padding: 20px;
          background: var(--card-bg);
          border-radius: 10px;
          margin-bottom: 20px;
      }
      .search-container > div {
          flex: 1;
          min-width: 200px;
      }
      .search-container label {
          font-weight: bold;
          margin-bottom: 5px;
          color: var(--accent-dark);
      }
      .search-input, .search-select {
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 5px;
          width: 100%;
      }
      .search-button {
          background: var(--secondary-color);
          color: white;
          padding: 10px 15px;
          border: none;
          border-radius: 5px;
          cursor: pointer;
      }
      /* Paginación */
      .pagination {
          text-align: center;
          margin-top: 20px;
      }
      .pagination a {
          padding: 8px 12px;
          margin: 0 5px;
          border: 1px solid #ccc;
          text-decoration: none;
          color: #333;
          border-radius: 4px;
      }
      .pagination a.active {
          background: var(--secondary-color);
          color: white;
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

    <!-- Contenido -->
    <div class="content">
      <!-- Barra de búsqueda -->
      <form method="GET" action="hospital.php" class="search-container">
        <div>
          <label for="busqueda">Buscar por nombre:</label>
          <input type="text" name="busqueda" id="busqueda" class="search-input" placeholder="Nombre del hospital" value="<?php echo htmlspecialchars($busqueda); ?>">
        </div>
        <div>
          <label for="ciudad">Filtrar por ciudad:</label>
          <select name="ciudad" id="ciudad" class="search-select">
            <option value="">-- Todas --</option>
            <?php foreach ($ciudadesDisponibles as $ciudad): ?>
              <option value="<?php echo htmlspecialchars($ciudad); ?>" <?php if ($filtroCiudad == $ciudad) echo 'selected'; ?>>
                <?php echo htmlspecialchars($ciudad); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <button type="submit" class="search-button">Aplicar filtros</button>
        </div>
      </form>

      <!-- Tabla de Hospitales -->
      <table>
        <thead>
          <tr>
            <th>CLUES</th>
            <th>Clave</th>
            <th>Hospital</th>
            <th>Entidad</th>
            <th>Municipio</th>
            <th>Ver en Mapa</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($hospitales_paginados as $item): 
                  $nombreHospital = $item['NOMBRE DE LA INSTITUCION'] ?? '';
                  $estado = getFieldValue($item, ['ENTIDAD', 'entidad']);
                  $ciudad = getFieldValue($item, ['MUNICIPIO', 'municipio']);
          ?>
          <tr>
            <td><?php echo htmlspecialchars($item['CLUES'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($item['CLAVE DE LA INSTITUCION'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($nombreHospital); ?></td>
            <td><?php echo htmlspecialchars($estado); ?></td>
            <td><?php echo htmlspecialchars($ciudad); ?></td>
            <td>
              <a href="mapa.php?estado=<?php echo urlencode($estado); ?>&ciudad=<?php echo urlencode($ciudad); ?>" class="btn-mapa">
                <i class="fas fa-map-marked-alt"></i> Ver Mapa
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- Paginación -->
      <div class="pagination">
        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
          <a href="hospital.php?pagina=<?php echo $i; ?>&busqueda=<?php echo urlencode($busqueda); ?>&ciudad=<?php echo urlencode($filtroCiudad); ?>" class="<?php echo ($pagina == $i) ? 'active' : ''; ?>">
            <?php echo $i; ?>
          </a>
        <?php endfor; ?>
      </div>

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


