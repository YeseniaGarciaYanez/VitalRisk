<?php
    // Obtener parámetros de filtro
    $entidad_seleccionada = isset($_GET['entidad']) ? $_GET['entidad'] : '';
    $municipio_seleccionado = isset($_GET['municipio']) ? $_GET['municipio'] : '';

    // URL de la API de hospitales
    $url = "https://sheet2api.com/v1/OOb2tXvPROOB/ola";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Agrupar hospitales por entidad y municipio
    $hospitales_municipios = [];
    foreach ($data as $item) {
        $municipio = $item['MUNICIPIO'] ?? 'Desconocido';
        $entidad = $item['ENTIDAD'] ?? 'Desconocido';
        
        if (!isset($hospitales_municipios[$entidad][$municipio])) {
            $hospitales_municipios[$entidad][$municipio] = [];
        }
        $hospitales_municipios[$entidad][$municipio][] = $item;
    }

    // Generar arreglo de municipios por entidad para el dropdown
    $municipiosPorEntidad = [];
    foreach ($hospitales_municipios as $entidad => $municipios) {
        $municipiosPorEntidad[$entidad] = array_values(array_unique(array_keys($municipios)));
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mapa de Hospitales</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
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
    body {
        background-color: var(--content-bg);
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    /* Navbar */
    .navbar {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--header-bg);
        padding: 10px;
        position: sticky;
        top: 0;
        z-index: 1000;
    }
    .navbar a {
        text-decoration: none;
    }
    .navbar img {
        height: 50px;
    }
    /* Contenedor principal */
    .container {
        width: 90%;
        margin: 20px auto;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        margin-top: 0;
    }
    label {
        font-size: 1rem;
        display: block;
        margin-top: 10px;
    }
    select, input {
        padding: 10px;
        margin: 5px 0 15px;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button {
        background: var(--primary-color);
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background: var(--hover-color);
    }
    /* Mapa */
    #map {
        width: 100%;
        height: 600px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <a href="hospital.php">
      <img src="../../Logo/vitarisk.png" alt="Logo">
    </a>
  </nav>

  <div class="container">
      <h2>Mapa de Hospitales</h2>
      <form id="filtros" method="GET" action="mapa.php">
        <label for="entidad">Filtrar por Entidad:</label>
        <select id="entidad" name="entidad" onchange="actualizarMunicipios()">
            <option value="">Todas</option>
            <?php foreach ($hospitales_municipios as $entidad => $muni): ?>
                <option value="<?php echo htmlspecialchars($entidad); ?>" <?php echo ($entidad === $entidad_seleccionada) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($entidad); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="municipio">Filtrar por Municipio:</label>
        <select id="municipio" name="municipio">
            <option value="">Todos</option>
            <?php
              if ($entidad_seleccionada && isset($municipiosPorEntidad[$entidad_seleccionada])) {
                  foreach ($municipiosPorEntidad[$entidad_seleccionada] as $muni) {
                      $selected = ($muni === $municipio_seleccionado) ? 'selected' : '';
                      echo "<option value=\"" . htmlspecialchars($muni) . "\" $selected>" . htmlspecialchars($muni) . "</option>";
                  }
              }
            ?>
        </select>
        <button type="submit">Aplicar Filtros</button>
      </form>
      <div id="map"></div>
  </div>

  <script>
    // Inicializar el mapa centrado en México
    var map = L.map('map').setView([23.6345, -102.5528], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Datos de hospitales agrupados por entidad y municipio
    var hospitales = <?php echo json_encode($hospitales_municipios); ?>;
    // Objeto con municipios por entidad para actualizar el dropdown
    var municipiosPorEntidad = <?php echo json_encode($municipiosPorEntidad); ?>;

    // Diccionario de coordenadas para entidades (clave en mayúsculas)
    var coordenadasEntidades = {
      "AGUASCALIENTES": [21.8853, -102.2916],
      "BAJA CALIFORNIA": [32.5149, -115.4523],
      "BAJA CALIFORNIA SUR": [26.0444, -111.6667],
      "CAMPECHE": [19.8301, -90.5349],
      "CHIAPAS": [16.7569, -93.1296],
      "CHIHUAHUA": [28.6323, -106.0691],
      "CIUDAD DE MÉXICO": [19.4326, -99.1332],
      "COAHUILA": [27.0587, -101.7068],
      "COLIMA": [19.2433, -103.7245],
      "DURANGO": [24.0270, -104.6534],
      "ESTADO DE MÉXICO": [19.3777, -99.1269],
      "GUANAJUATO": [21.0190, -101.2570],
      "GUERRERO": [17.5731, -99.5050],
      "HIDALGO": [20.0890, -98.7591],
      "JALISCO": [20.6597, -103.3496],
      "MICHOACÁN": [19.5665, -101.7057],
      "MORELOS": [18.9261, -99.2306],
      "NAYARIT": [21.7510, -105.2253],
      "NUEVO LEÓN": [25.6866, -100.3161],
      "OAXACA": [17.0732, -96.7266],
      "PUEBLA": [19.0413, -98.2062],
      "QUERÉTARO": [20.5888, -100.3899],
      "QUINTANA ROO": [19.1817, -88.4791],
      "SAN LUIS POTOSÍ": [22.1565, -100.9855],
      "SINALOA": [24.7519, -107.0000],
      "SONORA": [29.0729, -110.9559],
      "TABASCO": [18.1241, -92.3687],
      "TAMAULIPAS": [25.3749, -99.9975],
      "TLAXCALA": [19.3131, -98.2402],
      "VERACRUZ": [19.1738, -96.1342],
      "YUCATÁN": [21.1619, -89.6569],
      "ZACATECAS": [22.7709, -102.5833]
    };

    // Diccionario de coordenadas para algunos municipios (clave: "ENTIDAD_MUNICIPIO" en mayúsculas)
    var coordenadasMunicipios = {
      "BAJA CALIFORNIA_MEXICALI": [32.6633, -115.4689],
      "BAJA CALIFORNIA_TIJUANA": [32.5149, -117.0382],
      "BAJA CALIFORNIA_PLAYAS DE ROSARITO": [32.0853, -117.0920],
      "BAJA CALIFORNIA_ENSENADA": [31.8667, -116.6000],
      "BAJA CALIFORNIA_SAN QUINTIN": [30.2833, -115.0333],
      "BAJA CALIFORNIA_SAN FELIPE": [30.0667, -113.3333],
      "BAJA CALIFORNIA_TECATE": [32.2678, -116.6067]
      // Agrega más municipios con coordenadas precisas si lo requieres
    };

    var marcadores = [];

    // Función para limpiar marcadores existentes
    function limpiarMarcadores() {
        marcadores.forEach(function(marker) {
            map.removeLayer(marker);
        });
        marcadores = [];
    }

    // Función para generar un pequeño desfase aleatorio en grados
    function randomOffset() {
      // Rango de offset: ±0.02 grados (aproximadamente ±2km, ajusta según necesidad)
      return (Math.random() - 0.5) * 0.04;
    }

    // Función para mostrar un marcador por cada hospital
    function mostrarHospitales() {
        limpiarMarcadores();
        // Obtener filtros de la URL (pasados por GET) o de los dropdowns
        var urlParams = new URLSearchParams(window.location.search);
        var entidadFiltro = urlParams.get('entidad') || "";
        var municipioFiltro = urlParams.get('municipio') || "";

        // Si se filtra por entidad, usar esa; de lo contrario, recorrer todas
        var entidades = entidadFiltro ? [entidadFiltro] : Object.keys(hospitales);
        entidades.forEach(function(entidad) {
            // Si la entidad no está en el grupo, continuar
            if (!hospitales[entidad]) return;
            // Recorrer cada municipio de la entidad
            var municipios = municipioFiltro ? [municipioFiltro] : Object.keys(hospitales[entidad]);
            municipios.forEach(function(municipio) {
                // Obtener el arreglo de hospitales en esta entidad y municipio
                var listaHospitales = hospitales[entidad][municipio];
                if (!listaHospitales) return;
                // Convertir a mayúsculas para búsqueda de coordenadas
                var entidadKey = entidad.toUpperCase();
                var keyMunicipio = entidadKey + "_" + municipio.toUpperCase();
                // Coordenada base: buscar en municipios, si no, en entidad; si tampoco, fallback
                var baseCoords = coordenadasMunicipios[keyMunicipio] || coordenadasEntidades[entidadKey] || [23.6345, -102.5528];
                // Iterar cada hospital y crear marcador con un pequeño desfase
                listaHospitales.forEach(function(hospital) {
                    var lat = baseCoords[0] + randomOffset();
                    var lng = baseCoords[1] + randomOffset();
                    // Puedes personalizar el contenido del popup con más detalles del hospital
                    var popupContent = `<b>${hospital["NOMBRE DE LA INSTITUCION"]}</b><br>
                                        CLUES: ${hospital["CLUES"]}<br>
                                        Entidad: ${hospital["ENTIDAD"]}<br>
                                        Municipio: ${hospital["MUNICIPIO"]}`;
                    var marker = L.marker([lat, lng]).addTo(map).bindPopup(popupContent);
                    marcadores.push(marker);
                });
            });
        });
    }

    // Actualizar el dropdown de municipios según la entidad seleccionada
    function actualizarMunicipios() {
        var entidadSelect = document.getElementById("entidad");
        var municipioSelect = document.getElementById("municipio");
        var entidad = entidadSelect.value;
        // Limpiar municipios
        municipioSelect.innerHTML = "<option value=''>Todos</option>";
        if (entidad && municipiosPorEntidad[entidad]) {
            municipiosPorEntidad[entidad].forEach(function(muni) {
                municipioSelect.innerHTML += `<option value="${muni}">${muni}</option>`;
            });
        }
    }

    // Al cargar la página, mostrar los marcadores individuales por hospital
    mostrarHospitales();
  </script>
</body>
</html>
