<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Hospitales</title>
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
      /* Puedes agregar ajustes adicionales de estilo aquí si lo deseas */
  </style>
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

    <!-- Contenido -->
    <div class="content">
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

      // URL de la API
      $url = "https://sheet2api.com/v1/OOb2tXvPROOB/ola";
      // Obtener los datos desde la API
      $response = file_get_contents($url);
      $data = json_decode($response, true);

      // Verificar si la respuesta contiene un arreglo interno (por ejemplo "data")
      if (isset($data['data']) && is_array($data['data'])) {
          $items = $data['data'];
      } else {
          $items = $data;
      }

      // Recolectar ciudades (MUNICIPIO) disponibles para el dropdown
      $ciudadesDisponibles = [];
      foreach ($items as $item) {
          $ciudad = getFieldValue($item, ['MUNICIPIO', 'municipio']);
          if ($ciudad && !in_array($ciudad, $ciudadesDisponibles)) {
              $ciudadesDisponibles[] = $ciudad;
          }
      }
      sort($ciudadesDisponibles);

      // Recoger parámetros para filtros
      $busqueda = isset($_GET['busqueda']) ? strtolower(trim($_GET['busqueda'])) : '';
      $filtroCiudad = isset($_GET['ciudad']) ? $_GET['ciudad'] : '';
      ?>
      
      <!-- Filtros: Búsqueda por nombre y filtrado por ciudad (MUNICIPIO) -->
      <form method="GET" action="hospital.php" class="search-container">
        <div>
          <label for="busqueda">Buscar por nombre:</label>
          <input type="text" name="busqueda" id="busqueda" class="search-input" placeholder="Nombre del hospital" value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
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
          <?php
          // Array para evitar duplicados (por nombre)
          $hospitales_unicos = [];
          foreach ($items as $item):
            $nombreHospital = $item['NOMBRE DE LA INSTITUCION'] ?? '';
            // Obtener "Estado" (ENTIDAD) y "Ciudad" (MUNICIPIO)
            $estado = getFieldValue($item, ['ENTIDAD', 'entidad']);
            $ciudad = getFieldValue($item, ['MUNICIPIO', 'municipio']);

            // Evitar duplicados
            if (in_array($nombreHospital, $hospitales_unicos)) {
              continue;
            }
            // Aplicar filtros: búsqueda por nombre y filtro de ciudad
            if ($busqueda && strpos(strtolower($nombreHospital), $busqueda) === false) {
              continue;
            }
            if ($filtroCiudad && $ciudad !== $filtroCiudad) {
              continue;
            }
            $hospitales_unicos[] = $nombreHospital;
          ?>
          <tr>
            <td><?php echo htmlspecialchars($item['CLUES'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($item['CLAVE DE LA INSTITUCION'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($nombreHospital); ?></td>
            <td><?php echo htmlspecialchars($estado); ?></td>
            <td><?php echo htmlspecialchars($ciudad); ?></td>
            <td>
              <!-- Se pasa el estado y la ciudad a mapa.php para filtrar si se desea -->
              <a href="mapa.php?estado=<?php echo urlencode($estado); ?>&ciudad=<?php echo urlencode($ciudad); ?>" class="btn-mapa">
                <i class="fas fa-map-marked-alt"></i> Ver Mapa
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
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
