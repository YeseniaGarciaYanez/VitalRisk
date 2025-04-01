<?php
    // Obtener el estado seleccionado si existe
    $estado_seleccionado = isset($_GET['estado']) ? $_GET['estado'] : '';

    // URL de la API de hospitales
    $url = "https://sheet2api.com/v1/OOb2tXvPROOB/ola";
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Agrupar hospitales por estado y municipio
    $hospitales_municipios = [];
    foreach ($data as $item) {
        $municipio = $item['MUNICIPIO'] ?? 'Desconocido';
        $estado = $item['ENTIDAD'] ?? 'Desconocido';
        
        if (!isset($hospitales_municipios[$estado][$municipio])) {
            $hospitales_municipios[$estado][$municipio] = [];
        }
        $hospitales_municipios[$estado][$municipio][] = $item;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Hospitales</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <link rel="stylesheet" href="../../css/dashboard.css">
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
        }
        #map {
            width: 100%;
            height: 600px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        select, input {
            padding: 10px;
            margin: 10px 0;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Mapa de Hospitales</h2>
        <label for="estado">Filtrar por Estado:</label>
        <select id="estado" onchange="filtrarEstado()">
            <option value="">Todos</option>
            <?php foreach ($hospitales_municipios as $estado => $municipios) { ?>
                <option value="<?php echo htmlspecialchars($estado); ?>" <?php echo ($estado === $estado_seleccionado) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($estado); ?>
                </option>
            <?php } ?>
        </select>
        <div id="map"></div>
    </div>
    <script>
        // Inicializar el mapa centrado en México
        var map = L.map('map').setView([23.6345, -102.5528], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Datos de hospitales agrupados por estado y municipio
        var hospitales = <?php echo json_encode($hospitales_municipios); ?>;

        // Coordenadas aproximadas para cada estado (amplía esta lista según tus necesidades)
        var coordenadasEstados = {
            "Ciudad de México": [19.4326, -99.1332],
            "Jalisco": [20.6597, -103.3496],
            "Nuevo León": [25.6866, -100.3161],
            "Puebla": [19.0413, -98.2062],
            "Guanajuato": [20.9930, -101.1900]
            // Agrega más estados aquí...
        };

        // Array para almacenar los marcadores actuales
        var marcadores = [];

        // Función para limpiar los marcadores del mapa
        function limpiarMarcadores() {
            marcadores.forEach(function(marker) {
                map.removeLayer(marker);
            });
            marcadores = [];
        }

        // Función para mostrar los hospitales (agrupados por estado)
        function mostrarHospitales(estadoFiltro) {
            limpiarMarcadores();
            for (let estado in hospitales) {
                if (estadoFiltro && estado !== estadoFiltro) continue;
                // Usar coordenadas específicas del estado o el centro de México como fallback
                let coords = coordenadasEstados[estado] || [23.6345, -102.5528];
                // Contar municipios y hospitales
                let municipios = Object.keys(hospitales[estado]);
                let totalHospitales = 0;
                municipios.forEach(function(municipio) {
                    totalHospitales += hospitales[estado][municipio].length;
                });
                var marker = L.marker(coords).addTo(map)
                    .bindPopup(`<b>${estado}</b><br>${municipios.length} municipios<br>${totalHospitales} hospitales`);
                marcadores.push(marker);
            }
        }

        // Función para filtrar por estado
        function filtrarEstado() {
            var estado = document.getElementById('estado').value;
            mostrarHospitales(estado);
        }

        // Mostrar todos al cargar la página
        mostrarHospitales('');
    </script>
</body>
</html>
